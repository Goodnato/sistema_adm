<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Marcas_model extends CI_Model
{
    private $tabela = 'marcas';

    public function consultaTodasMarcas()
    { 
    	$sql = "SELECT id, nome FROM {$this->tabela}"; 

    	$query = $this->db->query($sql);
    	
        return $query->result_array();
    }

    public function consultaTodasMarcasPorStatus($status)
    { 
    	$sql = "SELECT id, nome FROM {$this->tabela} WHERE status = $status"; 

    	$query = $this->db->query($sql);
    	
        return $query->result_array();
    }
}