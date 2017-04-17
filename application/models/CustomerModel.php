<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CustomerModel extends CI_Model {
	
    public function getAll(){
        $sql="SELECT  * from customer where status = 1 ORDER BY  name, lastname ASC ";
        $query=$this->db->query($sql);
        return $query->result();
    }

    public function getId($id){
        $sql="SELECT  * from customer where id='".$id."' limit 1 ";
        $query=$this->db->query($sql);
        return $query->result();
    }

    public function saveCustomer($array){
        $id = 0;
        $this->db->trans_start();
        $this->db->insert('customer', $array);
        $id = $this->db->insert_id();
        $this->db->trans_complete();
    }
    
    public function updateCustomer($array,$id){
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('customer', $array); 
        $this->db->trans_complete();
    }

    public function deleteCustomer($id){
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('customer', array('status'=>0)); 
        $this->db->trans_complete();
    }

    public function searchCustomer($filtro){
        $sql="SELECT concat(name, ' ', lastname) AS label, id, cc, name, lastname  FROM customer   WHERE (name LIKE  '%".$filtro."%' or cc LIKE '%".$filtro."%' or lastname LIKE '%".$filtro."%') and status = 1";
        $query=$this->db->query($sql);
        return $query->result();
    }
}

?>