$(document).ready(function () {


$('.clockpicker').clockpicker();


  var calendar = $('#calendar').fullCalendar({

      editable:true,
      header:{
          left:'prev,next today',
          center:'title',
          right:'month,agendaWeek,agendaDay'
      },
      height:580,  // tamaño atura del calendar
      events: base_url + 'Eventos/NuevoEvento/load',
      selectable:true,
      selectHelper:true,

    dayClick:function(date, jsEvent, view){
      $("#addNewEvent")[0].reset();
       		// alert("Dia Seleccionado:"+date.format());
       		$("#fecha_evento").val(date.format());
       		$("#ModalEventos").modal();
          $("#btnAgregarNewEvent").show();  // Btn agregar new event hide
            $("#eliminarEvento").hide();  // Btn delete new event hide
            $("#updateEvento").hide();  // Btn update new event hide
            $("#nuevoEventoCliente").hide();  // Btn Add Event new event hide
            $("#divColor").show();
         	},
      editable:true,

// ============  Evento donde ya existe un registro aki te doy 2 opciones Eliminar o update datos   =================

      eventClick:function(event){  // Abrir modal y presentar Btn for delete and update ocultar registrar new event

        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
        var time = $.fullCalendar.formatDate(event.start, "HH:mm:ss");
        var title = event.title;
        var descripcion = event.descripcion;
        var id = event.id_evento;

        $("#fecha_evento").val(start);
        $("#titulo").val(title);
        $("#hora").val(time);
        $("#descripcion").val(descripcion);
        $("#id_evento").val(id);
            $("#ModalEventos").modal();
            $("#btnAgregarNewEvent").hide();  // Btn agregar new event hide
            $("#eliminarEvento").show();  // Btn delete new event show
            $("#updateEvento").show();  // Btn update new event show
            $("#nuevoEventoCliente").show();  // Btn Add Event new event show
            $("#divColor").hide();

      } // FIN

  });


});   // FIN DEL DOCUMENT READy



/* -------------------------------------------------------------------------- */
  /*                          AGRRGAR NUEW EVENTP                             */
  /* -------------------------------------------------------------------------- */
  $(document).on("click", "#btnAgregarNewEvent", function(e) {
      e.preventDefault();
      debugger;

var datos = {
       user_session : $("#username").val(),
       start : $("#fecha_evento").val()+" "+$('#hora').val(),
       title : $("#titulo").val(),
       descripcion : $("#descripcion").val(),
       color : $("#color").val(),
     }

      if (datos.titulo == "" || datos.descripcion == "" ) {
          alert("Todos los datos son requeridos...!");
      } else {

          $.ajax({
              type: "post",
              url: base_url + 'Eventos/NuevoEvento/insertNewEvent',
              data: (datos),
              dataType: "json",
              success: function(data) {
                  if (data.responce == "success") {
                      toastr["success"](data.message);
                      $("#addNewEvent")[0].reset();
                      $('#ModalEventos').modal('hide');
                      	$('#calendar').fullCalendar('refetchEvents');
                    //  Redireccionar a la siguiente pagina o liga cuando sea la respuesta como success
                        // location.href ="http://localhost/antigua/Eventos/Contratos";
                    //                  http://localhost/antigua/Eventos/Contratos
                  } else {
                      toastr["error"](data.message);
                  }
              },
          });
      }
  });


  $(document).on("click", "#nuevoEventoCliente ", function(e) {
      e.preventDefault();
debugger;
    // var datos = {
           var id_evento = $("#id_evento").val();
         // }

            //  Redireccionar a la siguiente pagina o liga cuando sea la respuesta como success
            location.href ="http://localhost/antigua/Eventos/Contratos?Numero_Evento="+id_evento+"";

  });




//  DELETE EVENTOS
  $(document).on("click", "#eliminarEvento", function (e) {
      e.preventDefault();

      var datos = {
              id_evento : $("#id_evento").val(),
              }
  // var id_evento = $("#id_evento").val();
      Swal.fire({
          title: 'Esta seguro de eliminar este evento...?',
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
              url: base_url + 'Eventos/NuevoEvento/deleteEvent',
              data: (datos),
              dataType: "json",
                  success: function (data) {
                      if (data.responce == "success") {
                          Swal.fire(
                              '¡Eliminado!',
                              'El evento ha sido eliminado.!',
                              'success'
                          );
                          $('#calendar').fullCalendar('refetchEvents'); // refresh el div del calendar
                          $('#ModalEventos').modal('hide');
                      } else {
                          console.log(data);
                      }
                  },
              });
          }
      });
  });


//  Update eventp
  $(document).on("click", "#updateEvento", function (e) {
      e.preventDefault();

      var datos = {
             start : $("#fecha_evento").val()+" "+$('#hora').val(),
             title : $("#titulo").val(),
             descripcion : $("#descripcion").val(),
             id_evento : $("#id_evento").val(),
           }

        if ( datos.titulo == "" || datos.descripcion == ""  ) {
      alert("Debe llenar todos los campos...!");
      } else {

          $.ajax({
              type: "post",
              url: base_url + 'Eventos/NuevoEvento/updateEvent',
              data: (datos),
              dataType: "json",
              success: function (data) {
                  if (data.response == "success") {
                      toastr["success"](data.message);
                      $("#addNewEvent")[0].reset();
                      $('#ModalEventos').modal('hide');
                      	$('#calendar').fullCalendar('refetchEvents');
                  } else {
                      toastr["error"](data.message);
                  }
              },
          });
      }
  });



//  Generar reporte fianl del evento x cliente

  function btnGenerarReporteEvento() {
    // debugger;
   var idEvento = $("#id_evento").val();
// var numero_control = $('#numero_control_constancia').val();
// var detalle        = $("#detalle_constancia").val();
// var semestre       = $("#semestre_constancia").val();
// var opcion         = $("#opcion_constancia").val();
// var carrera        = $("#carrera_constancia").val();

    // var url = base_url+"Administrativos/DocumentosAlumnos/generaConstanciaAlumno/" + numero_control + "/" + detalle + "/" + semestre + "/" + opcion + "/" + carrera ;
    //     window.open(url, "_blank", numero_control);

    var url = base_url+"Eventos/NuevoEvento/generaReportePdfEvento/"+ idEvento;
        window.open(url,  idEvento);


      }
