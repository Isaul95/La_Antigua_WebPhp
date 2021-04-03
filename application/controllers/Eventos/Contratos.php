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


}  // Fin del controller
