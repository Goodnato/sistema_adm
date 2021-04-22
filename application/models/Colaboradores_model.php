<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Colaboradores_model extends CI_Model
{
    private $tabela = 'colaboradores';

    public function consultaColaboradorPelaMatricula($matricula)
    {
        $sql = "SELECT
                    nome
                FROM 
                    {$this->tabela}
                WHERE
                    id = $matricula";

        $resultado = $this->db->query($sql)->result_array();

        return count($resultado) == 0 ? null : $resultado[0]['nome'];
    }

    public function consultaColaboradorImportPelaMatricula($matricula)
    {
        $sql = "SELECT
                    nome
                FROM 
                    {$this->tabela}_import
                WHERE
                    id = $matricula";

        $resultado = $this->db->query($sql)->result_array();

        return count($resultado) == 0 ? null : $resultado[0]['nome'];
    }
}
