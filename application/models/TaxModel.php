<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TaxModel extends CI_Model {
	
    public function getAll(){
        $sql="SELECT  * from tax where status = 1 and id > 0 ORDER BY  name ASC ";
        $query=$this->db->query($sql);
        return $query->result();
    }

    public function getId($id){
        $sql="SELECT  * from tax where id='".$id."' limit 1 ";
        $query=$this->db->query($sql);
        return $query->result();
    }

    public function saveTax($array){
        $id = 0;
        $this->db->trans_start();
        $this->db->insert('tax', $array);
        $id = $this->db->insert_id();
        $this->db->trans_complete();
    }
    
    public function updateTax($array,$id){
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('tax', $array); 
        $this->db->trans_complete();
    }

    public function deleteTax($id){
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('tax', array('status'=>0)); 
        $this->db->trans_complete();
    }
}

?>