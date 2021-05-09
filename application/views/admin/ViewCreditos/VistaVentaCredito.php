<div class="content-wrapper colorfondo"> <!-- STAR ALL CONTENT -->
             <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box box-solid colorfondo">
                    <div class="box-body">
<div class="container">
  <div class="row">
    <div class="col-md-12 mt-5">
      <h3 class="text-center">
      <strong><font color="#D34787">Ventas pendientes(Ventas a credito) ISAUL</font></strong>
    </h3>
      <hr style="background-color: black; color: black; height: 1px;">
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <!-- <div class="row">
          <div class="col-md-12">

          </div>
      </div> -->
<hr> <!-- Le da una linea sombreada para ver la divicion -->
<div class="row my-4">
    <div class="col-md-12 mx-auto">


      <table id="tbl_AllVentasACreditosPend" class="table table-striped table-bordered dt-responsive nowrap table-hover table-condensed" cellspacing="0" style="background:white!important" width="100%">
        <thead class="text-center bg-primary">
          <tr>
            <th width="7%">Venta</th>
            <th width="20%">Cliente</th>
            <th width="10%">Subtotal</th>
            <th width="8%">Total</th>
            <th width="9%">Pago/abono</th>
            <th width="9%">Restante</th>
            <th width="10%">Fecha</th>
            <th width="7%">Realizar Pago</th>
          </tr>
        </thead>
      </table>



    </div>
  </div>



  <!-- Modal Agregar horario de salida -->
  <div class="modal fade" id="modal_Add_PagoCredito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-center">
          <strong class="modal-title" id="exampleModalLabel">Pagando venta a credito</strong>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="username_pagos" name="username_pagos" value="<?php echo $username;?>" >
          <input type="hidden" id="id_ventaPagos" name="id_ventaPagos" >
          <input type="hidden" id="name_clientePagos" name="name_clientePagos" >

            <form id="addPagos">

                  <div class="form-group text-center">
                      <label for="">Escriba el monto del pago: *</label>
                    <input type="text" class="form-control text-center" id="monto_pagos" placeholder="00:00">
                  </div>
                  <!-- <div class="form-group">
                    <label for="">Escriba el monto del pago: *</label>
                    <input type="text" class="form-control" id="nombre" placeholder="00.00">
                  </div> -->

            </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" id="btnAddPagosVentaCredito">Agregar</button>
        </div>
      </div>
    </div>
  </div>




      <!-- Modal Agregar horario de entrega -->
      <div class="modal fade" id="modal_Add_HoraEntrega" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header bg-primary text-center">
              <strong class="modal-title" id="exampleModalLabel">Agregar Hora de Entrega</strong>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="username" name="username" value="<?php echo $username;?>" >
              <input type="hidden" id="id_horaEntrega" name="id_horaEntrega" >

                <form id="addHoraEntrega">

                      <div class="form-group input-group clockpicker text-center" data-autoclose="true">
                          <label for="">Capturar Hora de Entrega:*</label>
                        <input type="text" class="form-control text-center" id="hora_rutaEntrega" placeholder="00:00">
                      </div>

                </form>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" id="btnAddHoraEntrega">Agregar</button>
            </div>
          </div>
        </div>
      </div>



      <div id="loading-screen" style="display:none">
          <img src="<?php echo base_url()?>assets/template/dist/img/ajax-loader.gif">
          <p> Cargando... </p>
      </div>

    </div>
  </div>


</div>

                    </div>
                </div>
            </section>
    </div> <!-- /END ALL CONTENT -->
