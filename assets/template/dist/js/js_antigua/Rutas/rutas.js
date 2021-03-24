$(document).ready(function () {
    llenarTablaPlatillos(); // SEINICIALIZA LA FUNCTIO DE LA CARGA DEL LISTADO DE LA TABLA

    $('.clockpicker').clockpicker();

});



/* -----------------------   AGREGAR HORA DE SALIDA DEL MOBILIARIO  -------------------------- */

  $(document).on("click", "#btnAddHoraSalida", function(e) {
      e.preventDefault();

    var datos = {
        hora_salida : $("#hora_rutaSalida").val(),
        id_platillo : $("#id_x").val(),
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
                        $("#tbl_Platillos").DataTable().destroy();
                    		llenarTablaPlatillos();
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
            id_platillo : $("#id_x").val(),
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
                          $("#tbl_Platillos").DataTable().destroy();
                      		llenarTablaPlatillos();
                    } else {
                        toastr["error"](data.message);
                    }
                },
            });
        }
    });







function llenarTablaPlatillos() {

  $("#loading-screen").show();
   // $('.container').html('<div class="loading"><img src="'+ base_url + 'assets/template/dist/img/ajax-loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
    $.ajax({
        type: "get",
        url: base_url + 'RutasMobiliario/Rutas/verPlatillos',
        dataType: "json",
        success: function (response) {
            $("#tbl_Platillos").DataTable({
                data: response,
                responsive: true,
                columns: [
                    {
                        data: "id_platillo",
                        "visible": false,
                        "searchable": false
                    },
                    {
                        data: "nombre_platillo",
                    },
                    {
                        data: "precio",
                    },
                    {
                        data: "no_personas",
                    },
                    // {
                    //     orderable: false,
                    //     searchable: false,
                    //     data: function (row, type, set) {
                    //         return `
                    //     <a title="Capturar hora de entrega" onclick=modalCapturaHoraEntrega('${row.id_platillo}') class="btn btn-primary btn-remove"><i class="far fa-clock"></i></a>`;
                    //     },
                    // },
                    {
                        // data: "descripcion",
                        orderable: false,
                        searchable: false,
                        "className": "text-center",
                        // data: function (row, type, set) {
                        //     return `<a title="Capturar hora de salida" onclick=modalCapturaHoraSalida('${row.id_platillo}') class="btn btn-success btn-remove" ><i class="far fa-clock"></i></a>`;
                        // },
                        "render" : function(data, type, row) {
                            var hayNombres = `${row.nombre_platillo}`;
                            var hora_salida = `${row.hora_salida}`;
                                if( hayNombres != "null" && hora_salida == "null" ){
                                     var a = `<a title="Capturar hora de salida" onclick=modalCapturaHoraSalida('${row.id_platillo}') class="btn btn-success btn-remove" ><i class="far fa-clock"></i></a>`;
                                } else if (hora_salida == "null" && hayNombres == "null") {
                                       var a = '-------';
                                }else {
                                var a = '<div class="p-3 mb-2 bg-green text-white">'+hora_salida+'</div>';
                              }
                                return a;
                          },
                    },
                    {
                        orderable: false,
                        searchable: false,
                        "className": "text-center",
                        "render" : function(data, type, row) {
                          var hayHoraSalida = `${row.hora_salida}`;
                          var hora_entrega = `${row.hora_entrega}`;
                              if( hayHoraSalida != "null"  && hora_entrega == "null"){
                                  var a = `<a title="Capturar hora de entrega" onclick=modalCapturaHoraEntrega('${row.id_platillo}') class="btn btn-primary btn-remove"><i class="far fa-clock"></i></a>`;
                                } else if (hora_entrega != "null" ) {
                                       var a = '<div class="p-3 mb-2 bg-green text-white">'+hora_entrega+'</div>';
                                }else {
                                  var a = 'No hay horario de salida';
                                }
                                  return a;
                        },
                    },
                ],
                "language": language_espaniol,
            });
            $("#loading-screen").hide();
        },
    });
}



  function modalCapturaHoraSalida(id_platillo){

    		$("#modal_Add_HoraSalida").modal("show");
    		$("#id_x").val(id_platillo);
            // $("#tbl_Platillos").DataTable().destroy();
        		// llenarTablaPlatillos();
      }



  function modalCapturaHoraEntrega(id_platillo){
    		// debugger;

    		$("#modal_Add_HoraEntrega").modal("show");
    		$("#id_x").val(id_platillo);
            // $("#tbl_Platillos").DataTable().destroy();
        		// llenarTablaPlatillos();
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
