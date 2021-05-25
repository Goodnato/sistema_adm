<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Comandos extends CI_Controller
{
    const PORCENTAGEM_DEPRECIADO = 0.20;

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Aparelhos_model');
    }

    public function atualizaValorDepreciadoAparelhos()
    {
        $todosAparelhos = $this->Aparelhos_model->consultaTodosAparelhos();

        if (count($todosAparelhos) == 0) {
            return false;
        }

        foreach ($todosAparelhos as $aparelho) {
            if (empty($aparelho['data_nota']) || empty($aparelho['valor'])) {
                continue;
            }

            $diferencaAnos = $this->diferencaAnos($aparelho['data_nota'], date('Y-m-d'));
            $periodoDoisAnos = floor($diferencaAnos / 2);

            $valorDepreciado = $this->calculaValorDepreciado($aparelho['valor'], $periodoDoisAnos);

            $this->Aparelhos_model->editarAparelho($aparelho['id'], [
                'valor' => $valorDepreciado
            ]);
        }

        return true;
    }

    private function diferencaAnos($dataInicio, $dataFim)
    {
        $dataInicioObj = new DateTime($dataInicio);
        $dataFimObj = new DateTime($dataFim);

        return $dataInicioObj->diff($dataFimObj)->y;
    }

    private function calculaValorDepreciado($valor, $periodoDoisAnos)
    {
        for ($i = 0; $i < $periodoDoisAnos; $i++) {
            $valor -= $valor * self::PORCENTAGEM_DEPRECIADO;
        }

        return $valor;
    }
}
