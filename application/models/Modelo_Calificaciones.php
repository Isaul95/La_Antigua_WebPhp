<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelo_calificaciones extends CI_Model { // INICIO DEL MODELO


      	/* -------------------------------------------------------------------------- */
      	/*                                Fetch Records                               */
      	/* -------------------------------------------------------------------------- */
 
        public function obtenermaterias($profesor,$semestre){
            $this->db->distinct();
            $this->db->select("m.id_materia,m.nombre_materia");
            $this->db->from("materias m");
            $this->db->join("profesores p","m.profesor = p.id_profesores");
            $this->db->where("p.id_profesores", $profesor);
            $this->db->where("m.semestre", $semestre);
            $resultados = $this->db->get();
            return $resultados->result();
            }
            public function obtenercarreras(){
              $this->db->distinct();
              $this->db->select("id_carrera,carrera_descripcion");
              $this->db->from("carrera");
              $resultados = $this->db->get();
              return $resultados->result();
              }
              public function obteneropciones(){
                $this->db->distinct();
                $this->db->select("id_opcion,descripcion");
                $this->db->from("opciones");
                $resultados = $this->db->get();
                return $resultados->result();
                }

            //select alumnos.numero_control as numero_control, concat(alumnos.nombres,' ',alumnos.apellido_paterno,' ',alumnos.apellido_materno) as alumno,
          //detalles.cuatrimestre as cuatrimestre, carrera.carrera_descripcion as carrera_descripcion, 
            //calificaciones.calificacion, calificaciones.tiempo_extension 
            //from alumnos 
            //inner join detalles on alumnos.numero_control = detalles.alumno 
            //inner join carrera on detalles.carrera = carrera.id_carrera
             //inner join calificaciones on detalles.id_detalle = calificaciones.detalle 
             //where estatus_alumno_activo = 1 and calificaciones.materia = 189
  
            public function alumnos_asignados_a_la_materia_del_profesor($materia){
                $this->db->distinct();
                $this->db->select("detalles.id_detalle as id_detalle,alumnos.numero_control as numero_control, 
                concat(alumnos.nombres,' ',alumnos.apellido_paterno,' ',alumnos.apellido_materno) as alumno, 
                detalles.cuatrimestre as cuatrimestre, carrera.carrera_descripcion as carrera_descripcion,
                calificaciones.calificacion as calificacion, calificaciones.tiempo_extension as tiempo_extension");
                $this->db->from("alumnos");
                $this->db->join("detalles","alumnos.numero_control = detalles.alumno");
                $this->db->join("carrera","detalles.carrera = carrera.id_carrera");
                $this->db->join("calificaciones","detalles.id_detalle = calificaciones.detalle");
                $this->db->where("estatus_alumno_activo", "1");
                $this->db->where("materia", $materia);
                $resultados = $this->db->get();
                return $resultados->result();
                }

                public function alumnos_asignados_a_la_carrera_y_opcion_administrativo($carrera,$opcion){
                  $this->db->distinct();
                  $this->db->select("detalles.id_detalle as id_detalle,alumnos.numero_control as numero_control, 
                  concat(alumnos.nombres,' ',alumnos.apellido_paterno,' ',alumnos.apellido_materno) as alumno, 
                  detalles.cuatrimestre as cuatrimestre, carrera.carrera_descripcion as carrera_descripcion");
                  $this->db->from("alumnos");
                  $this->db->join("detalles","alumnos.numero_control = detalles.alumno");
                  $this->db->join("carrera","detalles.carrera = carrera.id_carrera");
                  $this->db->where("estatus_alumno_activo", "1");
                  $this->db->where("detalles.carrera", $carrera);
                  $this->db->where("detalles.opcion", $opcion);
                  $resultados = $this->db->get();
                  return $resultados->result();
                  }
                  public function updatecalificacion($materia,$id_detalle,$data){
                    return $this->db->update('calificaciones', $data, array('materia' => $materia,'detalle'=> $id_detalle));
                }
                public function single_entry($id,$materia)
                {
                  $this->db->select('*');
                    $this->db->from('calificaciones');
                    $this->db->where('detalle', $id);
                    $this->db->where('materia', $materia);
                    $query = $this->db->get();
                    if (count($query->result()) > 0) {
                        return $query->row();
                    }
                }
                public function sepuede_agregar_calificacion($detalle,$materia)
                {
                  $this->db->select('*');
                    $this->db->from('calificaciones');
                    $this->db->where('detalle', $detalle);
                    $this->db->where('materia', $materia);
                    $this->db->where_in('estado_profesor', ['0','1']);
                    $query = $this->db->get();
                    if (count($query->result()) > 0) {
                        return $query->row();
                    }
                }


// ***************************  INICIO FUNCTION PARA INSRTAR  ************************************
public function insert_entry($data)
    {
        return $this->db->insert('materias', $data);
    }



      public function update($numero_control, $data){
        return $this->db->update('materias', $data, array('id_materia' => $numero_control));
    }


          public function delete_entry($id)
          {
              return $this->db->delete('materias', array('id_materia' => $id));
          }
     
  } // FIN / CIERRE DEL MODELO
