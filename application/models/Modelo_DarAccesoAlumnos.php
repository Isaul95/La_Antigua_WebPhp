<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelo_DarAccesoAlumnos extends CI_Model { // INICIO DEL MODELO

  /* -------------------------------------------------------------------------- */
	/*                            INSERTAR BAUCHE TABLA                           */
	/* -------------------------------------------------------------------------- */
  public function insert_baucher($data){
          return $this->db->insert('alta_baucher_banco', $data);
      }


      public function insert_reciboValidadoXlaIntitucion($data){
              return $this->db->insert('recibo_validado', $data);
          }

	/* -------------------------------------------------------------------------- */
	/*        METODO PARA HACER EL CONTEO DE LAS VENTAS, USERS, ETC..             */
	/* -------------------------------------------------------------------------- */

    public function rowcountColegiatura($tabla){
        if ($tabla == "alta_baucher_banco") {
      // $this->db->select("COUNT(*)");
        // $this->db->from("alta_baucher_banco");
         $this->db->where("tipo_de_pago", "1"); /* SELECT SUM(`total`) FROM `venta` */
        }
      $resultados = $this->db->get($tabla);
      return $resultados->num_rows();
    }


    public function rowcountCursos($tabla){
        if ($tabla == "alta_baucher_banco") {
      // $this->db->select("COUNT(*)");
        // $this->db->from("alta_baucher_banco");
         $this->db->where("tipo_de_pago", "2"); /* SELECT SUM(`total`) FROM `venta` */
        }
      $resultados = $this->db->get($tabla);
      return $resultados->num_rows();
    }


    public function rowcountExtraordinario($tabla){
        if ($tabla == "alta_baucher_banco") {
      // $this->db->select("COUNT(*)");
        // $this->db->from("alta_baucher_banco");
         $this->db->where("tipo_de_pago", "4"); /* SELECT SUM(`total`) FROM `venta` */
        }
      $resultados = $this->db->get($tabla);
      return $resultados->num_rows();
    }


    public function rowcountTitulo($tabla){
        if ($tabla == "alta_baucher_banco") {
      // $this->db->select("COUNT(*)");
        // $this->db->from("alta_baucher_banco");
         $this->db->where("tipo_de_pago", "5"); /* SELECT SUM(`total`) FROM `venta` */
        }
      $resultados = $this->db->get($tabla);
      return $resultados->num_rows();
    }




    public function consultaCountAlumnosXxx($numero_control){
        // if ($tabla == "alta_baucher_banco") {
          $this->db->select("numero_control");
          $this->db->from("alta_baucher_banco");
          $this->db->where("numero_control",$numero_control); /* SELECT SUM(`total`) FROM `venta` */
//        $this->db->where("numero_control",$numero_control);
        // }
      // $resultados = $this->db->get($tabla);
      // return $resultados->num_rows();
      $resultados = $this->db->get();
      return $resultados->result();
    }


// 1.- Se obtiene el nombre completo de la tabla de alumnos y el no control
// 2.- Se obt. id de la tabla de los baucher y la fecha en k se subio el baucher

  public function obtenerListaDeAlumnosConBaucherRegistrado($tipoPago){
     $this->db->select("CONCAT(alu.nombres, ' ', alu.apellido_paterno, ' ', alu.apellido_materno) As nombre_completo, ban.id_alta_baucher_banco, ban.fecha_registro, alu.numero_control, alu.estatus, car.carrera_descripcion, rec.cantidad , rec.desc_concepto, rec.id_recibo, tip.pago");
     $this->db->from("alumnos alu");
     $this->db->join("alta_baucher_banco ban","alu.numero_control = ban.numero_control");
     $this->db->join("detalles det ","alu.numero_control = det.alumno");
     $this->db->join("carrera car","car.id_carrera = det.carrera");
     $this->db->join("tipos_de_pagos tip","tip.id_tipo_pago = ban.tipo_de_pago");
     $this->db->join("datos_recibo rec","rec.bauche = ban.id_alta_baucher_banco",'LEFT');
      $this->db->where("tip.pago",$tipoPago);
//   $this->db->join("habilitar_accesoalumnos hab","alu.numero_control = hab.numero_control",'LEFT');
      $resultados = $this->db->get();
      return $resultados->result();
  }


// Se recupera el baucher k se dio de alta para mostrarselo al ADMIN para corroborar k si sea
    public function getBaucherId($numero_control){
        $query = $this->db->query("select * FROM alta_baucher_banco where numero_control=?", array($numero_control));
        return $query->row_array();
    }

    // SE CONSULTA EL RECIBO YA VALIDADO X LA INSTITUCION
        public function getReciboValidado($id_recibo_valido){
            $query = $this->db->query("select * FROM recibo_validado where id_recibo_valido=?", array($id_recibo_valido));
            return $query->row_array();
        }

  //  =================  ACTUALIZA SIEMPRE EL ESTATUS DE LA TABLA DE ALUMNOS PARA HABILITAR Y DESHABILITAR  ======================
    public function update($numero_control, $data){
      $this->db->where("numero_control",$numero_control);
       return $this->db->update("alumnos", $data);
      }

//  ===============  <<<<<<<<<<<   actualiza el estado del comprobante de pago si fue validado o no el k subio  >>>>>>>>>> ============
        public function updateStatusComprobPago($numero_control, $data2){
          $this->db->where("numero_control",$numero_control);
           return $this->db->update("alta_baucher_banco", $data2);
          }

//   ************************  FUINCTION PARA ELIMINAR  el registro del alumno nauchere  ********************
      public function eliminarTodoRegistroAlumno($numero_control){
      return $this->db->delete('alta_baucher_banco', array('numero_control' => $numero_control));
      }

//    ******************     SE CONSULTAN EL RECIBO FIRMADO Y SELLADO DEL ALUMNOS   ***************************
      public function obtenerRecibosFirmadosDelAlumno(){
          $this->db->select("id_recibo_valido,nombre_archivo");
      $this->db->from("recibo_validado");
       // $this->db->where("Cantidad !=0");
      $resultados = $this->db->get();
      return $resultados->result();
      }


//  *************** Eliminar los datos del registro cuando se deshabilita el alumnos y cuando se elimina el baucher *****************
      public function deleteDatosDelRecibo($id_alta_baucher_banco){
      return $this->db->delete('datos_recibo', array('bauche' => $id_alta_baucher_banco));
      }

      public function insert_entry($data){
          return $this->db->insert('datos_recibo', $data);
        }

      public function getTipoDePagos(){
      	$resultados = $this->db->get("tipos_de_pagos");
    		return $resultados->result();
    	}

      //   ************************  FUINCTION PARA ELIMINAR  el recibo del alumno ya firmado y sellado  ********************
            public function eliminarReciboFirmadodelAlumno($id_recibo_valido){
            return $this->db->delete('recibo_validado', array('id_recibo_valido' => $id_recibo_valido));
            }



    public function obtenerHistorialDePagosXAlumnos($numero_control){
     $this->db->select("CONCAT(alu.nombres, ' ', alu.apellido_paterno, ' ', alu.apellido_materno) As nombre_completo, ban.id_alta_baucher_banco, ban.fecha_registro, ban.nombre_archivo, alu.numero_control, car.carrera_descripcion, sta.estado, tip.pago, rec.id_recibo, val.id_recibo_valido, det.cuatrimestre as semestre");
     $this->db->from("alumnos alu");
     $this->db->join("alta_baucher_banco ban","alu.numero_control = ban.numero_control");
     $this->db->join("detalles det ","alu.numero_control = det.alumno");
     $this->db->join("carrera car","car.id_carrera = det.carrera");
     $this->db->join("estatus sta","sta.estatus = ban.estado_archivo ");
     $this->db->join("tipos_de_pagos tip","tip.id_tipo_pago = ban.tipo_de_pago");
       $this->db->join("datos_recibo rec","rec.bauche = ban.id_alta_baucher_banco",'LEFT');
       $this->db->join("recibo_validado val","val.id_recibo = rec.id_recibo",'LEFT');
     $this->db->where("ban.numero_control",$numero_control);

     $resultados = $this->db->get();
      return $resultados->result();
    }



  } // FIN / CIERRE DEL MODELO
