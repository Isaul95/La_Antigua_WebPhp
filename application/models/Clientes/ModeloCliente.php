<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModeloCliente extends CI_Model { // INICIO DEL MODELO

  # Agregar nuevo articulo
  public function agregarCliente($data){
    return $this->db->insert('clientes', $data);
  }


} // FIN / CIERRE DEL MODELO
