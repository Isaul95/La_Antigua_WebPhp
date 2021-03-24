<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelo_Rutas extends CI_Model { // INICIO DEL MODELO


public function get_listaPlatillos(){
  $query = $this->db->get('platillos');
    return $query->result();
}

//
// public function insert_hora_salida($data){
//     return $this->db->insert('platillos', $data);
//   }



  public function agregarHorarioSalidaMob($data){
        return $this->db->update('platillos', $data, array('id_platillo' => $data['id_platillo']));
    }


  public function agregarHorarioEntregaMob($data){
        return $this->db->update('platillos', $data, array('id_platillo' => $data['id_platillo']));
    }



  } // FIN / CIERRE DEL MODELO
