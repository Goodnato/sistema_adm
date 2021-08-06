<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cidades_model extends CI_Model
{
    private $tabela = 'cidades';

    public function consultaTodasCidades()
    { 
    	$sql = "SELECT id, nome FROM {$this->tabela}"; 

    	$query = $this->db->query($sql);
    	
        return $query->result_array();
    }

}