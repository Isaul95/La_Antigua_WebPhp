$(document).ready(function () {
    llenarTablaAlumnosParaDocumentacion();

}); // FIN DE LA FUNCION PRINCIPAL


/* -------------------------------------------------------------------------- */
/*                                llenarllenarTablaalumnos               */
/* -------------------------------------------------------------------------- */


function llenarTablaAlumnosParaDocumentacion() {
    // debugger;
    $.ajax({
        type: "get",
        url: base_url + 'Administrativos/DocumentosAlumnos/datosGralDelAlumno',
        dataType: "json",
        success: function (response) {
            var i = "1";
            $("#tbl_alumnosDocumentacion").DataTable({
                data: response,
                responsive: true,
                columns: [{
                    data: "numero_control",
                },
                {
                    data: "alumno",
                },
                {
                    data: "semestre",
                },
                {
                    data: "carrera_descripcion",
                },
                {
                    // data: "certificado_estudios",
                    orderable: false,
                    searchable: false,
                    render : function(data, type, row) {
                        var a = `
                            <a title="Generar Certificado de Estudios" href="DocumentosAlumnos/generaCertificadoEstudios/${row.numero_control}/${row.semestre}" target="_blank"><i class="far fa-file-pdf fa-2x"></i></a>
                        `;
                         return a;
                    },
                },
                {
                    // data: "nombre_certificado_bachillerato",
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row, meta) {
                        var a;
                            var a = `
                            <a title="Generar Boleta Calificaciones" href="DocumentosAlumnos/generaBoletaCalificaciones/${row.numero_control}/${row.semestre}/${row.id_carrera}" target="_blank"><i class="far fa-file-pdf fa-2x"></i></a>
                            `;
                        return a;
                    },
                },
                {
                    // data: "curp",
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row, meta) {

                        return  a = `
<a title="Generar Historial Academico" href="DocumentosAlumnos/generaHistAcademico/${row.numero_control}/${row.id_carrera}" target="_blank"><i class="far fa-file-pdf fa-2x"></i></a>
                         `;

                    },
                },
                // {
                //     // data: "certificado_medico",
                //     orderable: false,
                //     searchable: false,
                //     render: function (data, type, row, meta) {
                //         var nombre_certificado_medico = `${row.nombre_certificado_medico}`;
                //         var a;
                //           if(nombre_certificado_medico != "null"&&nombre_certificado_medico != "undefined"){
                //         var a = `
                //                <a title="Descarga Documento" href="Alumnos/verCertificadoMedicoalumno/${row.numero_control}" target="_blank"><i class="far fa-file-pdf fa-2x"></i></a>
                //             `;
                //           }
                //           else{
                //             a = 'Sin archivo';
                //         }
                //         return a;
                //     },
                // },
                // {
                //     orderable: false,
                //     searchable: false,
                //     data: function (row, type, set) {
                //         return `
                //                 <a href="#" id="edit_alumno" class="btn btn-success btn-remove" value="${row.numero_control}"><i class="far fa-edit"></i></a>
                //                 <a href="#" id="del_alumno" class="btn btn-danger btn-remove" value="${row.numero_control}"><i class="fas fa-trash-alt"></i></a>
                //             `;
                //     },
                // },
                {
                    // data: "curp",
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row, meta) {

                        return  a = `
<a title="Generar Horario Alumno" href="DocumentosAlumnos/generaHorarioAlumno/${row.numero_control}/${row.semestre}" target="_blank"><i class="far fa-file-pdf fa-2x"></i></a>
                         `;

                    },
                },

                ],
                "language": language_espaniol,

            });
        },
    });
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
