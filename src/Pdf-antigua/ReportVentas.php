<?php

// require_once "./third_party/fpdf/fpdf.php";
require "./src/report-fpdf/fpdf.php";
//              src\report-fpdf\fpdf.php
// include_once("./application/config/setting.php");


//Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
// class Pdf extends FPDF {
// public function __construct() {
// parent::__construct();
// }
// // El encabezado del PDF
// public function Header(){

$pdf = new FPDF();

// $pdf->AddPage('P','A4',0);
$pdf->AddPage();
$pdf->SetFont('Arial','B', 12);

$pdf->Cell(50,10, 'Este header xxx se muestra en cada página generada',1,1,'L');
// $this->Ln(20);


$pdf->Output("Lista de alumnos.pdf", 'I');
