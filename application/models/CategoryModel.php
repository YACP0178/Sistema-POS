<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CategoryModel extends CI_Model {
	
    public function getAll(){
        $sql="SELECT  * from category where status = 1 ORDER BY  id, name desc ";
        $query=$this->db->query($sql);
        return $query->result();
    }

    public function getId($id){
        $sql="SELECT  * from category where id='".$id."' limit 1 ";
        $query=$this->db->query($sql);
        return $query->result();
    }

    public function saveCategory($array){
        $id = 0;
        $this->db->trans_start();
        $this->db->insert('category', $array);
        $id = $this->db->insert_id();
        $this->db->trans_complete();
    }
    
    public function updateCategory($array,$id){
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('category', $array); 
        $this->db->trans_complete();
    }

    public function deleteCategory($id){
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('category', array('status'=>0)); 
        $this->db->trans_complete();
    }
}

?>