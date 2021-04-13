<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Distribuicoes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Aparelhos_model');
        $this->load->model('Marcas_model');
        $this->load->model('Modelos_model');
        $this->load->model('Status_condicoes_aparelhos_model');
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
            'listaMarcas' => $this->Marcas_model->consultaTodasMarcas(),
            'listaMarcasAtivas' => $this->Marcas_model->consultaTodasMarcasPorStatus(STATUS_ATIVO),
            'listaModelos' => $this->Modelos_model->consultaTodosModelos(),
            'listaModelosAtivos' => $this->Modelos_model->consultaTodosModelosPorStatus(STATUS_ATIVO),
            'listaStatusCondicoes' => $this->Status_condicoes_aparelhos_model->consultaTodosStatus(),
            'listaStatusDisponibilidades' => $this->Status_disponibilidades_model->consultaTodosStatus(),
            'listaUsuariosCadastroAparelho' => $this->Aparelhos_model->consultaTodosUsuariosCadastroAparelho()
        ];

        return $carregaView;
    }
}
