<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banquetes extends CI_Controller {
		 private $permisos;
         public function __construct(){
	 	 parent::__construct();
		 $this->permisos = $this->backend_lib->control();
		 $this->load->helper(array('form', 'url'));
	 	 $this->load->library(array('session', 'form_validation'));
	 	 $this->load->model("banquetes/ModeloBanquetes");
	 }

	public function index(){
		$data  = array(
			'permisos' => $this->permisos,
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/banquetes/VistaBanquetes',$data);
		$this->load->view('layouts/footer');
	}
# Listar Mobiliario
public function listarBanquetes(){
    $posts = $this->ModeloBanquetes->listarBanquetes();
    echo json_encode($posts);
}
public function Foto($PlatilloID){
    $Consulta = $this->ModeloBanquetes->Buscarfotodebanquete($PlatilloID);
    $Foto = $Consulta->imagen;
    header("Content-Type: image/jpeg");
    print_r($Foto);
  }

# Agregar nuevo mobiliario
	public function agregarBanquete(){

		if ($this->input->is_ajax_request()) {

			$this->form_validation->set_rules('nombre', 'nombre', 'required');
			$this->form_validation->set_rules('precio', 'precio', 'required');
      $this->form_validation->set_rules('descripcion', 'descripcion', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data = array('res' => "error", 'message' => validation_errors());
			} else {
				$imagen='';
				$tipoArchivo='';
				if (isset($_FILES["imagen"])) {
				if ($_FILES['imagen']['name'] != '') {
					// code...
					$nombreArchivo = $_FILES['imagen']['name'];
					$tipoArchivo = $_FILES['imagen']['type'];
					$tamanoArchivo = $_FILES['imagen']['size'];
					$archivoSubido = fopen($_FILES['imagen']['tmp_name'], 'r+b');
					$imagen = fread($archivoSubido, $tamanoArchivo);
					fclose($archivoSubido);
				}
			}
			else {
				$imagen='';
				$tipoArchivo='';
			}
			//
			$ajax_data = array(
				'nombre' => $this->input->post('nombre'),
				'precio' => $this->input->post('precio'),
				'descripcion' => $this->input->post('descripcion'),
				'nombre_foto' => $nombreArchivo,
				'imagen' => $imagen
			);
        

				if ($this->ModeloBanquetes->agregarBanquete($ajax_data)) {
					$data = array('res' => "success", 'message' => "¡Banquete agregado!");
	  		} else {
					$data = array('res' => "error", 'message' => "¡Error! :(");
				}

	 		echo json_encode($data);


			}
		} else {
			echo "No se permite este acceso directo...!!!";
		}
	}


# Eliminar mobiliario

public function eliminarBanquete(){

	if ($this->input->is_ajax_request()) {
		$del_id = $this->input->post('del_id');
	if ($this->ModeloBanquetes->delete_entry($del_id)) {

			$data = array('responce' => "success");
	} else {

			$data = array('responce' => "error", "No se pudo eliminar...!");
	}
		echo json_encode($data);
	} else {
		echo "No se permite este acceso directo...!!!";
	}
}

public function editarBanquete(){

	if ($this->input->is_ajax_request()) {

		$edit_id = $this->input->post('edit_id');
		if ($post = $this->ModeloBanquetes->single_entry($edit_id)) {
			$data = array('responce' => "success", "post" => $post);
		}else{
			$data = array('responce' => "error", "failed to fetch");
		}
		echo json_encode($data);
	}else {
		echo "No se permite este acceso directo...!!!";
	}
}

public function updateBanquetes(){

	if ($this->input->is_ajax_request()) {
    $this->form_validation->set_rules('nombre', 'Nombre', 'required');
    $this->form_validation->set_rules('precio', 'Precio', 'required');
  	$this->form_validation->set_rules('descripcion', 'Descripcion', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data = array('res' => "error", 'message' => validation_errors());
		} else {

			

			


			if (isset($_FILES['imagen']['name'])) {

				$NombreFoto = $_FILES['imagen']['name'];
				$FotoTemporal = $_FILES['imagen']['tmp_name'];
	  
				$Archivo = fopen($FotoTemporal, 'r+b');
				$BytesFoto = fread($Archivo, filesize($FotoTemporal));
				fclose($Archivo);
	  
				$ajax_data['nombre_foto'] = $NombreFoto;
				$ajax_data['imagen'] = $BytesFoto;
			  }
			
			  $id_banquete = $this->input->post('id_banquete');
			$ajax_data['nombre'] = $this->input->post('nombre');
			$ajax_data['precio'] = $this->input->post('precio');
			$ajax_data['descripcion'] = $this->input->post('descripcion');

			if ($this->ModeloBanquetes->actualizarBanquete($id_banquete,$ajax_data)) {
				//
				$data = array('responce' => "success", 'message' => "¡Mobiliario actualizado!");
				} else {
          $data = array('responce' => "error", 'message' => "Error al agregar datos...!");
					//$data = array('responce' => "error", 'message' => "");
				}
			}
			echo json_encode($data);
		}else {
			echo "No se permite este acceso directo...!!!";
		}
}	// Fin de funcion editar


}  // Fin del controller
