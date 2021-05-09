<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contratos extends CI_Controller {

		 private $permisos;
	   public function __construct(){
	 	 parent::__construct();
		 $this->load->helper(array('form', 'url'));
	 	 $this->load->library(array('session', 'form_validation'));
		 $this->permisos = $this->backend_lib->control();
	 	 $this->load->model("Modelo_Eventos");
	 }


	public function index(){

		$data = array(
			'permisos' => $this->permisos,
			'username' => $this->session->userdata('username'),
		);

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/ViewEventos/VistaUtensilios',$data);
		$this->load->view('layouts/footer');
	}


	public function MostrarSalones() {
	    $MostrarConsulta = $this->Modelo_Eventos->EnlistarSalones();
	    echo json_encode($MostrarConsulta);
	  }


		public function MostrarMobiliario() {
	    $MostrarConsulta = $this->Modelo_Eventos->EnlistarMobiliario();
	    echo json_encode($MostrarConsulta);
	  }


	  public function Imagen($ClaveMueble) {
	    $Consulta = $this->Modelo_Eventos->BuscarDatosMuebleSeleccionado($ClaveMueble);
	    $Imagen = $Consulta->imagen;
	    header("Content-Type: image/jpeg");
	    print_r($Imagen);
	  }



	  public function ImagenSalon($id_salon) {
	    $Consulta = $this->Modelo_Eventos->datosSalonSeleccionado($id_salon);
	    $Imagen = $Consulta->foto;
	    header("Content-Type: image/jpeg");
	    print_r($Imagen);
	  }



		public function MostrarPlatillos() {
	    $MostrarConsulta = $this->Modelo_Eventos->EnlistarPlatillos();
	    echo json_encode($MostrarConsulta);
	  }


	  public function Foto($PlatilloID) {
	    $Consulta = $this->Modelo_Eventos->BuscarDatosPlatilloSeleccionado($PlatilloID);
	    $Foto = $Consulta->foto;
	    header("Content-Type: image/jpeg");
	    print_r($Foto);
	  }




	public function insertPiezasAlquiladosMobil(){

			$ajax_data = $this->input->post();
			if ($this->Modelo_Eventos->agregarPiezasAlquiladosMobil($ajax_data)) {
				$data = array('responce' => 'success', 'message' => 'Piezas agregado correctamente...!');
			} else {
				$data = array('responce' => 'error', 'message' => 'Fallo al agregar Piezas del mobiliario...!');
			}
			echo json_encode($data);
		}




	public function insertCantidadPersonasPlatillos(){

			$ajax_data = $this->input->post();
			if ($this->Modelo_Eventos->agregarCantidadPersonasPlatilloElegido($ajax_data)) {
				$data = array('responce' => 'success', 'message' => 'Cantidad de personas agregado correctamente...!');
			} else {
				$data = array('responce' => 'error', 'message' => 'Fallo al agregar Cantidad del platillo...!');
			}
			echo json_encode($data);
		}



	public function insertSalon(){

			$ajax_data = $this->input->post();
			if ($this->Modelo_Eventos->agregarDetallesSalon($ajax_data)) {
				$data = array('responce' => 'success', 'message' => 'Salon agregado correctamente...!');
			} else {
				$data = array('responce' => 'error', 'message' => 'Fallo al agregar Salon...!');
			}
			echo json_encode($data);
		}


//  Consulta el salon que esta en venta ACTUALMENTE
	public function verSalonEnVenta(){

			$venta = $this->input->post('venta');
			$posts = $this->Modelo_Eventos->obtenerSalonKEstaEnVenta($venta);
			echo json_encode($posts);

	}




//  Consulta el salon que esta en venta ACTUALMENTE para mostrar o ocultar el div de salones YA NO PODER ELEGIR MAS DE UN SALON
	public function verSalonEnVentaOcultarDivSalon(){

		$venta = $this->input->post('venta');
//$posts = $this->Modelo_Eventos->obtenerSalonKEstaEnVenta($venta);
		   if ($post = $this->Modelo_Eventos->obtenerSalonKEstaEnVenta($venta)) {
				 // $data = array('responce' => 'success', 'post' => $post);
				 $data = array('responce' => "success", "post" => $post, 'message' => 'TUUU==>>  XXXXXX!');
				// $data = array('responce' => 'success', 'message' => 'Salon agregado ya...!');
			} else {
				$data = array('responce' => 'error', 'message' => 'Fallo al consultar Salon...!');
			}
	    echo json_encode($data);

	}



// Consulta el MOBILIARIO que esta en venta ACTUALMENTE para mostrar o ocultar el div de mob YA NO PODER ELEGIR MAS DE UN mob
		public function verMobiliarioEnVentaOcultarDivMobiliario(){
			$venta = $this->input->post('venta');
			   if ($post = $this->Modelo_Eventos->obtenerMobiliarioKEstaEnVenta($venta)) {
					$data = array('responce' => 'success', "post" => $post, 'message' => 'Mobiliario agregado ya...!');
				} else {
					$data = array('responce' => 'error', 'message' => 'Fallo al consultar Mobiliario...!');
				}
		    echo json_encode($data);
		}



// Consulta el Platillos que esta en venta ACTUALMENTE para mostrar o ocultar el div de mob YA NO PODER ELEGIR MAS DE UN Platillos
		public function verPlatillosEnVentaOcultarDivPlatillos(){
			$venta = $this->input->post('venta');
			   if ($post = $this->Modelo_Eventos->obtenerPlatillosKEstaEnVenta($venta)) {
					$data = array('responce' => 'success', "post" => $post, 'message' => 'Platillos agregado ya...!');
				} else {
					$data = array('responce' => 'error', 'message' => 'Fallo al consultar Platillos...!');
				}
		    echo json_encode($data);
		}




	//  Consulta el mobiliario que esta en venta ACTUALMENTE
		public function verMobiliarioEnVenta(){
			$venta = $this->input->post('venta');
		    $posts = $this->Modelo_Eventos->obtenerMobiliarioKEstaEnVenta($venta);
		    echo json_encode($posts);
		}



	//  Consulta el Platilo que esta en venta ACTUALMENTE
		public function verPlatillosEnVenta(){

			$venta = $this->input->post('venta');
		    $posts = $this->Modelo_Eventos->obtenerPlatillosKEstaEnVenta($venta);
		    echo json_encode($posts);

		}




	public function eliminarSalonEnVenta(){

			$ajax_data = $this->input->post();
			if ($this->Modelo_Eventos->eliminarSalonEnCapturaDeVenta($ajax_data)) {
				$data = array('responce' => 'success', 'message' => 'Salon eliminado correctamente...!');
			} else {
				$data = array('responce' => 'error', 'message' => 'Fallo al eliminar Salon...!');
			}
			echo json_encode($data);
		}




	public function eliminarMobiliarioEnVenta(){

			$ajax_data = $this->input->post();
			if ($this->Modelo_Eventos->eliminarMobiliarioEnCapturaDeVenta($ajax_data)) {
				$data = array('responce' => 'success', 'message' => 'Mobiliario eliminado correctamente...!');
			} else {
				$data = array('responce' => 'error', 'message' => 'Fallo al eliminar Mobiliario...!');
			}
			echo json_encode($data);
		}



	public function eliminarPlatillosEnVenta(){

			$ajax_data = $this->input->post();
			if ($this->Modelo_Eventos->eliminarPlatillosEnCapturaDeVenta($ajax_data)) {
				$data = array('responce' => 'success', 'message' => 'Platillos eliminado correctamente...!');
			} else {
				$data = array('responce' => 'error', 'message' => 'Fallo al eliminar Platillos...!');
			}
			echo json_encode($data);
		}



/* =========  Ver el total de all ventas actual  ========== */
	public function verSumaTotalAllVentaActual(){
		if ($this->input->is_ajax_request()) {
			$venta = $this->input->post('venta');

			if ($post = $this->Modelo_Eventos->extraer_SumTotalVentaActual($venta)) {
				 $data = array('responce' => "success", "post" => $post);
			}else{
				$data = array('responce' => "error", "Fallos...!!! Controller(verSumaTotalAllVentaActual()) ");
			}
			echo json_encode($data);
		}else {
			echo "No se permite este acceso directo...!!!";
		}
	}





	//  Consulta el Platilo que esta en venta ACTUALMENTE
		public function verVentasCreditosActual(){

			$venta = $this->input->post('venta');
		    $posts = $this->Modelo_Eventos->obtenerVentasCreditos($venta);
		    echo json_encode($posts);

		}







//  Generar reporte PDF datelles generales del salon

  public function generaReportePDFSalonDetails($venta){
//
// $server = $venta;
// echo $server;

  			 require "./src/report-fpdf/fpdf.php";

         $pdf = new FPDF();

         // $pdf->AddPage('P','A4',0);
         $pdf->AddPage();
         $pdf->SetFont('Arial','B', 14);
				 $pdf->Image('src/Logo.png', 3, 3, 50);

				  $pdf->SetY(5);
         $pdf->Cell(200,10, utf8_decode('Reporte General de salón de eventos'),0,0,'C');
				 $pdf->Ln();


				 $DatesPlatillos = $this->Modelo_Eventos->obtenerSalonKEstaEnVenta($venta);

				foreach ($DatesPlatillos as $DatesPlatillos) {

 				$pdf->SetFont('Arial','', 12);
				 $pdf->Cell(135,20, utf8_decode('NOMBRE:'),0,0,'C');
				 	$pdf->SetX(40);
				 $pdf->Cell(150,20, $DatesPlatillos->name_cliente,0,0,'C');
				 $pdf->Ln(7);

				 $pdf->Cell(140,20, utf8_decode('DIRECCIÓN:'),0,0,'C');
				 $pdf->SetX(40);
				$pdf->Cell(150,20, $DatesPlatillos->direccionCliente,0,0,'C');
				 $pdf->Ln(7);
				 $pdf->Cell(150,20, utf8_decode('FECHA EVENTO:'),0,0,'C');
				 $pdf->SetX(40);
				$pdf->Cell(175,20, $DatesPlatillos->start,0,0,'C');
				 $pdf->Ln(35);

				  $pdf->SetFont('Arial','B', 10);
					$pdf->SetFillColor(11,63,71);//Fondo verde de celda
			  $pdf->SetTextColor(255, 255, 255); //Letra color blanco
				$pdf->SetDrawColor(88, 88 ,88);
        $pdf->Cell(50,8, utf8_decode('NOMBRE DEL SALÓN'), 1,0,'C',1);
        $pdf->Cell(84,8, utf8_decode('DIRECCIÓN'),1,0,'C',1);
        $pdf->Cell(30,8,'COSTO',1,0,'C',1);
        $pdf->Cell(30,8,'CAPACIDAD', 1,1,'C',1);


  //        $DatesPlatillos = $this->Modelo_Eventos->obtenerSalonKEstaEnVenta($venta);
	//
  // foreach ($DatesPlatillos as $DatesPlatillos) {
        // se imprime el numero actual y despues se incrementa el valor de $x en uno
        // Se imprimen los datos de cada alumno
        $pdf->SetFont('Arial','', 10);
				// $pdf->SetFillColor(2,157,116);//Fondo verde de celda
			$pdf->SetTextColor(5, 2, 1); //Letra color negra
			// $pdf->SetDrawColor(5, 2, 1);

        $pdf->Cell(50,10,$DatesPlatillos->nombre_salon , 1, 0, 'C');

				if($pdf->GetStringWidth($DatesPlatillos->direccion) > 70){
								$pdf->SetFont('Arial','', 7);
        						$pdf->Cell(84,10,$DatesPlatillos->direccion  , 1, 0, 'C');
								$pdf->SetFont('Arial','', 10);
							}else{
								$pdf->Cell(84,10,$DatesPlatillos->direccion  , 1, 0, 'C');
							}

        $pdf->Cell(30,10,$DatesPlatillos->cantidad_salon     , 1, 0, 'C');
        $pdf->Cell(30,10,$DatesPlatillos->capacidad    , 1, 0, 'C');
        // $pdf->Ln(10);

						   $pdf->Ln(30);
							 $pdf->SetFillColor(11,63,71);//Fondo verde de celda
						 $pdf->SetTextColor(255, 255, 255); //Letra color blanco
						 $pdf->SetDrawColor(88, 88 ,88);
										$pdf->Cell(195,8, utf8_decode('DESCRIPCIÓN GRAL DEL SALÓN'),1,0,'C',1);
										$pdf->Ln(8);

										if($pdf->GetStringWidth($DatesPlatillos->direccion) > 70){
														$pdf->SetFont('Arial','', 8);
														$pdf->SetTextColor(5, 2, 1); //Letra color negra
						        		$pdf->Cell(195,10, utf8_decode($DatesPlatillos->descripcion)  , 1, 0, 'C');
												$pdf->SetFont('Arial','', 10);
										}else{
													$pdf->Cell(195,10, utf8_decode($DatesPlatillos->descripcion)  , 1, 0, 'C');
										}
  }






        $pdf->Output("ReporteEvento_#".$venta.".pdf", 'I');

  }




//  Generar reporte PDF datelles generales del mobiliario para entrega al area de mobil..

	  public function generaReportePDFMobiliarioDetails($venta){

	  			 require "./src/report-fpdf/fpdf.php";

	         $pdf = new FPDF();

	         // $pdf->AddPage('P','A4',0);
	         $pdf->AddPage();
	         $pdf->SetFont('Arial','B', 14);
					 $pdf->Image('src/Logo.png', 3, 3, 50);

					  $pdf->SetY(5);
	         $pdf->Cell(200,10, utf8_decode('Reporte General del Mobiliario de eventos'),0,0,'C');
					 $pdf->Ln();

$DatesPlatillos = $this->Modelo_Eventos->obtenerMobiliarioKEstaEnVenta($venta);
foreach ($DatesPlatillos as $DatesPlatillos) {

					 $pdf->SetFont('Arial','', 12);
	 				 $pdf->Cell(135,20, utf8_decode('NOMBRE:'),0,0,'C');
	 				 	$pdf->SetX(40);
	 				 $pdf->Cell(150,20, $DatesPlatillos->name_cliente ,0,0,'C');
	 				 $pdf->Ln(7);

	 				 $pdf->Cell(140,20, utf8_decode('DIRECCIÓN:'),0,0,'C');
	 				 $pdf->SetX(40);
	 				$pdf->Cell(150,20,$DatesPlatillos->direccionCliente,0,0,'C');
	 				 $pdf->Ln(7);
	 				 $pdf->Cell(150,20, utf8_decode('FECHA EVENTO:'),0,0,'C');
	 				 $pdf->SetX(40);
	 				$pdf->Cell(175,20,$DatesPlatillos->start ,0,0,'C');
	 				 $pdf->Ln(35);

					  $pdf->SetFont('Arial','B', 10);
						$pdf->SetFillColor(11,63,71);//Fondo verde de celda
					$pdf->SetTextColor(255, 255, 255); //Letra color blanco
					$pdf->SetDrawColor(88, 88 ,88);
	        $pdf->Cell(70,8, utf8_decode('NOMBRE DEL MOBILIARIO'), 1,0,'C',1);
	        $pdf->Cell(40,8, utf8_decode('CANTIDAD'),1,0,'C',1);
	        $pdf->Cell(40,8,'P. UNITARIO',1,0,'C',1);
	        $pdf->Cell(40,8,'IMPORTE', 1,1,'C',1);


	         // $DatesPlatillos = $this->Modelo_Eventos->obtenerMobiliarioKEstaEnVenta($venta);

	  // foreach ($DatesPlatillos as $DatesPlatillos) {
	        // se imprime el numero actual y despues se incrementa el valor de $x en uno
	        // Se imprimen los datos de cada alumno
	        $pdf->SetFont('Arial','', 10);
					$pdf->SetTextColor(5, 2, 1); //Letra color negra
	        $pdf->Cell(70,10,$DatesPlatillos->nombre , 1, 0, 'C');
	        $pdf->Cell(40,10,$DatesPlatillos->cantidad_piezas_mobiliario  , 1, 0, 'C');
	        $pdf->Cell(40,10,$DatesPlatillos->precio     , 1, 0, 'C');
	        $pdf->Cell(40,10,$DatesPlatillos->precio_total_mob    , 1, 0, 'C');
	        $pdf->Ln(10);
	  }

	        $pdf->Output("ReporteMobiliario_".$venta.".pdf", 'I');

	  }





//  Generar reporte PDF datelles generales del mobiliario para entrega al area de mobil..

  public function generaReportePDFPlatillosDetails($venta){

  			 require "./src/report-fpdf/fpdf.php";

         $pdf = new FPDF();

         // $pdf->AddPage('P','A4',0);
         $pdf->AddPage();
         $pdf->SetFont('Arial','B', 14);
				 $pdf->Image('src/Logo.png', 3, 3, 50);

				  $pdf->SetY(5);
         $pdf->Cell(200,10, utf8_decode('Reporte General de Platillos de eventos'),0,0,'C');
				 $pdf->Ln();

				 $DatesPlatillos = $this->Modelo_Eventos->obtenerPlatillosKEstaEnVenta($venta);

  foreach ($DatesPlatillos as $DatesPlatillos) {

		$pdf->SetFont('Arial','', 12);
		$pdf->Cell(135,20, utf8_decode('NOMBRE:'),0,0,'C');
		 $pdf->SetX(40);
		$pdf->Cell(150,20, $DatesPlatillos->name_cliente ,0,0,'C');
		$pdf->Ln(7);

		$pdf->Cell(140,20, utf8_decode('DIRECCIÓN:'),0,0,'C');
		$pdf->SetX(40);
	 $pdf->Cell(150,20,$DatesPlatillos->direccionCliente,0,0,'C');
		$pdf->Ln(7);
		$pdf->Cell(150,20, utf8_decode('FECHA EVENTO:'),0,0,'C');
		$pdf->SetX(40);
	 $pdf->Cell(175,20,$DatesPlatillos->start ,0,0,'C');
		$pdf->Ln(35);

				  $pdf->SetFont('Arial','B', 10);
					$pdf->SetFillColor(11,63,71);//Fondo verde de celda
				$pdf->SetTextColor(255, 255, 255); //Letra color blanco
				$pdf->SetDrawColor(88, 88 ,88);
        $pdf->Cell(70,8, utf8_decode('NOMBRE DEL PLATILLO'), 1,0,'C',1);
        $pdf->Cell(40,8, utf8_decode('CANTIDAD'),1,0,'C',1);
        $pdf->Cell(40,8,'P. UNITARIO',1,0,'C',1);
        $pdf->Cell(40,8,'IMPORTE', 1,1,'C',1);


  //        $DatesPlatillos = $this->Modelo_Eventos->obtenerPlatillosKEstaEnVenta($venta);
	//
  // foreach ($DatesPlatillos as $DatesPlatillos) {
        // se imprime el numero actual y despues se incrementa el valor de $x en uno
        // Se imprimen los datos de cada alumno
        $pdf->SetFont('Arial','', 10);
				$pdf->SetTextColor(5, 2, 1); //Letra color negra
        $pdf->Cell(70,10,$DatesPlatillos->nombre_platillo , 1, 0, 'C');
        $pdf->Cell(40,10,$DatesPlatillos->cantidad_personas_platillo  , 1, 0, 'C');
        $pdf->Cell(40,10,$DatesPlatillos->costo     , 1, 0, 'C');
        $pdf->Cell(40,10,$DatesPlatillos->precio_total_platillo    , 1, 0, 'C');
        $pdf->Ln(10);
  }

        $pdf->Output("ReportePlatillos_".$venta.".pdf", 'I');

  }





}  // Fin del controller
