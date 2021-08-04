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

        $this->load->library('Sistemas_library');
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

		if($usuario['primeiro_acesso'] == 1) {
			$this->session->set_userdata('primeiroAcesso', $usuario);
			redirect(base_url("/Usuarios/primeiro_acesso"));
		}

        unset($usuario['senha']);

        $this->session->set_userdata('dadosUsuario', $usuario);

        $tela = $this->sistemas_library->retornaPrimeiraTelaAcesso($this->session->dadosUsuario['telas_autorizadas']);
        redirect(base_url("/$tela"));
    }

    private function confereCredenciais($email, $senha)
    {
        $usuario = $this->Usuarios_model->confereCredenciais($email, $senha);

        if (count($usuario) == 0) {
            return [];
        }

        return $usuario;
    }

	public function primeiro_acesso($submit = null)
	{
		$primeiroAcesso = $this->session->primeiroAcesso;
		if (!isset($primeiroAcesso)) {
            redirect(base_url('/'));
        }

		if (!$submit) {
			$this->load->view('login/primeiro_acesso');
			return;
		}

		$novaSenha = $_POST['novaSenha'];
        $repitaSenha = $_POST['repitaSenha'];

		if($novaSenha != $repitaSenha) {
			$this->session->set_flashdata('mensagemLogin', 'Senhas não conferem');

            redirect(base_url('/Usuarios/primeiro_acesso'));
		}

		if($novaSenha == $primeiroAcesso['senha']) {
			$this->session->set_flashdata('mensagemLogin', 'Nova senha deve ser diferente da anterior');

            redirect(base_url('/Usuarios/primeiro_acesso'));
		}

		$this->Usuarios_model->alteraSenha($primeiroAcesso['login'], $novaSenha);

		unset($primeiroAcesso['senha']);
		$this->session->set_userdata('dadosUsuario', $primeiroAcesso);
		unset($_SESSION['primeiroAcesso']);

        $tela = $this->sistemas_library->retornaPrimeiraTelaAcesso($this->session->dadosUsuario['telas_autorizadas']);
        redirect(base_url("/$tela"));
	}
}
