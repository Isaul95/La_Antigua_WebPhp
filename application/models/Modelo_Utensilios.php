<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelo_Utensilios extends CI_Model { // INICIO DEL MODELO


/* -------------------------------------------------------------------------- */
/*                        Lista datos Gral. del Alumno                        */
/* -------------------------------------------------------------------------- */

  public function get_listaUtensilios(){
    $query = $this->db->get('utensilios');
      return $query->result();
  }



  } // FIN / CIERRE DEL MODELO
