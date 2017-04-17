<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provider extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->Model('AuthModel');
		$this->load->Model('ProviderModel');
	}
	
	public function index()
	{
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['provider'] = $this->ProviderModel->getAll();
		$this->load->view('templates/provider/providerView', $data);
		$this->load->view('footerView');
	}


	public function insert(){
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['title'] = "Crear Proveedor";
		$this->load->view('templates/provider/providerFormView', $data);
		$this->load->view('footerView');
	}

	public function edit($id){
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['title'] = "Editar Proveedor";
		$data['provider'] = $this->ProviderModel->getId($id);
		$this->load->view('templates/provider/providerFormView', $data);
		$this->load->view('footerView');
	}

	public function save(){
		$arrData = $this->input->post('arrData');
		
		$id = $arrData['id'];
		$nit = $arrData['nit'];
		$name = $arrData['name'];
		$lastname = $arrData['lastname'];
		$email = $arrData['email'];
		$phone = $arrData['phone'];
		$address = $arrData['address'];

		$response = array (
				"status"     => 200,
	            "msg" => ""
	    );

	    if($nit == ''){
	    	$response["msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Numero NIT es Obligatorio</div>";
	    }else if($name == ''){
	    	$response["msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Nombre es Obligatorio</div>";
	    }else if($lastname == ''){
	    	$response["msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Apellido es Obligatorio</div>";
	    }else{
	    	if($id == ''){
	    		$this->ProviderModel->saveProvider($arrData);
	    		$response["msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Informacion Guardada Correctamente</div>";
	    	}else{
	    		$this->ProviderModel->updateProvider($arrData, $id);
	    		$response["msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Informacion Actualizada Correctamente</div>";
	    	}
	    }

	    echo json_encode($response);
	}

	public function delete(){
		$arrData = $this->input->post('arrData');

		$id = $arrData['id'];

		$response = array (
				"status"     => 200,
	            "msg" => ""
	    );

	    $this->ProviderModel->deleteProvider($id);
	    $response["msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Se eliminio el registro Correctamente</div>";
		
		echo json_encode($response);
	}

	public function searchProvider(){
		$filtro   = $this->input->get("term");
		$provider = $this->ProviderModel->searchProvider($filtro);
		echo json_encode($provider);
	}


}
?>