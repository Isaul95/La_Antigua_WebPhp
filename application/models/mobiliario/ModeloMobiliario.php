<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModeloMobiliario extends CI_Model { // INICIO DEL MODELO

# Listar datos de la tabla mobiliario
public function listarMobiliario(){
  $this->db->select('clave,nombre,precio,stock,estado,descripcion,nombre_foto');
  $this->db->from('mobiliario');
  $resultados = $this->db->get();
    return $resultados->result();
}
public function Buscarfotodemobiliario($BuscarID) {
    $this->db->select('imagen');
    $this->db->from('mobiliario');
    $this->db->where('clave', $BuscarID);
    $DatosPlatillo = $this->db->get();
    if (count($DatosPlatillo->result()) > 0) {
      return $DatosPlatillo->row();
    }
  }
# Agregar nuevo articulo
public function agregarMobiliario($data)
    {
        return $this->db->insert('mobiliario', $data);
    }


// Buscar por id
public function single_entry($id)
          {
              $this->db->select('clave,nombre,precio,stock,estado,descripcion');
              $this->db->from('mobiliario');
              $this->db->where('clave', $id);
              $query = $this->db->get();
              if (count($query->result()) > 0) {
                  return $query->row();
              }
          }
// Actualizar datos
public function actualizarMobiliario($clave,$ajax_data){
  return $this->db->update('mobiliario', $ajax_data, array('clave' => $clave));
  //$this->db->where('clave', $clave);
    //return $this->db->update('mobiliario', $ajax_data);
    //return $this->db->update('alumnos', $data, array('numero_control' => $numero_control));

}

public function delete_entry($id)
{
    return $this->db->delete('mobiliario', array('clave' => $id));
}

  } // FIN / CIERRE DEL MODELO
