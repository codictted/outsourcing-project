<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('fpdf.php');


class Pdf extends FPDF{
	// Extend FPDF using this class
	// More at fpdf.org -> Tutorials

	function __construct(){
		// Call parent constructor
		parent::__construct();
	}

	function Header(){
		// Logo
		//$this->Image('../icon/job.png',45,10,15);
		// Arial bold 15
		$this->SetFont('Arial','B',15);
		// Move to the right
		$this->Cell(80);
		// Title
		$this->Cell(40,10,'Outsourcing Management System',0,0,'C');
		// Line break
		$this->Ln(5);
		$this->SetFont('Arial','',11);
		$this->Cell(190,11,'#111 St., Sta. Mesa, Manila Philippines',0,0,'C');
		$this->Ln(10);
		$this->SetFont('Arial', 'B', 13);
		
	}

	// Page footer
	function Footer(){
		// Position at 1.5 cm from bottom
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Page number
		//$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		$this->Cell(0,10,iconv("UTF-8", "ISO-8859-1", "©").' Outsourcing Management System 2017 '.'| Page '.$this->PageNo().'/{nb}',0,0,'R');
		//$this->MultiCell(0,10,'sds',0,0,'C');
	}



}
?>
