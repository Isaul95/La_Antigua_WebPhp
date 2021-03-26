<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {
		 private $permisos;
         public function __construct(){
	 	 parent::__construct();
		 $this->permisos = $this->backend_lib->control();
		 $this->load->helper(array('form', 'url'));
	 	 $this->load->library(array('session', 'form_validation'));
	 	 $this->load->model("Clientes/ModeloClientes");
	 }

	public function index(){
		$data  = array(
			'permisos' => $this->permisos,
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/Clientes/VistaClientes',$data);
		$this->load->view('layouts/footer');
	}

	public function addCliente(){
		//echo implode(",", $this->input->post());

		if ($this->input->post()) {

				$ine='';
				$tipoArchivo='';
				if (isset($_FILES["ine"])) {
				if ($_FILES['ine']['name'] != '') {
					// code...
					$nombreArchivo = $_FILES['ine']['name'];
					$tipoArchivo = $_FILES['ine']['type'];
					$tamanoArchivo = $_FILES['ine']['size'];
					$archivoSubido = fopen($_FILES['ine']['tmp_name'], 'r+b');
					$ine = fread($archivoSubido, $tamanoArchivo);
					fclose($archivoSubido);
				}
			}
				else {
					$ine='';
					$tipoArchivo='';
				}
				//
				$ajax_data = array(
					'nombre' => $this->input->post('nombre'),
					'direccion' => $this->input->post('direccion'),
					'telefono' => $this->input->post('telefono'),
					'sexo' => $this->input->post('sexo'),
					'email' => $this->input->post('email'),
					'ine' => $ine
				);

				if ($this->ModeloClientes->agregarCliente($ajax_data)) {
					$data = array('res' => "success", 'message' => "¡Cliente agregado!");
				} else {
					$data = array('res' => "error", 'message' => "¡Error! :(");
				}

			echo json_encode($data);


		} else {
			echo "No se permite este acceso directo...!!!";
		}
	}



}  // Fin del controller
