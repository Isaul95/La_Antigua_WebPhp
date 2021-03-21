<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NuevoEvento extends CI_Controller {

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
					);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/ViewEventos/VistaNuevoEvento',$data);
		$this->load->view('layouts/footer');
	}


	/* -------------------------------------------------------------------------- */
	/*                      INSERTAR NUEVO EVENTO DEL DIA                         */
	/* --------------------------------------- ---------------------------------- */

		public function load(){
			$posts = $this->Modelo_Eventos->get_listarAllEventos();
			echo json_encode($posts);
		}


	public function insertNewEvent(){

				$ajax_data = $this->input->post();
				if ($this->Modelo_Eventos->insert_entry($ajax_data)) {
					$data = array('responce' => 'success', 'message' => 'Nuevo evento agregado correctamente...!');
				} else {
					$data = array('responce' => 'error', 'message' => 'Fallo al agregar datos del evento...!');
				}
			echo json_encode($data);
	}


	public function deleteEvent(){

				if ($this->input->is_ajax_request()) {
					$id_evento = $this->input->post('id_evento');

					if ($this->Modelo_Eventos->eliminarEvento($id_evento)) {
						$data = array('responce' => 'success');
					} else {
						$data = array('responce' => 'error');
					}
					echo json_encode($data);
				} else {
					echo "No direct script access allowed";
				}
			}


		public function updateEvent(){

					$id_evento = $this->input->post('id_evento');
					$ajax_data = $this->input->post();

					if ($this->Modelo_Eventos->update_evento($id_evento, $ajax_data)) {
						$data = array('response' => 'success', 'message' => 'Evento actualizado correctamente...!');
					} else {
						$data = array('response' => 'error', 'message' => 'Fallo al actualizar datos del evento...!');
					}
				echo json_encode($data);

		}



}  // Fin del controller
