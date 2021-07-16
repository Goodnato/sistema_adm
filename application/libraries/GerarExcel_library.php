<?php
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;

defined('BASEPATH') or exit('No direct script access allowed');

class GerarExcel_library
{
	public function gerar($nomeArquivo, $cabecalho, $valores)
	{
		$writer = WriterEntityFactory::createXLSXWriter();
		$writer->openToBrowser($nomeArquivo . ".xlsx");

		$writer->addRow(WriterEntityFactory::createRowFromArray($cabecalho));

		foreach ($valores as $linha) {
			$writer->addRow(WriterEntityFactory::createRowFromArray($linha));
		}

		$writer->close();
	}
}
