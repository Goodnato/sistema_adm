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
                'status' => false,
                'mensagem' => 'IMEI OBRIGATÓRIO'
            ]);

            return false;
        }

        $modelo = $this->Aparelhos_model->consultaAparelhoPeloImei($imei);
        if (count($modelo) == 0) {
            echo json_encode([
                'status' => false,
                'mensagem' => 'NÃO ENCONTRADO'
            ]);

            return false;
        }

        $statusDistribuicao = $this->Aparelhos_model->consultaDisponibilidadeAparelhoPorImei($imei);
        if (empty($statusDistribuicao) || $statusDistribuicao == DISTRIBUICAO_EM_USO) {
            echo json_encode([
                'status' => false,
                'mensagem' => "INDISPONÍVEL"
            ]);

            return false;
        }

        $condicao = $this->Aparelhos_model->consultaCondicaoAparelhoPorImei($imei);
        if (empty($condicao) || $condicao == CONDICAO_DESCARTADO || $condicao == CONDICAO_MANUTENCAO) {
            return [
                'status' => false,
                'mensagem' => "INDISPONÍVEL"
            ];
        }

        echo json_encode([
            'status' => true,
            'mensagem' => $modelo['modelo']
        ]);
    }

    public function consultarCategoriaPeloNumero()
    {
        $numeroLinha = $this->input->post('numeroLinha');

        if (empty($numeroLinha)) {
            echo json_encode([
                'status' => false,
                'mensagem' => 'LINHA É OBRIGATÓRIO'
            ]);

            return false;
        }

        $categoria = $this->Linhas_model->consultaLinhaPeloNumero($numeroLinha);
        if (empty($categoria)) {
            echo json_encode([
                'status' => false,
                'mensagem' => 'NÃO ENCONTRADA'
            ]);

            return false;
        }

        $statusDistribuicao = $this->Linhas_model->consultaDisponibilidadeLinhaPorNumero($numeroLinha);
        if (empty($statusDistribuicao) || $statusDistribuicao == DISTRIBUICAO_EM_USO) {
            echo json_encode([
                'status' => false,
                'mensagem' => "INDISPONÍVEL"
            ]);

            return false;
        }

        echo json_encode([
            'status' => true,
            'mensagem' => $categoria['id_linha']
        ]);
    }

    public function salvaDistribuicao()
    {
        $matricula = $this->input->post("matricula");
        $imei = $this->input->post("imei");
        $semAparelho = $this->input->post("semAparelho");
        $numeroLinha = $this->input->post("linha");
        $semLinha = $this->input->post("semLinha");

        $validaSemAparelhoLinha = $this->validaSemAparelhoLinha($semAparelho, $semLinha);
        if (!$validaSemAparelhoLinha['status']) {
            echo json_encode([
                'status' => false,
                'mensagem' => $validaSemAparelhoLinha['mensagem']
            ]);

            return false;
        }

        $validaMatricula = $this->validaMatricula($matricula);
        if (!$validaMatricula['status']) {
            echo json_encode([
                'status' => false,
                'mensagem' => $validaMatricula['mensagem']
            ]);

            return false;
        }

        $validaAparelho = $this->validaAparelho($semAparelho, $imei);
        if (!$validaAparelho['status']) {
            echo json_encode([
                'status' => false,
                'mensagem' => $validaAparelho['mensagem']
            ]);

            return false;
        }

        $validaLinha = $this->validaLinha($semLinha, $numeroLinha);
        if (!$validaLinha['status']) {
            echo json_encode([
                'status' => false,
                'mensagem' => $validaLinha['mensagem']
            ]);

            return false;
        }

        $idAparelho = empty($imei) ? null : $this->Aparelhos_model->consultaAparelhoPeloImei($imei)['id_aparelho'];
        $idLinha = empty($numeroLinha) ? null : $this->Linhas_model->consultaLinhaPeloNumero($numeroLinha)['id_linha'];

        $this->Distribuicoes_model->salvarDistribuicao([
            'id_aparelho' => $idAparelho,
            'id_linha' => $idLinha,
            'id_colaborador' => $matricula,
            'id_status_disponibilidade' => DISTRIBUICAO_EM_USO,
            'id_usuario_registro' => 1
        ]);

        $this->alteraDisponibilidadeAparelhoLinha($idAparelho, $idLinha);

        echo json_encode([
            'status' => true
        ]);
    }

    private function validaSemAparelhoLinha($semAparelho, $semLinha)
    {
        if ($semLinha == 1 && $semAparelho == 1) {
            return [
                'status' => false,
                'mensagem' => "Precisa selecionar um aparelho ou uma linha"
            ];
        }

        return [
            'status' => true
        ];
    }

    private function validaMatricula($matricula)
    {
        if (empty($matricula) || !is_numeric($matricula)) {
            return [
                'status' => false,
                'mensagem' => "A <b>Matrícula</b> é obrigatória"
            ];
        }

        if (empty($this->consultaMatriculaNasTabelas($matricula))) {
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
            return [
                'status' => true
            ];
        }

        if (empty($numeroLinha)) {
            return [
                'status' => false,
                'mensagem' => "A <b>Linha</b> é obrigatório"
            ];
        }

        $linha = $this->Linhas_model->consultaLinhaPeloNumero($numeroLinha);
        if (empty($linha)) {
            return [
                'status' => false,
                'mensagem' => "A <b>Linha</b> não foi encontrada"
            ];
        }

        $statusDistribuicao = $this->Linhas_model->consultaDisponibilidadeLinhaPorNumero($numeroLinha);
        if (empty($statusDistribuicao) || $statusDistribuicao == DISTRIBUICAO_EM_USO) {
            return [
                'status' => false,
                'mensagem' => "A <b>Linha</b> está indisponível"
            ];
        }

        return [
            'status' => true
        ];
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

    private function alteraDisponibilidadeAparelhoLinha($idAparelho, $idLinha)
    {
        if (!empty($idAparelho)) {
            $this->Aparelhos_model->editarAparelho($idAparelho, [
                'id_status_disponibilidade' => DISTRIBUICAO_EM_USO
            ]);
        }

        if (!empty($idLinha)) {
            $this->Linhas_model->editarLinha($idLinha, [
                'id_status_disponibilidade' => DISTRIBUICAO_EM_USO
            ]);
        }
    }
}
