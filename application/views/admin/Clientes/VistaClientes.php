<div class="content-wrapper colorfondo"> <!-- STAR ALL CONTENT -->
  <style type="text/css">
  textarea{
    resize: none;
  }
  .myForm{
    background: #AED6F1;
    width: 75%;
    height: 100%;
    padding: 25px 25px 25px 25px;
    border-radius: 10px;
    margin: auto;
  }
  </style>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box box-solid colorfondo">
      <div class="box-body">
        <div class="container">
          <div class="row">
            <div class="col-md-12 mt-5">
              <h1 class="text-center">
                <strong><font color="#D34787">Clientes</font></strong>
              </h1>
              <hr style="background-color: black; color: black; height: 1px;">
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-12">
                  <?php if($permisos->insert == 1):?>
                    <div class="flex-row">
                      <nav class="navbar navbar-light bg-light">
                        <form class="form-inline">
                          <button class="btn btn-success btn-float" type="button" id="agregarCliente">Agregar Cliente</button>
                          <button class="btn btn-success btn-float" type="button" id="inicioc">Inicio</button>
                          <button class="btn btn-success btn-float" type="button" id="clientesDos">Prueba 2</button>
                          <button class="btn btn-success btn-float" type="button" id="clientesTres">Prueba 3</button>
                          <button class="btn btn-success btn-float" type="button" id="clientesCuatro">Prueba 4</button>
                        </form>
                      </nav>
                    </div>
                <?php endif;?>
              </div>
            </div>
            <hr> <!-- Le da una linea sombreada para ver la divicion -->


            <!-- Agregar nuevo registro -->
            <div class="row my-4">
              <div class="col-md-12 mx-auto">

                <div id="formcli">
                  <!-- Aqui se agregan las vistas -->
                  <center><h1>¡Hola Clientes!</h1></center>
                </div>


            </div>
            </div>


          </div>
        </div>
      </div>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </section><!-- / MAIN content -->
</div> <!-- /END ALL CONTENT -->
