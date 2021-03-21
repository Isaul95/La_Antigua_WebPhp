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


  } // FIN / CIERRE DEL MODELO
