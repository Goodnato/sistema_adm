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

    public function editarAparelho($idAparelho, $dadosAparelho)
    {
        $this->db->update($this->tabela, $dadosAparelho, ['id' => $idAparelho]);
    }

    public function listaAparelhos($procurarSql, $ordenar, $totalPorPagina, $inicioPagina)
    {
        $sql = "SELECT
                    ap.id AS id_aparelho,
                    ap.imei1 AS imei1,
                    mc.nome AS nome_marca,
                    md.nome AS nome_modelo,
                    sc.nome AS status_condicao,
                    ap.id_usuario_registro AS usuario_registro,
                    CASE ap.id_status_condicao_aparelho
                        WHEN " . CONDICAO_MANUTENCAO . " THEN 'INDISPONIVEL'
                        WHEN " . CONDICAO_DESCARTADO . " THEN 'INDISPONIVEL'
                        ELSE sd.nome
                    END AS status_disponibilidade,
                    ap.valor
                FROM
                    {$this->tabela} ap
                INNER JOIN marcas mc ON mc.id = ap.id_marca
                INNER JOIN modelos md ON md.id = ap.id_modelo
                INNER JOIN status_condicoes_aparelhos sc ON sc.id = ap.id_status_condicao_aparelho
                INNER JOIN status_disponibilidades sd ON sd.id = ap.id_status_disponibilidade
                WHERE
                    1 = 1
                    $procurarSql
                ORDER BY {$ordenar['coluna']} {$ordenar['direcao']}
                LIMIT $totalPorPagina
                OFFSET $inicioPagina";

        return $this->db->query($sql)->result_array();
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

    public function totalRegistroAparelhosFiltrado($procurarSql)
    {
        $sql = "SELECT
                    COUNT(ap.id) AS total
                FROM
                    {$this->tabela} ap
                INNER JOIN marcas mc ON mc.id = ap.id_marca
                INNER JOIN modelos md ON md.id = ap.id_modelo
                INNER JOIN status_condicoes_aparelhos sc ON sc.id = ap.id_status_condicao_aparelho
                INNER JOIN status_disponibilidades sd ON sd.id = ap.id_status_disponibilidade
                WHERE
                    1 = 1
                    $procurarSql";

        $resultado = $this->db->query($sql)->result_array();

        return count($resultado) == 0 ? 0 : $resultado[0]['total'];
    }

    public function consultaAparelhosPorId($idAparelho)
    {
        $sql = "SELECT
                    ap.id AS id_aparelho,
                    ap.imei1 AS imei1,
                    ap.imei2 AS imei2,
                    md.nome AS nome_modelo,
                    mc.nome AS nome_marca,
                    ap.id_status_condicao_aparelho,
                    ap.nota_fiscal,
                    ap.data_nota,
                    REPLACE(ap.valor, '.', ',') AS valor,
                    ap.valor_depreciado,
                    us.nome AS nome_usuario_registro,
                    ap.status,
                    CASE ap.id_status_condicao_aparelho
                        WHEN " . CONDICAO_MANUTENCAO . " THEN 'INDISPONIVEL'
                        WHEN " . CONDICAO_DESCARTADO . " THEN 'INDISPONIVEL'
                        ELSE sd.nome
                    END AS status_disponibilidade
                FROM
                    {$this->tabela} ap
                INNER JOIN marcas mc ON mc.id = ap.id_marca
                INNER JOIN modelos md ON md.id = ap.id_modelo
                INNER JOIN usuarios us ON us.id = ap.id_usuario_registro
                INNER JOIN status_disponibilidades sd ON sd.id = ap.id_status_disponibilidade
                WHERE
                    ap.id = $idAparelho";

        $resultado = $this->db->query($sql)->result_array();

        return count($resultado) == 0 ? [] : $resultado[0];
    }

    public function consultaAparelhoPeloImei($imei)
    {
        $sql = "SELECT
                    ap.id AS id_aparelho,
                    md.nome AS modelo
                FROM 
                    {$this->tabela} ap
                INNER JOIN modelos md ON md.id = ap.id_modelo
                WHERE
                    ap.imei1 = $imei";

        $resultado = $this->db->query($sql)->result_array();

        return count($resultado) == 0 ? [] : $resultado[0];
    }

    public function consultaDisponibilidadeAparelhoPorImei($imei)
    {
        $sql = "SELECT
                    id_status_disponibilidade
                FROM 
                    {$this->tabela}
                WHERE
                    imei1 = $imei
                    AND status = " . STATUS_ATIVO;

        $resultado = $this->db->query($sql)->result_array();

        return count($resultado) == 0 ? null : $resultado[0]['id_status_disponibilidade'];
    }

    public function consultaCondicaoAparelhoPorImei($imei)
    {
        $sql = "SELECT
                    id_status_condicao_aparelho
                FROM 
                    {$this->tabela}
                WHERE
                    imei1 = $imei
                    AND status = " . STATUS_ATIVO;

        $resultado = $this->db->query($sql)->result_array();

        return count($resultado) == 0 ? null : $resultado[0]['id_status_condicao_aparelho'];
    }

    public function consultaTodosAparelhos()
    {
        $sql = "SELECT
                    *
                FROM
                    {$this->tabela}";

        return $this->db->query($sql)->result_array();
    }
}
