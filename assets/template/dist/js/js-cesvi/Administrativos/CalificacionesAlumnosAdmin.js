//https://www.youtube.com/watch?v=K6IH25Vf8ZA   - table cell editing using plain Javascript | DOM coding challenges
///https://www.youtube.com/watch?v=oxZj82kh4FA - Table Quick Edit Using Ajax jQuery
$(document).ready(function () {
    //llenarTablaAlumnosParaDocumentacion();
    var semestre = $("#numero").val();
    var profesor = $("#usuario").val();
    llenar_combo_materias_administrativos_profesores(semestre,profesor);
    $("#combo_materias_administrativos_profesores").change(function () {
        $("#tbl_list_calificaciones_profesor_por_materia").DataTable().destroy();
        llenartablaalumnosasignadosalamateriadelprofesorp($("#combo_materias_administrativos_profesores").val())
    });
    llenar_combo_carreras_administrativos_profesores();
    $("#combo_carreras_administrativos_profesores").change(function () {
        $("#tbl_list_calificaciones_administrativos_por_carrera_horario").DataTable().destroy();
        llenartablaalumnosasignados_por_carrerayopcion($("#combo_carreras_administrativos_profesores").val(),$("#combo_opciones_administrativos_profesores").val());
   });
    llenar_combo_opciones_administrativos_profesores();
    $("#combo_opciones_administrativos_profesores").change(function () {
        $("#tbl_list_calificaciones_administrativos_por_carrera_horario").DataTable().destroy();
        llenartablaalumnosasignados_por_carrerayopcion($("#combo_carreras_administrativos_profesores").val(),$("#combo_opciones_administrativos_profesores").val());
    });
}); // FIN DE LA FUNCION PRINCIPAL

//SELECT - ON CHANGE
//https://stackoverflow.com/questions/11179406/jquery-get-value-of-select-onchange
// SELECT - ADD VALUES
//https://es.stackoverflow.com/questions/33853/crear-select-con-html-usando-ajax
/* -------------------------------------------------------------------------- */
/*                                llenarllenarTablaalumnos               */
/* -------------------------------------------------------------------------- */
$("#modaleditcalificacion").on("hide.bs.modal", function (e) {
    // do something...
    $("#formeditcalificacion")[0].reset();
});



function llenar_combo_materias_administrativos_profesores(semestre,profesor){
    var fd = new FormData();
        fd.append("profesor", profesor);
        fd.append("semestre", semestre);
    $.ajax({
        type: "post",
        url: base_url + 'Administrativos/Calificaciones/vermateriasdelprofesor',
        data: fd,
        processData: false,
        contentType: false,
        dataType: "json",
        enctype: 'multipart/form-data',
        success: function (data) {
            $.each(data,function(key, registro) {
                $("#combo_materias_administrativos_profesores").append('<option value='+registro.id_materia+'>'+registro.nombre_materia+'</option>');
              });   
        
      },
    });
  }
  function llenar_combo_carreras_administrativos_profesores(){
    $.ajax({
        type: "get",
        url: base_url + 'Administrativos/Calificaciones/obtenercarreras',
        dataType: "json",
        success: function (data) {
            $.each(data,function(key, registro) {
                $("#combo_carreras_administrativos_profesores").append('<option value='+registro.id_carrera+'>'+registro.carrera_descripcion+'</option>');
              });   
        
      },
    });
  }
  function llenar_combo_opciones_administrativos_profesores(){
    $.ajax({
        type: "get",
        url: base_url + 'Administrativos/Calificaciones/obteneropciones',
        dataType: "json",
        success: function (data) {
            $.each(data,function(key, registro) {
                $("#combo_opciones_administrativos_profesores").append('<option value='+registro.id_opcion+'>'+registro.descripcion+'</option>');
              });   
        
      },
    });
  }
  //LLENAR LA TABLA DE ALUMNOS QUE CORRESPONDEN A LAS MATERIAS A LAS QUE EL PROFESOR TIENE ACCESO
function llenartablaalumnosasignadosalamateriadelprofesorp($materia) {
    // debugger;
    var idmateria = $materia;
    $.ajax({
        type: "post",
        url: base_url + 'Administrativos/Calificaciones/veralumnos_asignados_ala_materia_del_profesor',
        data: {
            materia_a_consultar: idmateria,
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
            var i = "1";
            $("#tbl_list_calificaciones_profesor_por_materia").DataTable({
                data: data,
                responsive: true,
                columns: [{
                    data: "id_detalle",
                    "visible": false,
                    "searchable": false
                },
                {
                    data: "numero_control",
                },
                {
                    data: "alumno",
                },
                {
                    data: "cuatrimestre",
                },
                {
                    data: "carrera_descripcion",
                },
                {
                    data: "calificacion",
                },
                {
                    data: "tiempo_extension",
                },
                {
                    orderable: false,
                    searchable: false,
                     data: function (row, type, set) {
                         return `
                                 <a href="#" id="edit_calificacion" class="btn btn-success btn-remove" value="${row.id_detalle}"><i class="far fa-edit"></i></a>
                               `;
                },
                },
                ],
                "language": language_espaniol,

            });
        },
    });
}

  //LLENAR LA TABLA DE ALUMNOS QUE CORRESPONDEN A LAS MATERIAS A LAS QUE EL PROFESOR TIENE ACCESO
  function llenartablaalumnosasignados_por_carrerayopcion($carrera,$opcion) {
    // debugger;
    var carrera = $carrera;
    var opcion = $opcion
    var fd = new FormData();
    fd.append("carrera",carrera);
    fd.append("opcion",opcion);

    $.ajax({
        type: "post",
        url: base_url + 'Administrativos/Calificaciones/veralumnos_asignados_porcarrera_opcion',
        data: fd,
        processData: false,
        contentType: false,        
        dataType: "json",
        enctype: 'multipart/form-data',
        success: function (data) {
            console.log(data);
            var i = "1";
            $("#tbl_list_calificaciones_administrativos_por_carrera_horario").DataTable({
                data: data,
                responsive: true,
                columns: [
                {
                    data: "id_detalle",
                    "visible": false,
                    "searchable": false
                },
                {
                    data: "numero_control",
                },
                {
                    data: "alumno",
                },
                {
                    data: "cuatrimestre",
                },
                {
                    data: "carrera_descripcion",
                },
                {
                    orderable: false,
                    searchable: false,
                     data: function (row, type, set) {
                         return `
                                 <a href="#" id="edit_materia" class="btn btn-success btn-remove" value="${row.id_detalle}"><i class="far fa-edit"></i></a>
                              `;
                },
                },
                ],
                "language": language_espaniol,

            });
        },
    });
}

$(document).on("click", "#edit_calificacion", function (e) {
    e.preventDefault();
    var edit_id = $(this).attr("value");
    var materia = $('#combo_materias_administrativos_profesores').val();
    var fd = new FormData();
            fd.append("detalle",edit_id);
            fd.append("materia",materia);
    $.ajax({
        type: "post",
        url: base_url + 'Administrativos/Calificaciones/editarcalificacion',
        data: fd,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            console.log(data); //ver la respuesta del json, los valores que contiene
            $('#modaleditcalificacion').modal('show');
            $('#calificacion_materia_profesor').val(data.post.calificacion);
            $('#detalle_update').val(data.post.detalle);
            $('#materia_update').val(data.post.materia);
            
        },
        error: function (response) {
            toastr["error"](response.message);
            $('#modaleditcalificacion').modal('hide');
        }
    });
});

$(document).on("click", "#update_calificacion", function (e) {
    e.preventDefault();
    var calificacion_materia_profesor = $("#calificacion_materia_profesor").val();
    var materia_update = $("#materia_update").val();
    var detalle_update = $("#detalle_update").val();
    if(calificacion_materia_profesor>60){
        var tiempo_extension = 'ord.'
    }else{
        var tiempo_extension = 'extrd.'
    }

      if (calificacion_materia_profesor == "") {
    alert("Debe llenar todos los campos vacios...!");
    } else {

        var fd = new FormData();

        fd.append("calificacion",  calificacion_materia_profesor);
        fd.append("detalle", detalle_update);
        fd.append("materia", materia_update);
        fd.append("ciclo", '21/01');
        fd.append("estado_profesor", 2);
        fd.append("tiempo_extension", tiempo_extension);


        $.ajax({
            type: "post",
            url: base_url + 'Administrativos/Calificaciones/updatecalificacion',
            data: fd,
            processData: false,
            contentType: false,
            dataType: "json",
            enctype: 'multipart/form-data',
            success: function (response) {
                if (response.response == "success") {
                    toastr["success"](response.message);
                    $("#modaleditcalificacion").modal("hide");
                    $("#formeditcalificacion")[0].reset();
                    $("#tbl_list_calificaciones_profesor_por_materia").DataTable().destroy();
                    llenartablaalumnosasignadosalamateriadelprofesorp($("#combo_materias_administrativos_profesores").val())
                } else {
                    toastr["error"](response.message);
                }
            },
            error: function (response) {
                toastr["error"](response.message);
            }
        });
    }
});
//LLENAR LA TABLA DE ALUMNOS QUE CORRESPONDEN A CARRERA Y OPCIÓN DE ESTUDIO

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