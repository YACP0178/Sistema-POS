<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->Model('AuthModel');
		$this->load->Model('CustomerModel');
	}
	
	public function index()
	{
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['customer'] = $this->CustomerModel->getAll();
		$this->load->view('templates/customer/customerView', $data);
		$this->load->view('footerView');
	}


	public function insert(){
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['title'] = "Crear Cliente";
		$this->load->view('templates/customer/customerFormView', $data);
		$this->load->view('footerView');
	}

	public function edit($id){
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['title'] = "Editar Cliente";
		$data['customer'] = $this->CustomerModel->getId($id);
		$this->load->view('templates/customer/customerFormView', $data);
		$this->load->view('footerView');
	}

	public function save(){
		$arrData = $this->input->post('arrData');
		
		$id = $arrData['id'];
		$cc = $arrData['cc'];
		$name = $arrData['name'];
		$lastname = $arrData['lastname'];
		$email = $arrData['email'];
		$phone = $arrData['phone'];
		$address = $arrData['address'];

		$response = array (
				"status"     => 200,
	            "msg" => ""
	    );

	    if($cc == ''){
	    	$response["msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Numero de Cedula es Obligatorio</div>";
	    }else if($name == ''){
	    	$response["msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Nombre es Obligatorio</div>";
	    }else if($lastname == ''){
	    	$response["msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Apellido es Obligatorio</div>";
	    }else{
	    	if($id == ''){
	    		$this->CustomerModel->saveCustomer($arrData);
	    		$response["msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Informacion Guardada Correctamente</div>";
	    	}else{
	    		$this->CustomerModel->updateCustomer($arrData, $id);
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

	    $this->CustomerModel->deleteCustomer($id);
	    $response["msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Se eliminio el registro Correctamente</div>";
		
		echo json_encode($response);
	}

	public function searchCustomer(){
		$filtro   = $this->input->get("term");
		$customer = $this->CustomerModel->searchCustomer($filtro);
		echo json_encode($customer);
	}


}
?>