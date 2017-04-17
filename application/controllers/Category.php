<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->Model('AuthModel');
		$this->load->Model('CategoryModel');
	}
	
	public function index()
	{
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['category'] = $this->CategoryModel->getAll();
		$this->load->view('templates/category/categoryView', $data);
		$this->load->view('footerView');
	}


	public function insert(){
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['title'] = "Crear Categoria";
		$this->load->view('templates/category/categoryFormView', $data);
		$this->load->view('footerView');
	}

	public function edit($id){
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['title'] = "Editar Categoria";
		$data['category'] = $this->CategoryModel->getId($id);
		$this->load->view('templates/category/categoryFormView', $data);
		$this->load->view('footerView');
	}

	public function save(){
		$arrData = $this->input->post('arrData');
		
		$id = $arrData['id'];
		$code = $arrData['code'];
		$name = $arrData['name'];
		
		$response = array (
				"status"     => 200,
	            "msg" => ""
	    );

	    if($code == ''){
	    	$response["msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Codigo es Obligatorio</div>";
	    }else if($name == ''){
	    	$response["msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Nombre es Obligatorio</div>";
	    }else{
	    	if($id == ''){
	    		$this->CategoryModel->saveCategory($arrData);
	    		$response["msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Informacion Guardada Correctamente</div>";
	    	}else{
	    		$this->CategoryModel->updateCategory($arrData, $id);
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

	    $this->CategoryModel->deleteCategory($id);
	    $response["msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Se eliminio el registro Correctamente</div>";
		
		echo json_encode($response);
	}


}
?>