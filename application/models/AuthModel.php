<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AuthModel extends CI_Model {
	
    public function login($username, $password){
          //$password = sha1($password);
     	  
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$row = $this->db->get('user')->row();
		return $row;
    }

    public function isLogged(){
    	$isLogged = $this->session->userdata('isLogin');

    	if(!isset($isLogged) || $isLogged != "true"){
    		redirect('/');
    		exit();
    	}
    }
}

?>