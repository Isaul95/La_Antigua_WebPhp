$(document).ready(function () {

});




/* -------------------------------------------------------------------------- */
/*                           Agregar Cliente                             */
/* -------------------------------------------------------------------------- */
$(document).on("click", "#btnEnviar", function (e) {
    e.preventDefault();
    var nombre = $("#nombre").val();
    var direccion = $("#direccion").val();  // Se convierte el texto a un float
    var telefono = $("#telefono").val();
    var sexo = $("#sexo").val();
    var email = $("#email").val();
    var ine = $("#archivo")[0].files[0];

    if ($("#archivo").val() == '') {
      // En caso de no agregar imagen
      ine = '';
    }else {
      // Validacion de la extencion del archivo
      var extencion = $('#archivo').val().split('.').pop().toLowerCase();
    //  tipoImagen = extencion;
      if(jQuery.inArray(extencion, ['pdf']) == -1){
        //
        alert("Archivo no valido");
        $('#archivo').val(''); // Limpia el input file
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
        fd.append("archivo", ine);
        //fd.append("tipoImagen", tipoImagen);
        $.ajax({
            type: "post",
            url: base_url + 'Email/Email/enviarCorreo',
            data: fd,
            processData: false,
            contentType: false,
            dataType: "json",
            enctype: 'multipart/form-data',
            success: function (response) {
                if (response.res == "success") {
                    toastr["success"](response.message);
                    $("#correo")[0].reset();

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
