<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Logs_alteracoes_model extends CI_Model
{
    private $tabela = 'logs_alteracoes';

    public function registrarLog($dadosLog)
    {
        $this->db->insert($this->tabela, $dadosLog);
    }
}
