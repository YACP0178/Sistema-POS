<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model {
	
    public function getAll(){
        $sql="SELECT  * from user where status = 1 ORDER BY  name ASC ";
        $query=$this->db->query($sql);
        return $query->result();
    }

    public function getId($id){
        $sql="SELECT  * from user where id='".$id."' limit 1 ";
        $query=$this->db->query($sql);
        return $query->result();
    }

    public function saveUser($array){
        $id = 0;
        $this->db->trans_start();
        $this->db->insert('user', $array);
        $id = $this->db->insert_id();
        $this->db->trans_complete();
    }
    
    public function updateUser($array,$id){
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('user', $array); 
        $this->db->trans_complete();
    }

    public function deleteUser($id){
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('user', array('status'=>0)); 
        $this->db->trans_complete();
    }
}

?>