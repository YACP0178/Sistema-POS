<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProductModel extends CI_Model {
	
    public function getAll(){
        $sql="SELECT  p.id, p.code, p.ref, p.description, p.category AS category, t.name AS nametax, t.value AS valuetax,c.name AS namecategory, p.coste, p.price, p.location from product AS p INNER JOIN category AS c ON p.category = c.id INNER JOIN tax AS t ON p.tax = t.id where p.status = 1 and p.id > 0 ORDER BY  p.description ASC ";
        $query=$this->db->query($sql);
        return $query->result();
    }

    public function getId($id){
        $sql="SELECT  * from product where id='".$id."' limit 1 ";
        $query=$this->db->query($sql);
        return $query->result();
    }

    public function saveProduct($array){
        $id = 0;
        $this->db->trans_start();
        $this->db->insert('product', $array);
        $id = $this->db->insert_id();
        $this->db->trans_complete();
    }
    
    public function updateProduct($array,$id){
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('product', $array); 
        $this->db->trans_complete();
    }

    public function deleteProduct($id){
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('product', array('status'=>0)); 
        $this->db->trans_complete();
    }


    public function searchProduct($filtro){
        $sql="SELECT concat(p.ref, ' ', p.description) AS label, p.id, p.ref, p.code, p.description, p.coste, p.price, t.value as tax  FROM product p  INNER JOIN tax AS t ON p.tax = t.id  WHERE (p.ref LIKE  '%".$filtro."%' or p.code = '".$filtro."' or p.description LIKE '%".$filtro."%') and p.status = 1";
        $query=$this->db->query($sql);
        return $query->result();
    }
}

?>