<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DocumentosAlumnos extends CI_Controller {

		 // private $permisos;
	   public function __construct(){
	 	 parent::__construct();
		 $this->load->helper(array('form', 'url'));
	 	 $this->load->library(array('session', 'form_validation'));
		 // $this->permisos = $this->backend_lib->control();
	 	 $this->load->model("Modelo_DocumentosDeAlumnos");
	 }


	public function index(){

		// $data = array(
		// 	'permisos' => $this->permisos,
		// );

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/Vistas_administrativos/VistaDocumentosAlumnos');
		$this->load->view('layouts/footer');
	}


	/* -------------------------------------------------------------------------- */
	/*                       Datos generales del alumno                           */
	/* --------------------------------------- ---------------------------------- */

		public function datosGralDelAlumno(){

			$posts = $this->Modelo_DocumentosDeAlumnos->obtenerDatosGnralDelAlumnos();
			echo json_encode($posts);
		}



		/* -------------------------------------------------------------------------- */
		/*                  1.- Generar certificado de estudios                       */
		/* --------------------------------------- ---------------------------------- */

		public function generaCertificadoEstudios($numero_control,$semestre){
			/*
			 * Se crea la function para hacer el llamado en el js
			 * se hace todo la parte del reporte
			 */
			error_reporting(0);

			include_once('src/phpjasperxml_0.9d/class/tcpdf/tcpdf.php');
			include_once("src/phpjasperxml_0.9d/class/PHPJasperXML.inc.php");

			// SE HACE LA CONECION PARA CADA HOJA DE ESTAS
			$server = "localhost";
			$user = "root";
			$pass = "";
			$db = "cesvi_webapp";


			$PHPJasperXML = new PHPJasperXML();
			 // $PHPJasperXML->debugsql=true;
			// 	$PHPJasperXML-> debugsql = false; // Si desea ver la setencia del sql del reporte lo pones en true

			$PHPJasperXML->arrayParameter=array("num_control"=>$numero_control,"Dsemestre"=>$semestre);

			$PHPJasperXML->load_xml_file("src/ReportesPDF_Cesvi_jrxml/certificado_estudios_plantilla.jrxml");

			$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
			$PHPJasperXML->outpage('I','CertificadoEstudios_'.$numero_control.'.pdf');

		}



/* -------------------------------------------------------------------------- */
/*                  2.- Generar boleta calificaciones                        */
/* --------------------------------------- ---------------------------------- */

				public function generaBoletaCalificaciones($numero_control,$semestre,$id_carrera){
					/*
					 * Se crea la function para hacer el llamado en el js
					 * se hace todo la parte del reporte
					 */
					error_reporting(0);

					include_once('src/phpjasperxml_0.9d/class/tcpdf/tcpdf.php');
					include_once("src/phpjasperxml_0.9d/class/PHPJasperXML.inc.php");

					// SE HACE LA CONECION PARA CADA HOJA DE ESTAS
					$server = "localhost";
					$user = "root";
					$pass = "";
					$db = "cesvi_webapp";


					$PHPJasperXML = new PHPJasperXML();
					 // $PHPJasperXML->debugsql=true;
					// 	$PHPJasperXML-> debugsql = false; // Si desea ver la setencia del sql del reporte lo pones en true

					$PHPJasperXML->arrayParameter=array("num_control"=>$numero_control,"Dsemestre"=>$semestre,"idcarrera"=>$id_carrera);

					$PHPJasperXML->load_xml_file("src/ReportesPDF_Cesvi_jrxml/boleta_Calificaciones_plantilla.jrxml");

					$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
					$PHPJasperXML->outpage('I','BoletaCalificaciones_'.$numero_control.'.pdf');

				}



				/* -------------------------------------------------------------------------- */
				/*                      3.- Generar Historial Academico                       */
				/* --------------------------------------- ---------------------------------- */

		public function generaHistAcademico($numero_control,$id_carrera){
									/*
									 * Se crea la function para hacer el llamado en el js
									 * se hace todo la parte del reporte
									 */
									error_reporting(0);

									include_once('src/phpjasperxml_0.9d/class/tcpdf/tcpdf.php');
									include_once("src/phpjasperxml_0.9d/class/PHPJasperXML.inc.php");

									// SE HACE LA CONECION PARA CADA HOJA DE ESTAS
									$server = "localhost";
									$user = "root";
									$pass = "";
									$db = "cesvi_webapp";

									$PHPJasperXML = new PHPJasperXML();
									 // $PHPJasperXML->debugsql=true;
									// 	$PHPJasperXML-> debugsql = false; // Si desea ver la setencia del sql del reporte lo pones en true

// $PHPJasperXML->arrayParameter=array("class_id"=>"'" .$p1. "'","student_name"=>"'" .$p2."'"); // EXAMPLE: MULTIPLES PARAMETRPS
									$PHPJasperXML->arrayParameter=array("num_control"=>$numero_control,"idcarrera"=>$id_carrera);
									// $PHPJasperXML->arrayParameter=array("parameter1"=>1);

									$PHPJasperXML->load_xml_file("src/ReportesPDF_Cesvi_jrxml/historia_academica_plantilla.jrxml");

									$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
									// $PHPJasperXML->outpage('I','HistorialAcademico_.pdf');
									$PHPJasperXML->outpage('I','HistorialAcademico_'.$numero_control.'.pdf');

								}


								/* -------------------------------------------------------------------------- */
								/*                      4.- Generar Horario Alumno                       */
								/* --------------------------------------- ---------------------------------- */

						public function generaHorarioAlumno($numero_control,$semestre){
													/*
													 * Se crea la function para hacer el llamado en el js
													 * se hace todo la parte del reporte
													 */
													error_reporting(0);

													include_once('src/phpjasperxml_0.9d/class/tcpdf/tcpdf.php');
													include_once("src/phpjasperxml_0.9d/class/PHPJasperXML.inc.php");

													// SE HACE LA CONECION PARA CADA HOJA DE ESTAS
													$server = "localhost";
													$user = "root";
													$pass = "";
													$db = "cesvi_webapp";

													$PHPJasperXML = new PHPJasperXML();
													 // $PHPJasperXML->debugsql=true;
													// 	$PHPJasperXML-> debugsql = false; // Si desea ver la setencia del sql del reporte lo pones en true

						// $PHPJasperXML->arrayParameter=array("class_id"=>"'" .$p1. "'","student_name"=>"'" .$p2."'"); // EXAMPLE: MULTIPLES PARAMETRPS
													$PHPJasperXML->arrayParameter=array("num_control"=>$numero_control,"Dsemestre"=>$semestre);
													// $PHPJasperXML->arrayParameter=array("parameter1"=>1);

$PHPJasperXML->load_xml_file("src/ReportesPDF_Cesvi_jrxml/Horarios.jrxml");

													$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
													// $PHPJasperXML->outpage('I','HistorialAcademico_.pdf');
													$PHPJasperXML->outpage('I','HistorialAcademico_'.$numero_control.'.pdf');

												}





}  // Fin del controller
