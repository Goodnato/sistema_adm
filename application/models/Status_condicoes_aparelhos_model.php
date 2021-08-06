<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Status_condicoes_aparelhos_model extends CI_Model
{
    private $tabela = 'status_condicoes_aparelhos';

    public function consultaTodosStatus()
    {
    	$sql = "SELECT id, nome FROM {$this->tabela}
        WHERE status = 1"; 

    	$query = $this->db->query($sql);
    	
        return $query->result_array();
    }
}