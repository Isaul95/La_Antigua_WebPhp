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
        $InformacionTablaMobiliario = $this->db->get('mobiliario');
        return $InformacionTablaMobiliario->result();
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


      public function EnlistarPlatillos() {
        $InformacionTablaPlatillos = $this->db->get('platillos');
        return $InformacionTablaPlatillos->result();
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
