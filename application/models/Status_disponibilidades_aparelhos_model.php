<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Status_disponibilidades_aparelhos_model extends CI_Model
{
    private $tabela = 'status_disponibilidades_aparelhos';

    public function consultaTodosStatusAtivos()
    {
    	$sql = "SELECT id, nome FROM {$this->tabela} WHERE status = " . STATUS_ATIVO; 

    	$query = $this->db->query($sql);
    	
        return $query->result_array();
    }
}