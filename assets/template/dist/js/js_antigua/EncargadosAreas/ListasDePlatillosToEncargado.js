$(document).ready(function () {
    llenarTablaPlatillosEntregaVenta(); // SEINICIALIZA LA FUNCTIO DE LA CARGA DEL LISTADO DE LA TABLA

    $('.clockpicker').clockpicker();

});



/* -----------------------   AGREGAR HORA DE SALIDA DEL MOBILIARIO  -------------------------- */

  $(document).on("click", "#btnAddHoraSalida", function(e) {
      e.preventDefault();

    var datos = {
        hora_salida : $("#hora_rutaSalida").val(),
        id_venta : $("#id_x").val(),
      }

      if (datos.hora_salida == "") {
          alert("Debe capturar un horario...!");
      } else {
          $.ajax({
              type: "post",
              url: base_url + 'RutasMobiliario/Rutas/insertHoraSalida',
              data: (datos),
              dataType: "json",
              success: function(data) {
                  if (data.responce == "success") {
                      toastr["success"](data.message);
                      $("#addHoraSalida")[0].reset();
                      $('#modal_Add_HoraSalida').modal('hide');
                        $("#tbl_platillosParaEntrega").DataTable().destroy();
                    		llenarTablaPlatillosEntregaVenta();
                  } else {
                      toastr["error"](data.message);
                  }
              },
          });
      }
  });



/* -----------------------   AGREGAR HORA DE Entrega DEL MOBILIARIO  -------------------------- */

    $(document).on("click", "#btnAddHoraEntrega", function(e) {
        e.preventDefault();

      var datos = {
            hora_entrega : $("#hora_rutaEntrega").val(),
            id_venta : $("#id_horaEntrega").val(),
        }

        if (datos.hora_entrega == "") {
            alert("Debe capturar un horario...!");
        } else {
            $.ajax({
                type: "post",
                url: base_url + 'RutasMobiliario/Rutas/insertHoraEntrega',
                data: (datos),
                dataType: "json",
                success: function(data) {
                    if (data.responce == "success") {
                        toastr["success"](data.message);
                        $("#addHoraEntrega")[0].reset();
                        $('#modal_Add_HoraEntrega').modal('hide');
                          $("#tbl_platillosParaEntrega").DataTable().destroy();
                      		llenarTablaPlatillosEntregaVenta();
                    } else {
                        toastr["error"](data.message);
                    }
                },
            });
        }
    });







function llenarTablaPlatillosEntregaVenta() {

  $("#loading-screen").show();
   // $('.container').html('<div class="loading"><img src="'+ base_url + 'assets/template/dist/img/ajax-loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
    $.ajax({
        type: "get",
        url: base_url + 'Platillos/ListaPlatillosEncargado/listarPlatillosEncargadoParaEntrega',
        dataType: "json",
        success: function (response) {
            $("#tbl_platillosParaEntrega").DataTable({
                data: response,
                responsive: true,
                columns: [
                    {
                        data: "id",
                        "visible": false,
                        "searchable": false
                    },
                    {
                        data: "platillo",
                        "visible": false,
                        "searchable": false
                    },
                    {
                        data: "venta",
                        "visible": false,
                        "searchable": false
                    },
                    {
                        data: "name_cliente",
                    },
                    {
                        data: "start",
                    },
                    {
                        data: "direccion",
                    },
                    {
                        data: "nombre_platillo",
                    },
                    {
                        data: "costo",
                        "className": "text-center",
                    },
                    {
                        data: "cantidad_personas_platillo",
                        "className": "text-center",
                    },

                ],
                "language": language_espaniol,
            });
            $("#loading-screen").hide();
        },
    });
}



  function modalCapturaHoraSalida(venta){

    		$("#modal_Add_HoraSalida").modal("show");
        $("#addHoraSalida")[0].reset();
    		$("#id_x").val(venta);
            // $("#tbl_platillosParaEntrega").DataTable().destroy();
        		// llenarTablaPlatillosEntregaVenta();
      }



  function modalCapturaHoraEntrega(venta){

    		$("#modal_Add_HoraEntrega").modal("show");
        $("#addHoraEntrega")[0].reset();
    		$("#id_horaEntrega").val(venta);
            // $("#tbl_platillosParaEntrega").DataTable().destroy();
        		// llenarTablaPlatillosEntregaVenta();
      }



// ********************   variable PARA CAMBIAR DE IDIOMA AL ESPAÑOL EL DataTable  *************************
var language_espaniol = {
    "lengthMenu": "Mostrar _MENU_ registros por pagina",
    "zeroRecords": "No se encontraron resultados en su busqueda",
    "searchPlaceholder": "Buscar Registros",
    "info": "Total: _TOTAL_ registros",
    "infoEmpty": "No Existen Registros",
    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
    "search": "Buscar:",
    "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
    }, /* TODO ESTO ES PARA CAMBIAR DE IDIOMA */
}
