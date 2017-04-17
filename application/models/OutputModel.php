<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Bogota');

class OutputModel extends CI_Model {
	
	public function saveOnput($array){
        $id = 0;
        $this->db->trans_start();
        $this->db->insert('output', $array);
        $id = $this->db->insert_id();
        $this->db->trans_complete();
        return $id;
    }

    public function saveOnputDetail($array){
        $this->db->trans_start();
        $this->db->insert('output_dt', $array);
        $this->db->trans_complete();
    }


    public function codeSal(){
        $sql="SELECT  * from output order by id desc limit 1";
        $query=$this->db->query($sql);
        return $query->result();
    }

    public function selectOutput($id){
        $sql="SELECT  o.id, o.code, o.date, o.user, o.movement, o.customer, concat(c.name,' ',c.lastname) AS nameCustomer, m.name AS namemovement from output AS o INNER JOIN customer AS c ON o.customer = c.id JOIN movement AS m ON o.movement = m.id where o.status = 1 and o.id ='$id'";
        $query=$this->db->query($sql);
        return $query->result();
    }

    public function selectOutputDt($idOutput){
        $sql="SELECT o.id, o.product,p.ref, p.description, p.unit, t.value as tax,o.cant, o.value, o.discount from output_dt AS o INNER JOIN product AS p ON o.product = p.id INNER JOIN tax AS t ON p.tax = t.id where o.status = 1 and o.output ='$idOutput'";
        $query=$this->db->query($sql);
        return $query->result();
    }
}

?>