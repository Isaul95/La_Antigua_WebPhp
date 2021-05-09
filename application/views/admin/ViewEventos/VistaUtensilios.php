
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

<input type="hidden" id="username_cliente" class="username_cliente" value="<?php echo $username;?>" >
<input type="hidden" id="id_eventoCliente" class="id_eventoCliente" value="<?php echo $_GET["Numero_Evento"]; ?>" >

<!-- Aki se almacena el idVenta una cvez k inserta en venta cuando ya exista evento, y cliene -->
<input type="hidden" id="id_ventaDesdeVenta" class="id_ventaDesdeVenta" >
<input type="hidden" id="estado_ventaActual" class="estado_ventaActual" >


  <div class="row">
    <div class="col-md-12">

	<div class="example-two">
		<ul class="tabs">
			<li><a href="#tab1"></span><span class="tab-text">Datos Generales</span></a></li>
			<li><a href="#tab2"></span><span class="tab-text">Salón de eventos</span></a></li>
			<li><a href="#tab3"></span><span class="tab-text">Mobiliario</span></a></li>
			<li><a href="#tab4"></span><span class="tab-text">Banquetes</span></a></li>
      <li><a href="#tab5"></span><span class="tab-text">General Reporte</span></a></li>
      <li><a href="#tab6"></span><span class="tab-text">Cobro</span></a></li>
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
          <input type="hidden" id="id_evento_Agregado" name="id_evento_Agregado" >

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

<div class="text-center">
    <button type="button" class="btn btn-danger btn-float" onclick="regresarACaledar()">
       <i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;<label><h5>Regresar a calendario de eventos</h5></label>
    </button>
</div>

			</article>


      <article id="tab2">

        <input type="hidden" id="id_clienteAdd" name="id_clienteAdd" >

          <div class="px-lg-5">
            <section class="content">

              <div class="row">
                <div id="Salones"></div>
              </div>

              <div id="SalonElegido">
                  <div class="text-center">
                    <h4><strong>Ya se eligi el sal&oacute;n</strong></h4>
                      <i class="far fa-image fa-9x"></i>
                  </div>
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

              <div id="MobiliarioElegido">
                <div class="text-center">
                  <h4><strong>Ya se eligi&oacute; el mobiliario</strong></h4>
                    <i class="fas fa-chair fa-9x"></i>
                </div>
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

              <div id="PlatillosElegido">
                <div class="text-center">
                  <h4><strong>Ya se eligier&oacute;n los platillos</strong></h4>
                    <i class="fas fa-utensils fa-9x"></i>
                </div>
              </div>

            </section>
          </div>
        </article>

        <article id="tab5">

  <div class="panel panel-default">
<div class="panel-heading text-center">	<h4><strong>Reporte general de sal&oacute;n</strong></h4></div>

    <div class="panel-body">

<!--     SALON ELEGIDO EN VENTA    -->

        <!-- <div class="form-group text-center">
            <label><h4><strong>Sal&oacute;n</strong></h4></label>
        </div> -->

        <div class="row my-4">
          <div class="col-md-12 mx-auto">

            <table id="tbl_VentaSalon" class="table table-striped table-bordered dt-responsive nowrap table-hover table-condensed" cellspacing="0" style="background:white!important" width="100%">
              <thead class="text-center bg-primary">
                <tr>
                  <th width="3%" type="hidden">Id</th>
                  <th width="3%" type="hidden">IdProducto</th>
                  <th>Producto</th>
                  <!-- <th width="7%">Cantidad</th> -->
                  <th width="7%">P.Unitario</th>
                  <th width="10%">Importe</th>
                  <th class="text-center" width="7%">Acciones</th>
                  <th class="text-center" width="7%">Reporte PDF</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>

		</div>
	</div>





  <div class="panel panel-default">
<div class="panel-heading text-center">	<h4><strong>Reporte general de mobiliario</strong></h4></div>

  <div class="panel-body">

<!--    MOBILIARIO ELEGIDO EN VENTA    -->

        <!-- <div class="form-group text-center">
            <label><h4><strong>Mobiliario</strong></h4></label>
        </div> -->

        <div class="row my-4">
          <div class="col-md-12 mx-auto">

            <table id="tbl_VentaMobiliario" class="table table-striped table-bordered dt-responsive nowrap table-hover table-condensed" cellspacing="0" style="background:white!important" width="100%">
              <thead class="text-center bg-primary">
                <tr>
                  <th width="3%" type="hidden">Id</th>
                  <th width="3%" type="hidden">IdProducto</th>
                  <th>Producto</th>
                  <th width="7%">Cantidad</th>
                  <th width="7%">P.Unitario</th>
                  <th width="10%">Importe</th>
                  <th class="text-center" width="7%">Acciones</th>
                  <th class="text-center" width="7%">Reporte PDF</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>

		</div>
	</div>




  <div class="panel panel-default">
<div class="panel-heading text-center">	<h4><strong>Reporte general de platillos</strong></h4></div>

    <div class="panel-body">

<!--    MOBILIARIO ELEGIDO EN VENTA    -->

        <!-- <div class="form-group text-center">
            <label><h4><strong>Platillos</strong></h4></label>
        </div> -->

        <div class="row my-4">
          <div class="col-md-12 mx-auto">

            <table id="tbl_VentaPlatillos" class="table table-striped table-bordered dt-responsive nowrap table-hover table-condensed" cellspacing="0" style="background:white!important" width="100%">
              <thead class="text-center bg-primary">
                <tr>
                  <th width="3%" type="hidden">Id</th>
                  <th width="3%" type="hidden">IdProducto</th>
                  <th>Producto</th>
                  <th width="7%">Cantidad</th>
                  <th width="7%">P.Unitario</th>
                  <th width="10%">Importe</th>
                  <th class="text-center" width="7%">Acciones</th>
                  <th class="text-center" width="7%">Reporte PDF</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>

		</div>
	</div>



          <!-- <div class="myForm" id="myForm"> -->


  <!--   RE´PRTE PDF PARA GENERAR VENTA
   <div class="row">
    <div class="form-group col-md-12">
      <button type="button" class="btn btn-primary" onclick="btnGenerarReporteEvento()">Generar Reporte de cleinte</button>
    </div>
  </div> -->



  <!-- </div> -->

        </article>




    <article id="tab6">

    <div class="panel panel-default">
        <div class="panel-heading text-center">	<h4><strong>Realizar cobro total $</strong></h4></div>
          <div class="panel-body">

            <div class="myForm" id="myForm" >

              <form class="" id="addPagoCobroForm">
<div class="msjVentaEnCaptura" id="msjVentaEnCaptura">
                <div class="row">
                  <div class="form-group col-md-3">
                  <h3> <strong>  <label>Total a pagar: $</label>  </strong> </h3>
                <!-- <h3> <strong>   <label id="cobroTotal">  </label>  </strong> </h3> -->
                  </div>
                  <div class="form-group col-md-6">
                      <h3> <strong>   <label id="cobroTotal"></label>  </strong> </h3>
                  </div>

                </div>

                <div class="row">
                  <div class="form-group col-md-3">
                    <h3> <strong>  <label>Pago: $</label>  </strong> </h3>
                  </div>
                  <div class="form-group col-md-2"> <br>
                    <input type="text" id="pagoNumero" class="form-control text-center" placeholder="00.00" >
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-3">
                    <h3> <strong>  <label>Cambio: $</label>  </strong> </h3>
                  </div>
                  <div class="form-group col-md-6"> <br>
                    <input type="text" id="cambioNumero" class="form-control text-center" readonly>
                  </div>
                </div>

                <!-- <div class="row">
                  <div class="form-group text-center">
                    <button type="button" class="btn btn-danger" id="btnAddPagoCobroTotal">Cobrar Venta</button>
                  </div>
                </div> -->

                <div class="row">

                  <div class="text-center">
                      <button type="button" class="btn btn-danger btn-float" id="addPago" onclick="btnAddPagoCobroTotal()">
                         <i class="fas fa-file-invoice-dollar fa-2x"></i>&nbsp;&nbsp;<label><h4>Cobrar Venta</h4></label>&nbsp;&nbsp;
                      </button>

                      <button type="button" class="btn btn-danger btn-float" id="addCredito" onclick="btnAddPagoCredito()">
                         <i class="fas fa-file-invoice-dollar fa-2x"></i>&nbsp;&nbsp;<label><h4>Venta a credito</h4></label>&nbsp;&nbsp;
                      </button>
                  </div>


                </div>
                </div>

              </form>
            </div>


            <!--  -->

            <br><br>

<div class="msjVentaCredito" id="msjVentaCredito">
   <div class="text-center">
<h4><strong>VENTA A CREDITO</strong></h4>
</div>

<div class="row my-4">
  <div class="col-md-12 mx-auto">

    <table id="tbl_VentaCredito" class="table table-striped table-bordered dt-responsive nowrap table-hover table-condensed" cellspacing="0" style="background:white!important" width="100%">
      <thead class="text-center bg-primary">
        <tr>
          <th width="10%">Venta</th>
          <th width="10%">Cliente</th>
          <th width="10%">Subtotal</th>
          <!-- <th width="7%">Cantidad</th> -->
          <th width="10%">Total</th>
          <th width="10%">Pago/abono</th>
          <th width="10%">Restante</th>
          <th width="10%">Fecha</th>
          <!-- <th class="text-center" width="7%">Acciones</th>
          <th class="text-center" width="7%">Reporte PDF</th> -->
        </tr>
      </thead>
    </table>

  </div>
</div>

  </div>

<br><br>



  <div class="msjVentaCredito" id="msjVentaRealizada">
    <div class="text-center">
  <h4><strong>venta normal bb => Realizada</strong></h4>
  </div>
    </div>

            <!--  -->

        </div>
    </div>

    </article>

    </div>
  </div>

</div>







<!--     CANTIDAD D EPIEZAS ELEGIDAS PARA EL MOBILIARIO     -->
<div class="modal fade" id="modalAddCantidadMob" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-primary text-center">
            <strong class="modal-title" id="exampleModalLabel">Agregar Cantidad (piezas)</strong>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <input type="hidden" id="id_modalMobiliario" name="id_modalMobiliario">
            <input type="hidden" id="precio_modalMobiliario" name="precio_modalMobiliario">
            <input type="hidden" id="userAltaMob" name="userAltaMob" value="<?php echo $username;?>" >

        <form id="addCantidadMobi">
              <div class="form-group">
                  <label for="">Cantidad del mobiliario: *</label>
                <input type="text" class="form-control" id="piezasMob" placeholder="Número de piezas">
              </div>

              <!-- <div class="form-group">
                <label for="">Clave</label>
                <input type="text" class="form-control" id="clave_licenciatura" placeholder="Rvoe">
              </div> -->

        </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <!-- Insert Button -->
            <button type="button" class="btn btn-primary" id="btnAddPiezasMobiliario">Agregar</button>
          </div>
        </div>
      </div>
    </div>




    <!--     CANTIDAD D PERSONAS ELEGIDAS PARA EL PLATILLO     -->
    <div class="modal fade" id="modalAddCantidadPlatillos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-primary text-center">
                <strong class="modal-title" id="exampleModalLabel">Agregar Cantidad de Personas</strong>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">

              <input type="hidden" id="id_modalPlatillo" name="id_modalPlatillo">
              <input type="hidden" id="precio_modalPlatillo" name="precio_modalPlatillo">
              <input type="hidden" id="userAltaMob" name="userAltaMob" value="<?php echo $username;?>" >

            <form id="addCantidadPersonasPlatillos">

                  <div class="form-group">
                      <label for="">Cantidad de personas: *</label>
                    <input type="text" class="form-control" id="cantidadPersonasPlatillo" placeholder="Número de personas">
                  </div>

            </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <!-- Insert Button -->
                <button type="button" class="btn btn-primary" id="btnAddCantidadPersonaPlatillo">Agregar</button>
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
