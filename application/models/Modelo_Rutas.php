<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelo_Rutas extends CI_Model { // INICIO DEL MODELO


// public function get_listaPlatillos(){
//   $query = $this->db->get('platillos');
//     return $query->result();
// }


  public function obtenerMobiliarioParaEntregar(){
    $this->db->select(" dv.id, dv.mobiliario, mob.nombre, mob.precio, dv.cantidad_piezas_mobiliario, dv.precio_total_mob, dv.venta , cli.nombre as name_cliente, cli.direccion, eve.start, ven.hora_entrega, ven.hora_salida ");
    $this->db->from(" descripcion_de_venta dv ");
    $this->db->join(" mobiliario mob","dv.mobiliario = mob.clave");
    $this->db->join(" venta ven","dv.venta = ven.id_venta");
    $this->db->join(" clientes cli","ven.cliente = cli.id_cliente");
    $this->db->join(" eventos eve","ven.evento = eve.id_evento");
    // $this->db->where('dv.venta', $venta);

    $resultados = $this->db->get();
    return $resultados->result();
    }




  public function agregarHorarioSalidaMob($data){
        return $this->db->update('venta', $data, array('id_venta' => $data['id_venta']));
    }


  public function agregarHorarioEntregaMob($data){
        return $this->db->update('venta', $data, array('id_venta' => $data['id_venta']));
    }



  } // FIN / CIERRE DEL MODELO
