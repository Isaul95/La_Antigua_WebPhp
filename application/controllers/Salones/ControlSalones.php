<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControlSalones extends CI_Controller {

  private $permisos;


  public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('session', 'form_validation'));
		$this->permisos = $this->backend_lib->control();
		$this->load->model('ModeloSalones');
	}


  public function index() {
		$AccionesPermitidas = array('permisos' => $this->permisos,);

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/VistaSalones/VistaSalones', $AccionesPermitidas);
		$this->load->view('layouts/footer');
	}


  public function VerSalones() {
		$MostrarConsulta = $this->ModeloSalones->EnlistarSalones();
		echo json_encode($MostrarConsulta);
	}


  public function BuscarSalon() {
    if ($this->input->is_ajax_request()) {
      $BuscarID = $this->input->post('buscarID');
      if ($informacionSalon = $this->ModeloSalones->BuscarDatosSalonSeleccionado($BuscarID)) {
        $RespuestaConsulta = array('Resultado' => "Exitoso", 'DatoSalon' => $informacionSalon);
      } else {
        $RespuestaConsulta = array('Resultado' => "Erroneo", "failed to fetch");
      }
      echo json_encode($RespuestaConsulta);
    } else {
      echo "No se permite este acceso directo";
    }
  }


  public function crearSalon() {
    if ($this->input->is_ajax_request()) {
      $this->form_validation->set_rules('nombre_salon', '', 'required', array('required' => 'El campo nombre no puede ir vacio'));
			$this->form_validation->set_rules('direccion', '', 'required', array('required' => 'El campo dirección no puede ir vacio'));
      $this->form_validation->set_rules('costo_alquiler', '', 'required', array('required' => 'El campo costo no puede ir vacio'));
			$this->form_validation->set_rules('capacidad', '', 'required', array('required' => 'El campo capacidad no puede ir vacio'));
      $this->form_validation->set_rules('descripcion', '', 'required', array('required' => 'El campo descripción no puede ir vacio'));
			$this->form_validation->set_rules('horarios', '', 'required', array('required' => 'El campo horarios no puede ir vacio'));
      if ($this->form_validation->run() == FALSE) {
        $Respuesta = array('Resultado' => "Erroneo", 'Mensaje' => validation_errors());
      } else {
        $ajax_data = $this->input->post();
        if ($this->ModeloSalones->crearNuevoSalon($ajax_data)) {
          $Respuesta = array('Resultado' => "Exitoso", 'Mensaje' => "¡Salón agregado!");
        } else {
          $Respuesta = array('Resultado' => "Erroneo", 'Mensaje' => "No se pudo agregar el salón");
        }
      }
      echo json_encode($Respuesta);
    } else {
      echo "No se permite este acceso directo";
    }
  }


  public function actualizarSalon() {
    if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('nombre_salon', '', 'required', array('required' => 'El campo nombre no puede ir vacio'));
			$this->form_validation->set_rules('direccion', '', 'required', array('required' => 'El campo dirección no puede ir vacio'));
			$this->form_validation->set_rules('costo_alquiler', '', 'required', array('required' => 'El campo costo no puede ir vacio'));
			$this->form_validation->set_rules('capacidad', '', 'required', array('required' => 'El campo capacidad no puede ir vacio'));
			$this->form_validation->set_rules('descripcion', '', 'required', array('required' => 'El campo descripción no puede ir vacio'));
			$this->form_validation->set_rules('horarios', '', 'required', array('required' => 'El campo horarios no puede ir vacio'));
      if ($this->form_validation->run() == FALSE) {
        $Respuesta = array('Resultado' => "Erroneo", 'Mensaje' => validation_errors());
      } else {
        $actualID = $this->input->post('actualID');
        $informacionModificada['nombre_salon'] = $this->input->post('nombre_salon');
				$informacionModificada['direccion'] = $this->input->post('direccion');
        $informacionModificada['costo_alquiler'] = $this->input->post('costo_alquiler');
				$informacionModificada['capacidad'] = $this->input->post('capacidad');
        $informacionModificada['descripcion'] = $this->input->post('descripcion');
				$informacionModificada['horarios'] = $this->input->post('horarios');
        if ($this->ModeloSalones->actualizarSalonSeleccionado($actualID, $informacionModificada)) {
          $Respuesta = array('Resultado' => "Exitoso", 'Mensaje' => "¡Datos del salón actualizados!");
        } else {
          $Respuesta = array('Resultado' => "Erroneo", 'Mensaje' => "No se pudieron actualizar los datos");
        }
      }
      echo json_encode($Respuesta);
    } else {
      echo "No se permite este acceso directo";
    }
  }

  public function EliminarSalon() {
    if ($this->input->is_ajax_request()) {
      $EliminarID = $this->input->post('eliminarID');
      $FotosSalon = $this->ModeloSalones->BuscarFotosSalonSeleccionado($EliminarID);
      foreach ($FotosSalon as $Foto){
        $this->ModeloSalones->EliminarFotoSeleccionada($Foto->id_foto);
      }
      if ($this->ModeloSalones->EliminarSalonSeleccionado($EliminarID)) {
        $RespuestaConsulta = array('Resultado' => "Exitoso");
      } else {
        $RespuestaConsulta = array('Resultado' => "Erroneo", "No se pudo eliminar el salón");
      }
      echo json_encode($RespuestaConsulta);
    } else {
      echo "No se permite este acceso directo";
    }
  }


  public function VerFotos() {
    if ($this->input->is_ajax_request()) {
      $BuscarID = $this->input->post('buscarID');
      $Fotos = $this->ModeloSalones->BuscarFotosSalonSeleccionado($BuscarID);
      echo json_encode($Fotos);
    } else {
    	echo "No se permite este acceso directo...!!!";
    }
  }


  public function Foto($FotoID){
    $Consulta = $this->ModeloSalones->BuscarDatosFotoSeleccionada($FotoID);
    $Foto = $Consulta->foto;
    header("Content-Type: image/jpeg");
    print_r($Foto);
  }


  public function CrearFoto() {
    if ($this->input->is_ajax_request()) {

      $NombreFoto = $_FILES['foto']['name'];
      $FotoTemporal = $_FILES['foto']['tmp_name'];

      $Archivo = fopen($FotoTemporal, 'r+b');
      $BytesFoto = fread($Archivo, filesize($FotoTemporal));
      fclose($Archivo);

      $AgregarDatos['nombre_foto'] = $NombreFoto;
      $AgregarDatos['foto'] = $BytesFoto;
      $AgregarDatos['id_salon'] = $this->input->post('id_salon');

      if ($this->ModeloSalones->CrearNuevaFoto($AgregarDatos)) {
        $Respuesta = array('Resultado' => "Exitoso", 'Mensaje' => "¡Foto agregada!");
      } else {
        $Respuesta = array('Resultado' => "Erroneo", 'Mensaje' => "No se pudo agregar la foto");
      }
      echo json_encode($Respuesta);
    } else {
      echo "No se permite este acceso directo";
    }
  }


  public function EliminarFoto() {
    if ($this->input->is_ajax_request()) {
      $EliminarID = $this->input->post('eliminarID');
      
      if ($this->ModeloSalones->EliminarFotoSeleccionada($EliminarID)) {
        $RespuestaConsulta = array('Resultado' => "Exitoso");
      } else {
        $RespuestaConsulta = array('Resultado' => "Erroneo", "No se pudo eliminar la foto");
      }
      echo json_encode($RespuestaConsulta);
    } else {
      echo "No se permite este acceso directo";
    }
  }

}
