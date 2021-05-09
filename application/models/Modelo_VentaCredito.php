<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelo_VentaCredito extends CI_Model { // INICIO DEL MODELO

//  Consulta All las ventas k esta a credito
    public function obtenerAllVentasACreditos(){
      $this->db->distinct();
      $this->db->select(" venta.id_venta, clientes.nombre,venta.subtotal , venta.total, venta.pago, venta.cambio,venta.fecha_reporte ");
      $this->db->from(" venta ");
      $this->db->join(" clientes "," venta.cliente = clientes.id_cliente ");
      // $this->db->where("venta.id_venta",$venta);
      $this->db->where_in('venta.estado_venta', ['Credito_pendiente']);
      $resultados = $this->db->get();
      return $resultados->result();
      }



// Se agrega el pago/abono actual de la venta conforme agregan pagos los pagos se suman al pago actual=50 + pagoNew=10 = actual$60.00
   public function agregarPagoMonto($pago, $id_venta){
     $query = $this->db->query("update venta set pago = pago  + ? where id_venta=? ", array($id_venta, $pago));
     return $query;
    }



// Se resta el cambio/restante actual de la venta conforme agregan pagos,
// los pagos le restan al cambio actual=50 - pagoNew=10 = restante x pagar => $40.00
   public function restarPagoRestante($cambio, $id_venta){
     $query = $this->db->query("update venta set cambio = cambio  - ? where id_venta=? ", array($id_venta, $cambio));
     return $query;
    }



// La sumatoria total de todos los pagos realizados
  public function sumatoriaTotalPagos($id_venta){
        $this->db->select("SUM(monto) as sumaPagos");
        $this->db->from("pagos");
        $this->db->where("id_venta", $id_venta);
        $resultados = $this->db->get();
        return $resultados->row();
    }


// LA VEBTA EN ESTADO = venta a credito PASA a = Realizada de acuerdo alas sumas de los apgos realizados
  public function ventaPagadaCompletaAvRealizada($id_venta,$sum){
    $query = $this->db->query("update venta set estado_venta='Realizada' where id_venta=? and total=? ", array($id_venta, $sum));
    return $query;
   }


   public function obtenerListaDePagosxParcialidades($id_venta){
       $this->db->select("id_pago, nombre, monto, CONCAT(fecha,' || ',hora) As fechaCompleta ");
        $this->db->from("pagos");
        $this->db->where("id_venta",$id_venta);
        // $this->db->group_by('nombre_completo');
         $resultados = $this->db->get();
         return $resultados->result();
     }


  } // FIN / CIERRE DEL MODELO
