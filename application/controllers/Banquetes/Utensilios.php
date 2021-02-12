<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utensilios extends CI_Controller {

		 private $permisos;
	   public function __construct(){
	 	 parent::__construct();
		 $this->load->helper(array('form', 'url'));
	 	 $this->load->library(array('session', 'form_validation'));
		 $this->permisos = $this->backend_lib->control();
	 	 $this->load->model("Modelo_Utensilios");
	 }


	public function index(){

		$data = array(
			'permisos' => $this->permisos,
		);

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/ViewBanquetes/VistaUtensilios',$data);
		$this->load->view('layouts/footer');
	}


	/* -------------------------------------------------------------------------- */
	/*                       Datos generales del alumno                           */
	/* --------------------------------------- ---------------------------------- */

		public function verUtensilios(){
			$posts = $this->Modelo_Utensilios->get_listaUtensilios();
			echo json_encode($posts);
		}









}  // Fin del controller
