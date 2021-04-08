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
        $this->load->model('Status_disponibilidades_model');
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
            'listaStatusDisponibilidades' => $this->Status_disponibilidades_model->consultaTodosStatus(),
            'listaUsuariosCadastroAparelho' => $this->Aparelhos_model->consultaTodosUsuariosCadastroAparelho()
        ];

        return $carregaView;
    }

    public function consultaMarcaPeloModelo()
    {
        $idModelo = (int) $this->input->post('idModelo');

        if ($idModelo <= 0) {
            echo json_encode([
                'status' => false
            ]);

            return false;
        }

        $marca = $this->Modelos_model->consultaMarcaPorModeloPorStatus($idModelo);

        if (count($marca) == 0) {
            echo json_encode([
                'status' => false
            ]);

            return false;
        }

        echo json_encode([
            'status' => true,
            'marca' => $marca
        ]);
    }

    public function salvarAparelho()
    {
        $this->form_validation->set_rules("imei", "<b>Imei</b>", "trim|required|greater_than[0]|is_unique[aparelhos.imei1]|exact_length[15]");
        $this->form_validation->set_rules("idModelo", "<b>Modelo</b>", "trim|required|integer|combines[modelos.id]");
        $this->form_validation->set_rules("idStatusCondicaoAparelho", "<b>Condição aparelho</b>", "trim|required|integer|combines[status_condicoes_aparelhos.id]");
        $this->form_validation->set_rules("notaFiscal", "<b>Nota fiscal</b>", "trim|integer|max_length[50]");
        $this->form_validation->set_rules("dataNotaFiscal", "<b>Data nota fiscal</b>", "trim|valid_date[Y-m-d]");
        $this->form_validation->set_rules("valorNotaFiscal", "<b>Valor nota fiscal</b>", "trim|decimal");

        if (!$this->form_validation->run()) {
            echo json_encode([
                'status' => false,
                'mensagem' => validation_errors()
            ]);

            return false;
        }

        $this->Aparelhos_model->salvarAparelho([
            'id_modelo' => $this->input->post('idModelo'),
            'id_marca' => $this->Modelos_model->consultaMarcaPorModeloPorStatus($this->input->post('idModelo'))['id'],
            'imei1' => $this->input->post('imei'),
            'id_status_condicao_aparelho' => $this->input->post('idStatusCondicaoAparelho'),
            'nota_fiscal' => $this->input->post('notaFiscal'),
            'data_nota' => $this->input->post('dataNotaFiscal'),
            'valor' => $this->input->post('valorNotaFiscal'),
            'id_usuario_registro' => 1
        ]);

        echo json_encode([
            'status' => true
        ]);
    }

    public function listaAparelhos()
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
        $procurarSql = $this->montaCondicaoListaAparelhosProcurar();
        $filtrosSql = $this->montaCondicaoListaAparelhosFiltros();

        $listaAparelhos = $this->Aparelhos_model->listaAparelhos(($procurarSql . $filtrosSql), $ordenar, $inicioLimite, $finalLimite);

        $teste = [
            "draw" => $draw,
            "recordsTotal" => $this->Aparelhos_model->totalRegistroAparelhos(),
            "recordsFiltered" => $this->Aparelhos_model->totalRegistroAparelhosFiltrados($procurarSql),
            "data" => $listaAparelhos
        ];
        echo json_encode($teste);
    }

    private function montaCondicaoListaAparelhosProcurar()
    {
        $procurarValor = $this->input->post('search')['value'];

        $procurarSql = " ";
        if (!empty($procurarValor)) {
            $procurarSql = " AND (
                mc.nome LIKE '%" . $procurarValor . "%' OR 
                md.nome LIKE '%" . $procurarValor . "%' OR 
                ap.imei1 LIKE '%" . $procurarValor . "%' OR 
                sc.nome LIKE '%" . $procurarValor . "%'
            )";
        }

        return $procurarSql;
    }

    private function montaCondicaoListaAparelhosFiltros()
    {
        $filtrosSql = " ";

        if (is_array($this->input->post('idMarca')) && count($this->input->post('idMarca')) > 0) {
            $filtrosSql .= "AND mc.id IN(" . implode(", ", $this->input->post('idMarca')) . ") ";
        }

        if (is_array($this->input->post('idModelo')) && count($this->input->post('idModelo')) > 0) {
            $filtrosSql .= "AND md.id IN(" . implode(", ", $this->input->post('idModelo')) . ") ";
        }

        if (!empty($this->input->post('imei'))) {
            $filtrosSql .= "AND ap.imei1 = '" . $this->input->post('imei') . "'";
        }

        if (is_array($this->input->post('idStatusCondicaoAparelho')) && count($this->input->post('idStatusCondicaoAparelho')) > 0) {
            $filtrosSql .= "AND sc.id IN(" . implode(", ", $this->input->post('idStatusCondicaoAparelho')) . ") ";
        }

        /*if (is_array($this->input->post('idDisponibilidade')) && count($this->input->post('idDisponibilidade')) > 0) {
            $filtrosSql .= "AND md.id IN(" . implode(", ", $this->input->post('idDisponibilidade')) . ") ";
        }*/

        if (is_array($this->input->post('status')) && count($this->input->post('status')) > 0) {
            $filtrosSql .= "AND ap.status IN(" . implode(", ", $this->input->post('status')) . ") ";
        }

        return $filtrosSql;
    }
}
