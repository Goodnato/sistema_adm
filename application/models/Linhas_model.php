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
                    IF(li.status = " . STATUS_ATIVO . " , 'ATIVO', 'INATIVO') AS status
                FROM
                    {$this->tabela} li
                INNER JOIN categorias cg ON cg.id = li.id_categoria
                INNER JOIN operadoras op ON op.id = li.id_operadora
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
                    
        //1 = constante STATUS_ATIVO
        $resultado = $this->db->query($sql)->result_array();

        return count($resultado) == 0 ? 0 : $resultado[0]['total'];
    }
    //1 =1  da consulta é utlizando pra quando não houver resultado na $procurarSQL
    public function totalRegistroLinhas()
    {
        $sql = "SELECT
                    COUNT(id) AS total
                FROM 
                    {$this->tabela}";

        $resultado = $this->db->query($sql)->result_array();

        return count($resultado) == 0 ? 0 : $resultado[0]['total'];
    }

    public function consultaLinhasPorId($idLinha)
    {
        $sql = "SELECT
                    ap.id AS id_aparelho,
                    ap.imei1 AS imei1,
                    md.nome AS nome_modelo,
                    mc.nome AS nome_marca,
                    ap.id_status_condicao_aparelho,
                    ap.nota_fiscal,
                    ap.data_nota,
                    REPLACE(ap.valor, '.', ',') AS valor,
                    ap.valor_depreciado,
                    us.nome AS nome_usuario_registro,
                    ap.status
                FROM
                    {$this->tabela} ap
                INNER JOIN marcas mc ON mc.id = ap.id_marca
                INNER JOIN modelos md ON md.id = ap.id_modelo
                INNER JOIN usuarios us ON us.id = ap.id_usuario_registro
                WHERE
                    ap.id = $idLinha";
        
        $resultado = $this->db->query($sql)->result_array();

        return count($resultado) == 0 ? [] : $resultado[0];
    }

    
}