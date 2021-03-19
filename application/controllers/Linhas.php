<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Linhas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Categorias_model');
    }

    public function index()
    {
        $this->load->view('head', $this->carregaView());
        $this->load->view('linhas/index');
        $this->load->view('footer');
    }

    private function carregaView()
    {        
        $carregaView = [
            'caminhoCss' => 'assets/css/linhas.css',
            'caminhoJs' => 'assets/js/linhas.js',
            'listaCategorias' => $this->Categorias_model->consultaTodasCategorias(),
        ];

        return $carregaView;
    }


}