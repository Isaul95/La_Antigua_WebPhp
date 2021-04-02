<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControlPlatillos extends CI_Controller {

  private $permisos;


  public function __construct() {
		parent::__construct();
		$this->load->helper(array ("form", "url"));
		$this->load->library(array ("session", "form_validation"));
		$this->permisos = $this->backend_lib->control();
		$this->load->model('ModeloPlatillos');
	}


  public function index() {
		$AccionesPermitidas = array ('permisos' => $this->permisos,);

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/VistaPlatillos/VistaPlatillos', $AccionesPermitidas);
		$this->load->view('layouts/footer');
	}


  public function VerPlatillos() {
		$MostrarConsulta = $this->ModeloPlatillos->EnlistarPlatillos();
		echo json_encode($MostrarConsulta);
	}


  public function Foto($PlatilloID){
    $Consulta = $this->ModeloPlatillos->Buscarfotodeplatillo($PlatilloID);
    $Foto = $Consulta->foto;
    header("Content-Type: image/jpeg");
    print_r($Foto);
  }


  public function BuscarPlatillo() {
    if ($this->input->is_ajax_request()) {
      $BuscarID = $this->input->post('buscarID');
      if ($informacionPlatillo = $this->ModeloPlatillos->BuscarDatosPlatilloSeleccionado($BuscarID)) {
        $RespuestaConsulta = array ('Resultado' => "Exitoso", 'DatoPlatillo' => $informacionPlatillo);
      } else {
        $RespuestaConsulta = array ('Resultado' => "Erroneo", 'Mensaje' => "No se encontrarón los datos del platillo seleccionado");
      }
      echo json_encode($RespuestaConsulta);
    } else {
      echo "No se permite este acceso directo";
    }
  }


  public function CrearPlatillo() {
    if ($this->input->is_ajax_request()) {

      $this->form_validation->set_rules('nombre_platillo', "", 'required|max_length[75]', array ('required' => "El campo nombre no puede ir vacio.", 'max_length' => "No debe ingresar más de 75 caracteres (letras, símbolos, números) en el campo nombre."));
      $this->form_validation->set_rules('costo', "", 'required|callback_ValidarCosto', array ('required' => "El campo costo no puede ir vacio"));
      $this->form_validation->set_rules('descripcion', "", 'required|max_length[500]', array('required' => "El campo descripción no puede ir vacio.", 'max_length' => "No debe ingresar más de 500 caracteres (letras, símbolos, números) en el campo descripcion."));

      if ($this->form_validation->run() == FALSE) {
        $Respuesta = array ('Resultado' => "Erroneo", 'Mensaje' => validation_errors());
      } else {
        if (isset($_FILES['foto']['name'])) {

          $NombreFoto = $_FILES['foto']['name'];
          $FotoTemporal = $_FILES['foto']['tmp_name'];

          $Archivo = fopen($FotoTemporal, 'r+b');
          $BytesFoto = fread($Archivo, filesize($FotoTemporal));
          fclose($Archivo);

          $AgregarDatos['nombre_foto'] = $NombreFoto;
          $AgregarDatos['foto'] = $BytesFoto;
        }
        $AgregarDatos = $this->input->post();
       

        if ($this->ModeloPlatillos->CrearNuevoPlatillo($AgregarDatos)) {
          $Respuesta = array('Resultado' => "Exitoso", 'Mensaje' => "¡Platillo agregado!");
        } else {
          $Respuesta = array('Resultado' => "Erroneo", 'Mensaje' => "No se pudo agregar el platillo");
        }
      }
        echo json_encode($Respuesta);
      } else {
        echo "No se permite este acceso directo";
      }
    }


  public function ActualizarPlatillo() {
    if ($this->input->is_ajax_request()) {

      $this->form_validation->set_rules('nombre_platillo', "", 'required|max_length[75]', array ('required' => "El campo nombre no puede ir vacio.", 'max_length' => "No debe ingresar más de 75 caracteres (letras, símbolos, números) en el campo nombre."));
      $this->form_validation->set_rules('costo', "", 'required|callback_ValidarCosto', array ('required' => "El campo costo no puede ir vacio"));
      $this->form_validation->set_rules('descripcion', "", 'required|max_length[500]', array('required' => "El campo descripción no puede ir vacio.", 'max_length' => "No debe ingresar más de 500 caracteres (letras, símbolos, números) en el campo descripcion."));

      if ($this->form_validation->run() == FALSE) {
        $Respuesta = array('Resultado' => "Erroneo", 'Mensaje' => validation_errors());
      } else {

        $ActualID = $this->input->post('actualID');

        $ModificarDatos['nombre_platillo'] = $this->input->post('nombre_platillo');
        $ModificarDatos['costo'] = $this->input->post('costo');
        $ModificarDatos['descripcion'] = $this->input->post('descripcion');

        if (isset($_FILES['foto']['name'])) {

          $NombreFoto = $_FILES['foto']['name'];
          $FotoTemporal = $_FILES['foto']['tmp_name'];

          $Archivo = fopen($FotoTemporal, 'r+b');
          $BytesFoto = fread($Archivo, filesize($FotoTemporal));
          fclose($Archivo);

          $ModificarDatos['nombre_foto'] = $NombreFoto;
          $ModificarDatos['foto'] = $BytesFoto;
        }

        if ($this->ModeloPlatillos->ActualizarPlatilloSeleccionado($ActualID, $ModificarDatos)) {
          $Respuesta = array('Resultado' => "Exitoso", 'Mensaje' => "¡Datos del platillo actualizados!");
        } else {
          $Respuesta = array('Resultado' => "Erroneo", 'Mensaje' => "No se pudieron actualizar los datos");
        }
      }
      echo json_encode($Respuesta);
    } else {
      echo "No se permite este acceso directo";
    }
  }


  public function EliminarPlatillo() {
    if ($this->input->is_ajax_request()) {
      $EliminarID = $this->input->post('eliminarID');
      $ResultadoEliminacion = $this->ModeloPlatillos->EliminarPlatilloSeleccionado($EliminarID);
      if ($ResultadoEliminacion == "Eliminado") {
        $RespuestaConsulta = array ('Resultado' => "Exitoso");
      } else {
        $RespuestaConsulta = array ('Resultado' => "Erroneo");
      }
      echo json_encode($RespuestaConsulta);
    } else {
      echo "No se permite este acceso directo";
    }
  }


  public function ValidarCosto($Costo) {
    $ExpresionRegular = "/[0-9]*\.?[0-9]*/";
    preg_match($ExpresionRegular, $Costo, $Coincidencias);
    if (count($Coincidencias) > 0) {
      if (strlen($Costo) == strlen($Coincidencias[0])) {
        $ExpresionRegularPesos = "/[0-9]*/";
        $ExpresionRegularCentavos = "/\.[0-9]*/";
        preg_match($ExpresionRegularPesos, $Costo, $CoincidenciasPesos);
        preg_match($ExpresionRegularCentavos, $Costo, $CoincidenciasCentavos);
        if (count($CoincidenciasCentavos) > 0) {
          if (strlen($CoincidenciasPesos[0]) <= 7 and (strlen($CoincidenciasCentavos[0]) <= 3)) {
            return true;
          } else {
            if (strlen($CoincidenciasPesos[0]) > 7) {
              $this->form_validation->set_message('ValidarCosto', "No debe ingresar valores mayores a 9,999,999.99 en el campo costo.");
            } else {
              $this->form_validation->set_message('ValidarCosto', "Sólo puede agregar dos dígitos, uno o ninguno después del punto decimal para el campo costo.");
            }
            return false;
          }
        } else {
          if (strlen($Costo) <= 7) {
            return true;
          } else {
            $this->form_validation->set_message('ValidarCosto', "No debe ingresar valores mayores a 9,999,999 en el campo costo.");
            return false;
          }
        }
      } else {
        $this->form_validation->set_message('ValidarCosto', "Favor de solo introducir números sin espacios ni comas para el precio del platillo, y el punto decimal para los centavos en caso de que sea necesario, en el campo costo.");
        return false;
      }
    } else {
      $this->form_validation->set_message('ValidarCosto', "Favor de solo introducir números sin espacios ni comas para el precio del platillo, y el punto decimal para los centavos en caso de que sea necesario, en el campo costo.");
      return false;
    }
  }







  //
  // public function generaHorarioProfesor(){
  // 			 require "./src/report-fpdf/fpdf.php";
  //
  //
  //       // Cabecera de p�gina
  //
  // 	$pdf = new FPDF();
  //       	// Logo
  //       	// $pdf->Image('src/reporte-fpdf/tutorial/logo.png',10,8,33);
  //       	// $pdf->Arial bold 15
  //       	$pdf->SetFont('Arial','B',15);
  //       	// Movernos a la derecha
  //       	$pdf->Cell(80);
  //       	// T�tulo
  //       	// $pdf->Cell(30,10,'Title',1,0,'L');
  //       	// Salto de l�nea
  //       	$pdf->Ln(20);
  //
  //
  //       // Pie de p�gina
  //
  //       	// Posici�n: a 1,5 cm del final
  //       	$pdf->SetY(-15);
  //       	// Arial italic 8
  //       	$pdf->SetFont('Arial','I',8);
  //       	// N�mero de p�gina
  //       	$pdf->Cell(0,10,'Page '.$pdf->PageNo().'/{nb}',0,0,'C');
  //
  //       // Creaci�n del objeto de la clase heredada
  //       // $pdf = new PDF();
  //       $pdf->AliasNbPages();
  //       $pdf->AddPage();
  //       $pdf->SetFont('Times','',12);
  //       for($i=1;$i<=40;$i++)
  //       	$pdf->Cell(0,10,'Imprimiendo l�nea n�mero '.$i,0,1);
  //       $pdf->Output();
  //
  //
  // }



    public function generaHorarioProfesor(){

    			 require "./src/report-fpdf/fpdf.php";
      // include_once("./application/config/setting.php");


           $pdf = new FPDF();

           // $pdf->AddPage('P','A4',0);
           $pdf->AddPage();
           $pdf->SetFont('Arial','B', 12);
           // $pdf->Image('src/LogCesvi.jpg', 5, 5, 30);
           // $pdf->Image('src/LogCesvi.jpg' , 80 ,22, 35 , 38,'JPG');
           $pdf->Image("ssbu.jpg",60,50, 100, 70,’JPG’,"http://evilnapsis.com/");

           $pdf->Cell(100,10, utf8_decode('Este header se muestra en cada página generada'),1,1,'L');
           // $pdf->Cell(0,10,utf8_decode('Este footer se muestra en cada página generada'),1,0,'L');
           // $this->Ln(20);


   /*
  * TITULOS DE COLUMNAS
  *
  * $this-&amp;gt;pdf-&amp;gt;Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
  */

          $pdf->Cell(15,10,'NUM',    1,0,'C');
          $pdf->Cell(65,10,'PATERNO',1,0,'C');
          $pdf->Cell(60,10,'MATERNO',1,0,'C');
          $pdf->Cell(55,10,'NOMBRE', 1,1,'C');
          // $pdf->Cell(40,10,'FECHA DE NACIMIENTO','TB',0,'C','1');


           $DatesPlatillos = $this->ModeloPlatillos->EnlistarPlatillos();


    foreach ($DatesPlatillos as $DatesPlatillos) {
          // se imprime el numero actual y despues se incrementa el valor de $x en uno
          // Se imprimen los datos de cada alumno
          $pdf->SetFont('Arial','', 10);
          $pdf->Cell(15,10,$DatesPlatillos->nombre_platillo , 1, 0, 'C');
          $pdf->Cell(65,10,$DatesPlatillos->costo           , 1, 0, 'C');
          $pdf->Cell(60,10,$DatesPlatillos->descripcion     , 1, 0, 'C');
          $pdf->Cell(55,10,$DatesPlatillos->ingredientes    , 1, 0, 'C');
          $pdf->Ln(10);

    //    $pdf->Cell(25,5,$DatesPlatillos-> ,B',0,'L',0);
    //    $pdf->Cell(25,5,$DatesPlatillos-> ,BR',0,'C',0);
    //  Se agrega un salto de linea
    }

           $pdf->Output("Lista de Xalumnos.pdf", 'I');


    }




}
