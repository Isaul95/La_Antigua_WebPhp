<div class="content-wrapper colorfondo">
  <section class="content">

    <div class="box box-solid colorfondo">
      <div class="box-body">
        <div class="container">

          <div class="row">
            <div class="col-md-12 mt-5">
              <h1 class="text-center">
                <strong><font color="#D34787">Platillos</font></strong>
              </h1>
              <hr style="background-color: black; color: black; height: 1px;">
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">

              <div class="row">
                <div class="col-md-12">
                  <?php if ($permisos->insert == 1):?>
                    <div class="d-flex flex-row">
                      <a type="button" class="btn btn-primary btn-float" data-toggle="modal" data-target="#ModalAgregarPlatillo"><span class="fa fa-plus"></span> Nuevo platillo</a>
                    </div>
                  <?php endif;?>
                </div>
              </div>

              <hr>

              <div class="row my-4">
                <div class="col-md-12 mx-auto">
                  <table class="table table-striped table-bordered dt-responsive nowrap table-hover table-condensed" id="TablaPlatillos" style="background: white!important;" cellspacing="0">
                    <thead class="text-center bg-primary">
                      <tr>
                        <th></th>
                        <th class="text-center" width="20%">Platillo</th>
                        <th class="text-center" width="12%">Costo</th>
                        <th class="text-center" width="35%">Descripción</th>
                        <th class="text-center" width="20%">Foto</th>
                        <th class="text-center" width="13%">Acciones</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>


              <div class="modal fade" id="ModalAgregarPlatillo" tabindex="-1" aria-labelledby="TituloModalAgregarPlatillo" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header bg-primary text-center">
                      <strong class="modal-title" id="TituloModalAgregarPlatillo">Agregar un nuevo platillo</strong>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <form id="FormularioAgregarPlatillo">
                        <div class="container">
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Platillo</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control text-center" id="AgregarNombre" placeholder="Nombre del platillo">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Costo del platillo</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control text-center" id="AgregarCosto" placeholder="Costo del platillo"/>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Descripción</label>
                                <div class="col-sm-9">
                                  <textarea class="form-control text-center" id="AgregarDescripcion" style="resize: none;" placeholder="Descripción del platillo" rows="3" cols="3"></textarea>
                                </div>
                              </div>
                              <div>
                                <div style="text-align: center;">
                                  <label>Seleccione una imagen</label>
                                </div>
                                <div class="form-control">
                                  <input type="file" class="custom-file-input" id="AgregarImagen" style="padding: 0 15%;">
                                </div>
                              </div>
                              <div style="text-align: center;">
                                <img id="MostrarImagenSeleccionada" style="padding: 2%;">
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                      <button type="button" class="btn btn-primary" id="AgregarPlatillo">Agregar</button>
                    </div>
                  </div>
                </div>
              </div>


              <div class="modal fade" id="ModalModificarPlatillo" tabindex="-1" aria-labelledby="TituloModalModificarPlatillo" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header bg-primary text-center">
                      <strong class="modal-title" id="TituloModalModificarPlatillo">Editar datos del platillo</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <form id="FormularioEditarPlatillo">
                        <div class="container">
                          <div class="row">
                            <div class="col-sm-6">
                              <div style="text-align: center;">
                                <label>Imagen actual</label>
                              </div>
                              <div id="MostrarImagenActual" style="text-align: center;"></div>
                              <div class="form-group row">
                                <input type="hidden" id="ID_Actual">
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Platillo</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control text-center" id="NombreModificado" placeholder="Nombre del platillo">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Costo del platillo</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control text-center" id="CostoModificado" placeholder="Costo del platillo"/>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Descripción</label>
                                <div class="col-sm-9">
                                  <textarea class="form-control text-center" id="DescripcionModificada" style="resize: none;" placeholder="Descripción del platillo" rows="3" cols="3"></textarea>
                                </div>
                              </div>
                              <div>
                                <div style="text-align: center;">
                                  <label>Seleccione una imagen</label>
                                </div>
                                <div class="form-control">
                                  <input type="file" class="custom-file-input" id="ImagenModificada" style="padding: 0 15%;">
                                </div>
                              </div>
                              <div style="text-align: center;">
                                <img id="MostrarImagenModificada" style="padding: 2%;">
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                      <button type="button" class="btn btn-primary" id="ActualizarPlatillo">Modificar</button>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>

  </section>
</div>
