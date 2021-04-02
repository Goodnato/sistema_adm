<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Status_disponibilidades_model extends CI_Model
{
    private $tabela = 'status_disponibilidades';

    public function consultaTodosStatus()
    {
    	$sql = "SELECT id, nome FROM {$this->tabela}"; 

    	$query = $this->db->query($sql);
    	
        return $query->result_array();
    }
}