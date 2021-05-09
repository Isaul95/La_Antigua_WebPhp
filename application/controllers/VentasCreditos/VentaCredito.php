<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VentaCredito extends CI_Controller {

		 private $permisos;
	   public function __construct(){
	 	 parent::__construct();
		 $this->load->helper(array('form', 'url'));
	 	 $this->load->library(array('session', 'form_validation'));
		 $this->permisos = $this->backend_lib->control();
	 	 $this->load->model("Modelo_VentaCredito");
		 $this->load->model("Clientes/ModeloCliente"); // Para poder acceder el modelocliente insert table pagos
	 }


	public function index(){
					$data = array(
						'permisos' => $this->permisos,
						'username' => $this->session->userdata('username'),
					);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/ViewCreditos/VistaVentaCredito',$data);
		$this->load->view('layouts/footer');
	}


		public function verListaVentasCreditosActuales(){
			$posts = $this->Modelo_VentaCredito->obtenerAllVentasACreditos();
			echo json_encode($posts);
		}



	public function insertPago(){

			$id_venta = $this->input->post('id_venta');
			$pago = $this->input->post('pago');						// Campo de => pago para venta
			$cambio = $this->input->post('pago');						// Campo de => cambio  para venta

// 		DATOS PARA INSERT INTO TABLE PAGOS los pagos k se hacen de la venta acredito
					$data_pagos['nombre'] 	 = $this->input->post('nombre');
					$data_pagos['monto']     = $this->input->post('pago');
					$data_pagos['id_venta']  = $this->input->post('id_venta');
					$data_pagos['fecha'] 		 = $this->input->post('fecha');
					$data_pagos['hora'] 		 = $this->input->post('hora');

			if ($this->Modelo_VentaCredito->agregarPagoMonto($id_venta, $pago)) {      // Se agregan pagos, suma de pagos
				  $this->Modelo_VentaCredito->restarPagoRestante($id_venta, $cambio);    // Se restan los pagos al cambio o restante table venta
					$this->ModeloCliente->insert_InPagosVentaCredito($data_pagos);

					$sum = $this->Modelo_VentaCredito->sumatoriaTotalPagos($id_venta);

					// echo $sum;

					$this->Modelo_VentaCredito->ventaPagadaCompletaAvRealizada($id_venta,$sum->sumaPagos);

				$data = array('responce' => 'success', 'message' => 'Pago agregado correctamente...!');
			} else {
				$data = array('responce' => 'error', 'message' => 'Fallo al realizar el pago...!');
			}
			echo json_encode($data);
		}

	//
	//
	// public function insertHoraEntrega(){
	// 		$ajax_data = $this->input->post();
	// 		if ($this->Modelo_Rutas->agregarHorarioEntregaMob($ajax_data)) {
	// 			$data = array('responce' => 'success', 'message' => 'Hora de entrega agregado...!');
	// 		} else {
	// 			$data = array('responce' => 'error', 'message' => 'Fallo al agregar hora de entrega...!');
	// 		}
	// 		echo json_encode($data);
	// 	}


}  // Fin del controller
