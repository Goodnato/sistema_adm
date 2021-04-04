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

    public function listaLinhas($procurarSql, $ordenar, $inicioLimite, $finalLimite)
    {
        $sql = "SELECT
                    li.id AS id_linha,
                    li.numero_linha AS numero_linha,
                    li.codigo_chip AS codigo_chip,
                    cg.nome AS nome_categoria,
                    op.nome AS nome_operadora,
                    li.pin_puk1,
                    li.pin_puk2,
                    us.nome AS registro_usuario,
                    ap.data_registro,
                    ap.status
                FROM
                    {$this->tabela} li
                INNER JOIN categorias cg ON cg.id = li.id_categoria
                INNER JOIN operadoras op ON op.id = li.id_operadora
                INNER JOIN usuarios us ON us.id = li.id_usuario_registro
                WHERE
                    1 = 1
                    $procurarSql
                ORDER BY {$ordenar['coluna']} {$ordenar['direcao']}
                LIMIT $inicioLimite, $finalLimite";

        return $this->db->query($sql)->result_array();
    }

    public function totalRegistroLinhasFiltradas($procurarSql)
    {
        $sql = "SELECT
                    COUNT(li.id) AS total
                FROM
                    {$this->tabela} li
                INNER JOIN categorias cg ON cg.id = li.id_categoria
                INNER JOIN operadoras op ON op.id = li.id_operadora
                INNER JOIN usuarios us ON us.id = li.id_usuario_registro
                WHERE
                    1 = 1
                    $procurarSql";

        $resultado = $this->db->query($sql)->result_array();

        return count($resultado) == 0 ? 0 : $resultado[0]['total'];
    }

    public function totalRegistroLinhas()
    {
        $sql = "SELECT
                    COUNT(id) AS total
                FROM 
                    {$this->tabela}";

        $resultado = $this->db->query($sql)->result_array();

        return count($resultado) == 0 ? 0 : $resultado[0]['total'];
    }

    
}