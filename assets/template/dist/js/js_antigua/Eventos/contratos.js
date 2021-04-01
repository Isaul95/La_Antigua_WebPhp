$(document).ready(function () {

  VisualizarSalones();
  VisualizarMobiliario();
  VisualizarPlatillos();

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
          + "<div class=\"col-sm-4 col-md-4\">"
            + "<div class=\"thumbnail\" style=\"width: 100%;\">"
              + "<div class=\"caption\" style=\"width: 100%;\">"
                + "<h3>" + tablaSalones[salon].nombre_salon + "</h3>"
                + "<textarea class=\"text-justify\" style=\"border: none; resize: none; width: 100%;\" rows=\"3\" readonly>"
                + tablaSalones[salon].direccion + "</textarea>"
                + "<h4>$" + tablaSalones[salon].costo_alquiler + "</h4>"
                + "<h4>Para " + tablaSalones[salon].capacidad + " personas</h4>"
                + "<textarea class=\"text-justify\" style=\"border: none; resize: none; width: 100%;\" rows=\"3\" readonly>"
                + tablaSalones[salon].descripcion + "</textarea>"
                + "<textarea class=\"text-justify\" style=\"border: none; resize: none; width: 100%;\" rows=\"3\" readonly>"
                + tablaSalones[salon].horarios + "</textarea>"
              + "</div>"
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

            +  "<button onclick=addToVenta('"+ tablaMobiliario[mueble].clave +"') type='button' class=\"btn btn-danger\" style=\"width: 100%; height: 40px !important;\">"+'Añadir al carrito'+"</button>"

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
            + "</div>"
          + "</div>"
          //console.log(document.getElementById('Ima'+platillo).width);
      }
      $('#Platillos').html(textoHTML);
    },
  });
}





  function addToVenta (id_mobiliario){
      debugger;
            var datos = {
                clave : id_mobiliario,
            }
alert("Id =>" + datos.clave);
            // const swalWithBootstrapButtons = Swal.mixin({
            //   customClass: {
            //     confirmButton: 'btn btn-success',
            //     cancelButton: 'btn btn-danger mr-2'
            //   },
            //   buttonsStyling: false
            // })
            //
            // swalWithBootstrapButtons.fire({
            //   title: 'Esta seguro de borrar el baucher del alumno...?',
            //   text: "!Esta acción es irreversile!",
            //   icon: 'warning',
            //   showCancelButton: true,
            //   confirmButtonText: 'Si, bórralo!',
            //   cancelButtonText: 'No, cancelar!',
            //   reverseButtons: true
            // }).then((result) => {
            //   if (result.value) {
            //
            //       $.ajax({
            //         // url: base_url+'mantenimiento/RegistroPagos/eliminar',
            //            url: base_url+'Finanzas/HabilitarAlumnos/eliminarAllRegistro',
            //         type: "post",
            //         dataType: "json",
            //         data: {
            //           numero_control: numero_control,
            //           id_alta_baucher_banco : id_alta_baucher_banco
            //         },
            //         success: function(data){
            //           if (data.responce == "success") {
            //               swalWithBootstrapButtons.fire(
            //                 '¡Eliminado!',
            //                 'Su archivo ha sido eliminado.!',
            //                 'success'
            //               );
            //               $('#tbl_listaHistPagosParcialidad').DataTable().destroy();
            //               litaHistorialParcialidadXAlumnos();
            //           }else{
            //               swalWithBootstrapButtons.fire(
            //                 '¡Eliminado',
            //                 'El registro no se elimino...!',
            //                 'error'
            //               );
            //           }
            //         }
            //       });
            //
            //   } else if (
            //     /* Read more about handling dismissals below */
            //     result.dismiss === Swal.DismissReason.cancel
            //   ) {
            //     swalWithBootstrapButtons.fire(
            //       'Cancelada',
            //       'El registro no se elimino...!',
            //       'error'
            //     )
            //   }
            // });

        }
