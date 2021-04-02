$(document).ready(function () {
    llenartablabanquetes(); // SEINICIALIZA LA FUNCTIO DE LA CARGA DEL LISTADO DE LA TABLA
    //date_picker_carrera();
});

/* ---------------------------- Add periodo Modal --------------------------- */
$("#modal_add_banquete").on("hide.bs.modal", function (e) {
    // do something...
    $("#addbanquete")[0].reset();
});
/* ---------------------------- Edit periodo Modal --------------------------- */
$("#modaleditbanquete").on("hide.bs.modal", function (e) {
    // do something...
    $("#formeditarbanquete")[0].reset();
});

/* -------------------------------------------------------------------------- */
/*                      Llenar tabla Mobiliario                               */
/* -------------------------------------------------------------------------- */
function llenartablabanquetes() {
    $.ajax({
        type: "get",
        url: base_url + 'Administrativos/Banquetes/listarBanquetes',
        dataType: "json",
        success: function (response) {
            var i = "1";
            $("#tbl_banquetes").DataTable({
                data: response,
                responsive: true,
                columns: [
                    {
                        data: "id_banquete",
                        "visible": false,
                        "searchable": false
                    },
                    {
                        data: "nombre",
                    },
                    {
                        data: "precio",
                    },
                    {
                        data: "descripcion",
                    },


                    {
                        data: 'nombre_foto',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                          //  var imagenPlatillo = `<img src="ControlPlatillos/Foto/${row.id_platillo}" width="150" height="150"/>`;
                          //return imagenPlatillo;
                          var foto = `${row.nombre_foto}`;
                                        var imagenbanquete="";
                                        if(foto!="null"&&foto!="undefined"&&foto!=""){
                                          var imagenbanquete = `<img src="Banquetes/Foto/${row.id_banquete}" width="150" height="150"/>`;
                                             
                                        }
                                        else{
                                            imagenbanquete="Sin imagen";
                                        }
                                         
                                      return imagenbanquete;
                        },
                      },


                    {
                        orderable: false,
                        searchable: false,
                        data: function (row, type, set) {
                            return `

                        <a href="#" id="edit_banquete" class="btn btn-success btn-remove" value="${row.id_banquete}"><i class="far fa-edit"></i></a>
                        <a href="#" id="del_banquete" class="btn btn-danger btn-remove" value="${row.id_banquete}"><i class="fas fa-trash-alt"></i></a>
                                 `;
                        },
                    },
                ],

                "language": language_espaniol,
            });
        },
    });
} // fin de llenar tabla Banquetes

/* -------------------------------------------------------------------------- */
/*                           Agregar Banquete                             */
/* -------------------------------------------------------------------------- */
$(document).on("click", "#btnaddbanquete", function (e) {
    e.preventDefault();
    var nombre = $("#nombre_banquete").val();
    var precio = parseFloat($("#precio_banquete").val());  // Se convierte el texto a un float
    var descripcion = $("#descripcion_banquete").val();
    var imagen = $("#imagen_banquete")[0].files[0];

    if ($("#imagen_banquete").val() == '') {
      // En caso de no agregar imagen
      imagen = '';
    }else {
      // Validacion de la extencion del archivo
      var extencion = $('#imagen_banquete').val().split('.').pop().toLowerCase();

      if(jQuery.inArray(extencion, ['gif','png','jpg','jpeg']) == -1){
        //
        alert("Archivo no valido");
        $('#imagen_banquete').val(''); // Limpia el input file
        return false;
      }
    }

    if (nombre == "" || precio == "" || descripcion == "") {
        alert("¡Complete todos los campos!");
    } else {
        var fd = new FormData();
        fd.append("nombre", nombre);
        fd.append("precio", precio);
        fd.append("descripcion", descripcion);
        fd.append("imagen", imagen);
        $.ajax({
            type: "post",
            url: base_url + 'Administrativos/Banquetes/agregarBanquete',
            data: fd,
            processData: false,
            contentType: false,
            dataType: "json",
            enctype: 'multipart/form-data',
            success: function (response) {
                if (response.res == "success") {
                    toastr["success"](response.message);
                    $("#modal_add_banquete").modal("hide");
                    $("#addbanquete")[0].reset();
                    $("#tbl_banquetes").DataTable().destroy();
                    llenartablabanquetes();
                } else {
                    toastr["error"](response.message);
                }
            },
        });
    }
});


/* -------------------------------------------------------------------------- */
/*                             Eliminar registro                              */
/* -------------------------------------------------------------------------- */
$(document).on("click", "#del_banquete", function (e) {
    e.preventDefault();
    var del_id = $(this).attr("value");
    Swal.fire({
        title: "¿Estás seguro de Borrar?",
        text: "¡Esta acción es irreversile!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Si, bórralo!",
        cancelButtonText: "¡No, cancelar!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: base_url + 'Administrativos/Banquetes/eliminarBanquete',
                data: {
                    del_id: del_id,
                },
                dataType: "json",
                success: function (data) {
                    if (data.responce == "success") {
                        Swal.fire(
                            '¡Eliminado!',
                            'El periodo fue eliminado',
                            'success'
                        );
                        $("#tbl_banquetes").DataTable().destroy();
                        llenartablabanquetes();
                    }
                },
            });
        }
    });
});
/* -------------------------------------------------------------------------- */
/*                 Llenar formulario Actualizar                               */
/* -------------------------------------------------------------------------- */
$(document).on("click", "#edit_banquete", function (e) {
    e.preventDefault();
    var edit_id = $(this).attr("value");
    $.ajax({
        type: "post",
        url: base_url + 'Administrativos/Banquetes/editarBanquete',
        data: {
            edit_id: edit_id,
        },
        dataType: "json",
        success: function (data) {
            console.log(data); //ver la respuesta del json, los valores que contiene
            $('#modaleditbanquete').modal('show');

            // Llena los inputs del formulario con los datos a modificar
            $('#id_banquete_update').val(data.post.id_banquete);
            $('#nombre_banquete_new').val(data.post.nombre);
            $('#precio_banquete_new').val(data.post.precio);
            $('#descripcion_banquete_new').val(data.post.descripcion);
          //  $('#uploaded_image_ban').val(data.post.imagen);
          $('#MostrarImagenActualBanquetes').html(`
          <img class="rounded img-thumbnail" src="Banquetes/Foto/${data.post.id_banquete}" width="250" height="250">
        `);
        },
    });
});


/* -------------------------------------------------------------------------- */
/*                        Actualizar Mobiliario                               */
/* -------------------------------------------------------------------------- */
$(document).on("click", "#update_banquete", function (e) {
    e.preventDefault();
//debugger;
    var id_banquete = $("#id_banquete_update").val();
    var nombre = $("#nombre_banquete_new").val();
    var precio = parseFloat($("#precio_banquete_new").val());
    var descripcion = $("#descripcion_banquete_new").val();
    var imgact=$("#uploaded_image_ban").val();

    var imagen = $("#imagen_banquete_new")[0].files[0];

    if ($("#imagen_banquete_new").val() == '') {
      // En caso de no agregar imagen
      imagen = imgact;
    }else {
      // Validacion de la extencion del archivo
      var extencion = $('#imagen_banquete_new').val().split('.').pop().toLowerCase();

      if(jQuery.inArray(extencion, ['gif','png','jpg','jpeg']) == -1){
        //
        alert("Archivo no valido");
        $('#imagen_banquete_new').val(''); // Limpia el input file
        return false;
      }
    }

    if (nombre == "" || precio == ""  || descripcion == "") {
        alert("¡Complete todos los campos!");
    } else {
      var fd = new FormData();
      fd.append("id_banquete", id_banquete);
      fd.append("nombre", nombre);
      fd.append("precio", precio);
      fd.append("descripcion", descripcion);
      fd.append("imagen", imagen);

      $.ajax({
          type: "post",
          url: base_url + 'Administrativos/Banquetes/updateBanquetes',
          data:fd,
          processData: false,
          contentType: false,
          dataType: "json",
          enctype: 'multipart/form-data',
          success: function (data) {
            //console.log(res); //ver la respuesta del json, los valores que contiene
              if (data.responce == "success") {
                toastr["success"](data.message);
                $("#modaleditbanquete").modal("hide");
                $("#formeditarbanquete")[0].reset();
                $("#tbl_banquetes").DataTable().destroy();
                llenartablabanquetes();
              } else {
                  toastr["error"](data.message);
              }
          },
      });


    }
});


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
