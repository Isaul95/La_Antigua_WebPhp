<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListaPlatillosEncargado extends CI_Controller {
		 private $permisos;
         public function __construct(){
	 	 parent::__construct();
		 $this->permisos = $this->backend_lib->control();
	 	 $this->load->library(array('session', 'form_validation'));
	 	 $this->load->model("ModeloPlatillos");
	 }

	public function index(){
		$data  = array(
			'permisos' => $this->permisos,
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/VistaPlatillos/VistaPlatillosEnVenta',$data);
		$this->load->view('layouts/footer');
	}



# Listar platillos que esta para entregar a evento
public function listarPlatillosEncargadoParaEntrega(){
    $posts = $this->ModeloPlatillos->obtenerPlatillosParaEntregar();
    echo json_encode($posts);
}




}  // Fin del controller
