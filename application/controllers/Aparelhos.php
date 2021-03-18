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
        $this->load->model('Status_condicoes_model');
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
            'listaModelos' => $this->Modelos_model->consultaTodosModelos(),
            'listaStatusCondicoes' => $this->Status_condicoes_model->consultaTodosStatus(),
        ];

        return $carregaView;
    }
}