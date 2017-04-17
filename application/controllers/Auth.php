<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->Model('AuthModel');
	}

	public function index()
	{
		$this->load->view('loginView');
	}

	public function login()
	{

		$arrData = $this->input->post('arrData');

		$username = $arrData['username'];
		$password = $arrData['password'];


		$response = array (
				"status"     => "",
	            "error_msg" => "",
	            "login" => ""
	    );

		$user = $this->AuthModel->login($username, $password);


	    if(count($user) == 1){
	    	$response['status'] = 200;
	    	$response['login'] = "true";
	    	$sessionData = array(
	    		    'userid'=> $user->id,
	    			'username'=> $user->username,
	    			'name'=> $user->name,
	    			'lastname'=> $user->lastname,
	    			'isLogin' => true
 	    		);

	    	$this->session->set_userdata($sessionData);

	    }else{
	    	$response['status'] = 200;
	    	$response['login'] = "false";
	    	$response['error_msg'] = 'Usuario Incorrecto';
	    }

	    echo json_encode($response);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/','refresh');
		exit;
	}

}
