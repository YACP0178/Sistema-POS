<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class StockModel extends CI_Model {

    public function getAll(){
        $sql="SELECT s.id, s.cant, p.ref, p.description, p.unit, s.coste from stock AS s INNER JOIN product AS p ON s.product = p.id where s.status = 1 ORDER BY  p.description ASC ";
        $query=$this->db->query($sql);
        return $query->result();
    }
    
    public function getAllClosing(){
        $sql="SELECT * FROM closing WHERE status=1  ORDER BY date ASC";
        $query=$this->db->query($sql);
        return $query->result();
    }
    
    public function getIdClosing($id){
        $sql="SELECT * FROM closing WHERE status=1 and id=".$id."  ORDER BY date ASC";
        $query=$this->db->query($sql);
        return $query->result();
    }
    
    public function getIdClosingDt($closing){
        $sql="SELECT 
                 cdt.id, cat.id as categoryid, cat.name as categoryname,pro.id as product, pro.ref, pro.description, cdt.provider, pv.name as nameprovider , cdt.cant,cdt.coste
              FROM 
                closing_dt cdt 
                left join product pro on cdt.product = pro.id
                left join category cat on pro.category = cat.id
                left join provider pv on cdt.provider = pv.id
              WHERE 
                cdt.status=1 and 
                cdt.closing=".$closing."  
            ORDER BY cat.name, pro.description ASC";
        $query=$this->db->query($sql);
        return $query->result();
    }
    
    public function getResultClosing(){
        $sql="select 
	            cat.id as categoryid, cat.name as categoryname,'' as id, pro.id as product, pro.ref, pro.description, inp.provider, pv.name as nameprovider , st.coste, '' as cant
              from product pro 
              left join category cat on pro.category = cat.id
              inner join stock st on st.product = pro.id and st.status = 1
              inner join input_dt idt on idt.product = pro.id and st.status = 1
              inner join input inp on inp.id = idt.input and st.status = 1
              left join provider pv on inp.provider = pv.id
              where 
	            pro.status = 1
              group by inp.provider, pro.ref
              order by cat.name, pro.description";
        $query=$this->db->query($sql);
        return $query->result();
    }
    
    public function saveClosing($array){
        $id = 0;
        $this->db->trans_start();
        $this->db->insert('closing', $array);
        $id = $this->db->insert_id();
        $this->db->trans_complete();
        return $id;
    }

    public function saveClosingDetail($array){
        $this->db->trans_start();
        $this->db->insert('closing_dt', $array);
        $this->db->trans_complete();
    }
    
    public function updateClosing($array,$id){
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('closing', $array); 
        $this->db->trans_complete();
    }
    
    public function updateClosingDt($array,$id){
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('closing_dt', $array); 
        $this->db->trans_complete();
    }
    
    /*public function getIdClosing($idClosing){
        $sql="SELECT  * from closing_dt where closing='".$idClosing."' ";
        $query=$this->db->query($sql);
        return $query->result();
    }*/

    public function getId($idProduct){
        $sql="SELECT  * from stock where product='".$idProduct."' limit 1 ";
        $query=$this->db->query($sql);
        return $query->result();
    }
	
	public function saveStock($array){
        $this->db->trans_start();
        $this->db->insert('stock', $array);
        $this->db->trans_complete();
    }

    public function updateCant($id, $cant){
        $this->db->trans_start();
        $this->db->where('product', $id);
        $this->db->update('stock', array("cant"=>$cant)); 
        $this->db->trans_complete();
    }

    public function updateValue($id, $value){
        $this->db->trans_start();
        $this->db->where('product', $id);
        $this->db->update('stock', array("coste"=>$value)); 
        $this->db->trans_complete();
    }
   
}

?>