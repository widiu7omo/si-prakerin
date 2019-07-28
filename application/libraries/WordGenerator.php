<?php


namespace Tools;

use PhpOffice\PhpWord\PhpWord;

require "vendor/autoload.php";

class WordGenerator {
	public $files;
	public $location;

	public function __construct() {
		//Do your magic here
	}

	public function create_surat( $kind = null ) {
		switch ( $kind ) {
			case 'magang':
				$this->surat_permohonan();
				break;
			default:
				return null;
		}
	}

	public function surat_permohonan() {
		$phpWord = new PhpWord();

		/* [THE HTML] */
		$section = $phpWord->addSection();
		//header letter
		$header = $section->addHeader();
		$header->addImage( base_url( 'assets/img/surat/header.png' ), array(
			'width'            => 460,
			'height'           => 85,
			'marginTop'        => - 1,
			'marginLeft'       => - 1,
			'wrappingStyle'    => 'behind',
		) );

		$section->addText(null );
		$section->addText(
			"Nomor	: B/17/PL40/PK.01.06/2019                             11 Januari 2019
			\nHal	: Permohonan Praktek Kerja Lapangan (PKL)",
			array('name' => 'Bookman Old Style', 'size' => 12)
		);
		$section->addText( "Hal               : Permohonan Praktek Kerja Lapangan (PKL)",
			array('name' => 'Bookman Old Style', 'size' => 12)
		);
		$section->addText(null );
		$section->addText(
			"\nGreat achievement is usually born of great sacrifice, "
			. "and is never the result of selfishness."
			. "(Napoleon Hill)",
			array('name' => 'Bookman Old Style', 'size' => 12)
		);
		$section->addText(
			"\nGreat achievement is usually born of great sacrifice, "
			. "and is never the result of selfishness."
			. "(Napoleon Hill)",
			array('name' => 'Bookman Old Style', 'size' => 12)
		);
//		$html = "<h1>HELLO WORLD!</h1>";
//		$html .= "<p>This is a paragraph of random text</p>";
//		$html .= "<table ><tr><td>A table</td><td>Cell</td></tr></table>";
//		\PhpOffice\PhpWord\Shared\Html::addHtml( $section, $html, false, false );
		/* [SAVE FILE ON THE SERVER] */
		// $pw->save("html-to-doc.docx", "Word2007");

		/* [OR FORCE DOWNLOAD] */
		header( 'Content-Type: application/octet-stream' );
		header( 'Content-Disposition: attachment;filename="convert.docx"' );
		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter( $phpWord, 'Word2007' );
		$objWriter->save( 'php://output' );

	}

}