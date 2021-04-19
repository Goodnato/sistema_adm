<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Modelos_model extends CI_Model
{
    private $tabela = 'modelos';
    
    public function consultaTodosModelos()
    { 
    	$sql = "SELECT id, nome FROM {$this->tabela}"; 

    	$query = $this->db->query($sql);
    	
        return $query->result_array();
    }

    public function consultaTodosModelosPorStatus($status)
    { 
    	$sql = "SELECT id, nome FROM {$this->tabela} WHERE status = $status"; 

    	$query = $this->db->query($sql);
    	
        return $query->result_array();
    }

    public function consultaMarcaPorModeloPorStatus($idModelo, $status = STATUS_ATIVO)
    {
        $sql = "SELECT 
                    mc.id, 
                    mc.nome 
                FROM {$this->tabela} AS md 
                INNER JOIN marcas AS mc ON mc.id = md.id_marca
                WHERE 
                    md.id = $idModelo
                    AND mc.status = $status";

    	$query = $this->db->query($sql);
    	
        return count($query->result_array()) == 0 ? [] : $query->result_array()[0];
    }

}