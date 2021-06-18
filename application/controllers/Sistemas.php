<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sistemas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!isset($this->session->dadosUsuario)) {
            redirect(base_url('/'));
        }

        $this->load->model('Usuarios_model');
        $this->load->model('Colaboradores_model');
    }

    public function sair()
    {
        $this->session->sess_destroy();

        redirect(base_url('/'));
    }

    public function alterarSenha()
    {
        $senhaAntiga = $_POST['senhaAntiga'];
        $senhaNova = $_POST['senhaNova'];
        $senhaRepetir = $_POST['senhaRepetir'];

        if (empty($senhaAntiga) || empty($senhaAntiga) || empty($senhaAntiga)) {
            echo json_encode([
                'status' => false,
                'mensagem' => 'Todos os campos são obrigatórios'
            ]);

            return false;
        }

        if ($senhaAntiga == $senhaNova) {
            echo json_encode([
                'status' => false,
                'mensagem' => 'Senha nova deve ser diferente que a antiga'
            ]);

            return false;
        }

        if ($senhaNova != $senhaRepetir) {
            echo json_encode([
                'status' => false,
                'mensagem' => 'Senha nova não confere com a confirmação'
            ]);

            return false;
        }

        $senhaUsuario = $this->Usuarios_model->confereSenhaUsuario($this->session->dadosUsuario['login'], $senhaAntiga);
        if (count($senhaUsuario) == 0) {
            echo json_encode([
                'status' => false,
                'mensagem' => 'Senha antiga inválida'
            ]);

            return false;
        }

        $this->Usuarios_model->alteraSenha($this->session->dadosUsuario['login'], $senhaNova);

        echo json_encode([
            'status' => true
        ]);

        return false;
    }

    public function acessoProibido()
    {
        $this->load->view('acesso_proibido');
    }

    public function atualizaColaboradores()
    {
        $todosColaboradoresImport = $this->Colaboradores_model->consultaTodosColaboradoresImport();

        if (empty($todosColaboradoresImport)) {
            echo 'Nenhum colaborador no import';
            return false;
        }

        $this->Colaboradores_model->atualizaTodosColeboradores($todosColaboradoresImport);
        echo 'Finalizado';
    }
}
