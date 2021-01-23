<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calificaciones extends CI_Controller {

	   public function __construct(){
	 	 parent::__construct();
		 $this->load->helper(array('form', 'url'));
	 	 $this->load->library(array('session', 'form_validation'));
	 	 $this->load->model("Modelo_Calificaciones");
	 }


	public function index(){

		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/Vistas_administrativos/VistaCalificaciones');
		$this->load->view('layouts/footer');
	}



	public function VistaCalificacionesPorSemestre(){
		$data = array(
			// 'tipoDePagos' => $this->Modelo_DarAccesoAlumnos->getTipoDePagos(),
			'username' => $this->session->userdata('username'),
			'rol' => $this->session->userdata('rol'),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		 $this->load->view('admin/Vistas_administrativos/VistaAlumnosPorSemestre',$data);
		$this->load->view('layouts/footer');
	}

	public function vermateriasdelprofesor(){
		$profesor = $this->input->post('profesor');
		$semestre = $this->input->post('semestre');
		$posts = $this->Modelo_Calificaciones->obtenermaterias($profesor,$semestre);
		echo json_encode($posts);
	}

	public function obtenercarreras(){
		$posts = $this->Modelo_Calificaciones->obtenercarreras();
		echo json_encode($posts);

	}

	public function obteneropciones(){
		$posts = $this->Modelo_Calificaciones->obteneropciones();
		echo json_encode($posts);

	}
	public function veralumnos_asignados_ala_materia_del_profesor(){
		$edit_id = $this->input->post('materia_a_consultar');
		$posts = $this->Modelo_Calificaciones->alumnos_asignados_a_la_materia_del_profesor($edit_id);
		echo json_encode($posts);
	}
	public function veralumnos_asignados_porcarrera_opcion(){
		$carrera = $this->input->post('carrera');
		$opcion = $this->input->post('opcion');
		$posts = $this->Modelo_Calificaciones->alumnos_asignados_a_la_carrera_y_opcion_administrativo($carrera,$opcion);
		echo json_encode($posts);
	}
	public function viewalumno(){
		if ($this->input->is_ajax_request()) {
			$view_id = $this->input->post('view_id');
			if ($post = $this->Modelo_Alumnos->ficha_alumno($view_id)) {
				$data = array('responce' => "success", "post" => $post);
			}else{
				$data = array('responce' => "error", "failed to fetch");
			}
			echo json_encode($data);
		}else {
			echo "No se permite este acceso directo...!!!";
		}
	}
	public function updatecalificacion(){
		if ($this->input->is_ajax_request()) {	
			
				$id_detalle = $this->input->post('detalle');
				$materia = $this->input->post('materia');
				if ($post = $this->Modelo_Calificaciones->sepuede_agregar_calificacion($id_detalle,$materia)) {
					$ajax_data['calificacion'] = $this ->input->post('calificacion');
				    $ajax_data['ciclo'] = $this ->input->post('ciclo');
				    $ajax_data['estado_profesor'] = $this ->input->post('estado_profesor');
				    $ajax_data['tiempo_extension'] = $this ->input->post('tiempo_extension');
				     if ($this->Modelo_Calificaciones->updatecalificacion($materia,$id_detalle,$ajax_data)) {
					     $data = array('response' => "success", 'message' => "Datos actualizados correctamente");
				     } else {
					   $data = array('response' => "error", 'message' => "Error al agregar datos...!");
				     }
				}else{
					$data = array('response' => "error", 'message' => "No puede agregar calificación nuevamente");		
				}
				echo json_encode($data);			
			}
		  else{
			echo "No se permite este acceso directo...!!!";
		}
	}
	public function editarcalificacion(){
		if ($this->input->is_ajax_request()) {
			$id_detalle = $this->input->post('detalle');
			$materia = $this->input->post('materia');
			if ($post = $this->Modelo_Calificaciones->single_entry($id_detalle,$materia)) {
				$data = array('responce' => "success", "post" => $post);
			}else{
				$data = array('responce' => "error", "failed to fetch");
			}
			echo json_encode($data);
		}else {
			echo "No se permite este acceso directo...!!!";
		}
	}
	/* -------------------------------------------------------------------------- */
	/*                               Insert Records                               */
	/* -------------------------------------------------------------------------- */
	//
	// public function insertarPagos(){
	//
	// 	if ($this->input->is_ajax_request()) {
	// 		$this->form_validation->set_rules('nombre', 'Nombre Alumno', 'required');
	// 		$this->form_validation->set_rules('numero_con', 'Número de control', 'required');
	// 		$this->form_validation->set_rules('carrera', 'Carrera', 'required');
	// 		$this->form_validation->set_rules('semestre', 'Semestre', 'required');
	//
	// 		if ($this->form_validation->run() == FALSE) {
	// 			$data = array('res' => "error", 'message' => validation_errors());
	// 		} else {
	// 			$config['upload_path'] = "./assets/template/dist/img/uploads";
	// 			$config['allowed_types'] = 'gif|jpg|png|pdf';
	// 			$config['max_size']     = '1000';
	// 			// $config['max_width'] = '1024';
	// 			// $config['max_height'] = '768';
	// 			$this->load->library('upload', $config);
	//
	// 			if (!$this->upload->do_upload("archivo")) {
	// 				$data = array('res' => "error", 'message' => $this->upload->display_errors());
	// 			} else {
	//   $file_name = $_FILES['archivo']['name'];
	// 	$file_size = $_FILES['archivo']['size'];
	// 	$file_tmp = $_FILES['archivo']['tmp_name'];
	// 	$file_type = $_FILES['archivo']['type'];
	//
	// 	$imagen_temporal = $file_tmp;
	// 	$tipo = $file_type;
	//
	// 	$fp = fopen($imagen_temporal, 'r+b');
	// 	$binario = fread($fp, filesize($imagen_temporal));
	// 	fclose($fp);
	//
	// 	$ajax_data = $this->input->post();
	// 	$ajax_data['archivo'] = $binario; // Documento pdf
	// 	$ajax_data['img'] = $this->upload->data('file_name'); // name file
	//
	// 				if ($this->Modelo_RegistrosPag->insert_entry($ajax_data)) {
	// 					$data = array('res' => "success", 'message' => "Datos agregados correctamente...!");
	// 				} else {
	// 					$data = array('res' => "error", 'message' => "Error al agregar datos...!");
	// 				}
	// 			}
	// 		}
	// 		echo json_encode($data);
	// 	} else {
	// 		echo "No se permite este acceso directo...!!!";
	// 	}
	//
	// }




	/* -------------------------------------------------------------------------- */
	/*                                Fetch Records                               */
	/* -------------------------------------------------------------------------- */
	//
	// public function listaAccesoAlumnosARecibos() {
	//
	// 	$posts = $this->Modelo_DarAccesoAlumnos->obtenerListaDeAlumnosInscritos();
	// 	echo json_encode($posts);
	//
	// }



	//
	// public function verArchivo($id){
	// 	$consulta = $this->Modelo_RegistrosPag->getArchivoId($id);
	// 	$archivo = $consulta['archivo'];
	// 	$img = $consulta['img'];
	// 	header("Content-type: application/pdf");
	// 	header("Content-Disposition: inline; filename=$img.pdf");
	// 	print_r($archivo);
	//
	// }


	/* -------------------------------------------------------------------------- */
/*                               Delete Records                               */
/* -------------------------------------------------------------------------- */
//
// public function eliminarPagos()
// {
// 	if ($this->input->is_ajax_request()) {
//
// 		$del_id = $this->input->post('del_id');
//
// 		$post = $this->Modelo_RegistrosPag->single_entry($del_id);
//
// 		unlink(APPPATH . '../assets/template/dist/img/uploads/' . $post->img);
//
// 		if ($this->Modelo_RegistrosPag->delete_entry($del_id)) {
// 			$data = array('res' => "success", 'message' => "Datos eliminados con éxito...!");
// 		} else {
// 			$data = array('res' => "error", 'message' => "No se pudo eliminar...!");
// 		}
// 		echo json_encode($data);
// 	} else {
// 		echo "No se permite este acceso directo...!!!";
// 	}
// }
//


}  // Fin del controller
