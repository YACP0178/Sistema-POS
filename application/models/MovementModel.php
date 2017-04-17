<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MovementModel extends CI_Model {
    
    public function getES($es){
        $sql="SELECT  * from movement where status = 1 and type = '$es' ORDER BY  name ASC ";
        $query=$this->db->query($sql);
        return $query->result();
    }
}

?>