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
                    id = $matricula
                    AND status = 1";

        $resultado = $this->db->query($sql)->result_array();

        return count($resultado) == 0 ? null : $resultado[0]['nome'];
    }

    public function atualizaTodosColeboradores()
    {
        $sql =
            "REPLACE INTO {$this->tabela}
                (
                    id,
                    nome,
                    id_centro_custo,
                    cargo,
                    email,
                    gestor,
                    situacao,
                    empresa,
                    cidade,
                    matricula_coordenador
                )
                SELECT * FROM {$this->tabela}_import";

        $this->db->query($sql);
    }
}
