<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Status_condicoes_model extends CI_Model
{
    public function consultaTodosStatus()
    {
    	$sql = "SELECT id, nome FROM status_condicoes WHERE status = 1"; 

    	$query = $this->db->query($sql);
    	
        return $query->result_array();
    }
}