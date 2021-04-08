<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Linhas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Linhas_model');
        $this->load->model('Categorias_model');
        $this->load->model('Operadoras_model');
        $this->load->model('Status_condicoes_aparelhos_model');
        $this->load->model('Status_disponibilidades_model');
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
            'listaCategoriasAtivas' => $this->Categorias_model->consultaTodasCategoriasPorStatus(STATUS_ATIVO),
            'listaOperadoras' => $this->Operadoras_model->consultaTodasOperadoras(),
            'listaOperadorasAtivas' => $this->Operadoras_model->consultaTodasOperadorasPorStatus(STATUS_ATIVO),
            'listaStatusCondicoes' => $this->Status_condicoes_aparelhos_model->consultaTodosStatus(),
            'listaStatusDisponibilidades' => $this->Status_disponibilidades_model->consultaTodosStatus(),
            'listaUsuariosCadastroLinha' => $this->Linhas_model->consultaTodosUsuariosCadastroLinha()
        ];

        return $carregaView;
    }

    public function salvarLinha()
    {
        $this->form_validation->set_rules("numeroLinha", "<b>Número da Linha</b>", "trim|required|is_unique[linhas.numero_linha]|exact_length[14]");
        $this->form_validation->set_rules("codigoChip", "<b>Código do Chip</b>", "trim|required|integer|is_unique[linhas.codigo_chip]|exact_length[15]");
        $this->form_validation->set_rules("idCategoria", "<b>Categoria</b>", "trim|required|integer|combines[categorias.id]");
        $this->form_validation->set_rules("idOperadora", "<b>Operadora</b>", "trim|required|integer|combines[operadoras.id]");
        $this->form_validation->set_rules("pinPuk1", "<b>Pin-Puk1</b>", "trim|max_length[13]");
        $this->form_validation->set_rules("pinPuk2", "<b>Pin-Puk2</b>", "max_length[13]");

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
            'id_operadora' => $this->input->post('idOperadora'),
            'pin_puk1' => $this->input->post('pinPuk1'),
            'pin_puk2' => $this->input->post('pinPuk2'),
            'id_usuario_registro' => 1
        ]);

        echo json_encode([
            'status' => true
        ]);

        
    }

    public function listaLinhas()
    {
        $numeroPorPagina = $this->input->post('length');
        $inicioLimite = $this->input->post('start');
        $finalLimite = $inicioLimite + $numeroPorPagina;
        $draw = $this->input->post('draw');
        $indiceColuna = $this->input->post('order')[0]['column'];
        $ordenar = [
            'coluna' => $this->input->post('columns')[$indiceColuna]['data'],
            'direcao' => $this->input->post('order')[0]['dir']
        ];

        $procurarSql = $this->montaCondicaoListaLinhasProcurar();

        $filtrosSql = $this->montaCondicaoListaLinhasFiltros();

        $listaAparelhos = $this->Linhas_model->listaLinhas($procurarSql, $ordenar, $inicioLimite, $finalLimite);
        //organizar o array para fazer json_encode e popular a tabela
        $teste = [
            "draw" => $draw,
            "recordsTotal" => $this->Linhas_model->totalRegistroLinhas(),
            "recordsFiltered" => $this->Linhas_model->totalRegistroLinhasFiltradas($procurarSql),
            "data" => $listaAparelhos
        ];
        //fornece a variavel que popula a tabela com os dados
        echo json_encode($teste);
    }
    
    private function montaCondicaoListaLinhasProcurar() //criar os critérios para a consulta ao banco, gera  a variavel $procurarSql
    {
        $procurarValor = $_POST['search']['value'];

        $procurarSql = " ";
        if(!empty($procurarValor)){
            $procurarSql = " AND (
                li.numero_linha LIKE '%".$procurarValor."%' OR 
                li.codigo_chip LIKE '%".$procurarValor."%' OR 
                cg.nome LIKE '%".$procurarValor."%' OR 
                us.nome LIKE '%".$procurarValor."%' OR 
            )";
        }

        return $procurarSql;
    }

    private function montaCondicaoListaLinhasFiltros()
    {
        $filtrosSql = " ";

        if (!empty($this->input->post('numeroLinha'))) {
            $filtrosSql .= "AND li.numero_linha = '" . $this->input->post('numeroLinha') . "'";
        }

        if (!empty($this->input->post('codigoChip'))) {
            $filtrosSql .= "AND li.imei1 = '" . $this->input->post('codigoChip') . "'";
        }

        if (is_array($this->input->post('idCategoria')) && count($this->input->post('idCategoria')) > 0) {
            $filtrosSql .= "AND cg.id IN(" . implode(", ", $this->input->post('idCategoria')) . ") ";
        }

        if (is_array($this->input->post('idOperadora')) && count($this->input->post('idOperadora')) > 0) {
            $filtrosSql .= "AND op.id IN(" . implode(", ", $this->input->post('idOperadora')) . ") ";
        }

        if (is_array($this->input->post('idUsuarioRegistro')) && count($this->input->post('idUsuarioRegistro')) > 0) {
            $filtrosSql .= "AND us.id IN(" . implode(", ", $this->input->post('idUsuarioRegistro')) . ") ";
        }

        /*if (is_array($this->input->post('idDisponibilidade')) && count($this->input->post('idDisponibilidade')) > 0) {
            $filtrosSql .= "AND md.id IN(" . implode(", ", $this->input->post('idDisponibilidade')) . ") ";
        }*/

        if (is_array($this->input->post('status')) && count($this->input->post('status')) > 0) {
            $filtrosSql .= "AND li.status IN(" . implode(", ", $this->input->post('status')) . ") ";
        }

        return $filtrosSql;
    }



}