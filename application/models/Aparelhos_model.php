<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Aparelhos_model extends CI_Model
{
    private $tabela = 'aparelhos';

    public function consultaTodosUsuariosCadastroAparelho()
    { 
    	$sql = "SELECT DISTINCT
                    us.id, 
                    us.nome 
                FROM {$this->tabela} AS ap 
                INNER JOIN usuarios AS us ON us.id = ap.id_usuario_registro";

    	$query = $this->db->query($sql);
    	
        return $query->result_array();
    }

    public function salvarAparelho($dadosAparelho)
    {
        $this->db->insert($this->tabela, $dadosAparelho);
    }
}