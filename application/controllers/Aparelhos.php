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
            'listaStatusCondicoes' => $this->Status_condicoes_aparelhos_model->consultaTodosStatusAtivos(),
            'listaStatusDisponibilidades' => $this->Status_disponibilidades_aparelhos_model->consultaTodosStatusAtivos(),
            'listaUsuariosCadastroAparelho' => $this->Aparelhos_model->consultaUsuariosCadastroAparelho()
        ];

        return $carregaView;
    }

    public function consultaMarcaPeloModelo()
    {
        $idModelo = (int) $this->input->post('idModelo');

        if($idModelo <= 0){
            echo json_encode([
                'status' => false, 
                'mensagem' => 'Modelo inválido'
            ]);

            return false;
        }

        $marca = $this->Modelos_model->consultaMarcaPorStatusPorModelo(STATUS_ATIVO, $idModelo);

        if(count($marca) == 0){
            echo json_encode([
                'status' => false, 
                'mensagem' => 'Modelo não encontrado'
            ]);

            return false;
        }

        echo json_encode([
            'status' => true,
            'mensagem' => $marca
        ]);
    }
}