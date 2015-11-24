<?php

class Barcode extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('fpdf');
	}
	
	function index() {
		$this->load->library('fpdf');
		$this->fpdf->FPDF('P','cm','A4');
		$this->fpdf->AddPage();
		$this->fpdf->AddFont('free3of9','','free3of9.php');
		
		
		$banyaknya = 13;
		for ( $i = 1; $i <= $banyaknya; $i = $i+4 )
		{
			// CETAK BARCODE NOMOR TIKET
			for ( $a = 0; $a <4; $a++ ) {
				$urutan_a = $i + $a;
				$this->fpdf->SetFont('free3of9','',30);
				$this->fpdf->Cell(0.5, 1, '', 'LT', 0, 'L');
				$this->fpdf->Cell(4, 1,"*XY0001*",'RT',0,'L');
				@$status_a++;
			}
			if ($status_a >= 3) {
				$this->fpdf->Ln();
				$status_a = 0;
			}
			for ( $b = 0; $b <4; $b++ ) {
				$urutan_b = $i + $b;
				$this->fpdf->SetFont('Arial','',8);
				$this->fpdf->Cell(0.5, 0.4, '', 'L', 0, 'L');
				$this->fpdf->Cell(4,0.4,"Kemeja Batik Cirebon",'R',0,'L');
				@$status_b++;
			}
			if ($status_b >= 3) {
				$this->fpdf->Ln();
				$status_b = 0;
			}
			for ( $c = 0; $c < 4; $c++) {
				$this->fpdf->Cell(0.5, 0.4, '', 'LB', 0, 'L');
				$this->fpdf->Cell(1.3, 0.4, 'XY0001', 'BR', 0, 'L');
				$this->fpdf->Cell(2.7,0.4,"Rp 1.300.000",'BR',0,'L');
				@$status_c++;
			}
			
			if ($status_c >= 3) {
				$this->fpdf->Ln();
				$status_c = 0;
			}
		}
		$this->fpdf->Output();
	}
}


/* haha */