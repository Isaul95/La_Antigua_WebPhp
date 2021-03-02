$(document).ready(function () {
    llenartablamobiliario(); // SEINICIALIZA LA FUNCTIO DE LA CARGA DEL LISTADO DE LA TABLA
    //date_picker_carrera();
});

/* ---------------------------- Add periodo Modal --------------------------- */
$("#modal_add_mobiliario").on("hide.bs.modal", function (e) {
    // do something...
    $("#addmobiliario")[0].reset();
});
/* ---------------------------- Edit periodo Modal --------------------------- */
$("#modaleditmobiliario").on("hide.bs.modal", function (e) {
    // do something...
    $("#formeditarmobiliario")[0].reset();
});

/* -------------------------------------------------------------------------- */
/*                      Llenar tabla Mobiliario                               */
/* -------------------------------------------------------------------------- */
function llenartablamobiliario() {
    $.ajax({
        type: "get",
        url: base_url + 'Administrativos/Mobiliario/listarMobiliario',
        dataType: "json",
        success: function (response) {
            var i = "1";
            $("#tbl_mobilario").DataTable({
                data: response,
                responsive: true,
                columns: [
                    {
                        data: "clave",
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
                        data: "stock",
                    },
                    {
                        data: "estado",
                    },
                    {
                        data: "descripcion",
                    },


                    {
                    data: "imagen",
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row, meta) {
                        var imagen = `${row.imagen}`;
                          var a;
                            if(imagen != "null" && imagen != "undefined" && imagen != ""){
                                var a = `
                                <center><img src="../assets/imagenesMob/${row.imagen}" target="_blank" class="img-thumbnail" width="50" height="35" /></center>

                             `;
                            }
                            else{
                                a = 'Sin imagen';
                            }

                        return a;
                    }
                  },


                    {
                        orderable: false,
                        searchable: false,
                        data: function (row, type, set) {
                            return `

                        <a href="#" id="edit_mobiliario" class="btn btn-success btn-remove" value="${row.clave}"><i class="far fa-edit"></i></a>
                        <a href="#" id="del_mobiliario" class="btn btn-danger btn-remove" value="${row.clave}"><i class="fas fa-trash-alt"></i></a>
                                 `;
                        },
                    },
                ],

                "language": language_espaniol,
            });
        },
    });
} // fin de llenar tabla Mobiliario

/* -------------------------------------------------------------------------- */
/*                           Agregar Mobiliario                               */
/* -------------------------------------------------------------------------- */
$(document).on("click", "#btnaddmobiliario", function (e) {
    e.preventDefault();
    var nombre = $("#nombre").val();
    var precio = parseFloat($("#precio").val());  // Se convierte el texto a un float
    var stock = $("#stock").val();
    var descripcion = $("#descripcion").val();
    var imagen = $("#imagen")[0].files[0];

    if ($("#imagen").val() == '') {
      // En caso de no agregar imagen
      imagen = '';
    }else {
      // Validacion de la extencion del archivo
      var extencion = $('#imagen').val().split('.').pop().toLowerCase();

      if(jQuery.inArray(extencion, ['gif','png','jpg','jpeg']) == -1){
        //
        alert("Archivo no valido");
        $('#imagen').val(''); // Limpia el input file
        return false;
      }
    }

    if (nombre == "" || precio == "" || stock == "" || descripcion == "") {
        alert("¡Complete todos los campos!");
    } else {
        var fd = new FormData();
        fd.append("nombre", nombre);
        fd.append("precio", precio);
        fd.append("stock", stock);
        fd.append("descripcion", descripcion);
        fd.append("imagen", imagen);
        $.ajax({
            type: "post",
            url: base_url + 'Administrativos/Mobiliario/agregarMobiliario',
            data: fd,
            processData: false,
            contentType: false,
            dataType: "json",
            enctype: 'multipart/form-data',
            success: function (response) {
                if (response.res == "success") {
                    toastr["success"](response.message);
                    $("#modal_add_mobiliario").modal("hide");
                    $("#addmobiliario")[0].reset();
                    $("#tbl_mobilario").DataTable().destroy();
                    llenartablamobiliario();
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
$(document).on("click", "#del_mobiliario", function (e) {
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
                url: base_url + 'Administrativos/Mobiliario/eliminarMobiliario',
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
                        $("#tbl_mobilario").DataTable().destroy();
                        llenartablamobiliario();
                    }
                },
            });
        }
    });
});
/* -------------------------------------------------------------------------- */
/*                 Llenar formulario Actualizar                               */
/* -------------------------------------------------------------------------- */
$(document).on("click", "#edit_mobiliario", function (e) {
    e.preventDefault();
    var edit_id = $(this).attr("value");
    $.ajax({
        type: "post",
        url: base_url + 'Administrativos/Mobiliario/editarMobiliario',
        data: {
            edit_id: edit_id,
        },
        dataType: "json",
        success: function (data) {
            console.log(data); //ver la respuesta del json, los valores que contiene
            $('#modaleditmobiliario').modal('show');

            // Llena los inputs del formulario con los datos a modificar
            $('#id_mobiliario_update').val(data.post.clave);
            $('#nombre_nuevo').val(data.post.nombre);
            $('#precio_nuevo').val(data.post.precio);
            $('#stock_nuevo').val(data.post.stock);
            $('#estado_nuevo').val(data.post.estado);
            $('#descripcion_nueva').val(data.post.descripcion);
            $('#uploaded_image').val(data.post.imagen);
        },
    });
});


/* -------------------------------------------------------------------------- */
/*                        Actualizar Mobiliario                               */
/* -------------------------------------------------------------------------- */
$(document).on("click", "#update_mobiliario", function (e) {
    e.preventDefault();
//debugger;
    var clave = $("#id_mobiliario_update").val();
    var nombre = $("#nombre_nuevo").val();
    var precio = parseFloat($("#precio_nuevo").val());
    var stock = $("#stock_nuevo").val();
    var estado = $("#estado_nuevo").val();
    var descripcion = $("#descripcion_nueva").val();
    var imgact=$("#uploaded_image").val();

    var imagen = $("#imagen_nueva")[0].files[0];

    if ($("#imagen_nueva").val() == '') {
      // En caso de no agregar imagen
      imagen = imgact;
    }else {
      // Validacion de la extencion del archivo
      var extencion = $('#imagen_nueva').val().split('.').pop().toLowerCase();

      if(jQuery.inArray(extencion, ['gif','png','jpg','jpeg']) == -1){
        //
        alert("Archivo no valido");
        $('#imagen_nueva').val(''); // Limpia el input file
        return false;
      }
    }

    if (nombre == "" || precio == "" || stock == "" || estado =="" || descripcion == "") {
        alert("¡Complete todos los campos!");
    } else {
      var fd = new FormData();
      fd.append("clave", clave);
      fd.append("nombre", nombre);
      fd.append("precio", precio);
      fd.append("stock", stock);
      fd.append("estado", estado);
      fd.append("descripcion", descripcion);
      fd.append("imagen", imagen);

      $.ajax({
          type: "post",
          url: base_url + 'Administrativos/Mobiliario/updateMobiliario',
          data:fd,
          processData: false,
          contentType: false,
          dataType: "json",
          enctype: 'multipart/form-data',
          success: function (data) {
            //console.log(res); //ver la respuesta del json, los valores que contiene
              if (data.responce == "success") {
                toastr["success"](data.message);
                $("#modaleditmobiliario").modal("hide");
                $("#formeditarmobiliario")[0].reset();
                $("#tbl_mobilario").DataTable().destroy();
                llenartablamobiliario();
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
