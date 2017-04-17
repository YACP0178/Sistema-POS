<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class InventoryModel extends CI_Model {

	public function getStock($stock){
		$status = 1;
        $this->db->select('i.date, i.movement, m.name AS movementname, i.user, i.ecant, i.evalue, i.scant, i.svalue, i.pcant, i.pvalue');
        $this->db->from('inventory i');
        $this->db->join('movement m', 'i.movement = m.id');
        $this->db->where('i.stock', $stock);
        $this->db->where('i.status', $status);
        $this->db->order_by('i.date', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
	
	public function saveInventory($array){
        $this->db->trans_start();
        $this->db->insert('inventory', $array);
        $this->db->trans_complete();
    }   
}

?>