<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Logs_alteracoes_model extends CI_Model
{
    private $tabela = 'logs_alteracoes';

    public function registrarLog($dadosLog)
    {
        $this->db->insert($this->tabela, $dadosLog);
    }

    public function consultarLog($tabela, $identificador)
    {
        $sql = "SELECT
                    lg.*,
                    DATE_FORMAT(lg.data_registro, '%d/%m/%Y') AS data_registro,
                    u.nome AS nome_usuario
                FROM
                    {$this->tabela} lg
                INNER JOIN usuarios u ON u.id = lg.id_usuario
                WHERE
                    lg.tabela = '$tabela'
                    AND lg.identificador = $identificador";

        return $this->db->query($sql)->result_array();
    }
}
