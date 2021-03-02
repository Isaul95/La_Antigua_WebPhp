<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModeloBanquetes extends CI_Model { // INICIO DEL MODELO

# Listar datos de la tabla mobiliario
public function listarBanquetes(){

  $resultados = $this->db->get('banquetes');
  return $resultados->result();

}

# Agregar nuevo Banquete
public function agregarBanquete($data)
    {
        return $this->db->insert('banquetes', $data);
    }


// Buscar por id
public function single_entry($id)
          {
              $this->db->select('*');
              $this->db->from('banquetes');
              $this->db->where('id_banquete', $id);
              $query = $this->db->get();
              if (count($query->result()) > 0) {
                  return $query->row();
              }
          }
// Actualizar datos
public function actualizarBanquete($id_banquete,$ajax_data){
  return $this->db->update('banquetes', $ajax_data, array('id_banquete' => $id_banquete));


}

public function delete_entry($id)
{
    return $this->db->delete('banquetes', array('id_banquete' => $id));
}

  } // FIN / CIERRE DEL MODELO
