<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->Model('AuthModel');
		$this->load->Model('ProductModel');
		$this->load->Model('CategoryModel');
		$this->load->Model('TaxModel');
	}
	
	public function index()
	{
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['product'] = $this->ProductModel->getAll();
		$this->load->view('templates/product/productView', $data);
		$this->load->view('footerView');
	}


	public function insert(){
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['title'] = "Crear Producto";
		$data['category'] = $this->CategoryModel->getAll();
		$data['tax'] = $this->TaxModel->getAll();
		$this->load->view('templates/product/productFormView', $data);
		$this->load->view('footerView');
	}

	public function edit($id){
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$data['title'] = "Editar Producto";
		$data['product'] = $this->ProductModel->getId($id);
		$data['tax'] = $this->TaxModel->getAll();
		$this->load->view('templates/product/productFormView', $data);
		$this->load->view('footerView');
	}

	public function save(){
		$arrData = $this->input->post('arrData');
		
		$id = $arrData['id'];
		$code = $arrData['code'];
		$ref = $arrData['ref'];
		$description = $arrData['description'];
		$category = $arrData['category'];
		$tax = $arrData['tax'];
		$coste = $arrData['coste'];
		$price = $arrData['price'];
		$stockmin = $arrData['stockmin'];
		$location = $arrData['location'];
		$unit = $arrData['unit'];

		$response = array (
				"status"     => 200,
	            "msg" => ""
	    );

	    if($ref == ''){
	    	$response["msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>La Referencia es Obligatorio</div>";
	    }else if($description == ''){
	    	$response["msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>La Descripción es Obligatorio</div>";
	    }else if($coste == ''){
	    	$response["msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Valor Costo es Obligatorio</div>";
	    }else if($price == ''){
	    	$response["msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Valor Precio es Obligatorio</div>";
	    }else if(intval($coste) >= intval($price)){
	    	$response["msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Valor Precio debe ser mayor al Valor costo</div>";
	    }else{
	    	if($id == ''){
	    		$this->ProductModel->saveProduct($arrData);
	    		$response["msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Informacion Guardada Correctamente</div>";
	    	}else{
	    		$this->ProductModel->updateProduct($arrData, $id);
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

	    $this->ProductModel->deleteProduct($id);
	    $response["msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Se eliminio el registro Correctamente</div>";
		
		echo json_encode($response);
	}

	public function searchProduct(){
		$filtro   = $this->input->get("term");
		$product = $this->ProductModel->searchProduct($filtro);
		echo json_encode($product);
	}


}
?>