$(document).ready(function () {

  VisualizarSalones();

  VisualizarMobiliario();
  VisualizarPlatillos();

  verCarrusel();

   $('ul.tabs li a:first').addClass('active');
	$('.secciones article').hide();
	$('.secciones article:first').show();

	$('ul.tabs li a').click(function(){
		$('ul.tabs li a').removeClass('active');
		$(this).addClass('active');
		$('.secciones article').hide();

		var activeTab = $(this).attr('href');
		$(activeTab).show();
		return false;
	});


});   // FIN DEL DOCUMENT READy


function VisualizarSalones() {
  $.ajax({
    type: 'get',
    url: base_url + 'Eventos/Contratos/MostrarSalones',
    dataType: 'json',
    success: function(tablaSalones) {
      var textoHTML='';
      for (var salon = 0; salon < tablaSalones.length; salon++) {
        textoHTML+= ""
//    title="+"Ver&nbsp;Galería"+" onclick=verGaleriaSalon('"+ tablaSalones[salon].id_salon +"')
          + "<div class=\"col-sm-4 col-md-4\">"
            + "<div class=\"thumbnail\" style=\"width: 100%;\">"
  + "<img title="+"Ver&nbsp;Galería"+" onclick=verGaleriaSalon('"+ tablaSalones[salon].id_salon +"') src=\"Contratos/ImagenSalon/" + tablaSalones[salon].id_salon + "\""
  + "class=\"img-fluid card-img-top\" style=\"width: 100%; height: 200px !important;\">"
              + "<div class=\"caption\" style=\"width: 100%;\">"
                + "<h3>" + tablaSalones[salon].nombre_salon + "</h3>"
                + "<textarea class=\"text-justify\" style=\"border: none; resize: none; width: 100%;\" rows=\"2\" readonly>"
                + tablaSalones[salon].direccion + "</textarea>"
                + "<h4> <center> <strong> Precio: $" + tablaSalones[salon].costo_alquiler + "</strong> <center> </h4>"
                + "<h4> Capacidad para: " + tablaSalones[salon].capacidad + " personas</h4>"
                + "<textarea class=\"text-justify\" style=\"border: none; resize: none; width: 100%;\" rows=\"3\" readonly>"
                + tablaSalones[salon].descripcion + "</textarea>"
                + "<textarea class=\"text-justify\" style=\"border: none; resize: none; width: 100%;\" rows=\"1\" readonly>"
                + tablaSalones[salon].horarios + "</textarea>"
              + "</div>"

              +  "<button onclick=addSalonVenta('"+ tablaSalones[salon].id_salon +"','"+ tablaSalones[salon].costo_alquiler +"') type='button' class=\"btn btn-danger\" style=\"width: 100%; height: 40px !important;\">"+'Añadir '+"</button>"

            + "</div>"
          + "</div>"
      }
      $('#Salones').html(textoHTML);
    },
  });
}


function VisualizarMobiliario() {
  $.ajax({
    type: 'get',
    url: base_url + 'Eventos/Contratos/MostrarMobiliario',
    dataType: 'json',
    success: function(tablaMobiliario) {
      var textoHTML='';
      for (var mueble = 0; mueble < tablaMobiliario.length; mueble++) {
        textoHTML+= ""
          + "<div class=\"col-sm-4 col-md-4\">"
            + "<div class=\"thumbnail\" style=\"width: 100%;\">"
              + "<img src=\"Contratos/Imagen/" + tablaMobiliario[mueble].clave + "\""
              + "class=\"img-fluid card-img-top\" style=\"width: 100%; height: 200px !important;\">"
              + "<div class=\"caption\" style=\"width: 100%;\">"
                + "<h3>" + tablaMobiliario[mueble].nombre + "</h3>"
                + "<h4>$" + tablaMobiliario[mueble].precio + "</h4>"
                + "<h4>Hay " + tablaMobiliario[mueble].stock + " piezas disponibles</h4>"
                + "<textarea class=\"text-justify\" style=\"border: none; resize: none; width: 100%;\" rows=\"3\" readonly>"
                + tablaMobiliario[mueble].descripcion + "</textarea>"
              + "</div>"

            +  "<button onclick=addMobiliarioVenta('"+ tablaMobiliario[mueble].clave +"','"+ tablaMobiliario[mueble].precio +"') type='button' class=\"btn btn-danger\" style=\"width: 100%; height: 40px !important;\">"+'Añadir '+"</button>"

            + "</div>"
          + "</div>"
      }
      $('#Mobiliario').html(textoHTML);
    },
  });
}


function VisualizarPlatillos() {
  $.ajax({
    type: 'get',
    url: base_url + 'Eventos/Contratos/MostrarPlatillos',
    dataType: 'json',
    success: function(tablaPlatillos) {
      var textoHTML='';
      for (var platillo = 0; platillo < tablaPlatillos.length; platillo++) {
        textoHTML+= ""
          + "<div class=\"col-sm-4 col-md-4\">"
            + "<div class=\"thumbnail\" style=\"width: 100%;\">"
              + "<img src=\"Contratos/Foto/" + tablaPlatillos[platillo].id_platillo + "\""
              + "class=\"img-fluid card-img-top\" style=\"width: 100%; height: 200px !important;\">"
              + "<div class=\"caption\" style=\"width: 100%;\">"
                + "<h3>" + tablaPlatillos[platillo].nombre_platillo + "</h3>"
                + "<h4>$" + tablaPlatillos[platillo].costo + "</h4>"
                + "<textarea class=\"text-justify\" style=\"border: none; resize: none; width: 100%;\" rows=\"3\" readonly>"
                + tablaPlatillos[platillo].descripcion + "</textarea>"
              + "</div>"

      +  "<button onclick=addBanqueteVenta('"+ tablaPlatillos[platillo].id_platillo +"','"+ tablaPlatillos[platillo].costo +"') type='button' class=\"btn btn-danger\" style=\"width: 100%; height: 40px !important;\">"+'Añadir '+"</button>"

            + "</div>"
          + "</div>"
          //console.log(document.getElementById('Ima'+platillo).width);
      }
      $('#Platillos').html(textoHTML);
    },
  });
}





  function addMobiliarioVenta (id_mobiliario, precioMob){
      // debugger;

          $("#id_modalMobiliario").val(id_mobiliario);
          $("#precio_modalMobiliario").val(precioMob);

        $("#modalAddCantidadMob").modal("show");
    //  alert("Id Mobiliario =>" + datos.clave);


      }





  function addSalonVenta (id_salon, costo_alquiler){
    debugger;

            var datos = {
                salon : id_salon,
                cantidad_salon : costo_alquiler,
                // venta : 1,
                venta : $("#id_ventaDesdeVenta").val(),
            }

            $.ajax({
            type: "post",
            url: base_url + 'Eventos/Contratos/insertSalon',
            data: (datos),
            dataType: "json",
            success: function(data) {
                if (data.responce == "success") {
                    toastr["success"](data.message);
                    // VisualizarSalones();
                    $("#tbl_VentaSalon").DataTable().destroy();
                    llenartablaSalonEnVenta();         // Esta function esta en Clientes.js
                    verSiYaExisteSalonEnVenta();
                } else {
                    toastr["error"](data.message);
                }
            },
        });


    }




  function verGaleriaSalon (id_salon){
      $("#id_salonXGaleria").val(id_salon);
    $("#modalGaleriaFotosxSalon").modal("show");
    }



  function addBanqueteVenta (id_platillo, precioPlatillo){

          $("#id_modalPlatillo").val(id_platillo);
          $("#precio_modalPlatillo").val(precioPlatillo);
          $("#modalAddCantidadPlatillos").modal("show");
            // alert("Id Banquete =>" + datos.id_platillo);
    }







    //
    // function verCarrusel() {
    //   $.ajax({
    //     type: 'get',
    //     url: base_url + 'Eventos/Contratos/MostrarSalones',
    //     dataType: 'json',
    //     success: function(tablaSalones) {
    //       var textoHTML='';
    //       for (var salon = 0; salon < tablaSalones.length; salon++) {
    //         textoHTML+= ""
    //             + "<div class=\"carousel-inner\" >"
    //               + "<img src=\"Contratos/ImagenSalon/" + tablaSalones[salon].id_salon + "\""
    //               + "class=\"img-fluid card-img-top\" style=\"width: 100%; height: 100% !important;\">"
    //               + "<div class=\"caption\" style=\"width: 100%;\">"
    //                 // + "<h3>" + tablaSalones[salon].nombre_salon + "</h3>"
    //               // + "</div>"
    //
    //             + "</div>"
    //           + "</div>"
    //
    //           + "<div class=\"left carousel-control\" href=\"#myCarousel\" data-slide=\"prev\">"
    //           + "<div class=\"right carousel-control\" href=\"#myCarousel\" data-slide=\"next\">"
    //
    //       }
    //       $('#carruselSalones').html(textoHTML);
    //     },
    //   });
    // }






//
//         function verCarrusel() {
//           $.ajax({
//             type: 'get',
//             url: base_url + 'Eventos/Contratos/MostrarSalones',
//             dataType: 'json',
//             success: function(tablaSalones) {
//               var textoHTML='';
//               var activeClass = "";
//               var setActive = 0;
//
//               for (var salon = 0; salon < tablaSalones.length; salon++) {
//
//                 if(!setActive) {
//                     setActive = 1;
//                     activeClass = 'active';
//                 }
//
//                 textoHTML+= ""
// + "<div id=\"myCarousel\" class=\"carousel slide\" data-ride=\"carousel\" >"
//                 + "<div class=\"item" + activeClass + "\" >"
//                 + "<div class=\"col-xs-12\">"
//                 // + "<a href=\"+ tablaSalones[salon].id_salon + \">"
//               + "<img src=\"Contratos/ImagenSalon/" + tablaSalones[salon].id_salon + "\""
//               + "class=\"img-fluid card-img-top\" style=\"width: 100%; height: 100% !important;\">"
//               + "</a>"
//                         // + "<h3>" + tablaSalones[salon].nombre_salon + "</h3>"
//                       // + "</div>"
//
//                     + "</div>"
//                   + "</div>"
//
//                   // + "<a class=\"sr-only\" class=\"glyphicon glyphicon-chevron-left\" class=\"left carousel-control\" href=\"#myCarousel\" data-slide=\"prev\"></a>"
//                   // + "<a class=\"sr-only\" class=\"glyphicon glyphicon-chevron-right\" class=\"right carousel-control\" href=\"#myCarousel\" data-slide=\"next\"></a>"
// + "</div>"
//               }
//               $('#carruselSalones').html(textoHTML);
//             },
//           });
//         }









    function verCarrusel() {
      $.ajax({
        type: 'get',
        url: base_url + 'Eventos/Contratos/MostrarSalones',
        dataType: 'json',
        success: function(tablaSalones) {
          // debugger;
          var textoHTML='';
          var setActive = 0;

          for (var salon = 0; salon < tablaSalones.length; salon++) {
            var activeClass = "";

                if(!setActive) {
                    setActive = 1;
                    activeClass = 'active';
                }
// + "<h3>" + tablaMobiliario[mueble].nombre + "</h3>"
            textoHTML+= ""
                + "<div class=\"item" + activeClass + "\" >"
                    // + "<div class=\"col-xs-12\">"
                    // + "<a href=\""+ tablaSalones[salon].id_salon +"\">"
                  + "<img src=\"Contratos/ImagenSalon/" + tablaSalones[salon].id_salon + "\" "
                  + "class=\"img-fluid card-img-top\" style=\"width: 100%;  !important;\">"
                  + "</a>"
                    // + "<h3>" + tablaSalones[salon].nombre_salon + "</h3>"
                // + "</div>"

              // +  "<button onclick=addBanqueteVenta('"+ tablaPlatillos[platillo].id_platillo +"') type='button' class=\"btn btn-danger\" style=\"width: 100%; height: 40px !important;\">"+'Añadir '+"</button>"

                // + "</div>"
              + "</div>"

              // + "<div class=\"left carousel-control\" href=\"#myCarousel\" data-slide=\"prev\">"
              // + "<div class=\"right carousel-control\" href=\"#myCarousel\" data-slide=\"next\">"
          }
          $('#carruselSalones').html(textoHTML);
        },
      });
    }









/* -----------------------   AGREGAR HORA DE SALIDA DEL MOBILIARIO  -------------------------- */

  $(document).on("click", "#btnAddPiezasMobiliario", function(e) {
      e.preventDefault();
debugger;
      var piezasIngresadasMob = $("#piezasMob").val();
      var precioMob = $("#precio_modalMobiliario").val();

      precioXpiezaMob = (precioMob * piezasIngresadasMob);

    var datos = {
        cantidad_piezas_mobiliario : $("#piezasMob").val(),
        mobiliario : $("#id_modalMobiliario").val(),
        precio_total_mob : precioXpiezaMob,
        venta : $("#id_ventaDesdeVenta").val(),
      }

      if (datos.cantidad_mobiliario == "") {
          alert("Debe capturar la cantidad de piezas...!");
      } else {
          $.ajax({
              type: "post",
              url: base_url + 'Eventos/Contratos/insertPiezasAlquiladosMobil',
              data: (datos),
              dataType: "json",
              success: function(data) {
                  if (data.responce == "success") {
                      toastr["success"](data.message);
                      $("#addCantidadMobi")[0].reset();
                      $('#modalAddCantidadMob').modal('hide');

                      $("#tbl_VentaMobiliario").DataTable().destroy();
                      llenartablaMobiliarioEnVenta();         // Esta function esta en Clientes.js
                      verSiYaExisteMobiliarioEnVenta();

                  } else {
                      toastr["error"](data.message);
                  }
              },
          });
      }
  });




  /* -----------------------   AGREGAR HORA DE SALIDA DEL MOBILIARIO  -------------------------- */

    $(document).on("click", "#btnAddCantidadPersonaPlatillo", function(e) {
        e.preventDefault();
        var piezasIngresadasPlat = $("#cantidadPersonasPlatillo").val();
        var precioPlat = $("#precio_modalPlatillo").val();

        precioXpiezaPlat = (precioPlat * piezasIngresadasPlat);


      var datos = {
          cantidad_personas_platillo : $("#cantidadPersonasPlatillo").val(),
          platillo : $("#id_modalPlatillo").val(),
          precio_total_platillo : precioXpiezaPlat,
          venta : $("#id_ventaDesdeVenta").val(),
        }

        if (datos.cantidad_platillo == "") {
            alert("Debe capturar la cantidad de piezas...!");
        } else {
            $.ajax({
                type: "post",
                url: base_url + 'Eventos/Contratos/insertCantidadPersonasPlatillos',
                data: (datos),
                dataType: "json",
                success: function(data) {
                    if (data.responce == "success") {
                        toastr["success"](data.message);
                        $("#addCantidadPersonasPlatillos")[0].reset();
                        $('#modalAddCantidadPlatillos').modal('hide');

                        $("#tbl_VentaPlatillos").DataTable().destroy();
                        llenarTablaPlatillosEnVenta();         // Esta function esta en Clientes.js
                        verSiYaExistePlatillosEnVenta();

                    } else {
                        toastr["error"](data.message);
                    }
                },
            });
        }
    });
