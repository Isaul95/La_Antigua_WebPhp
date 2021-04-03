<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModeloCliente extends CI_Model { // INICIO DEL MODELO

  # Agregar nuevo articulo
  public function agregarCliente($data){
    return $this->db->insert('clientes', $data);
  }



/* =========  Una vez agregado los datos del cliente se obtienen para visualizarlos NO EDIT  ========== */
public function extraer_datesCliente($id_cliente){
      $this->db->select('id_cliente, nombre, direccion, telefono, email, sexo');
      $this->db->from('clientes');
      $this->db->where('id_cliente', $id_cliente);
      $query = $this->db->get();
      if (count($query->result()) > 0) {
          return $query->row();
      }
  }



  public function getIneCliente($id_cliente){
    $query = $this->db->query("select * FROM clientes where id_cliente=?", array($id_cliente));
    return $query->row_array();
    }


} // FIN / CIERRE DEL MODELO
