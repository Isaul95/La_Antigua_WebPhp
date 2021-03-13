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

        //$this->form_validation->set_rules("id_platillo", "", "required", array ('required' => "El campo ID no puede ir vacio"));
        $this->form_validation->set_rules('nombre_platillo', "", 'required|max_length[75]', array ('required' => "El campo nombre no puede ir vacio.", 'max_length' => "No debe ingresar más de 75 caracteres (letras, símbolos, números) en el campo nombre."));
        $this->form_validation->set_rules('costo', "", 'required|callback_ValidarCosto', array ('required' => "El campo costo no puede ir vacio"));
        $this->form_validation->set_rules('descripcion', "", 'required|max_length[500]', array('required' => "El campo descripción no puede ir vacio.", 'max_length' => "No debe ingresar más de 500 caracteres (letras, símbolos, números) en el campo descripcion."));

        if ($this->form_validation->run() == FALSE) {
          $Respuesta = array ('Resultado' => "Erroneo", 'Mensaje' => validation_errors());
        } else {

          $config['upload_path'] = './assets/platillosImagenes/';
          $config['allowed_types'] = 'gif|jpg|png';

          $this->load->library('upload', $config);
          if (!$this->upload->do_upload('foto')) {
            $Respuesta = array('Resultado' => "Erroneo", 'Mensaje' => $this->upload->display_errors());
          } else {

            $AgregarDatos = $this->input->post();
            $AgregarDatos['foto'] = $this->upload->data('file_name');
            if ($this->ModeloPlatillos->CrearNuevoPlatillo($AgregarDatos)) {
              $Respuesta = array('Resultado' => "Exitoso", 'Mensaje' => "¡Platillo agregado!");
            } else {
              $Respuesta = array('Resultado' => "Erroneo", 'Mensaje' => "No se pudo agregar el platillo");
            }
          }
        }
          echo json_encode($Respuesta);
        } else {
          echo "No se permite este acceso directo";
        }
      }


    public function ActualizarPlatillo() {
      if ($this->input->is_ajax_request()) {
        //$this->form_validation->set_rules('modificadoID', '', 'required', array('required' => 'El campo ID no puede ir vacio.'));
        $this->form_validation->set_rules('nombre_platillo', "", 'required|max_length[75]', array ('required' => "El campo nombre no puede ir vacio.", 'max_length' => "No debe ingresar más de 75 caracteres (letras, símbolos, números) en el campo nombre."));
        $this->form_validation->set_rules('costo', "", 'required|callback_ValidarCosto', array ('required' => "El campo costo no puede ir vacio"));
        $this->form_validation->set_rules('descripcion', "", 'required|max_length[500]', array('required' => "El campo descripción no puede ir vacio.", 'max_length' => "No debe ingresar más de 500 caracteres (letras, símbolos, números) en el campo descripcion."));

        if ($this->form_validation->run() == FALSE) {
          $Respuesta = array('Resultado' => "Erroneo", 'Mensaje' => validation_errors());
        } else {

          $ActualID = $this->input->post('actualID');

          //$ModificarDatos['id_platillo'] = $this->input->post('modificadoID');
          $ModificarDatos['nombre_platillo'] = $this->input->post('nombre_platillo');
          $ModificarDatos['costo'] = $this->input->post('costo');
          $ModificarDatos['descripcion'] = $this->input->post('descripcion');

          if (isset($_FILES['foto']['name'])) {

            $config['upload_path'] = './assets/platillosImagenes/';
            $config['allowed_types'] = 'gif|jpg|png';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('foto')) {
              $Respuesta = array('Resultado' => "Erroneo", 'Mensaje' => $this->upload->display_errors());
            } else {

              if ($EliminarFoto = $this->ModeloPlatillos->BuscarDatosPlatilloSeleccionado($ActualID)) {
                unlink('./assets/platillosImagenes/' . $EliminarFoto->foto);
                //$ModificarDatos['foto'] = $this->upload->data('file_name');
                $data = array("upload_data" => $this->upload->data());
                $imagenModificada = $data['upload_data']['file_name'];
                $ModificarDatos['foto'] = $imagenModificada;
              }
            }
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
      $EliminarFoto = $this->ModeloPlatillos->BuscarDatosPlatilloSeleccionado($EliminarID);
      $ResultadoEliminacion = $this->ModeloPlatillos->EliminarPlatilloSeleccionado($EliminarID);
      if ($ResultadoEliminacion == "Eliminado") {
        unlink('./assets/platillosImagenes/' . $EliminarFoto->foto);
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

}
