<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Distribuicoes_model extends CI_Model
{
    private $tabela = 'distribuicoes';

    public function consultaTodosColaboradoresCadastradosDistribuicao()
    {
        $sql = "SELECT DISTINCT
                    co.id, 
                    co.nome 
                FROM {$this->tabela} AS di 
                INNER JOIN colaboradores AS co ON co.id = di.id_colaborador";

        return $this->db->query($sql)->result_array();
    }

    public function consultaTodasCidadesCadastradosDistribuicao()
    {
        $sql = "SELECT DISTINCT
                    cl.cidade 
                FROM {$this->tabela} AS di 
                INNER JOIN colaboradores AS cl ON cl.id = di.id_colaborador
                WHERE cl.cidade IS NOT NULL";

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

    public function listaDistribuicoes($procurarSql, $ordenar, $totalPorPagina, $inicioPagina)
    {
        $sql = "SELECT
                    dt.id AS id_distribuicao,
                    md.nome AS modelo,
                    li.numero_linha,
                    ap.imei1 AS imei,
                    CONCAT(co.nome, ' (', co.id, ')') AS nome_colaborador,
                    CONCAT(cc.id, ' (', cc.area, ')') AS centro_custo,
                    cd.nome AS cidade,
                    IF(dt.id_status_disponibilidade = " . DISTRIBUICAO_DISPONIVEL . " , 'DEVOLVIDO', sd.nome) AS status_disponibilidade
                FROM
                    {$this->tabela} dt
                LEFT JOIN aparelhos ap ON ap.id = dt.id_aparelho
                LEFT JOIN modelos md ON md.id = ap.id_modelo
                LEFT JOIN linhas li ON li.id = dt.id_linha
                INNER JOIN colaboradores co ON co.id = dt.id_colaborador
                INNER JOIN cidades cd ON cd.id = ap.id_cidade
                LEFT JOIN centro_custo cc ON cc.id = co.id_centro_custo
                INNER JOIN status_disponibilidades sd ON sd.id = dt.id_status_disponibilidade
                WHERE
                    1 = 1
                    $procurarSql
                ORDER BY {$ordenar['coluna']} {$ordenar['direcao']}
                LIMIT $totalPorPagina
                OFFSET $inicioPagina";

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

    public function totalRegistroDistribuicoesFiltrado($procurarSql)
    {
        $sql = "SELECT
                    COUNT(dt.id) AS total
                FROM
                    {$this->tabela} dt
                LEFT JOIN aparelhos ap ON ap.id = dt.id_aparelho
                LEFT JOIN linhas li ON li.id = dt.id_linha
                INNER JOIN colaboradores co ON co.id = dt.id_colaborador
                INNER JOIN cidades cd ON cd.id = ap.id_cidade
                INNER JOIN centro_custo cc ON cc.id = co.id_centro_custo
                INNER JOIN status_disponibilidades sd ON sd.id = dt.id_status_disponibilidade
                WHERE
                    1 = 1
                    $procurarSql";

        $resultado = $this->db->query($sql)->result_array();

        return count($resultado) == 0 ? 0 : $resultado[0]['total'];
    }



    public function consultaDistribuicaoPorId($idDistribuicao)
    {
        $sql = "SELECT
                    dt.id_status_disponibilidade,
                    co.id AS id_colaborador,
                    co.nome AS nome_colaborador,
                    ap.imei1 AS imei,
                    ap.id AS id_aparelho,
                    md.nome AS nome_modelo,
                    cda.nome AS nome_cidade_ap,
                    li.numero_linha,
                    li.id AS id_linha,
                    cg.nome AS categoria,
                    cdli.nome AS nome_cidade_li,
                    CONCAT(cc.id, ' (', cc.area, ')') AS centro_custo,
                    co.gestor AS gestor,
                    u.nome AS nome_usuario,
                    DATE_FORMAT(dt.data_registro, '%d/%m/%Y') AS data_registro,
					mvd.motivo,
                    'EM USO' AS status_disponibilidade
                FROM
                    {$this->tabela} dt
                LEFT JOIN aparelhos ap ON ap.id = dt.id_aparelho
                LEFT JOIN modelos md ON md.id = ap.id_modelo
                LEFT JOIN linhas li ON li.id = dt.id_linha
                INNER JOIN colaboradores co ON co.id = dt.id_colaborador
                INNER JOIN cidades cda ON cda.id = ap.id_cidade
                INNER JOIN cidades cdli ON cdli.id = li.id_cidade
                INNER JOIN cidades cd ON cd.id = ap.id_cidade
                LEFT JOIN categorias cg ON cg.id = li.id_categoria
                LEFT JOIN centro_custo cc ON cc.id = co.id_centro_custo
                INNER JOIN usuarios u ON u.id = dt.id_usuario_registro
                LEFT JOIN motivos_devolucoes mvd ON mvd.id = dt.id_motivo_devolucao
                WHERE
                    dt.id = $idDistribuicao";

        $resultado = $this->db->query($sql)->result_array();

        return count($resultado) == 0 ? [] : $resultado[0];
    }

    public function fecharDistribuicao($idDistribuicao, $idMotivoDevolucao)
    {
        $this->db->update($this->tabela, [
			'id_status_disponibilidade' => DISTRIBUICAO_DEVOLVIDO,
			'id_motivo_devolucao' => $idMotivoDevolucao
		], ['id' => $idDistribuicao]);
    }

    public function alterarDisponibilidadeItens($tabela, $idItem)
    {
        $sql = "UPDATE
                    $tabela
                SET
                    id_status_disponibilidade = " . DISTRIBUICAO_DEVOLVIDO . "
                WHERE
                    id = $idItem";

        $this->db->query($sql);
    }
}
