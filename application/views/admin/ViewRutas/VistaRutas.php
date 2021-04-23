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
      <strong><font color="#D34787">Agenda de rutas(Mobiliario para entrega)</font></strong>
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


      <table id="tbl_RutasEntregaMobil" class="table table-striped table-bordered dt-responsive nowrap table-hover table-condensed" cellspacing="0" style="background:white!important">
        <thead class="text-center bg-primary">
          <tr>
            <th width="3%" type="hidden">id</th>
            <th width="3%" type="hidden">mobiliario</th>
            <th width="3%" type="hidden">venta</th>
            <th>Nombre cliente</th>
            <th class="text-center" width="10%">Fecha y Hora entrega</th>
            <th>Lugar</th>
            <th class="text-center" width="10%">Mobiliario</th>
            <th class="text-center" width="10%">Precio</th>
            <th class="text-center" width="10%">Piezas</th>
            <th class="text-center" width="7%">Hora Salida</th>
            <th class="text-center" width="7%">Hora Entrega</th>
          </tr>
        </thead>
      </table>

    </div>
  </div>



  <!-- Modal Agregar horario de salida -->
  <div class="modal fade" id="modal_Add_HoraSalida" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header bg-primary text-center">
          <strong class="modal-title" id="exampleModalLabel">Agregar hora de salida</strong>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="username" name="username" value="<?php echo $username;?>" >
          <input type="hidden" id="id_x" name="id_x" >

            <form id="addHoraSalida">

                  <div class="form-group input-group clockpicker text-center" data-autoclose="true">
                      <label for="">Capturar Hora de Salida:*</label>
                    <input type="text" class="form-control text-center" id="hora_rutaSalida" placeholder="00:00">
                  </div>

            </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" id="btnAddHoraSalida">Agregar</button>
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
