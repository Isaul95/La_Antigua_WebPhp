<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControlPlatillosClientes extends CI_Controller {

  private $permisos;


  public function __construct() {
		parent::__construct();
		$this->load->helper(array ("form", "url"));
		$this->load->library(array ("session", "form_validation"));
		$this->permisos = $this->backend_lib->control();
		$this->load->model('ModeloPlatillosClientes');
	}


  public function index() {
		$AccionesPermitidas = array ('permisos' => $this->permisos,);

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/VistaPlatillosClientes/VistaPlatillosClientes', $AccionesPermitidas);
		$this->load->view('layouts/footer');
	}


  public function MostrarPlatillos() {
    $MostrarConsulta = $this->ModeloPlatillosClientes->EnlistarPlatillos();
    echo json_encode($MostrarConsulta);
  }


  public function Foto($PlatilloID) {
    $Consulta = $this->ModeloPlatillosClientes->BuscarDatosPlatilloSeleccionado($PlatilloID);
    $Foto = $Consulta->foto;
    header("Content-Type: image/jpeg");
    print_r($Foto);
  }


}
