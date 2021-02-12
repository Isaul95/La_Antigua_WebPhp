<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Platillos extends CI_Controller {

		 private $permisos;
	   public function __construct(){
	 	 parent::__construct();
		 $this->load->helper(array('form', 'url'));
	 	 $this->load->library(array('session', 'form_validation'));
		 $this->permisos = $this->backend_lib->control();
	 	 $this->load->model("Modelo_Platillos");
	 }


	public function index(){
					$data = array(
						'permisos' => $this->permisos,
					);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/ViewBanquetes/VistaPlatillos',$data);
		$this->load->view('layouts/footer');
	}


	/* -------------------------------------------------------------------------- */
	/*                       Datos generales del alumno                           */
	/* --------------------------------------- ---------------------------------- */

		public function verPlatillos(){
			$posts = $this->Modelo_Platillos->get_listaPlatillos();
			echo json_encode($posts);
		}





}  // Fin del controller
