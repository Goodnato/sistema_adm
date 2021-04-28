<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Distribuicoes_model extends CI_Model
{
    private $tabela = 'distribuicoes';

    public function consultaTodosColaboradoresCadastradosDistribuicao()
    {
        $sql = "SELECT DISTINCT
                    us.id, 
                    us.nome 
                FROM {$this->tabela} AS di 
                INNER JOIN usuarios AS us ON us.id = di.id_usuario_registro";

        return $this->db->query($sql)->result_array();
    }

    public function consultaTodasCidadesCadastradosDistribuicao()
    {
        $sql = "SELECT DISTINCT
                    cl.cidade 
                FROM {$this->tabela} AS di 
                INNER JOIN colaboradores AS cl ON cl.id = di.id_colaborador";

        return $this->db->query($sql)->result_array();
    }

    public function consultaTodasAreasCadastradasDistribuicao()
    {
        $sql = "SELECT DISTINCT
                    cc.area 
                FROM {$this->tabela} AS di 
                INNER JOIN colaboradores AS cl ON cl.id = di.id_colaborador
                INNER JOIN centro_custo AS cc ON cc.id = cl.id_centro_custo";

        return $this->db->query($sql)->result_array();
    }

    public function salvarDistribuicao($dadosDistribuicao)
    {
        $this->db->insert($this->tabela, $dadosDistribuicao);
    }

    public function listaDistribuicoes($procurarSql, $ordenar, $inicioLimite, $finalLimite)
    {
        $sql = "SELECT
                    dt.id AS id_distribuicao,
                    md.nome AS modelo,
                    li.numero_linha,
                    co.nome AS nome_colaborador,
                    cc.nome AS centro_custo,
                    co.cidade AS cidade,
                    IF(dt.id_status_disponibilidade = " . DISTRIBUICAO_DISPONIVEL . " , 'DEVOLVIDO', sd.nome) AS status_disponibilidade
                FROM
                    {$this->tabela} dt
                LEFT JOIN aparelhos ap ON ap.id = dt.id_aparelho
                LEFT JOIN modelos md ON md.id = ap.id_modelo
                LEFT JOIN linhas li ON li.id = dt.id_linha
                INNER JOIN colaboradores co ON co.id = dt.id_colaborador
                LEFT JOIN centro_custo cc ON cc.id = co.id_centro_custo
                INNER JOIN status_disponibilidades sd ON sd.id = dt.id_status_disponibilidade
                WHERE
                    1 = 1
                    $procurarSql
                ORDER BY {$ordenar['coluna']} {$ordenar['direcao']}
                LIMIT $inicioLimite, $finalLimite";

        return $this->db->query($sql)->result_array();
    }

    public function totalRegistroDistribuicoes()
    {
        $sql = "SELECT
                    COUNT(id) AS total
                FROM 
                    {$this->tabela}";

        $resultado = $this->db->query($sql)->result_array();

        return count($resultado) == 0 ? 0 : $resultado[0]['total'];
    }
}
