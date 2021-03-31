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
        $this->form_validation->set_rules("numeroLinha", "<b>Número da Linha</b>", "trim|required|integer|is_unique[linhas.numero_linha]|exact_length[10]");
        $this->form_validation->set_rules("codigoChip", "<b>Código do Chip</b>", "trim|required|integer|is_unique[linhas.codigo_chip]|exact_length[15]");
        $this->form_validation->set_rules("idCategoria", "<b>Categoria</b>", "trim|required|integer|combines[categorias.id]");
        $this->form_validation->set_rules("operadora", "<b>Operadora</b>", "trim|max_length[50]");
        $this->form_validation->set_rules("pinPuk1", "<b>Pin-Puk1</b>", "trim|integer|max_length[12]");
        $this->form_validation->set_rules("pinPuk2", "<b>Pin-Puk2</b>", "trim|integer|max_length[12]");

        if (!$this->form_validation->run()) {
            echo json_encode([
                'status' => false,
                'mensagem' => validation_errors()
            ]);
            
            return false;
        }

        $this->Linhas_model->salvarLinha([
            'numero_linha' => $this->input->post('numeroLinha'),
            'codigo_chip' => $this->input->post('codigoChip'),
            'id_categoria' => $this->input->post('idCategoria'),
            'operadora' => $this->input->post('operadora'),
            'pin_puk1' => $this->input->post('pinPuk1'),
            'pin_puk2' => $this->input->post('pinPuk2'),
            'id_usuario_registro' => 1
        ]);

        echo json_encode([
            'status' => true
        ]);

        
    }


}