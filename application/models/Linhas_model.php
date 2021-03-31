<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Linhas_model extends CI_Model
{
    private $tabela = 'linhas';

    public function salvarLinha($dadosLinha)
    {
        $this->db->insert($this->tabela, $dadosLinha);
    }
    
}