<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Bogota');

class Input extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->Model('AuthModel');
		$this->load->Model('InputModel');
		$this->load->Model('ProductModel');
		$this->load->Model('MovementModel');
		$this->load->Model('ProviderModel');
		$this->load->Model('StockModel');
		$this->load->Model('InventoryModel');
		$this->load->Model('ConfigModel');
	}

	public function index()
	{
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['movement'] = $this->MovementModel->getES('E');
		$this->load->view('templates/input/inputView', $data);
		$this->load->view('footerView');
	}

	public function inputPrint($id)
	{
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['input'] = $this->InputModel->selectInput($id);
		$data['inputDt'] = $this->InputModel->selectInputDt($id);
		$this->load->view('templates/input/inputPrint',$data);
		$this->load->view('footerView');
	}


	public function save(){
		$arrData = json_decode($this->input->post('arrData'));
		
		$date = date('Y-m-j H:i:s');
		$code = $arrData->code;
		$provider = $arrData->provider;
		$movement = $arrData->movement;
		$detail = $arrData->arrDataDetail;
	

		$response = array (
				"status"     => 200,
	            "msg" => '',
	            "inputId" => ''
	    );

	    $sinCant = true;

	    if($movement == 2){
	    	foreach($detail as $det){
	    		$stock = $this->StockModel->getId($det->idproduct);
	    		if(count($stock) == 1){
		    		if($stock[0]->cant < $det->cant){
		    			$response["msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Producto ".$det->productname." no tiene cantidades en inventario</div>";
		    			$sinCant = false;
		    		}
		    	}else{
		    		$response["msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Producto ".$det->productname." no tiene cantidades en inventario</div>";
		    		$sinCant = false;
		    	}
	    	}
	    }


	    if($sinCant){
		    if($provider==""){
	            $response["msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Proveddor es Obligatorio</div>";
	        }else{
	        	if($code==""){
	        		if (count($this->InputModel->codeEnt()) == 1)
	        			$code = 'COP-'.strval(intval($this->InputModel->codeEnt()[0]->id)+1);
	        		else
	        			$code = 'COP-'.strval(1);
	        		
	        	}

	        	$input      = array(
	                'code'      => $code,
	                'date'      => $date,
	                'user'      => $this->session->userdata('userid'),
	                'provider'  => $provider,
	                'movement'  => $movement
	            );   

	        	$idinput = $this->InputModel->saveInput($input);
	        	

	        	foreach($detail as $detail){
	                
	                $inputDetail   = array(
		                'input'     => $idinput,
		                'product'   => $detail->idproduct,
		                'cant'      => $detail->cant,
		                'discount'  => $detail->desc,
		                'value'     => $detail->coste,
		                'flete'     => $detail->flete

	                ); 

	                $this->InputModel->saveInputDetail($inputDetail);

	                //******************Realizar Proceso de Inventario*******************
	                $stock = $this->StockModel->getId($detail->idproduct);

	                $stockValue = 0;
	                $stocKcant = 0;
	                $ecant = 0;
	                $evalue = 0;
	                $scant = 0;
	                $svalue = 0;
	                $pcant = 0;
	                $pvalue = 0;


	                $costeFlete = ($detail->coste+$detail->flete);

	                if(count($stock) == 1){
	                	$configMean = $this->ConfigModel->getAll();

	                	if ($configMean[0]->mean == 1){
                        	$stockValue = $stock[0]->coste;
                        }else{
                        	$stockValue = $costeFlete;
                        	$this->StockModel->updateValue($detail->idproduct, $stockValue);
                        }

                        


                		if($movement == 1){
                			
                			if ($configMean[0]->mean == 1){
                				if($stock[0]->coste != $costeFlete){
	                				$stockValue = (($stock[0]->coste*$stock[0]->cant)+($costeFlete*$detail->cant))/($detail->cant+$stock[0]->cant);
	                				$this->StockModel->updateValue($detail->idproduct, $stockValue);
                			    }
                			}
                			
                			$stocKcant = $stock[0]->cant + $detail->cant;
                			$ecant =  $detail->cant;
                			$evalue = $costeFlete;
                			$pcant =  $stock[0]->cant+$detail->cant;
                            $pvalue = $stockValue;
                		}else{
                			if ($configMean[0]->mean == 1){
	                			if($stock[0]->coste != $costeFlete){
	                				$stockValue = (($stock[0]->coste*$stock[0]->cant)-($costeFlete*$detail->cant))/($stock[0]->cant-$detail->cant);
	                				$this->StockModel->updateValue($detail->idproduct, $stockValue);
	                			}
	                	    }

                			$stocKcant = $stock[0]->cant - $detail->cant;
                			$scant = $detail->cant;
                			$svalue = $costeFlete;
                			$pcant = $stock[0]->cant-$detail->cant;
                            $pvalue = $stockValue;
                		}
	                	
	                	
	                    $this->StockModel->updateCant($detail->idproduct, $stocKcant);
	                }else{
	                	$arrStock = array(
			                'product'  => $detail->idproduct,
			                'cant'     => $detail->cant,
			                'coste'    => $costeFlete
		                ); 

		                $this->StockModel->saveStock($arrStock);
		                $stock = $this->StockModel->getId($detail->idproduct);

		                
		                $ecant = $detail->cant;
	        			$evalue = $costeFlete;
	        			$pcant = $detail->cant;
	                    $pvalue = $costeFlete;
	                }


	                $arrInventory = array(
		                'stock'     => $stock[0]->id,
		                'date'      => $date,
		                'movement'  => $movement,
		                'user'      => $this->session->userdata('userid'),
		                'ecant'      => $ecant,
		                'evalue'      => $evalue,
		                'scant'      => $scant,
		                'svalue'      => $svalue,
		                'pcant'      => $pcant,
		                'pvalue'      => $pvalue
	                ); 

	                $this->InventoryModel->saveInventory($arrInventory);
	                //****************Termina Proceso de inventario*****************
	            }

	            $response["inputId"] = $idinput;
	            $response["msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Informacion Guardada Correctamente</div>";


	        }
	    }

	    echo json_encode($response);
	}

}
?>