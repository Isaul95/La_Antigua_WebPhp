$(document).ready(function () {


$('.clockpicker').clockpicker();


  var calendar = $('#calendar').fullCalendar({
      editable:true,
      header:{
          left:'prev,next today',
          center:'title',
          right:'month,agendaWeek,agendaDay'
      },
      height:580,
      // events:"http://localhost/antigua/Eventos/NuevoEvento/load",
      events: base_url + 'Eventos/NuevoEvento/load',
// url: base_url + 'Administrativos/Carreras/insertarcarrera',
      selectable:true,
      selectHelper:true,
    //   select:function(start, end, allDay){
    //       var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
    //       alert("Dia Seleccionado start:"+start);
    //       var title = prompt("Enter Event Title");
    //
    //       if(title)
    //       {
    //           var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
    //           var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
    //           $.ajax({
    // //            url: "<?php echo base_url(); ?>fullcalendar/insert",
    //               url: base_url + 'Eventos/NuevoEvento/insertNewEvent',
    //               type:"POST",
    //               data:{title:title, start:start, end:end},
    //               success:function()
    //               {
    //                   calendar.fullCalendar('refetchEvents');
    //                   alert("Added Successfully");
    //               }
    //           })
    //       }
    //   },
    dayClick:function(date, jsEvent, view){

         		// alert("Dia Seleccionado:"+date.format());
         		$("#fecha_evento").val(date.format());
            // var id_evento = event.id_evento;
            // $("#id_evento").val(id_evento);
         		$("#ModalEventos").modal();

         	},
      editable:true,
      eventResize:function(event)
      {
          var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
          var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");

          var title = event.title;
          var id = event.id;

          $.ajax({
              url:"<?php echo base_url(); ?>fullcalendar/update",
              type:"POST",
              data:{title:title, start:start, end:end, id:id},
              success:function()
              {
                  calendar.fullCalendar('refetchEvents');
                  alert("Event Update");
              }
          })
      },
      eventDrop:function(event)
      {
          var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
          //alert(start);
          var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
          //alert(end);
          var title = event.title;
          var id = event.id_evento;
          $.ajax({
              url:"<?php echo base_url(); ?>fullcalendar/update",
              type:"POST",
              data:{title:title, start:start, end:end, id:id},
              success:function()
              {
                  calendar.fullCalendar('refetchEvents');
                  alert("Event Updated");
              }
          })
      },
      eventClick:function(event){
        debugger;
          // if(confirm("Are you sure you want to remove it?")){

              var id = event.id_evento;
              $("#id_evento").val(id);
              $("#ModalEventos").modal();

              $.ajax({
                  url:"<?php echo base_url(); ?>fullcalendar/delete",
                  type:"POST",
                  data:{id:id},
                  success:function()
                  {
                      calendar.fullCalendar('refetchEvents');
                      alert('Event Removed');
                  }
              })
          // }
      }
  });


});   // FIN DEL DOCUMENT READy






/* -------------------------------------------------------------------------- */
  /*            Insert oficio pa Practicas_profesionale                         */
  /* -------------------------------------------------------------------------- */
  $(document).on("click", "#btnAgregarNewEvent", function(e) {
      e.preventDefault();
      debugger;

var datos = {
       // hora : $("#hora").val(),
       start : $("#fecha_evento").val()+" "+$('#hora').val(),
       title : $("#titulo").val(),
       descripcion : $("#descripcion").val(),
       color : $("#color").val(),
     }

      if (datos.titulo == "" || datos.hora == "" || datos.descripcion == "" ) {
          alert("Todos los datos son requeridos...!");
      } else {

          $.ajax({
              type: "post",
          //  url: base_url + 'Eventos/NuevoEvento/insertNewEvent',
              url: base_url + 'Eventos/NuevoEvento/insertNewEvent',
              data: (datos),
              dataType: "json",
              success: function(data) {
                  if (data.responce == "success") {
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
