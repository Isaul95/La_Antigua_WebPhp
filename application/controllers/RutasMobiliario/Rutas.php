<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rutas extends CI_Controller {

		 private $permisos;
	   public function __construct(){
	 	 parent::__construct();
		 $this->load->helper(array('form', 'url'));
	 	 $this->load->library(array('session', 'form_validation'));
		 $this->permisos = $this->backend_lib->control();
	 	 $this->load->model("Modelo_Rutas");
	 }


	public function index(){
					$data = array(
						'permisos' => $this->permisos,
						'username' => $this->session->userdata('username'),
					);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/ViewRutas/VistaRutas',$data);
		$this->load->view('layouts/footer');
	}


		public function listarMobiliarioParaEntrega(){
			$posts = $this->Modelo_Rutas->obtenerMobiliarioParaEntregar();
			echo json_encode($posts);
		}



	public function insertHoraSalida(){

			$ajax_data = $this->input->post();
			if ($this->Modelo_Rutas->agregarHorarioSalidaMob($ajax_data)) {
				$data = array('responce' => 'success', 'message' => 'Hora de salida agregado...!');
			} else {
				$data = array('responce' => 'error', 'message' => 'Fallo al agregar hora de salida...!');
			}
			echo json_encode($data);
		}



	public function insertHoraEntrega(){
			$ajax_data = $this->input->post();
			if ($this->Modelo_Rutas->agregarHorarioEntregaMob($ajax_data)) {
				$data = array('responce' => 'success', 'message' => 'Hora de entrega agregado...!');
			} else {
				$data = array('responce' => 'error', 'message' => 'Fallo al agregar hora de entrega...!');
			}
			echo json_encode($data);
		}


}  // Fin del controller
