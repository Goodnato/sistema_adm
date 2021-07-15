<?php
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;

defined('BASEPATH') or exit('No direct script access allowed');

class GerarExcel_library
{
	public function gerar()
	{
		$writer = WriterEntityFactory::createXLSXWriter();
		// $writer = WriterEntityFactory::createODSWriter();
		// $writer = WriterEntityFactory::createCSVWriter();

		$writer->openToBrowser("Teste.xlsx"); // stream data directly to the browser

		$cells = [
			WriterEntityFactory::createCell('Carl'),
			WriterEntityFactory::createCell('is'),
			WriterEntityFactory::createCell('great!'),
		];

		/** add a row at a time */
		$singleRow = WriterEntityFactory::createRow($cells);
		$writer->addRow($singleRow);

		/** add multiple rows at a time */
		$multipleRows = [
			WriterEntityFactory::createRow($cells),
			WriterEntityFactory::createRow($cells),
		];
		$writer->addRows($multipleRows); 

		/** Shortcut: add a row from an array of values */
		$values = ['Carl', 'is', 'great!'];
		$rowFromValues = WriterEntityFactory::createRowFromArray($values);
		$writer->addRow($rowFromValues);

		$writer->close();
	}
}
