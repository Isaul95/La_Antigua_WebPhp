<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NuevoEvento extends CI_Controller {

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
		$this->load->view('admin/ViewEventos/VistaNuevoEvento',$data);
		$this->load->view('layouts/footer');
	}


	/* -------------------------------------------------------------------------- */
	/*                      INSERTAR NUEVO EVENTO DEL DIA                         */
	/* --------------------------------------- ---------------------------------- */

		public function load(){
			$posts = $this->Modelo_Eventos->get_listarAllEventos();
			echo json_encode($posts);
		}


	public function insertNewEvent(){

				$ajax_data = $this->input->post();
				if ($this->Modelo_Eventos->insert_entry($ajax_data)) {
					$data = array('responce' => 'success', 'message' => 'Nuevo evento agregado correctamente...!');
				} else {
					$data = array('responce' => 'error', 'message' => 'Fallo al agregar datos del evento...!');
				}
			echo json_encode($data);
	}


	public function deleteEvent(){

				if ($this->input->is_ajax_request()) {
					$id_evento = $this->input->post('id_evento');

					if ($this->Modelo_Eventos->eliminarEvento($id_evento)) {
						$data = array('responce' => 'success');
					} else {
						$data = array('responce' => 'error');
					}
					echo json_encode($data);
				} else {
					echo "No direct script access allowed";
				}
			}


		public function updateEvent(){

					$id_evento = $this->input->post('id_evento');
					$ajax_data = $this->input->post();

					if ($this->Modelo_Eventos->update_evento($id_evento, $ajax_data)) {
						$data = array('response' => 'success', 'message' => 'Evento actualizado correctamente...!');
					} else {
						$data = array('response' => 'error', 'message' => 'Fallo al actualizar datos del evento...!');
					}
				echo json_encode($data);

		}






    public function generaReportePdfEvento($idEvento){

    			 require "./src/report-fpdf/fpdf.php";

           $pdf = new FPDF();

           // $pdf->AddPage('P','A4',0);
           $pdf->AddPage();
           $pdf->SetFont('Arial','B', 12);
					 $pdf->Image('src/LogCesvi.jpg', 3, 3, 50);

					  $pdf->SetY(20);
           $pdf->Cell(0,20, utf8_decode('Este header se muestra en cada página generada'),0,0,'C');
					 $pdf->Ln(27);

          $pdf->Cell(15,10,'NUM',    1,0,'C');
          $pdf->Cell(65,10,'PATERNO',1,0,'C');
          $pdf->Cell(60,10,'MATERNO',1,0,'C');
          $pdf->Cell(55,10,'NOMBRE', 1,1,'C');


           // $DatesPlatillos = $this->ModeloPlatillos->EnlistarPlatillos();


    // foreach ($DatesPlatillos as $DatesPlatillos) {
    //       // se imprime el numero actual y despues se incrementa el valor de $x en uno
    //       // Se imprimen los datos de cada alumno
    //       $pdf->SetFont('Arial','', 10);
    //       $pdf->Cell(15,10,$DatesPlatillos->nombre_platillo , 1, 0, 'C');
    //       $pdf->Cell(65,10,$DatesPlatillos->costo           , 1, 0, 'C');
    //       $pdf->Cell(60,10,$DatesPlatillos->descripcion     , 1, 0, 'C');
    //       $pdf->Cell(55,10,$DatesPlatillos->ingredientes    , 1, 0, 'C');
    //       $pdf->Ln(10);
		//
    // }

          $pdf->Output("ReporteEvento_#".$idEvento.".pdf", 'I');

    }









}  // Fin del controller
