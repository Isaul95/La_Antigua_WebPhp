<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelo_Eventos extends CI_Model { // INICIO DEL MODELO


    public function get_listarAllEventos(){
      $query = $this->db->get('eventos');
        return $query->result();
    }


    public function insert_entry($data){
        return $this->db->insert('eventos', $data);
      }


    public function eliminarEvento($id_evento){
      return $this->db->delete('eventos', array('id_evento' => $id_evento));
      }


    public function update_evento($id_evento, $data){
            return $this->db->update('eventos', $data, array('id_evento' => $id_evento));
        }

        public function EnlistarSalones() {
        $InformacionTablaSalones = $this->db->get('salones');
        return $InformacionTablaSalones->result();
      }


      public function EnlistarMobiliario() {
        // $InformacionTablaMobiliario = $this->db->get('mobiliario');
        // return $InformacionTablaMobiliario->result();

        $this->db->select(" clave, nombre, precio, id_categoria, stock, estado, descripcion ");
    $this->db->from("mobiliario");
    $resultados = $this->db->get();
    return $resultados->result();

      }


      public function BuscarDatosMuebleSeleccionado($BuscarClave) {
        $this->db->select('*');
        $this->db->from('mobiliario');
        $this->db->where('clave', $BuscarClave);
        $DatosMueble = $this->db->get();
        if (count($DatosMueble->result()) > 0) {
          return $DatosMueble->row();
        }
      }



// Se consulta la ultima inagen de la galeria de fotos del salon correspondiente al salon = id_salon
    public function datosSalonSeleccionado($id_salon) {
      $this->db->select('*');
      $this->db->from('fotos_salones');
      $this->db->where(' id_salon = ', $id_salon);
      // $this->db->where('id_foto = (SELECT MAX(id_foto ) FROM fotos_salones) AND id_salon = ', $id_salon);
      $DatosMueble = $this->db->get();
      if (count($DatosMueble->result()) > 0) {
        return $DatosMueble->row();
      }
    }





      public function EnlistarPlatillos() {
        // $InformacionTablaPlatillos = $this->db->get('platillos');
        // return $InformacionTablaPlatillos->result();

        $this->db->select("id_platillo, nombre_platillo, costo, descripcion");
    $this->db->from("platillos");
    $resultados = $this->db->get();
    return $resultados->result();

      }



        // public function obtenercarreras(){
        //     $this->db->select("id_platillo, nombre_platillo, costo, descripcion");
        // $this->db->from("platillos");
        // $resultados = $this->db->get();
        // return $resultados->result();
        // }




        public function obtenercarreras(){
            $this->db->select("id_platillo, nombre_platillo, costo, descripcion");
        $this->db->from("platillos");
        $resultados = $this->db->get();
        return $resultados->result();
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



  public function agregarPiezasAlquiladosMobil($data){
        return $this->db->update('descripcion_de_venta', $data, array('venta' => $data['venta']));
    }




  public function agregarCantidadPersonasPlatilloElegido($data){
        return $this->db->update('descripcion_de_venta', $data, array('venta' => $data['venta']));
    }



  public function agregarDetallesSalon($data){
        return $this->db->update('descripcion_de_venta', $data, array('venta' => $data['venta']));
    }


  public function obtenerSalonKEstaEnVenta($venta){
    // $this->db->distinct();
    $this->db->select(" dv.id, dv.salon, sal.nombre_salon, dv.cantidad_salon, dv.importe, dv.venta, sal.direccion, sal.capacidad, sal.descripcion, cli.nombre as name_cliente, cli.direccion as direccionCliente, eve.start ");
    $this->db->from(" descripcion_de_venta dv ");
    $this->db->join(" salones sal","dv.salon = sal.id_salon");
    $this->db->join(" venta ven "," dv.venta = ven.id_venta ");
    $this->db->join(" clientes cli "," ven.cliente = cli.id_cliente ");
    $this->db->join(" eventos eve "," ven.evento = eve.id_evento ");
    $this->db->where('dv.venta', $venta);
    // $this->db->where('m.especialidad', $especialidad);

    $resultados = $this->db->get();
    return $resultados->result();
    }



  public function obtenerMobiliarioKEstaEnVenta($venta){
    $this->db->select(" dv.id, dv.mobiliario, mob.nombre, mob.precio, dv.cantidad_piezas_mobiliario, dv.precio_total_mob, dv.venta, cli.nombre as name_cliente, cli.direccion as direccionCliente, eve.start ");
    $this->db->from(" descripcion_de_venta dv ");
    $this->db->join(" mobiliario mob","dv.mobiliario = mob.clave");
    $this->db->join(" venta ven "," dv.venta = ven.id_venta ");
    $this->db->join(" clientes cli "," ven.cliente = cli.id_cliente ");
    $this->db->join(" eventos eve "," ven.evento = eve.id_evento ");
    $this->db->where('dv.venta', $venta);

    $resultados = $this->db->get();
    return $resultados->result();
    }




  public function obtenerPlatillosKEstaEnVenta($venta){
    $this->db->select(" dv.id, dv.platillo, pla.nombre_platillo, pla.costo, dv.cantidad_personas_platillo, dv.precio_total_platillo, dv.venta , cli.nombre as name_cliente, cli.direccion as direccionCliente, eve.start");
    $this->db->from(" descripcion_de_venta dv ");
    $this->db->join(" platillos pla","dv.platillo = pla.id_platillo");
    $this->db->join(" venta ven "," dv.venta = ven.id_venta ");
    $this->db->join(" clientes cli "," ven.cliente = cli.id_cliente ");
    $this->db->join(" eventos eve "," ven.evento = eve.id_evento ");
    $this->db->where('dv.venta', $venta);

    $resultados = $this->db->get();
    return $resultados->result();
    }




//  Salon en cero
  public function eliminarSalonEnCapturaDeVenta($data){
        return $this->db->update('descripcion_de_venta', $data, array('venta' => $data['venta']));
    }


//  Mobiliario en cero
  public function eliminarMobiliarioEnCapturaDeVenta($data){
        return $this->db->update('descripcion_de_venta', $data, array('venta' => $data['venta']));
    }



//  Platillos en cero
  public function eliminarPlatillosEnCapturaDeVenta($data){
        return $this->db->update('descripcion_de_venta', $data, array('venta' => $data['venta']));
    }




/* =========  suma venta tptal  ========== */
public function extraer_SumTotalVentaActual($venta){
      $this->db->select(' SUM( precio_total_mob + precio_total_platillo + cantidad_salon) as totalVentas ');
      $this->db->from('descripcion_de_venta');
      $this->db->where('venta', $venta);
      // $this->db->where('user_session', $user_session);
      $query = $this->db->get();
      if (count($query->result()) > 0) {
          return $query->row();
      }
  }





//  Consulta si l aventa esta a credito, los creditos pendientes del cliente
    public function obtenerVentasCreditos($venta){
      $this->db->distinct();
      $this->db->select(" venta.id_venta, clientes.nombre,venta.subtotal , venta.total, venta.pago, venta.cambio,venta.fecha_reporte ");
      $this->db->from(" venta ");
      $this->db->join(" clientes "," venta.cliente = clientes.id_cliente ");
      $this->db->where("venta.id_venta",$venta);
      $this->db->where_in('venta.estado_venta', ['Credito_pendiente']);

      $resultados = $this->db->get();
      return $resultados->result();
      }






  } // FIN / CIERRE DEL MODELO
