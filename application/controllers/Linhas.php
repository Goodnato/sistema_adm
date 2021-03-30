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
            'listaCategoriasAtivas' => $this->Categorias_model->consultaTodasCategoriasPorStatus(STATUS_ATIVO)
        ];

        return $carregaView;
    }

    public function salvarLinha(){
        $this->form_validation->set_rules("imei", "<b>Imei</b>", "trim|required|integer|is_unique[aparelhos.imei1]|exact_length[15]");
        $this->form_validation->set_rules("idModelo", "<b>Modelo</b>", "trim|required|integer|combines[modelos.id]");
        $this->form_validation->set_rules("idStatusCondicaoAparelho", "<b>Condição aparelho</b>", "trim|required|integer|combines[status_condicoes_aparelhos.id]");
        $this->form_validation->set_rules("notaFiscal", "<b>Nota fiscal</b>", "trim|integer|max_length[50]");
        $this->form_validation->set_rules("dataNotaFiscal", "<b>Data nota fiscal</b>", "trim|valid_date[Y-m-d]");
        $this->form_validation->set_rules("valorNotaFiscal", "<b>Valor nota fiscal</b>", "trim|decimal");

        
    }


}