<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Aparelhos_model extends CI_Model
{
    private $tabela = 'aparelhos';

    public function consultaUsuariosCadastroAparelho()
    { 
    	$sql = "SELECT 
                    ap.id, 
                    us.nome 
                FROM {$this->tabela} AS ap 
                INNER JOIN usuarios AS us ON us.id = ap.id_usuario_registro";

    	$query = $this->db->query($sql);
    	
        return $query->result_array();
    }
}