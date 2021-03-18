<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Marcas_model extends CI_Model
{
    public function consultaTodasMarcas()
    { 

    	$sql = "SELECT id, nome FROM marcas WHERE status = 1"; 

    	$query = $this->db->query($sql);
    	
        return $query->result_array();
    }
}