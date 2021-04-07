<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Aparelhos_model extends CI_Model
{
    private $tabela = 'aparelhos';

    public function consultaTodosUsuariosCadastroAparelho()
    {
        $sql = "SELECT DISTINCT
                    us.id, 
                    us.nome 
                FROM {$this->tabela} AS ap 
                INNER JOIN usuarios AS us ON us.id = ap.id_usuario_registro";

        return $this->db->query($sql)->result_array();
    }

    public function salvarAparelho($dadosAparelho)
    {
        $this->db->insert($this->tabela, $dadosAparelho);
    }

    public function listaAparelhos($procurarSql, $ordenar, $inicioLimite, $finalLimite)
    {
        $sql = "SELECT
                    ap.id AS id_aparelho,
                    ap.imei1 AS imei1,
                    mc.nome AS nome_marca,
                    md.nome AS nome_modelo,
                    sc.nome AS status_condicao,
                    ap.nota_fiscal,
                    DATE_FORMAT(ap.data_nota, '%d/%m/%Y') AS data_nota,
                    REPLACE(ap.valor, '.', ',') AS valor,
                    ap.valor_depreciado,
                    us.nome AS registro_usuario,
                    DATE_FORMAT(ap.data_registro, '%d/%m/%Y') AS data_registro,
                    IF(ap.status = " . STATUS_ATIVO . " , 'ATIVO', 'INATIVO') AS status
                FROM
                    {$this->tabela} ap
                INNER JOIN marcas mc ON mc.id = ap.id_marca
                INNER JOIN modelos md ON md.id = ap.id_modelo
                INNER JOIN status_condicoes_aparelhos sc ON sc.id = ap.id_status_condicao_aparelho
                INNER JOIN usuarios us ON us.id = ap.id_usuario_registro
                WHERE
                    1 = 1
                    $procurarSql
                ORDER BY {$ordenar['coluna']} {$ordenar['direcao']}
                LIMIT $inicioLimite, $finalLimite";

        return $this->db->query($sql)->result_array();
    }

    public function totalRegistroAparelhosFiltrados($procurarSql)
    {
        $sql = "SELECT
                    COUNT(ap.id) AS total
                FROM
                    {$this->tabela} ap
                INNER JOIN marcas mc ON mc.id = ap.id_marca
                INNER JOIN modelos md ON md.id = ap.id_modelo
                INNER JOIN status_condicoes_aparelhos sc ON sc.id = ap.id_status_condicao_aparelho
                INNER JOIN usuarios us ON us.id = ap.id_usuario_registro
                WHERE
                    1 = 1
                    $procurarSql";

        $resultado = $this->db->query($sql)->result_array();

        return count($resultado) == 0 ? 0 : $resultado[0]['total'];
    }

    public function totalRegistroAparelhos()
    {
        $sql = "SELECT
                    COUNT(id) AS total
                FROM 
                    {$this->tabela}";

        $resultado = $this->db->query($sql)->result_array();

        return count($resultado) == 0 ? 0 : $resultado[0]['total'];
    }
}
