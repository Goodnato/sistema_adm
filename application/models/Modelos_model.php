<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Modelos_model extends CI_Model
{
    public function consultaTodosModelos()
    { 

    	$sql = "SELECT id, nome FROM modelos WHERE status = 1"; 

    	$query = $this->db->query($sql);
    	
        return $query->result_array();
    }
}