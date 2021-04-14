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




	public function insertPiezasAlquiladosMobil(){

			$ajax_data = $this->input->post();
			if ($this->Modelo_Eventos->agregarPiezasAlquiladosMobil($ajax_data)) {
				$data = array('responce' => 'success', 'message' => 'Piezas agregado correctamente...!');
			} else {
				$data = array('responce' => 'error', 'message' => 'Fallo al agregar Piezas del mobiliario...!');
			}
			echo json_encode($data);
		}




	public function insertCantidadPersonasPlatillos(){

			$ajax_data = $this->input->post();
			if ($this->Modelo_Eventos->agregarCantidadPersonasPlatilloElegido($ajax_data)) {
				$data = array('responce' => 'success', 'message' => 'Cantidad de personas agregado correctamente...!');
			} else {
				$data = array('responce' => 'error', 'message' => 'Fallo al agregar Cantidad del platillo...!');
			}
			echo json_encode($data);
		}



	public function insertSalon(){

			$ajax_data = $this->input->post();
			if ($this->Modelo_Eventos->agregarDetallesSalon($ajax_data)) {
				$data = array('responce' => 'success', 'message' => 'Salon agregado correctamente...!');
			} else {
				$data = array('responce' => 'error', 'message' => 'Fallo al agregar Salon...!');
			}
			echo json_encode($data);
		}


//  Consulta el salon que esta en venta ACTUALMENTE
	public function verSalonEnVenta(){

		$venta = $this->input->post('venta');
	    $posts = $this->Modelo_Eventos->obtenerSalonKEstaEnVenta($venta);
	    echo json_encode($posts);

	}




//  Consulta el salon que esta en venta ACTUALMENTE para mostrar o ocultar el div de salones YA NO PODER ELEGIR MAS DE UN SALON
	public function verSalonEnVentaOcultarDivSalon(){

		$venta = $this->input->post('venta');
//$posts = $this->Modelo_Eventos->obtenerSalonKEstaEnVenta($venta);
		   if ($post = $this->Modelo_Eventos->obtenerSalonKEstaEnVenta($venta)) {
				 // $data = array('responce' => 'success', 'post' => $post);
				 $data = array('responce' => "success", "post" => $post, 'message' => 'TUUU==>>  XXXXXX!');
				// $data = array('responce' => 'success', 'message' => 'Salon agregado ya...!');
			} else {
				$data = array('responce' => 'error', 'message' => 'Fallo al consultar Salon...!');
			}
	    echo json_encode($data);

	}



// Consulta el MOBILIARIO que esta en venta ACTUALMENTE para mostrar o ocultar el div de mob YA NO PODER ELEGIR MAS DE UN mob
		public function verMobiliarioEnVentaOcultarDivMobiliario(){
			$venta = $this->input->post('venta');
			   if ($post = $this->Modelo_Eventos->obtenerMobiliarioKEstaEnVenta($venta)) {
					$data = array('responce' => 'success', "post" => $post, 'message' => 'Mobiliario agregado ya...!');
				} else {
					$data = array('responce' => 'error', 'message' => 'Fallo al consultar Mobiliario...!');
				}
		    echo json_encode($data);
		}



// Consulta el Platillos que esta en venta ACTUALMENTE para mostrar o ocultar el div de mob YA NO PODER ELEGIR MAS DE UN Platillos
		public function verPlatillosEnVentaOcultarDivPlatillos(){
			$venta = $this->input->post('venta');
			   if ($post = $this->Modelo_Eventos->obtenerPlatillosKEstaEnVenta($venta)) {
					$data = array('responce' => 'success', "post" => $post, 'message' => 'Platillos agregado ya...!');
				} else {
					$data = array('responce' => 'error', 'message' => 'Fallo al consultar Platillos...!');
				}
		    echo json_encode($data);
		}




	//  Consulta el mobiliario que esta en venta ACTUALMENTE
		public function verMobiliarioEnVenta(){
			$venta = $this->input->post('venta');
		    $posts = $this->Modelo_Eventos->obtenerMobiliarioKEstaEnVenta($venta);
		    echo json_encode($posts);
		}



	//  Consulta el Platilo que esta en venta ACTUALMENTE
		public function verPlatillosEnVenta(){

			$venta = $this->input->post('venta');
		    $posts = $this->Modelo_Eventos->obtenerPlatillosKEstaEnVenta($venta);
		    echo json_encode($posts);

		}




	public function eliminarSalonEnVenta(){

			$ajax_data = $this->input->post();
			if ($this->Modelo_Eventos->eliminarSalonEnCapturaDeVenta($ajax_data)) {
				$data = array('responce' => 'success', 'message' => 'Salon eliminado correctamente...!');
			} else {
				$data = array('responce' => 'error', 'message' => 'Fallo al eliminar Salon...!');
			}
			echo json_encode($data);
		}




	public function eliminarMobiliarioEnVenta(){

			$ajax_data = $this->input->post();
			if ($this->Modelo_Eventos->eliminarMobiliarioEnCapturaDeVenta($ajax_data)) {
				$data = array('responce' => 'success', 'message' => 'Mobiliario eliminado correctamente...!');
			} else {
				$data = array('responce' => 'error', 'message' => 'Fallo al eliminar Mobiliario...!');
			}
			echo json_encode($data);
		}



	public function eliminarPlatillosEnVenta(){

			$ajax_data = $this->input->post();
			if ($this->Modelo_Eventos->eliminarPlatillosEnCapturaDeVenta($ajax_data)) {
				$data = array('responce' => 'success', 'message' => 'Platillos eliminado correctamente...!');
			} else {
				$data = array('responce' => 'error', 'message' => 'Fallo al eliminar Platillos...!');
			}
			echo json_encode($data);
		}



/* =========  Ver el total de all ventas actual  ========== */
	public function verSumaTotalAllVentaActual(){
		if ($this->input->is_ajax_request()) {
			$venta = $this->input->post('venta');

			if ($post = $this->Modelo_Eventos->extraer_SumTotalVentaActual($venta)) {
				 $data = array('responce' => "success", "post" => $post);
			}else{
				$data = array('responce' => "error", "Fallos...!!! Controller(verSumaTotalAllVentaActual()) ");
			}
			echo json_encode($data);
		}else {
			echo "No se permite este acceso directo...!!!";
		}
	}




}  // Fin del controller
