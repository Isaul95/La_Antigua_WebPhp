<div class="content-wrapper colorfondo">
  <section class="content">

    <div class="box box-solid colorfondo">
      <div class="box-body">
        <div class="container">

          <div class="row">
            <div class="col-md-12 mt-5">
              <h1 class="text-center">
                <strong><font color="#D34787">Salones</font></strong>
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
                      <a type="button" class="btn btn-primary btn-float" data-toggle="modal" data-target="#ModalAgregarSalon"><span class="fa fa-plus"></span> Nuevo salón</a>
                    </div>
                  <?php endif;?>
                </div>
              </div>

              <hr>

              <div class="row">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover table-condensed dt-responsive nowrap" id="TablaSalones" style="background: white!important;" cellspacing="0">
                    <thead class="text-center bg-primary">
                      <tr>
                        <th class="text-center" width="%">Salón</th>
                        <th class="text-center" width="%">Dirección</th>
                        <th class="text-center" width="%">Costo</th>
                        <th class="text-center" width="%">Capacidad</th>
                        <th class="text-center" width="15%">Acciones</th>
                        <th class="text-center" width="5%">Galería de fotos</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>


              <div class="modal fade" id="ModalVisualizarSalon" tabindex="-1" aria-labelledby="TituloModalVisualizarSalon" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header bg-primary text-center">
                      <strong class="modal-title" id="TituloModalVisualizarSalon">Información del salón</strong>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                        <div class="container">
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Salón</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control text-center" id="visualizarNombre" readonly>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Dirección</label>
                                <div class="col-sm-9">
                                  <textarea class="form-control text-center" id="visualizarDireccion" style="resize: none;" rows="3" cols="3" readonly></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Costo del alquiler</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control text-center" id="visualizarCosto" readonly>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Capacidad máxima</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control text-center" id="visualizarCapacidad" readonly>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Descripción</label>
                                <div class="col-sm-9">
                                  <textarea class="form-control text-center" id="visualizarDescripcion" style="resize: none;" rows="3" cols="3" readonly></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Horarios</label>
                                <div class="col-sm-9">
                                  <textarea class="form-control text-center" id="visualizarHorarios" style="resize: none;" rows="3" cols="3" readonly></textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>


              <div class="modal fade" id="ModalAgregarSalon" tabindex="-1" aria-labelledby="TituloModalAgregarSalon" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header bg-primary text-center">
                      <strong class="modal-title" id="TituloModalAgregarSalon">Agregar un nuevo salón</strong>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <form id="FormularioAgregarSalon">
                        <div class="container">
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Salón</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control text-center" id="AgregarNombre" placeholder="Nombre del salón">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Dirección</label>
                                <div class="col-sm-9">
                                  <textarea class="form-control text-center" id="AgregarDireccion" style="resize: none;" placeholder="Dirección del salón" rows="3" cols="3"></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Costo</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control text-center" id="AgregarCosto" placeholder="Costo del alquiler del salón">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Capacidad</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control text-center" id="AgregarCapacidad" placeholder="Capacidad máxima del salón">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Descripción</label>
                                <div class="col-sm-9">
                                  <textarea class="form-control text-center" id="AgregarDescripcion" style="resize: none;" placeholder="Descripción del salón" rows="3" cols="3"></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Horarios</label>
                                <div class="col-sm-9">
                                  <textarea class="form-control text-center" id="AgregarHorarios" style="resize: none;" placeholder="Horarios del salón" rows="3" cols="3"></textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                      <button type="button" class="btn btn-primary" id="AgregarSalon">Agregar</button>
                    </div>
                  </div>
                </div>
              </div>


              <div class="modal fade" id="ModalModificarSalon" tabindex="-1" aria-labelledby="TituloModalModificarSalon" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header bg-primary text-center">
                      <strong class="modal-title" id="TituloModalModificarSalon">Editar datos del salón</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <form id="FormularioEditarSalon">
                        <div class="container">
                          <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group row">
                                <input type="hidden" id="ID_Actual">
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Salón</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control text-center" id="NombreModificado" placeholder="Nombre del salón">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Dirección</label>
                                <div class="col-sm-9">
                                  <textarea class="form-control text-center" id="DireccionModificada" style="resize: none;" placeholder="Dirección del salón" rows="3" cols="3"></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Costo</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control text-center" id="CostoModificado" placeholder="Costo del alquiler del salón">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Capacidad</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control text-center" id="CapacidadModificada" placeholder="Capacidad máxima del salón">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Descripción</label>
                                <div class="col-sm-9">
                                  <textarea class="form-control text-center" id="DescripcionModificada" style="resize: none;" placeholder="Descripción del salón" rows="3" cols="3"></textarea>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label text-center">Horarios</label>
                                <div class="col-sm-9">
                                  <textarea class="form-control text-center" id="HorariosModificados" style="resize: none;" placeholder="Horarios del salón" rows="3" cols="3"></textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                      <button type="button" class="btn btn-primary" id="ActualizarSalon">Modificar</button>
                    </div>
                  </div>
                </div>
              </div>



              <div class="modal fade" id="ModalGaleriaSalon" tabindex="-1" aria-labelledby="TituloModalGaleriaSalon" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header bg-primary text-center">
                      <strong class="modal-title" id="TituloModalGaleriaSalon">Fotos del salón</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      <div class="row">
                        <form id="FormularioAgregarFoto">
                          <div>
                            <div style="text-align: center;">
                              <label>Seleccione una foto</label>
                            </div>
                            <div class="form-control">
                              <input type="file" class="custom-file-input" id="SeleccionarNuevaFoto" style="padding: 0 15%;">
                            </div>
                          </div>
                          <!-- <div style="text-align: center;">
                            <img id="MostrarFotoSeleccionada" style="padding: 2%;">
                          </div> -->
                        </form>
                        <div style="text-align: center;">
                          <button type="button" class="btn btn-primary" id="AgregarFotoSalon">Agregar</button>
                        </div>
                      </div>
                      <input type="hidden" id="FotoID">
                      <hr>
                      <div class="row">
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover table-condensed dt-responsive nowrap" id="TablaFotos" style="background: white!important;" cellspacing="0" width="100%">
                            <thead class="text-center bg-primary">
                              <tr>
                                <th class="text-center" width="60%">Foto</th>
                                <th class="text-center" width="8%">Acciones</th>
                              </tr>
                            </thead>
                          </table>
                        </div>
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
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
