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


# Agregar nuevo mobiliario
	public function agregarBanquete(){

		if ($this->input->is_ajax_request()) {

			$this->form_validation->set_rules('nombre', 'nombre', 'required');
			$this->form_validation->set_rules('precio', 'precio', 'required');
      $this->form_validation->set_rules('descripcion', 'descripcion', 'required');

			if ($this->form_validation->run() == FALSE) {
				$data = array('res' => "error", 'message' => validation_errors());
			} else {

        // Cargar imagen
        // Definir ruta en donde guardar la imagen y tipo de dato permitido(png, jpg)
        $config = [
          "upload_path" => "./assets/imagenesMob/",
          'allowed_types' => "png|jpg"
        ];
				// Cargar libreria para poder subir imagen
        $this->load->library("upload",$config);
				$imagen='';

        if ($this->upload->do_upload('imagen')) {
          // code...
	        $data = array("upload_data" => $this->upload->data());
					$imagen = $data['upload_data']['file_name'];

				}else {
					$imagen='';
				}
				//
	      $ajax_data = array(
	        'nombre' => $this->input->post('nombre'),
	        'precio' => $this->input->post('precio'),
	        'descripcion' => $this->input->post('descripcion'),
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

			// Cargar imagen
			// Definir ruta en donde guardar la imagen y tipo de dato permitido(png, jpg)
			$config = [
				"upload_path" => './assets/imagenesMob/',
				'allowed_types' => "png|jpg"
			];
			// Cargar libreria para poder subir imagen
			$this->load->library("upload",$config);
			$imagen_nueva='';

			if ($this->upload->do_upload('imagen')) {
				// code...

				$data = array("upload_data" => $this->upload->data());
				$imagen_nueva = $data['upload_data']['file_name'];
				//$ajax_data['imagen'] = $imagen_nueva;

			}else {
				$imagen_nueva = $this->input->post('imagen');
				//$ajax_data['imagen'] = $imagen_nueva;
			}

			$id_banquete = $this->input->post('id_banquete');


			$ajax_data = array(
				'nombre' => $this->input->post('nombre'),
				'precio' => $this->input->post('precio'),
				'descripcion' => $this->input->post('descripcion'),
				'imagen' => $imagen_nueva
			);

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
