<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelo_Eventos extends CI_Model { // INICIO DEL MODELO


    public function get_listarAllEventos(){
      $query = $this->db->get('eventos');
        return $query->result();
    }


    public function insert_entry($data){
        return $this->db->insert('eventos', $data);
      }


    public function eliminarEvento($id_evento){
      return $this->db->delete('eventos', array('id_evento' => $id_evento));
      }


    public function update_evento($id_evento, $data){
            return $this->db->update('eventos', $data, array('id_evento' => $id_evento));
        }

        public function EnlistarSalones() {
        $InformacionTablaSalones = $this->db->get('salones');
        return $InformacionTablaSalones->result();
      }


      public function EnlistarMobiliario() {
        // $InformacionTablaMobiliario = $this->db->get('mobiliario');
        // return $InformacionTablaMobiliario->result();

        $this->db->select(" clave, nombre, precio, id_categoria, stock, estado, descripcion ");
    $this->db->from("mobiliario");
    $resultados = $this->db->get();
    return $resultados->result();

      }


      public function BuscarDatosMuebleSeleccionado($BuscarClave) {
        $this->db->select('*');
        $this->db->from('mobiliario');
        $this->db->where('clave', $BuscarClave);
        $DatosMueble = $this->db->get();
        if (count($DatosMueble->result()) > 0) {
          return $DatosMueble->row();
        }
      }



// Se consulta la ultima inagen de la galeria de fotos del salon correspondiente al salon = id_salon
    public function datosSalonSeleccionado($id_salon) {
      $this->db->select('*');
      $this->db->from('fotos_salones');
      $this->db->where(' id_salon = ', $id_salon);
      // $this->db->where('id_foto = (SELECT MAX(id_foto ) FROM fotos_salones) AND id_salon = ', $id_salon);
      $DatosMueble = $this->db->get();
      if (count($DatosMueble->result()) > 0) {
        return $DatosMueble->row();
      }
    }





      public function EnlistarPlatillos() {
        // $InformacionTablaPlatillos = $this->db->get('platillos');
        // return $InformacionTablaPlatillos->result();

        $this->db->select("id_platillo, nombre_platillo, costo, descripcion");
    $this->db->from("platillos");
    $resultados = $this->db->get();
    return $resultados->result();

      }



        // public function obtenercarreras(){
        //     $this->db->select("id_platillo, nombre_platillo, costo, descripcion");
        // $this->db->from("platillos");
        // $resultados = $this->db->get();
        // return $resultados->result();
        // }




        public function obtenercarreras(){
            $this->db->select("id_platillo, nombre_platillo, costo, descripcion");
        $this->db->from("platillos");
        $resultados = $this->db->get();
        return $resultados->result();
        }


      public function BuscarDatosPlatilloSeleccionado($BuscarID) {
        $this->db->select('*');
        $this->db->from('platillos');
        $this->db->where('id_platillo', $BuscarID);
        $DatosPlatillo = $this->db->get();
        if (count($DatosPlatillo->result()) > 0) {
          return $DatosPlatillo->row();
        }
      }


  } // FIN / CIERRE DEL MODELO
