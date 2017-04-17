<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->Model('AuthModel');
		$this->load->Model('ConfigModel');
	}
	
	public function index()
	{
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['config'] = $this->ConfigModel->getAll();
		$this->load->view('templates/config/configFormView', $data);
		$this->load->view('footerView');
	}

	public function save(){
		$arrData = $this->input->post('arrData');
		
		$id = $arrData['id'];
		/*$company = $arrData['company'];
		$manager = $arrData['manager'];
		$nit = $arrData['nit'];
		$phone = $arrData['phone'];
		$address = $arrData['address'];
		$mean = $arrData['mean'];*/

		$response = array (
				"status"     => 200,
	            "msg" => ""
	    );

	    
	    if($id == ''){
    		$this->ConfigModel->saveConfig($arrData);
    		$response["msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Informacion Guardada Correctamente</div>";
    	}else{
    		$this->ConfigModel->updateConfig($arrData, $id);
    		$response["msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Informacion Actualizada Correctamente</div>";
    	}
	    

	    echo json_encode($response);
	}
}
?>