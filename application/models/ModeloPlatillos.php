<?php
defined('BASEPATH') OR exit('No direct script acces allowed');

class ModeloPlatillos extends CI_Model {


  public function EnlistarPlatillos() {
    $this->db->select('id_platillo,nombre_platillo,costo,descripcion,nombre_foto');
    $this->db->from('platillos');
    $InformacionTablaPlatillos = $this->db->get();
      return $InformacionTablaPlatillos->result();
  }


  public function Buscarfotodeplatillo($BuscarID) {
    $this->db->select('foto');
    $this->db->from('platillos');
    $this->db->where('id_platillo', $BuscarID);
    $DatosPlatillo = $this->db->get();
    if (count($DatosPlatillo->result()) > 0) {
      return $DatosPlatillo->row();
    }
  }
  public function BuscarDatosPlatilloSeleccionado($BuscarID) {
    $this->db->select('id_platillo,nombre_platillo,costo,descripcion');
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
