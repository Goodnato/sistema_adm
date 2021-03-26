<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Aparelhos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Aparelhos_model');
        $this->load->model('Marcas_model');
        $this->load->model('Modelos_model');
        $this->load->model('Status_condicoes_aparelhos_model');
        $this->load->model('Status_disponibilidades_aparelhos_model');
    }

    public function index()
    {
        $this->load->view('head', $this->carregaView());
        $this->load->view('aparelhos/index');
        $this->load->view('footer');
    }

    private function carregaView()
    {
        $carregaView = [
            'caminhoCss' => 'assets/css/aparelhos.css',
            'caminhoJs' => 'assets/js/aparelhos.js',
            'listaMarcas' => $this->Marcas_model->consultaTodasMarcas(),
            'listaMarcasAtivas' => $this->Marcas_model->consultaTodasMarcasPorStatus(STATUS_ATIVO),
            'listaModelos' => $this->Modelos_model->consultaTodosModelos(),
            'listaModelosAtivos' => $this->Modelos_model->consultaTodosModelosPorStatus(STATUS_ATIVO),
            'listaStatusCondicoes' => $this->Status_condicoes_aparelhos_model->consultaTodosStatus(),
            'listaStatusDisponibilidades' => $this->Status_disponibilidades_aparelhos_model->consultaTodosStatus(),
            'listaUsuariosCadastroAparelho' => $this->Aparelhos_model->consultaTodosUsuariosCadastroAparelho()
        ];

        return $carregaView;
    }

    public function consultaMarcaPeloModelo()
    {
        $idModelo = (int) $this->input->post('idModelo');

        if ($idModelo <= 0) {

            return false;
        }

        $marca = $this->Modelos_model->consultaMarcaPorStatusPorModelo(STATUS_ATIVO, $idModelo);

        if (count($marca) == 0) {

            return false;
        }

        echo json_encode([
            'status' => true,
            'marca' => $marca
        ]);
    }

    public function salvarAparelho()
    {
        $this->form_validation->set_rules("imei", "<b>Imei</b>", "trim|required|integer|is_unique[aparelhos.imei1]|exact_length[15]");
        $this->form_validation->set_rules("idModelo", "<b>Modelo</b>", "trim|required|integer|combines[modelos.id]");
        $this->form_validation->set_rules("idCondicaoAparelho", "<b>Condição aparelho</b>", "trim|required|integer|combines[status_condicoes_aparelhos.id]");
        $this->form_validation->set_rules("notaFiscal", "<b>Nota fiscal</b>", "trim|integer");

        if (!$this->form_validation->run()) {
            print_r(validation_errors());exit;
        } else{
            echo 2;exit;
        }
    }
}
