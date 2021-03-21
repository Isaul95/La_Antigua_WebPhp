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



  } // FIN / CIERRE DEL MODELO
