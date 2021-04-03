
<div class="content-wrapper colorfondo"> <!-- STAR ALL CONTENT -->
             <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box box-solid colorfondo">
                    <div class="box-body">
<div class="container">
  <!-- <div class="row">
    <div class="col-md-12 mt-5">
      <h1 class="text-center">
      <strong><font color="#D34787">Prueba Tabs</font></strong>
      </h1>
      <hr style="background-color: black; color: black; height: 1px;">
        </div>
  </div> -->


<input type="hidden" id="username" class="username" value="<?php echo $username;?>" >
<input type="hidden" id="id_evento" class="id_evento" value="<?php echo $_GET["Numero_Evento"]; ?>" >


  <div class="row">
    <div class="col-md-12">

	<div class="example-two">
		<ul class="tabs">
			<li><a href="#tab1"></span><span class="tab-text">Datos Generales</span></a></li>
			<li><a href="#tab2"></span><span class="tab-text">Salón de eventos</span></a></li>
			<li><a href="#tab3"></span><span class="tab-text">Mobiliario</span></a></li>
			<li><a href="#tab4"></span><span class="tab-text">Banquetes</span></a></li>
      <li><a href="#tab5"></span><span class="tab-text">Generar Reporte</span></a></li>
		</ul>

<hr style="background-color: black; color: black; height: 0px;">

		<div class="secciones">

			<article id="tab1">

        <div class="panel panel-default">
			<div class="panel-heading text-center">	<h4>Datos del responsable del evento</h4></div>
        <br>
        <br>

        <div class="panel-body">

        <div class="myForm" id="myForm">
<input type="hidden" id="id_clienteAdd" name="id_clienteAdd" >
          <form class="" id="addClienteForm">
            <div class="row">
              <div class="form-group col-md-6">
                <label>Nombre: *</label>
                <input type="text" id="nombreCliente" class="form-control" placeholder="Nombre">
              </div>
              <div class="form-group col-md-6">
                <label>Dirección: *</label>
                <input type="text" id="direccionCliente" class="form-control" placeholder="Dirección">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label>Telefono: *</label>
                <input type="text" id="telefonoCliente" class="form-control" placeholder="Telefono">
              </div>
              <div class="form-group col-md-6">
                <label>Sexo: *</label>
                <select class="form-control" id="sexoCliente">
                  <option>Masculino</option>
                  <option>Femenino</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label>Email: *</label>
                <input type="text" id="emailCliente" class="form-control" placeholder="Email">
              </div>

              <div id="divAddPdf">
                  <div class="form-group col-md-6 form-control-file">
                    <label>INE: *</label>
                    <input type="file" class="custom-file-input" name="ine" id="ine" />
                  </div>
              </div>

            <div id="divMostrarPdf">
                  <div class="form-group col-md-6 form-control-file text-center">
                    <label>Ver Pdf:</label> </br>
                      <a onclick="verPdfIne()">
                         <i class="far fa-file-pdf fa-2x"></i>
                      </a>
                  </div>
            </div>

            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <button type="button" class="btn btn-primary" id="btnAddClienteXContrato">Agregar</button>
              </div>
            </div>
          </form>
        </div>

</div>

</div>

			</article>


      <article id="tab2">
          <div class="px-lg-5">
            <section class="content">
              <div class="row">
                <div id="Salones"></div>
              </div>
            </section>
          </div>
        </article>

        <article id="tab3">
          <div class="px-lg-5">
            <section class="content">
              <div class="row">
                <div id="Mobiliario"></div>
              </div>
            </section>
          </div>
        </article>

        <article id="tab4">
          <div class="px-lg-5">
            <section class="content">
              <div class="row">
                <div id="Platillos"></div>
              </div>
            </section>
          </div>
        </article>

        <article id="tab5">

          <div class="panel panel-default">
        <div class="panel-heading text-center">	<h4>Realizar reporte general del evento</h4></div>
          <br>
          <br>

          <div class="panel-body">

          <div class="myForm" id="myForm">

            <!-- <form class="" id="addCliente">
              <div class="row">
                <div class="form-group col-md-6">
                  <label>Nombre: *</label>
                  <input type="text" id="nombreCliente" class="form-control" placeholder="Nombre">
                </div>
                <div class="form-group col-md-6">
                  <label>Dirección: *</label>
                  <input type="text" id="direccionCliente" class="form-control" placeholder="Dirección">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label>Telefono: *</label>
                  <input type="text" id="telefonoCliente" class="form-control" placeholder="Telefono">
                </div>
                <div class="form-group col-md-6">
                  <label>Sexo: *</label>
                  <select class="form-control" id="sexoCliente">
                    <option>Masculino</option>
                    <option>Femenino</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label>Email: *</label>
                  <input type="text" id="emailCliente" class="form-control" placeholder="Email">
                </div>
                <div class="form-group col-md-6 form-control-file">
                  <label>INE: *</label>
                  <input type="file" class="custom-file-input" name="ine" id="ine" />
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-12">
                  <button type="button" class="btn btn-primary" id="btnaddCliente">Agregar</button>
                </div>
              </div>
            </form>
          </div> -->

  <div class="row">
    <div class="form-group col-md-12">
      <button type="button" class="btn btn-primary" onclick="btnGenerarReporteEvento()">Generar Reporte de cleinte</button>
    </div>
  </div>

  <!-- <div id="generarConstanciaPDFAlumno">

                    <center>
                      <h4><font color="#3498DB">Generar Constancia del Alumno</font></h4> <br>
                     <a onclick="generaConstanciaPdfStuden()">
                       <i class="far fa-file-pdf fa-2x"></i></a>
                     </center> <br>

            </div> -->


  </div>

        </article>


		</div>
	</div>




    </div>
  </div>

</div>





<!-- Modal Consultar Historico de pagos x parcialidades X Alumnos -->
<div class="modal fade" id="modalGaleriaFotosxSalon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <!-- <div class="modal-dialog modal-lg"> -->
    <div class="modal-content">
      <!-- <div class="modal-header bg-primary text-center">
        <strong class="modal-title" id="exampleModalLabel">XXXX</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
      <div class="modal-body">
            <input type="hidden" id="id_salonXGaleria" name="id_salonXGaleria">
            <input type="hidden" id="userAlta" name="userAlta" value="<?php echo $username;?>" >


            <div class="col-md-12">
            <div class="carousel slide multi-image-slider" id="theCarousel">


            <div class="carousel-inner">
            <div id="carruselSalones"></div>
            </div>


            <a class="bg-danger" class="left carousel-control" href="#theCarousel" data-slide="prev"><i class="glyphicon
            glyphicon-chevron-left"></i></a>
            <a class="bg-dark" class="right carousel-control" href="#theCarousel" data-slide="next"><i class="glyphicon
            glyphicon-chevron-right"></i></a>
            </div>
            </div>




      <!-- <div class="container">
            <h2>Carousel Example</h2> -->
            <!-- <div id="myCarousel" class="carousel slide" data-ride="carousel"> -->
              <!-- Indicators -->
              <!-- <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
              </ol> -->

              <!-- Wrapper for slides -->
              <!-- <div class="carousel-inner"> -->

                <!-- <div class="item active">
                  <div id="carruselSalones"></div>
                </div> -->

                <!-- <div class="item active">
                  <img src="<?php echo base_url()?>/src/1.jpg" alt="Los Angeles" style="height:5%;" style="width:100%;">
                </div>
                <div class="item">
                  <img src="<?php echo base_url()?>src/2.jpg" alt="Chicago" style="height:100%;" style="width:100%;">
                </div>
                <div class="item">
                  <img src="<?php echo base_url()?>src/3.jpg" alt="New york"  style="height:100%;" style="width:100%;">
                </div> -->
              <!-- </div> -->

              <!-- Left and right controls -->
              <!-- <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
              </a> -->
              <!-- <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon
              glyphicon-chevron-left"></i></a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon
              glyphicon-chevron-right"></i></a> -->
            <!-- </div> -->

      <!-- </div> -->




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>




</div>


<!--      carruselSalones    -->


                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </section>
            <!-- / MAIN content -->

    </div> <!-- /END ALL CONTENT -->











<!-- < php
            include_once("./application/config/setting.php");
            $sqlQuery = "SELECT id_foto, nombre_foto, foto FROM fotos_salones";
            $resultSet = mysqli_query($conn, $sqlQuery);
            $setActive = 0;
            $sliderHtml = '';
            while( $sliderImage = mysqli_fetch_assoc($resultSet)){
            $activeClass = "";
            if(!$setActive) {
            $setActive = 1;
            $activeClass = 'active';
            }
            $sliderHtml.= "<div class='item ".$activeClass."'>";
            $sliderHtml.= "<div class='col-xs-4'><a href='".$sliderImage['id_foto']."'>";
            $sliderHtml.= "<img src='Contratos/ImagenSalon/".$sliderImage['id_foto']."' class='img-responsive'>";
            $sliderHtml.= "</a></div></div>";
            }
            echo $sliderHtml;
            ?> -->
