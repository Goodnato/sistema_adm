<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Categorias_model extends CI_Model
{
    public function consultaTodasCategorias()
    { 

    	$sql = "SELECT id, nome FROM categorias WHERE status = 1"; 

    	$query = $this->db->query($sql);
    	
        return $query->result_array();
    }
}