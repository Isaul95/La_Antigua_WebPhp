<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobiliario extends CI_Controller {
		 private $permisos;
         public function __construct(){
	 	 parent::__construct();
		 $this->permisos = $this->backend_lib->control();
		 $this->load->helper(array('form', 'url'));
	 	 $this->load->library(array('session', 'form_validation'));
	 	 $this->load->model("mobiliario/ModeloMobiliario");
	 }

	public function index(){
		$data  = array(
			'permisos' => $this->permisos,
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/mobiliario/VistaMobiliario',$data);
		$this->load->view('layouts/footer');
	}
# Listar Mobiliario
public function listarMobiliario(){
    $posts = $this->ModeloMobiliario->listarMobiliario();
    echo json_encode($posts);
}


# Agregar nuevo mobiliario
	public function agregarMobiliario(){

		if ($this->input->is_ajax_request()) {

			$this->form_validation->set_rules('nombre', 'nombre', 'required');
			$this->form_validation->set_rules('precio', 'precio', 'required');
			$this->form_validation->set_rules('stock', 'stock', 'required');
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
	        'stock' => $this->input->post('stock'),
	        'descripcion' => $this->input->post('descripcion'),
	        'imagen' => $imagen
	      );

				if ($this->ModeloMobiliario->agregarMobiliario($ajax_data)) {
					$data = array('res' => "success", 'message' => "¡Articulo agregado!");
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

public function eliminarMobiliario(){

	if ($this->input->is_ajax_request()) {
		$del_id = $this->input->post('del_id');
	if ($this->ModeloMobiliario->delete_entry($del_id)) {

			$data = array('responce' => "success");
	} else {

			$data = array('responce' => "error", "No se pudo eliminar...!");
	}
		echo json_encode($data);
	} else {
		echo "No se permite este acceso directo...!!!";
	}
}

public function editarMobiliario(){

	if ($this->input->is_ajax_request()) {

		$edit_id = $this->input->post('edit_id');
		if ($post = $this->ModeloMobiliario->single_entry($edit_id)) {
			$data = array('responce' => "success", "post" => $post);
		}else{
			$data = array('responce' => "error", "failed to fetch");
		}
		echo json_encode($data);
	}else {
		echo "No se permite este acceso directo...!!!";
	}
}

public function updateMobiliario(){

	if ($this->input->is_ajax_request()) {
    $this->form_validation->set_rules('nombre', 'Nombre', 'required');
    $this->form_validation->set_rules('precio', 'Precio', 'required');
    $this->form_validation->set_rules('stock', 'Stock', 'required');
		$this->form_validation->set_rules('estado', 'Estado', 'required');
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
			//
			//$ajax_data = $this->input->post();
			//$clave = $this->input->post('id_mobiliario_update');
			$clave = $this->input->post('clave');


			$ajax_data = array(
				'nombre' => $this->input->post('nombre'),
				'precio' => $this->input->post('precio'),
				'stock' => $this->input->post('stock'),
				'estado' => $this->input->post('estado'),
				'descripcion' => $this->input->post('descripcion'),
				'imagen' => $imagen_nueva
			);



/*
			$ajax_data['nombre'] = $this->input->post('nombre');
			$ajax_data['precio'] = $this->input->post('precio');
			$ajax_data['stock'] = $this->input->post('stock');
			$ajax_data['estado'] = $this->input->post('estado');
			$ajax_data['descripcion'] = $this->input->post('descripcion');
			$ajax_data['imagen'] = $imagen_nueva;
*/
			if ($this->ModeloMobiliario->actualizarMobiliario($clave,$ajax_data)) {
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
