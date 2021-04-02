<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Linhas_model extends CI_Model
{
    private $tabela = 'linhas';

    public function consultaTodosUsuariosCadastroLinha()
    {
        $sql = "SELECT DISTINCT
                    us.id, 
                    us.nome 
                FROM {$this->tabela} AS li 
                INNER JOIN usuarios AS us ON us.id = li.id_usuario_registro";

        return $this->db->query($sql)->result_array();
    }

    public function salvarLinha($dadosLinha)
    {
        $this->db->insert($this->tabela, $dadosLinha);
    }
    
}