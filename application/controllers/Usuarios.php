<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (isset($this->session->dadosUsuario)) {
            redirect(base_url('/Aparelhos'));
        }

        $this->load->model('Usuarios_model');
    }

    public function index()
    {
        $this->load->view('login/index');
    }

    public function login()
    {
        $login = $_POST['login'];
        $senha = $_POST['senha'];

        $usuario = $this->confereCredenciais($login, $senha);

        if (count($usuario) == 0) {
            $this->session->set_flashdata('mensagemLogin', 'Usuário ou senha inválido');

            redirect(base_url('/'));
        }

        $usuario = $usuario[0];
        unset($usuario['senha']);

        $this->session->set_userdata('dadosUsuario', $usuario);

        redirect(base_url('/Aparelhos'));
    }

    private function confereCredenciais($email, $senha)
    {
        $usuario = $this->Usuarios_model->confereCredenciais($email, $senha);

        if (count($usuario) == 0) {
            return [];
        }

        return $usuario;
    }
}
