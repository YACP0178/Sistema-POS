<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Bogota');

class InputModel extends CI_Model {
	

    public function saveInput($array){
        $id = 0;
        $this->db->trans_start();
        $this->db->insert('input', $array);
        $id = $this->db->insert_id();
        $this->db->trans_complete();
        return $id;
    }

    public function saveInputDetail($array){
        $this->db->trans_start();
        $this->db->insert('input_dt', $array);
        $this->db->trans_complete();
    }


    public function codeEnt(){
        $sql="SELECT  * from input order by id desc limit 1";
        $query=$this->db->query($sql);
        return $query->result();
    }

    public function selectInput($id){
        $sql="SELECT  i.id, i.code, i.date, i.user, i.movement, i.provider, concat(p.name,' ',p.lastname) AS nameProvider, m.name AS namemovement from input AS i INNER JOIN provider AS p ON i.provider = p.id JOIN movement AS m ON i.movement = m.id where p.status = 1 and i.id ='$id'";
        $query=$this->db->query($sql);
        return $query->result();
    }

    public function selectInputDt($idInput){
        $sql="SELECT i.id, i.product, p.description, i.cant, i.value, i.discount from input_dt AS i INNER JOIN product AS p ON i.product = p.id where p.status = 1 and i.input ='$idInput'";
        $query=$this->db->query($sql);
        return $query->result();
    }
}

?>