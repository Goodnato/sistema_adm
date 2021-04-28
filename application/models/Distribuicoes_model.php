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
}
