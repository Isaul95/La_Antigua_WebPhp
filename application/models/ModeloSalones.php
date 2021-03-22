<?php
defined('BASEPATH') OR exit('No direct script acces allowed');

class ModeloSalones extends CI_Model {


  public function EnlistarSalones() {
    $InformacionTablaSalones = $this->db->get('salones');
    return $InformacionTablaSalones->result();
  }


  public function BuscarDatosSalonSeleccionado($BuscarID) {
    $this->db->select('*');
    $this->db->from('salones');
    $this->db->where('id_salon', $BuscarID);
    $DatosSalon = $this->db->get();
    if (count($DatosSalon->result()) > 0) {
      return $DatosSalon->row();
    }
  }


  public function crearNuevoSalon($AgregarDatos) {
    return $this->db->insert('salones', $AgregarDatos);
  }


  public function actualizarSalonSeleccionado($originalID, $informacionModificada) {
    return $this->db->update('salones', $informacionModificada, array('id_salon' => $originalID));
  }


  public function EliminarSalonSeleccionado($EliminarID) {
    return $this->db->delete('salones', array('id_salon' => $EliminarID));
  }


  public function BuscarFotosSalonSeleccionado($BuscarID) {
    $this->db->select('id_foto,nombre_foto,id_salon');
    $this->db->from('fotos_salones');
    $this->db->where('id_salon', $BuscarID);
    $FotosSalon = $this->db->get();
    return $FotosSalon->result();
  }


  public function BuscarDatosFotoSeleccionada($FotoID) {
    $this->db->select('*');
    $this->db->from('fotos_salones');
    $this->db->where('id_foto', $FotoID);
    $DatosFoto = $this->db->get();
    if (count($DatosFoto->result()) > 0) {
      return $DatosFoto->row();
    }
  }


  public function CrearNuevaFoto($AgregarDatos) {
    return $this->db->insert('fotos_salones', $AgregarDatos);
  }


  public function EliminarFotoSeleccionada($EliminarID) {
    return $this->db->delete('fotos_salones', array('id_foto' => $EliminarID));
  }

}
