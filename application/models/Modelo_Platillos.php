<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelo_Platillos extends CI_Model { // INICIO DEL MODELO


/* -------------------------------------------------------------------------- */
/*                        Lista datos Gral. de                                */
/* -------------------------------------------------------------------------- */

public function get_listaPlatillos(){
  $query = $this->db->get('platillos');
    return $query->result();
}





  } // FIN / CIERRE DEL MODELO
