<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->Model('AuthModel');
		$this->load->Model('StockModel');
		$this->load->Model('InventoryModel');
	}
	
	public function index()
	{
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['stock'] = $this->StockModel->getAll();
		$this->load->view('templates/stock/stockView', $data);
		$this->load->view('footerView');
	}
	
	public function closing()
	{
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['closing'] = $this->StockModel->getAllClosing();
		$this->load->view('templates/stock/closingView', $data);
		$this->load->view('footerView');
	}
	
	public function closingPrint($id)
	{
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['closing'] = $this->StockModel->getIdClosing($id);
		$data['closingDt'] = $this->StockModel->getIdClosingDt($id);
		$this->load->view('templates/stock/closingPrint', $data);
		$this->load->view('footerView');
	}
	
	public function closingInsert(){
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['closingDt'] = $this->StockModel->getResultClosing();
		$this->load->view('templates/stock/closingFormView', $data);
		$this->load->view('footerView');
	}
	
	public function closingEdit($id){
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['closing'] = $this->StockModel->getIdClosing($id);
		$data['closingDt'] = $this->StockModel->getIdClosingDt($id);
		$this->load->view('templates/stock/closingFormView', $data);
		$this->load->view('footerView');
	}
	
	public function closingSave(){
		$arrData = json_decode($this->input->post('arrData'));
		
		$response = array (
				"status"     => 201,
				"idclosing"     => '',
	            "msg" => '',
	    );
		
		$id = $arrData->id;
		$date = $arrData->date;
		$description = $arrData->description;
		$detail = $arrData->arrDataDetail;
		
		$closing      =  array(
            'date'             => $date,
            'description'      => $description
	    );
	    
	    
	    if($id == ''){
	    	$idclosing = $this->StockModel->saveClosing($closing);	
	    }else{
	    	$idclosing = $id;
	    	$this->StockModel->updateClosing($closing, $id);
	    }
	    
	    
	    foreach($detail as $detail){
	    	$iddetail = $detail->id;
	                
            $closingDetail   = array(
                'closing'     => $idclosing,
                'product'   => $detail->product,
                'cant'      => $detail->cant,
                'provider'  => $detail->provider,
                'coste'     => $detail->coste

            ); 
            
            if($iddetail == ''){
            	$this->StockModel->saveClosingDetail($closingDetail);
            }else{
            	$this->StockModel->updateClosingDt($closingDetail, $iddetail);
            }
            
	    }
	    
	    $response["status"] = 200;
	    $response["idclosing"] = $idclosing;
	    echo json_encode($response);
	}

	public function inventory($id)
	{
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['inventory'] = $this->InventoryModel->getStock($id);
		$this->load->view('templates/stock/inventoryView', $data);
		$this->load->view('footerView');
	}


}
?>