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

    public function editarLinha($idLinha, $dadosLinha)
    {
        $this->db->update($this->tabela, $dadosLinha, ['id' => $idLinha]);
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
                    li.id AS id_linha,
                    li.numero_linha,
                    li.codigo_chip,
                    li.id_categoria,
                    li.id_operadora,
                    cg.nome AS nome_categoria,
                    op.nome AS nome_operadora,
                    li.pin_puk1,
                    li.pin_puk2,    
                    us.nome AS nome_usuario_registro,
                    li.status,
                    sd.nome AS status_disponibilidade
                FROM
                    {$this->tabela} li
                INNER JOIN categorias cg ON cg.id = li.id_categoria
                INNER JOIN operadoras op ON op.id = li.id_operadora
                INNER JOIN usuarios us ON us.id = li.id_usuario_registro
                INNER JOIN status_disponibilidades sd ON sd.id = li.id_status_disponibilidade
                WHERE
                    li.id = $idLinha";

        $resultado = $this->db->query($sql)->result_array();

        return count($resultado) == 0 ? [] : $resultado[0];
    }

    public function consultaLinhaPeloNumero($numeroLinha)
    {
        $sql = "SELECT
                    li.id AS id_linha,
                    cg.nome AS categoria
                FROM 
                    {$this->tabela} li
                INNER JOIN categorias cg ON cg.id = li.id_categoria
                WHERE
                    li.numero_linha = '$numeroLinha'";

        $resultado = $this->db->query($sql)->result_array();

        return count($resultado) == 0 ? [] : $resultado[0];
    }

    public function consultaDisponibilidadeLinhaPorNumero($numeroLinha)
    {
        $sql = "SELECT
                    id_status_disponibilidade
                FROM 
                    {$this->tabela}
                WHERE
                    numero_linha = '$numeroLinha'
                    AND status = " . STATUS_ATIVO;

        $resultado = $this->db->query($sql)->result_array();

        return count($resultado) == 0 ? null : $resultado[0]['id_status_disponibilidade'];
    }
}
