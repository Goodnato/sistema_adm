<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Operadoras_model extends CI_Model
{
    private $tabela = 'operadoras';

    public function consultaTodasOperadoras()
    { 
    	$sql = "SELECT id, nome FROM {$this->tabela}"; 

    	$query = $this->db->query($sql);
    	
        return $query->result_array();
    }


    public function consultaTodasOperadorasPorStatus($status)
    { 
    	$sql = "SELECT id, nome FROM {$this->tabela} WHERE status = $status"; 

    	$query = $this->db->query($sql);
    	
        return $query->result_array();
    }




}