<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Bogota');

class Output extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->Model('AuthModel');
		$this->load->Model('OutputModel');
		$this->load->Model('MovementModel');
		$this->load->Model('StockModel');
		$this->load->Model('InventoryModel');
		$this->load->Model('ConfigModel');
	}

	public function index()
	{
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['movement'] = $this->MovementModel->getES('S');
		$this->load->view('templates/output/outputView', $data);
		$this->load->view('footerView');
	}

	public function outputPrint($id)
	{
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['output'] = $this->OutputModel->selectOutput($id);
		$data['outputDt'] = $this->OutputModel->selectOutputDt($id);
		$data['config'] = $this->ConfigModel->getAll();
		$this->load->view('templates/output/outputPrint', $data);
		$this->load->view('footerView');
	}

	public function save(){
		$arrData = json_decode($this->input->post('arrData'));

		
		$date = date('Y-m-j H:i:s');
		$code = $arrData->code;
		$customer = $arrData->customer;
		$movement = $arrData->movement;
		$detail = $arrData->arrDataDetail;
	

		$response = array (
				"status"     => 200,
	            "msg" => '',
	            "outputId" => ''
	    );

	    $sinCant = true;

	    if($movement == 3){
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
		    if($customer==""){
	            $response["msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Cliente es Obligatorio</div>";
	        }else{
	        	if($code==""){
	        		if (count($this->OutputModel->codeSal()) == 1)
	        			$code = 'VEN-'.strval(intval($this->OutputModel->codeSal()[0]->id)+1);
	        		else
	        			$code = 'VEN-'.strval(1);
	        	}

	        	$output      = array(
	                'code'      => $code,
	                'date'      => $date,
	                'user'      => $this->session->userdata('userid'),
	                'customer'  => $customer,
	                'movement'  => $movement
	            );   

	        	$idoutput = $this->OutputModel->saveOnput($output);
	        	

	        	foreach($detail as $detail){
	                
	                $outputDetail   = array(
		                'output'     => $idoutput,
		                'product'   => $detail->idproduct,
		                'cant'      => $detail->cant,
		                'discount'  => $detail->desc,
		                'value'     => $detail->price

	                ); 

	                $this->OutputModel->saveOnputDetail($outputDetail);

	                //******************Realizar Proceso de Inventario*******************
	                $stock = $this->StockModel->getId($detail->idproduct);
	                $stockValue = 0;
	                $stocKcant = $detail->cant;
	                $ecant = 0;
	                $evalue = 0;
	                $scant = 0;
	                $svalue = 0;
	                $pcant = 0;
	                $pvalue = 0;


	                if(count($stock) == 1){
	                	$stockValue = $stock[0]->coste;
	                	if($movement == 4){
                			/*if($stock[0]->coste != $detail->price){
                				$stockValue = (($stock[0]->coste*$stock[0]->cant)+($detail->price*$detail->cant))/($detail->cant+$stock[0]->cant);
                				$this->StockModel->updateValue($detail->idproduct, $stockValue);
                			}*/
                			$stocKcant = $stock[0]->cant + $detail->cant;
                			$ecant =  $detail->cant;
                			$evalue = $stock[0]->coste;
                			$pcant =  $stock[0]->cant+$detail->cant;
                            $pvalue = $stockValue;
                		}else{
                			/*if($stock[0]->coste != $detail->price){
                				$stockValue = (($stock[0]->coste*$stock[0]->cant)-($detail->price*$detail->cant))/($stock[0]->cant-$detail->cant);
                				$this->StockModel->updateValue($detail->idproduct, $stockValue);
                			}*/
                			$stocKcant = $stock[0]->cant - $detail->cant;
                			$scant = $detail->cant;
                			$svalue = $stock[0]->coste;
                			$pcant = $stock[0]->cant-$detail->cant;
                            $pvalue = $stockValue;
                		}
	                	
	                	
	                    $this->StockModel->updateCant($detail->idproduct, $stocKcant);
	                }else{
	                	$arrStock = array(
			                'product'  => $detail->idproduct,
			                'cant'     => $detail->cant,
			                'coste'    => $detail->price
		                ); 

		                $this->StockModel->saveStock($arrStock);
		                $stock = $this->StockModel->getId($detail->idproduct);

		                
		                $ecant = $detail->cant;
	        			$evalue = $detail->price;
	        			$pcant = $detail->cant;
	                    $pvalue = $detail->price;
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

	            $response["outputId"] = $idoutput;
	            $response["msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Informacion Guardada Correctamente</div>";


	        }
	    }

	    echo json_encode($response);
	}
}
?>