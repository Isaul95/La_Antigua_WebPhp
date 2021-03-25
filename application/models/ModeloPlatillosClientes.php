<?php
defined('BASEPATH') OR exit('No direct script acces allowed');

class ModeloPlatillosClientes extends CI_Model {

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


}
