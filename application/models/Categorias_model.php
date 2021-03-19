<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Categorias_model extends CI_Model
{
    public function consultaTodasCategoriasAtivas()
    { 

    	$sql = "SELECT id, nome FROM categorias WHERE status = " . STATUS_ATIVO; 

    	$query = $this->db->query($sql);
    	
        return $query->result_array();
    }
}