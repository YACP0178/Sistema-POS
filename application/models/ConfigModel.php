<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ConfigModel extends CI_Model {

	public function getAll(){
        $sql="SELECT  * from config where status = 1 limit 1 ";
        $query=$this->db->query($sql);
        return $query->result();
    }

    public function saveConfig($array){
        $id = 0;
        $this->db->trans_start();
        $this->db->insert('config', $array);
        $id = $this->db->insert_id();
        $this->db->trans_complete();
    }
    
    public function updateConfig($array,$id){
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('config', $array); 
        $this->db->trans_complete();
    }

}

?>