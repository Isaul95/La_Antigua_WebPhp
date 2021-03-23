$(document).ready(function () {

});
/*
$(document).on("click", "#agregarCliente", function (e) {
    e.preventDefault();
    $("#myForm").show();
    return false;


});
$(document).on("click", "#inicioc", function (e) {
    e.preventDefault();
    $("#myForm").hide();
    $("#addCliente")[0].reset();
    $("#btnaddCliente")[0].reset();
    return false;


});

*/

function vistaClientes() {
  //
  $.ajax({
  type: "GET",
  url: base_url + 'application/views/admin/Clientes/VistaInicioClientes',
  success: function(datos) {
      $("#formcli").html(datos);
      $("#addCliente")[0].reset();
      //$("#btnaddCliente")[0].reset();
  }
})

}

$(document).on("click", "#inicioc", function (e) {
    e.preventDefault();
    vistaClientes();

});
$(document).on("click", "#agregarCliente", function (e) {
    e.preventDefault();
    $.ajax({
    type: "GET",
    url: base_url + 'application/views/admin/Clientes/formularioClientes',
    success: function(datos) {
        $("#formcli").html(datos);
        $("#addCliente")[0].reset();
        //$("#btnaddCliente")[0].reset();
    }
})


});

$(document).on("click", "#clientesDos", function (e) {
    e.preventDefault();
    $.ajax({
    type: "GET",
    url: base_url + 'application/views/admin/Clientes/clientes_dos',
    success: function(datos) {
        $("#formcli").html(datos);
        $("#addCliente")[0].reset();
        //$("#btnaddCliente")[0].reset();
    }
})


});

$(document).on("click", "#clientesTres", function (e) {
    e.preventDefault();
    $.ajax({
    type: "GET",
    url: base_url + 'application/views/admin/Clientes/clientesTres',
    success: function(datos) {
        $("#formcli").html(datos);
        $("#addCliente")[0].reset();
        //$("#btnaddCliente")[0].reset();
    }
})


});

$(document).on("click", "#clientesCuatro", function (e) {
    e.preventDefault();
    $.ajax({
    type: "GET",
    url: base_url + 'application/views/admin/Clientes/clientesCuatro',
    success: function(datos) {
        $("#formcli").html(datos);
        $("#addCliente")[0].reset();
        //$("#btnaddCliente")[0].reset();
    }
})


});



/* -------------------------------------------------------------------------- */
/*                           Agregar Cliente                             */
/* -------------------------------------------------------------------------- */
$(document).on("click", "#btnaddCliente", function (e) {
    e.preventDefault();
    var nombre = $("#nombreCliente").val();
    var direccion = $("#direccionCliente").val();  // Se convierte el texto a un float
    var telefono = $("#telefonoCliente").val();
    var sexo = $("#sexoCliente").val();
    var email = $("#emailCliente").val();
    var ine = $("#ine")[0].files[0];

    if ($("#ine").val() == '') {
      // En caso de no agregar imagen
      ine = '';
    }else {
      // Validacion de la extencion del archivo
      var extencion = $('#ine').val().split('.').pop().toLowerCase();
    //  tipoImagen = extencion;
      if(jQuery.inArray(extencion, ['pdf']) == -1){
        //
        alert("Archivo no valido");
        $('#ine').val(''); // Limpia el input file
        return false;
      }
    }

    if (nombre == "" || direccion == "" || telefono == "" || sexo == "") {
        alert("¡Complete todos los campos!");
    } else {
        var fd = new FormData();
        fd.append("nombre", nombre);
        fd.append("direccion", direccion);
        fd.append("telefono", telefono);
        fd.append("sexo", sexo);
        fd.append("email", email);
        fd.append("ine", ine);
        //fd.append("tipoImagen", tipoImagen);
        $.ajax({
            type: "post",
            url: base_url + 'Clientes/Clientes/addCliente',
            data: fd,
            processData: false,
            contentType: false,
            dataType: "json",
            enctype: 'multipart/form-data',
            success: function (response) {
                if (response.res == "success") {
                    toastr["success"](response.message);
                    vistaClientes();

                } else {
                    toastr["error"](response.message);
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
