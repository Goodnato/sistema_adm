<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Aparelhos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('Aparelhos_model');
    }

    public function index()
    {
        $carregaView = [
            'caminhoCss' => 'assets/css/aparelhos.css',
            'caminhoJs' => 'assets/js/aparelhos.js'
        ];

        $this->load->view('head', $carregaView);
        $this->load->view('aparelhos/index');
        $this->load->view('footer');
    }
}