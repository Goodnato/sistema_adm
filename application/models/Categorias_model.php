<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Categorias_model extends CI_Model
{
    private $tabela = 'categorias';

    public function consultaTodasCategorias()
    { 
    	$sql = "SELECT id, nome FROM {$this->tabela}"; 

    	$query = $this->db->query($sql);
    	
        return $query->result_array();
    }


    public function consultaTodasCategoriasPorStatus($status)
    { 
    	$sql = "SELECT id, nome FROM {$this->tabela} WHERE status = $status"; 

    	$query = $this->db->query($sql);
    	
        return $query->result_array();
    }




}