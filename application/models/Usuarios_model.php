<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios_model extends CI_Model
{
    private $tabela = 'usuarios';

    public function confereCredenciais($login, $senha)
    {
        $sql = "SELECT
                    *
                FROM
                    {$this->tabela}
                WHERE
                    login = '{$login}'
                    AND senha = '{$senha}'";

        return $this->db->query($sql)->result_array();
    }
}
