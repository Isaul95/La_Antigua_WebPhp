<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModeloCliente extends CI_Model { // INICIO DEL MODELO

  # Agregar nuevo articulo
  public function agregarCliente($data){
    return $this->db->insert('clientes', $data);
  }


/* =========  Una vez agregado los datos del cliente se obtienen para visualizarlos NO EDIT  ========== */
public function extraer_datesCliente($id_evento, $user_session){
      $this->db->select('id_cliente, nombre, direccion, telefono, email, sexo, user_session, id_evento');
      $this->db->from('clientes');
      $this->db->where('id_evento', $id_evento);
      $this->db->where('user_session', $user_session);
      $query = $this->db->get();
      if (count($query->result()) > 0) {
          return $query->row();
      }
  }



  public function getIneCliente($id_cliente){
    $query = $this->db->query("select * FROM clientes where id_cliente=?", array($id_cliente));
    return $query->row_array();
    }


    # Agregar nuevo articulo
    public function insert_createNewVenta($data){
      return $this->db->insert('venta', $data);
    }



    # Agregar nuevo insert_InDescripcionVenta
    public function insert_InDescripcionVenta($data){
      return $this->db->insert('descripcion_de_venta', $data);
    }



  /* =========  Se consulta si ya esxiste una venta ctaual con el user, el cliente y el evento  ========== */
  public function extraer_ventaActual($usuario, $cliente, $evento){
        $this->db->select('*');
        $this->db->from('venta');
        $this->db->where('usuario', $usuario);
        $this->db->where('cliente', $cliente);
        $this->db->where('evento', $evento);
            $query = $this->db->get();
            if (count($query->result()) > 0) {
                return $query->row();
            }
    }




/* =========  Se consulta si ya esxiste una venta ctaual   ========== */
public function extraer_InDescripcionVenta($venta){
      $this->db->select('*');
      $this->db->from('descripcion_de_venta');
      $this->db->where('venta', $venta);
//    $this->db->where('cliente', $cliente);
          $query = $this->db->get();
          if (count($query->result()) > 0) {
              return $query->row();
          }
  }



  //  Salon en cero
    public function insert_InVentaRealizarCobroTotal($data){
          return $this->db->update('venta', $data, array('id_venta' => $data['id_venta']));
      }


// Registrar como un gastos la venta a credito realizada
  public function insert_InEgresoVentaCredito($data_egreso){
     return $this->db->insert('egreso', $data_egreso);
    }



// Registrar como un pago en la tabla de pagos una venta credito
  public function insert_InPagosVentaCredito($data_pagos){
     return $this->db->insert('pagos', $data_pagos);
    }




/* =========  Se consulta el tipo de venta Estado= (Realizada/Credito) con el user, el cliente y el evento  ========== */
  public function extraer_verTipoVentaActual_EstadoVenta($usuario, $cliente, $evento){
      $this->db->select('*');
      $this->db->from('venta');
      $this->db->where('usuario', $usuario);
      $this->db->where('cliente', $cliente);
      $this->db->where('evento', $evento);
          $query = $this->db->get();
          if (count($query->result()) > 0) {
              return $query->row();
          }
  }



} // FIN / CIERRE DEL MODELO
