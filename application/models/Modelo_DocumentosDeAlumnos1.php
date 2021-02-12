<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelo_DocumentosDeAlumnos extends CI_Model { // INICIO DEL MODELO


/* -------------------------------------------------------------------------- */
/*                        Lista datos Gral. del Alumno                        */
/* -------------------------------------------------------------------------- */

public function obtenerDatosGnralDelAlumnos(){
    $this->db->distinct();
    $this->db->select("alumnos.numero_control as numero_control,
    concat(alumnos.nombres,' ',alumnos.apellido_paterno,' ',alumnos.apellido_materno) as alumno,
    detalles.cuatrimestre as semestre, carrera.carrera_descripcion as carrera_descripcion, carrera.id_carrera");
    $this->db->from("alumnos");
    $this->db->join("detalles","alumnos.numero_control = detalles.alumno");
    $this->db->join("carrera","detalles.carrera = carrera.id_carrera");
    $this->db->where("estatus_alumno_activo", "1");
    $resultados = $this->db->get();
    return $resultados->result();
    }






      // public function get_entries()
      //   {
      //       $query = $this->db->get('cod');
      //       return $query->result();
      //   }


        // public function obtenerListaPagos(){
        //         $this->db->select("id, nombre, numero_con, carrera , semestre");
        //     $this->db->from("cod");
        //      // $this->db->where("Cantidad !=0");
        //     $resultados = $this->db->get();
        //     return $resultados->result();
        //     }


  } // FIN / CIERRE DEL MODELO
