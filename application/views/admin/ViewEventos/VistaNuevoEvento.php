<div class="content-wrapper colorfondo"> <!-- STAR ALL CONTENT -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>


            <section class="content">
                <div class="box box-solid colorfondo">
                    <div class="box-body">
<div class="container">
  <div class="row">
    <div class="col-md-12 mt-5">
      <h3 class="text-center">
      <strong><font color="#D34787">Nuevo Evento</font></strong>
    </h3>
      <hr style="background-color: black; color: black; height: 1px;">
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <!-- <div class="row">
          <div class="col-md-12">
          </div>   =>>  UNA COLUMNA
      </div> -->

      <!--   ================ DIV TO print CALENDAR BODY==================  -->
<div class="row my-4">
    <div class="col-md-12 mx-auto">

          <div id="calendar"></div>

    </div>
  </div>
<br/>
<br/>



<!-- Modal Agregar registro para recibo de pago -->
  <div class="modal fade" id="ModalEventos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-center">
          <strong class="modal-title" id="exampleModalLabel">Agregar Nuevo Evento para esta fecha</strong>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="username" name="username" value="<?php echo $username;?>" >
          <input type="hidden" id="id_evento" name="id_evento" >

          <!-- Add Record Form -->
      <form id="addNewEvent">

            <div class="form-group">
              <label for="">Fecha: </label>
              <input type="text" class="form-control" id="fecha_evento" readonly>
            </div>

            <div class="form-group">
              <label for="">Titulo: *</label>
              <input type="text" class="form-control" id="titulo" placeholder="Titulo del evento...">
            </div>

            <div class="form-group input-group clockpicker" data-autoclose="true" >
              <label for="">Hora del evento: *</label>
              <input type="text" class="form-control" id="hora"  placeholder="Horario del evento...">
            </div>

            <div class="form-group">
              <label for="">Descripción: *</label>
              <textarea rows="3" class="form-control" id="descripcion" ></textarea>
            </div>


            <div class="form-group" id="divColor">
            <label for="">Color: </label>
            <input type="color" class="form-control" id="color">
            </div>

      </form>
        </div>
        <div class="modal-footer">
          <!-- Insert Button -->
          <button type="button" class="btn btn-primary" id="nuevoEventoCliente">Agregar Contrato</button>

          <button type="button" class="btn btn-primary" id="btnAgregarNewEvent">Agregar</button>
          <button type="button" class="btn btn-success" id="eliminarEvento" >Eliminar</button>
          <button type="button" class="btn btn-info" id="updateEvento" >Actualizar</button>

          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>



  <div id="loading-screen-eventos" style="display:none">
      <img src="<?php echo base_url()?>assets/template/dist/img/ajax-loader.gif">
      <p> Cargando... </p>
  </div>


              </div>
              </div>
            </div>
        </div>
      </div>
    </section>
  </div>
