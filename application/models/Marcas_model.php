<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Marcas_model extends CI_Model
{
    private $tabela = 'marcas';

    public function consultaTodasMarcasAtivas()
    { 
    	$sql = "SELECT id, nome FROM {$this->tabela} WHERE status = " . STATUS_ATIVO; 

    	$query = $this->db->query($sql);
    	
        return $query->result_array();
    }
}