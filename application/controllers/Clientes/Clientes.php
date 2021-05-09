<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {
		 private $permisos;
         public function __construct(){
	 	 parent::__construct();
		 $this->permisos = $this->backend_lib->control();
		 $this->load->helper(array('form', 'url'));
	 	 $this->load->library(array('session', 'form_validation'));
	 	 $this->load->model("Clientes/ModeloCliente");
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
					'ine' => $ine,
					'user_session' => $this->input->post('user_session'),
					'id_evento' => $this->input->post('id_evento'),
					'nombre_ine' => $nombreArchivo
				);

				if ($this->ModeloCliente->agregarCliente($ajax_data)) {
					$data = array('res' => "success", 'message' => "¡Datos del cliente agregado correctamente!");
				} else {
					$data = array('res' => "error", 'message' => "¡Error! :(");
				}

			echo json_encode($data);


		} else {
			echo "No se permite este acceso directo...!!!";
		}
	}




/* =========  Una vez agregado los datos del cliente se recuperan esos datos para visualizarlos NO EDIT  ========== */
	public function verDatosCliente(){
		if ($this->input->is_ajax_request()) {
			$id_evento = $this->input->post('id_evento');
			$user_session = $this->input->post('user_session');

			if ($post = $this->ModeloCliente->extraer_datesCliente($id_evento, $user_session)) {
				 $data = array('responce' => "success", "post" => $post);
			}else{
				$data = array('responce' => "error", "Fallos...!!! Controller(verDatosCliente()) ");
			}
			echo json_encode($data);
		}else {
			echo "No se permite este acceso directo...!!!";
		}
	}



	public function verPdfIneXCliente($id_cliente){
			$consulta = $this->ModeloCliente->getIneCliente($id_cliente);
			$archivo = $consulta['ine'];
			$img = $consulta['nombre_ine'];
			header("Content-type: application/pdf");
			header("Content-Disposition: inline; filename=$img");
			print_r($archivo);

		}



/* =========    ========== */
		public function verSiExisteVentaActual(){
			if ($this->input->is_ajax_request()) {

				$usuario = $this->input->post('usuario');
				$cliente = $this->input->post('cliente');
				$evento = $this->input->post('evento');

				if ($post = $this->ModeloCliente->extraer_ventaActual($usuario, $cliente, $evento)) {
					 // $data = array('responce' => 'success', 'message' => 'Ya existe venta...!');
					 $data = array('responce' => "success", "post" => $post, 'message' => 'Ya existe venta...!');
				}else{
					 $data = array('responce' => 'error', 'message' => 'Aun no existe venta...!');
				}
				echo json_encode($data);
			}else {
				echo "No se permite este acceso directo...!!!";
			}
		}





	public function createNewVenta(){

				$ajax_data = $this->input->post();
				if ($this->ModeloCliente->insert_createNewVenta($ajax_data)) {
					$data = array('responce' => 'success', 'message' => 'Nuevo venta agregado correctamente...!');
				} else {
					$data = array('responce' => 'error', 'message' => 'Fallo al agregar venta...!');
				}
			echo json_encode($data);
	}




	public function createNewInsertInDescripcionVenta(){

				$ajax_data = $this->input->post();
				if ($this->ModeloCliente->insert_InDescripcionVenta($ajax_data)) {
					$data = array('responce' => 'success', 'message' => 'Se agrego en descripcion de venta correctamente...!');
				} else {
					$data = array('responce' => 'error', 'message' => 'Fallo al agregar descripcion de venta...!');
				}
			echo json_encode($data);
	}




	/* =========  Descripcion de Venta  ========== */
	public function verSiExisteVentaActualInDescripcionVenta(){
		if ($this->input->is_ajax_request()) {

			$venta = $this->input->post('venta');
			// $cliente = $this->input->post('cliente');

			if ($post = $this->ModeloCliente->extraer_InDescripcionVenta($venta)) {
				 $data = array('responce' => 'success', 'message' => 'Ya existe en descripcion de venta...!');
				 // $data = array('responce' => "success", "post" => $post, 'message' => 'Ya existe en descripcion de venta...!');
			}else{
				 $data = array('responce' => 'error', 'message' => 'Aun no existe en descripcion venta...!');
			}
			echo json_encode($data);
		}else {
			echo "No se permite este acceso directo...!!!";
		}
	}



	public function createRealizarCobroTerminar(){
				// $ajax_data = $this->input->post();

// 				DATOS PARA INSERT INTO TABLE VENTA
					$data_venta['id_venta'] 		 = $this->input->post('id_venta');
					$data_venta['subtotal']      = $this->input->post('subtotal');
					$data_venta['total'] 				 = $this->input->post('total');
					$data_venta['pago'] 				 = $this->input->post('pago');
					$data_venta['cambio'] 		   = $this->input->post('cambio');
					$data_venta['estado_venta']  = $this->input->post('estado_venta');
					$data_venta['fecha_reporte'] 				 = $this->input->post('fecha_reporte');
					$data_venta['hora'] 				 = $this->input->post('hora');


// 				DATOS PARA INSERT INTO TABLE EGRESos
					$data_egreso['cantidad'] 	= $this->input->post('cantidad');
					$data_egreso['tipo']      = $this->input->post('tipo');
					$data_egreso['fecha'] 		= $this->input->post('fecha_reporte');
					$data_egreso['total'] 		= $this->input->post('cambio');
					$data_egreso['usuario'] 	= $this->input->post('usuario');
					$data_egreso['id_venta'] 	= $this->input->post('id_venta');


// 				DATOS PARA INSERT INTO TABLE PAGOS los pagos k se hacen de la venta acredito
					$data_pagos['nombre'] 	 = $this->input->post('nombre');
					$data_pagos['monto']  = $this->input->post('pago');
					$data_pagos['id_venta']  = $this->input->post('id_venta');
					$data_pagos['fecha'] 		 = $this->input->post('fecha_reporte');
					$data_pagos['hora'] 		 = $this->input->post('hora');


				if ($this->ModeloCliente->insert_InVentaRealizarCobroTotal($data_venta)) {
						$this->ModeloCliente->insert_InEgresoVentaCredito($data_egreso);
						$this->ModeloCliente->insert_InPagosVentaCredito($data_pagos);
					$data = array('responce' => 'success', 'message' => 'Se agrego la venta correctamente...!');
				} else {
					$data = array('responce' => 'error', 'message' => 'Fallo al agregar la venta Final...!');
				}
			echo json_encode($data);
	}




	/* =========  verificar en que estado de venta se quedo venta realiza o venta a credito por pagar  ========== */
	public function verTipoVentaActualInEstadoVenta(){
		if ($this->input->is_ajax_request()) {

			$usuario = $this->input->post('usuario');
			$cliente = $this->input->post('cliente');
			$evento = $this->input->post('evento');

			if ($post = $this->ModeloCliente->extraer_verTipoVentaActual_EstadoVenta($usuario, $cliente, $evento)) {
				 // $data = array('responce' => 'success', 'message' => 'Ya existe venta...!');
				 $data = array('responce' => "success", "post" => $post, 'message' => 'Ya existe venta CREDITO...!');
			}else{
				 $data = array('responce' => 'error', 'message' => 'Aun no existe venta...!');
			}
			echo json_encode($data);
		}else {
			echo "No se permite este acceso directo...!!!";
		}
	}



}  // Fin del controller
