<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Distribuicoes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Distribuicoes_model');
        $this->load->model('Aparelhos_model');
        $this->load->model('Linhas_model');
        $this->load->model('Colaboradores_model');
        $this->load->model('Status_disponibilidades_model');
    }

    public function index()
    {
        $this->load->view('head', $this->carregaView());
        $this->load->view('distribuicoes/index');
        $this->load->view('footer');
    }

    private function carregaView()
    {
        $carregaView = [
            'tituloAtual' => 'Distribuições',
            'paginaAtual' => PAGINA_DISTRIBUICOES,
            'caminhoCss' => 'assets/css/distribuicoes.css',
            'caminhoJs' => 'assets/js/distribuicoes.js',
            'listaColaboradoresCadastrados' => $this->Distribuicoes_model->consultaTodosColaboradoresCadastradosDistribuicao(),
            'listaCidadesCadastradas' => $this->Distribuicoes_model->consultaTodasCidadesCadastradosDistribuicao(),
            'listaAreasCadastradas' => $this->Distribuicoes_model->consultaTodasAreasCadastradasDistribuicao(),
            'listaStatusDisponibilidades' => $this->Status_disponibilidades_model->consultaTodosStatus()
        ];

        return $carregaView;
    }

    public function consultarColaboradorPelaMatricula()
    {
        $matricula = (int) $this->input->post('matricula');

        if ($matricula <= 0) {
            echo json_encode([
                'status' => false
            ]);

            return false;
        }

        $colaborador = $this->Colaboradores_model->consultaColaboradorPelaMatricula($matricula);
        if (empty($colaborador)) {
            echo json_encode([
                'status' => false
            ]);

            return false;
        }

        echo json_encode([
            'status' => true,
            'colaborador' => $colaborador
        ]);
    }

    public function consultarModeloPeloImei()
    {
        $imei = (int) $this->input->post('imei');

        if ($imei <= 0) {
            echo json_encode([
                'status' => false
            ]);

            return false;
        }

        $modelo = $this->Aparelhos_model->consultaModeloPeloImei($imei);

        if (empty($modelo)) {
            echo json_encode([
                'status' => false
            ]);

            return false;
        }

        echo json_encode([
            'status' => true,
            'modelo' => $modelo
        ]);
    }

    public function consultarCategoriaPeloNumero()
    {
        $numeroLinha = $this->input->post('numeroLinha');

        if (empty($numeroLinha)) {
            echo json_encode([
                'status' => false
            ]);

            return false;
        }

        $categoria = $this->Linhas_model->consultaCategoriaPeloNumero($numeroLinha);

        if (empty($categoria)) {
            echo json_encode([
                'status' => false
            ]);

            return false;
        }

        echo json_encode([
            'status' => true,
            'categoria' => $categoria
        ]);
    }
}
