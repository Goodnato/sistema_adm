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

        $colaborador = $this->consultaMatriculaNasTabelas($matricula);

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

    public function salvaDistribuicao()
    {
        $matricula = $this->input->post("matricula");
        $imei = $this->input->post("imei");
        $semAparelho = $this->input->post("semAparelho");
        $linha = $this->input->post("linha");
        $semLinha = $this->input->post("semLinha");

        $validaMatricula = $this->validaMatricula($matricula);
        if (!$validaMatricula['status']) {

            return false;
        }

        $validaAparelho = $this->validaAparelho($semAparelho, $imei);
        if (!$validaAparelho['status']) {

            return false;
        }
    }

    private function validaMatricula($matricula)
    {
        if (empty($matricula) || !is_numeric($matricula)) {
            return [
                'status' => false,
                'mensagem' => "A <b>Matrícula</b> é obrigatória"
            ];
        }

        if (!empty($this->consultaMatriculaNasTabelas($matricula))) {
            return [
                'status' => false,
                'mensagem' => "A <b>Matrícula</b> não foi encontrada"
            ];
        }

        return [
            'status' => true
        ];
    }

    private function validaAparelho($semAparelho, $imei)
    {
        if ($semAparelho == 1) {
            return [
                'status' => true
            ];
        }

        if (empty($imei)) {
            return [
                'status' => false,
                'mensagem' => "O <b>Imei</b> é obrigatório"
            ];
        }

        $modelo = $this->Aparelhos_model->consultaModeloPeloImei($imei);
        if (empty($modelo)) {
            return [
                'status' => false,
                'mensagem' => "O <b>Aparelho</b> não foi encontrado"
            ];
        }

        $statusDistribuicao = $this->Aparelhos_model->consultaDisponibilidadeAparelhoPorImei($imei);
        if (empty($statusDistribuicao) || $statusDistribuicao == DISTRIBUICAO_EM_USO) {
            return [
                'status' => false,
                'mensagem' => "O <b>Aparelho</b> está indisponível"
            ];
        }

        $condicao = $this->Aparelhos_model->consultaCondicaoAparelhoPorImei($imei);
        if (empty($condicao) || $condicao == CONDICAO_DESCARTADO || $condicao == CONDICAO_MANUTENCAO) {
            return [
                'status' => false,
                'mensagem' => "O <b>Aparelho</b> está indisponível"
            ];
        }

        return [
            'status' => true
        ];
    }

    private function validaLinha($semLinha, $numeroLinha)
    {
        if ($semLinha == 1) {
            return true;
        }

        $linha = $this->Linhas_model->consultaCategoriaPeloNumero($numeroLinha);
        if (empty($linha)) {
            return false;
        }

        return true;
    }



    private function consultaMatriculaNasTabelas($matricula)
    {
        $colaborador = $this->Colaboradores_model->consultaColaboradorPelaMatricula($matricula);
        if (!empty($colaborador)) {
            return $colaborador;
        }

        $colaborador = $this->Colaboradores_model->consultaColaboradorImportPelaMatricula($matricula);
        if (!empty($colaborador)) {
            return $colaborador;
        }

        return null;
    }
}
