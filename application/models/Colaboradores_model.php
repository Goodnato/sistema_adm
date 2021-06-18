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

    public function consultaTodosColaboradoresImport()
    {
        $sql = "SELECT
                    *
                FROM 
                    {$this->tabela}_import";

        $resultado = $this->db->query($sql)->result_array();

        return count($resultado) == 0 ? null : $resultado;
    }

    public function atualizaTodosColeboradores($todosColaboradoresImport)
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
                VALUES ";

        foreach ($todosColaboradoresImport as $colaborador) {
            $sql .= "(
                '" . trim($colaborador['id']) . "',
                '" . trim($colaborador['nome']) . "',
                '" . trim($colaborador['id_centro_custo']) . "',
                '" . trim($colaborador['cargo']) . "',
                '" . trim($colaborador['email']) . "',
                '" . trim($colaborador['gestor']) . "',
                '" . trim($colaborador['situacao']) . "',
                '" . trim($colaborador['empresa']) . "',
                '" . trim($colaborador['cidade']) . "',
                '" . trim($colaborador['matricula_coordenador']) . "'
            ),";
        }

        $sql = substr($sql, 0, -1);

        $this->db->query($sql);
    }
}
