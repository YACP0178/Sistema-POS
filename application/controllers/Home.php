<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->Model('AuthModel');
	}
	
	public function index()
	{
		$this->AuthModel->isLogged();
		$this->load->view('headerView');
		$this->load->view('templates/home/homeView');
		$this->load->view('footerView');
	}
}
?>