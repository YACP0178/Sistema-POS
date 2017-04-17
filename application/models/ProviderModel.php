<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProviderModel extends CI_Model {
	
    public function getAll(){
        $sql="SELECT  * from provider where status = 1 ORDER BY  name ASC ";
        $query=$this->db->query($sql);
        return $query->result();
    }

    public function getId($id){
        $sql="SELECT  * from provider where id='".$id."' limit 1 ";
        $query=$this->db->query($sql);
        return $query->result();
    }

    public function saveProvider($array){
        $id = 0;
        $this->db->trans_start();
        $this->db->insert('provider', $array);
        $id = $this->db->insert_id();
        $this->db->trans_complete();
    }
    
    public function updateProvider($array,$id){
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('provider', $array); 
        $this->db->trans_complete();
    }

    public function deleteProvider($id){
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('provider', array('status'=>0)); 
        $this->db->trans_complete();
    }

    public function searchProvider($filtro){
        $sql="SELECT concat(name, ' ', lastname) AS label, id, nit, name, lastname  FROM provider   WHERE (nit LIKE  '%".$filtro."%' or name LIKE '%".$filtro."%' or lastname LIKE '%".$filtro."%') and status = 1";
        $query=$this->db->query($sql);
        return $query->result();
    }
}

?>