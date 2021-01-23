
  $(document).ready(function(){
        litarAlumnosConBaucherRegistrados();

    }); // FIN DE LA FUNCION PRINCIPAL



    // LISTADO DE LA TABLA ALUMOS PARA HABILTAR DAR ACCESO A SU RECIBO Y ELEHIR MATERIAS
      /* -------------------------------------------------------------------------- */
      /*                      llenarTablaPagos Records                              */
      /* -------------------------------------------------------------------------- */
      function litarAlumnosConBaucherRegistrados() {
         console.log("Lista de alumnos con baucher...!");
          debugger;
          var datos = {
              tipoPago : $("#tipoPago").val(),
              }
              var url = base_url+'Finanzas/HabilitarAlumnos/listaDeAlumnosConBaucherRegistrado/'+datos.tipoPago;

          $.ajax({
              type: "post",
              // url: base_url+'Finanzas/HabilitarAlumnos/listaDeAlumnosConBaucherRegistrado',
              url: url,
              dataType: "json",
              success: function(response) {
                  var i = "1";
                  $("#tbl_listAlumConBaucher").DataTable({
                      data: response,
                      responsive: true,
                      columns: [
                        {
                              data: "id_alta_baucher_banco",
                              "visible": false, // ocultar la columna
                          },
                          {
                              data: "nombre_completo",
                          },
                          {
                              data: "carrera_descripcion",
                          },
                          {
                              data: "numero_control",
                          },
                          {
                              data: "fecha_registro",
                          },
                          {
                              data: "archivo",
                              render: function(data, type, row, meta) {
                                //  Se consulta el file.pdf x el no. de control
                                  var a = `
                                      <a title="Descarga Baucher" href="verBaucher/${row.numero_control}" target="_blank"><i class="far fa-file-pdf fa-2x"></i></a>
                                  `;
                                  return a;
                              },
                          },

                          {
                        //   Es el estatus de la tabla de alumnos
                              data: "estatus",
                              orderable: false,
                              searchable: false,
                              "render" : function(data, type, row) {
                                var habilitarAlumno = `${row.estatus}`;
                                var string = '<input type="checkbox" ';
                                if(habilitarAlumno == 1){
                                  string = string + `checked onclick=habilitaRegistro(0,'${row.numero_control}','${row.id_alta_baucher_banco}')>`;
                                }else {
                                  string = string +`onclick=habilitaRegistro(1,'${row.numero_control}','${row.id_alta_baucher_banco}')>`;
                                }
                                return string;
			                         },
                          },

// DEBE ESTAR disabled , ASTA K SE ACTIVE EL CHECK DE DAR ACCESO AL ALUMNO  SE DEBE DE ACTIVE ESTE CHECK PARA GENERAR EL RECIVO PDF
                          {
                              data: "cantidad",
                              orderable: false,
                              searchable: false,
                              "render" : function(data, type, row) {
                                var hayCantidad = `${row.cantidad}`;
                                var hayDescConcepto = `${row.desc_concepto}`;
                                debugger;
                                    if(hayCantidad != "null" && hayDescConcepto!= "null"){
                                      var a = `
                                          <a title="Descarga Recibo" href="generaPdfRcibo/${row.numero_control}" target="_blank"><i class="far fa-file-pdf fa-2x"></i></a>
                                      `;
                                      // var a = `
                                      //     <a title="Descarga Recibo" onclick=mostrarDocumento('${row.numero_control}')><i class="far fa-file-pdf fa-2x"></i></a>
                                      // `;
                                    }else {
                                      var a = 'No hay recibo';
                                    }
                                  return a;
                               },
                          },
                            {
                                orderable: false,
                                searchable: false,
                                "render" : function(data, type, row) {
                                    return `
                                    <button type='button' class="btn btn-danger" onclick=noAplicaRegistro('${row.numero_control}','${row.id_alta_baucher_banco}')>No Aplica</button>
                                    `;
                                },
                            },
                            {
                                orderable: false,
                                searchable: false,
                                "render" : function(data, type, row) {
var a = `
    <a title="Agregar Recibo Valido" onclick=recuperarDocumentos('${row.numero_control}','${row.id_alta_baucher_banco}','${row.id_recibo}')><i class="fa fa-upload iconbig azul fa-2x"></i></a>
`;
return a;

                                },
                            },
                      ],
                        "language" : language_espaniol,
                  });
              },
          });
      }


      function mostrarDocumento(numero_control) {
        debugger;
          	// var idProyectoAnexo = $('#idProyectoAnexo').val();
// var url = base_url+'Finanzas/HabilitarAlumnos/listaDeAlumnosConBaucherRegistrado/'+datos.tipoPago;
   var url = base_url+"Finanzas/HabilitarAlumnos/generaPdfRcibo/" + numero_control + ".html";
          	window.open(url, "_blank", numero_control);
      }



    function recuperarDocumentos(numero_control, id_alta_baucher_banco,id_recibo){
    		debugger;
    		// $('#mensajeErrorDoc').hide();
    		// $('#mensaje').hide();
    		// $('#modalDocumento').find('input[type="file"]').val('');

    		$("#modalDocumento").modal("show");
    		$("#numero_controlVarHide").val(numero_control);
    		$("#id_alta_baucher_bancoVarHide").val(id_alta_baucher_banco);
    		$("#id_reciboVarHide").val(id_recibo);
    		llenarTablaDeDocumentosFirmados();
    }


    function llenarTablaDeDocumentosFirmados() {
       console.log("Lista de los recibos firmados de cada alumno...!");
        debugger;
        $.ajax({
            type: "get",
            url: base_url+'Finanzas/HabilitarAlumnos/verRecibosFirmados',
            dataType: "json",
            success: function(response) {
                var i = "1";
                $("#tbl_listaRecibosFirmados").DataTable({
                    data: response,
                    responsive: true,
                    columns: [
                      {
                            data: "id_recibo_valido",
                            // "visible": false,
                            // "searchable": false
                        },
                        {
                            data: "nombre_archivo",
                        },
                        {
                            data: "archivo",
                            render: function(data, type, row, meta) {
                              var namePdf = `${row.nombre_archivo}`;
                                      if(namePdf != "null"){
                              							$('#archivoPDF').hide();
                              							$('#altaReciboValidado').attr('disabled','disabled');
                              						}
                                return a = `
                      <a title="Descarga Baucher" href="verReciboFirmado/${row.id_recibo_valido}" target="_blank"><i class="far fa-file-pdf fa-2x"></i></a>
                                `;
                            },
                        },
                        {
                            orderable: false,
                            searchable: false,
                            data: function (row, type, set) {
                                return `
                <a class="btn btn-danger btn-remove" onclick=deleteRecFirmado('${row.id_recibo_valido}')><i class="fas fa-trash-alt"></i></a>
                                     `;
                            },
                        },
                    ],
                      "language" : language_espaniol,
                });
            },
        });
    }



    function deleteRecFirmado(id_recibo_valido){
        debugger;

              const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger mr-2'
                },
                buttonsStyling: false
              })

              swalWithBootstrapButtons.fire({
                title: 'Esta seguro de borrar el recibo firmado del alumno...?',
                text: "!Esta acción es irreversile!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, bórralo!',
                cancelButtonText: 'No, cancelar!',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {

                    $.ajax({
                     url: base_url+'Finanzas/HabilitarAlumnos/eliminarReciboFirmadoAlum',
                      type: "post",
                      dataType: "json",
                      data: {
                        id_recibo_valido: id_recibo_valido
                      },
                      success: function(data){
                        if (data.responce == "success") {
                            swalWithBootstrapButtons.fire(
                              '¡Eliminado!',
                              'Su archivo ha sido eliminado.!',
                              'success'
                            );
                            $('#tbl_listaRecibosFirmados').DataTable().destroy();
                            llenarTablaDeDocumentosFirmados();
                            $('#archivoPDF').show();
                            $('#altaReciboValidado').removeAttr('disabled');
                        }else{
                            swalWithBootstrapButtons.fire(
                              '¡Eliminado',
                              'El registro no se elimino...!',
                              'error'
                            );
                        }
                      }
                    });

                } else if (
                  /* Read more about handling dismissals below */
                  result.dismiss === Swal.DismissReason.cancel
                ) {
                  swalWithBootstrapButtons.fire(
                    'Cancelada',
                    'El registro no se elimino...!',
                    'error'
                  )
                }
              });

          }



    /* -------------------------------------------------------------------------- */
    /*            DAR DE ALTA EL RECIBO DE PAGO FIRMADO Y SELLADO                 */
    /* -------------------------------------------------------------------------- */
    $(document).on("click", "#altaReciboValidado", function(e) {
        e.preventDefault();
        debugger;

        var id_recibo = $("#id_reciboVarHide").val();
        var img = $("#archivo")[0].files[0]; // this is file
        var archivo = $("#archivo")[0].files[0];
        var usuario_alta = $("#userAlta").val();

        if (archivo == undefined) {
            alert("No seleccionó el documento a guardar...!");
        } else {
            var fd = new FormData();

            fd.append("id_recibo", id_recibo);
            fd.append("archivo", img); //Obt principalmente el name file
            fd.append("archivo", archivo); // Obt el file como tal
            fd.append("usuario_alta", usuario_alta);

            $.ajax({
                type: "post",
                url: base_url+'Finanzas/HabilitarAlumnos/agregarReciboFirmado',
                data: fd,
                processData: false,
                contentType: false,
                dataType: "json",
                enctype : 'multipart/form-data',
                success: function(response) {
                    if (response.res == "success") {
                        toastr["success"](response.message);
                        $('#tbl_listaRecibosFirmados').DataTable().destroy();
                        llenarTablaDeDocumentosFirmados();
			    	            $('#archivoPDF').hide();
                    } else {
                        toastr["error"](response.message);
                    }
                },
            });
        }
    });



      function noAplicaRegistro(numero_control){
          debugger;
                var datos = {
                    numero_control : numero_control,
                }

                const swalWithBootstrapButtons = Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger mr-2'
                  },
                  buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                  title: 'Esta seguro de borrar el baucher del alumno...?',
                  text: "!Esta acción es irreversile!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Si, bórralo!',
                  cancelButtonText: 'No, cancelar!',
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) {

                      $.ajax({
                        // url: base_url+'mantenimiento/RegistroPagos/eliminar',
                           url: base_url+'Finanzas/HabilitarAlumnos/eliminarAllRegistro',
                        type: "post",
                        dataType: "json",
                        data: {
                          numero_control: numero_control
                        },
                        success: function(data){
                          if (data.responce == "success") {
                              swalWithBootstrapButtons.fire(
                                '¡Eliminado!',
                                'Su archivo ha sido eliminado.!',
                                'success'
                              );
                              $('#tbl_listAlumConBaucher').DataTable().destroy();
                              litarAlumnosConBaucherRegistrados();
                          }else{
                              swalWithBootstrapButtons.fire(
                                '¡Eliminado',
                                'El registro no se elimino...!',
                                'error'
                              );
                          }
                        }
                      });

                  } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                  ) {
                    swalWithBootstrapButtons.fire(
                      'Cancelada',
                      'El registro no se elimino...!',
                      'error'
                    )
                  }
                });

            }




// SOLO SE VA HABILITAR CUANDO ESTE DESHABILITADO, UNA VEZ K SE ABILITE SE DESBLOKEA
function habilitaRegistro(estatus, numero_control, id_alta_baucher_banco){
    debugger;
      		var datos = {
      				numero_control : numero_control,
              estatus: estatus,
              id_alta_baucher_banco: id_alta_baucher_banco,
      		}

      		$.ajax({
      			url: base_url+'Finanzas/HabilitarAlumnos/marcarParaRegistro/'+numero_control,
            type: "post",
            dataType: "json",
      			data : (datos),
      			success : function(data){
              if (data.responce == "success") {
                    if (estatus == 0) {  // SI SE DESABILITA SE CARGA LA PAGINA PARA K NO SE INSERTE DOBLE LA INORMACION
                      // alert("estra en el reload");
                        location.reload();
                    }
          toastr["success"](data.message);
          $("#tbl_listAlumConBaucher").DataTable().destroy();
            litarAlumnosConBaucherRegistrados();
          addDatoParaReciboPagoAlumno(id_alta_baucher_banco, numero_control, estatus);
              }else{
                toastr["error"](data.message);
              }
      			}
      		});
      }


      // SE RECOGEN LOS DATOS PARA PODER GENERAR EL RECIBO DE PAGO SIN FIRMA NI SELLO  onClick="eliminarRegistroGasto()"
      function addDatoParaReciboPagoAlumno(id_alta_baucher_banco, numero_control, estatus){
          debugger;
              if(estatus == 1){  // si habilitan debe mostrar modal si es DESHABILITADO no debe mostrarse
              	$('#addDatosRecibo').modal({show: true}); // abrir modal al execute la function
              }
              // Aki solo se imprime al num de control no pude inprimir los demas datos x problemas de los espacios
              $("#numero_con").val(numero_control); // DATO K SE MUESTRA EN EL TXT DEL MODAL

              $(document).on("click", "#addDatosAGenerarReciboPago", function(e){ // ADD DATES FOR REVIBO DE PAGO
                e.preventDefault();
                // Se recojern los valores en la variable datos
              var datos = {
                  bauche: id_alta_baucher_banco,
                  desc_concepto : $("#concepto").val(),
                  cantidad : $("#cantidad").val(),
                  importe_letra : $("#numletra").val()+"PESOS 00/100 M.N",
                  usuario_creacion : $("#username").val(),
                  // var name = $("#concepto").val();
              }

              if (datos.desc_concepto == "" || datos.cantidad == "" || datos.importe_letra == "") {
                alert("Los dato del recibo son obligatorios...!!!");
              }else{

                $.ajax({
                  url: base_url+'Finanzas/HabilitarAlumnos/registroDatosParaGenerarReciboPago',
                  type: "post",
                  dataType: "json",
                  data : (datos),
                  success: function(data){
                    if (data.responce == "success") {
                      $('#tbl_listAlumConBaucher').DataTable().destroy();
                      litarAlumnosConBaucherRegistrados();
                      toastr["success"](data.message);
                      $('#addDatosRecibo').modal('hide');
                    }else{
                      toastr["error"](data.message);
                    }
                  }
                });
                // $("#form")[0].reset();  // VACIA MODAL DESPUES DE INSERT
              }
                });

            }






// ********************   VAR PARA CAMBIAR DE IDIOMA AL ESPAÑOL EL DataTable  *************************
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
