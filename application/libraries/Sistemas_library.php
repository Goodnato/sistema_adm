<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sistemas_library
{
    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function validaAcessoTela($listaAcessoTela, $tela)
    {
        if (empty($listaAcessoTela)) {
            return true;
        }

        $arrayAcessoTela = explode("|", $listaAcessoTela);

        return in_array($tela, $arrayAcessoTela);
    }

    public function retornaPrimeiraTelaAcesso($listaAcessoTela)
    {
        if (empty($listaAcessoTela)) {
            return 'Aparelhos';
        }

        $arrayAcessoTela = explode("|", $listaAcessoTela);

        if (in_array(PAGINA_APARELHOS, $arrayAcessoTela)) {
            return 'Aparelhos';
        }

        switch (array_shift($arrayAcessoTela)) {
            case 2:
                return 'Linhas';
                break;

            case 3:
                return 'Distribuicoes';
                break;
        };
    }
}
