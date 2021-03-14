<?php
defined('BASEPATH') OR exit('No direct script acces allowed');

class ModeloPlatillos extends CI_Model {


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


  public function CrearNuevoPlatillo($AgregarDatos) {
    return $this->db->insert('platillos', $AgregarDatos);
  }


  public function ActualizarPlatilloSeleccionado($originalID, $ModificarDatos) {
    return $this->db->update('platillos', $ModificarDatos, array('id_platillo' => $originalID));
  }


  public function EliminarPlatilloSeleccionado($EliminarID) {
    return $this->db->delete('platillos', array('id_platillo' => $EliminarID));
  }

}
