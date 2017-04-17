<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->Model('AuthModel');
		$this->load->Model('UserModel');
	}
	
	public function index()
	{
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['user'] = $this->UserModel->getAll();
		$this->load->view('templates/user/userView', $data);
		$this->load->view('footerView');
	}


	public function insert(){
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['title'] = "Crear Usuario";
		$this->load->view('templates/user/userFormView', $data);
		$this->load->view('footerView');
	}

	public function edit($id){
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['title'] = "Editar Usuario";
		$data['user'] = $this->UserModel->getId($id);
		$this->load->view('templates/user/userFormView', $data);
		$this->load->view('footerView');
	}

	public function save(){
		$arrData = $this->input->post('arrData');
		
		$id = $arrData['id'];
		$name = $arrData['name'];
		$lastname = $arrData['lastname'];
		$username = $arrData['username'];
		$password = $arrData['password'];
		$password2 = $arrData['password2'];

		$response = array (
				"status"     => 200,
	            "msg" => ""
	    );

	    if($name == ''){
	    	$response["msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Nombre es Obligatorio</div>";
	    }else if($lastname == ''){
	    	$response["msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Apellido es Obligatorio</div>";
	    }else if($username == ''){
	    	$response["msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Usuario es Obligatorio</div>";
	    }else if($password == ''){
	    	$response["msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>La Clave es Obligatorio</div>";
	    }else if($password2 == ''){
	    	$response["msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>La confirmacion de la clave es Obligatorio</div>";
	    }else{
	    	unset($arrData['password2']);
	    	if($id == ''){
	    		$this->UserModel->saveUser($arrData);
	    		$response["msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Informacion Guardada Correctamente</div>";
	    	}else{
	    		$this->UserModel->updateUser($arrData, $id);
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

	    $this->UserModel->deleteUser($id);
	    $response["msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Se eliminio el registro Correctamente</div>";
		
		echo json_encode($response);
	}


}
?>