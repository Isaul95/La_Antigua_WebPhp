const $SeleccionarNuevaFoto = document.querySelector('#SeleccionarNuevaFoto');
      $MostrarFotoSeleccionada = document.querySelector('#MostrarFotoSeleccionada');


$(document).ready(function() {
  MostrarTablaSalones();
});


  $('#ModalAgregarSalon').on('hide.bs.modal', function(e) {
    $('#FormularioAgregarSalon')[0].reset();
  });


  $('#ModalModificarSalon').on('hide.bs.modal', function(e) {
    $('#FormularioEditarSalon')[0].reset();
  });


  $('#ModalAgregarFoto').on('hide.bs.modal', function(e) {
    $('#FormularioAgregarFoto')[0].reset();
    $MostrarFotoSeleccionada.src = "";
    $MostrarFotoSeleccionada.width = "0";
    $MostrarFotoSeleccionada.height = "0";
  });


function MostrarTablaSalones() {
  $.ajax({
    type: 'get',
    url: base_url + 'Salones/ControlSalones/VerSalones',
    dataType: 'json',
    success: function(datosTablaSalones) {
      var contador = "1";
      $('#TablaSalones').DataTable({
        data: datosTablaSalones,
        responsive: true,
        columns: [
          {
            data: 'nombre_salon',
          },
          {
            data: 'direccion',
            orderable: false,
          },
          {
            data: 'costo_alquiler',
          },
          {
            data: 'capacidad',
          },
          {
            orderable: false,
            searchable: false,
            data: function(row, type, set) {
              return `
                <a href="#" id="InformacionSalon" class="btn btn-info" ID_Seleccionado="${row.id_salon}">
                <i class="fas fa-book-open"></i></a>
                <a href="#" id="EditarSalon" class="btn btn-success btn-remove" ID_Seleccionado="${row.id_salon}">
                <i class="far fa-edit"></i></a>
                <a href="#" id="BorrarSalon" class="btn btn-danger btn-remove" ID_Seleccionado="${row.id_salon}">
                <i class="fas fa-trash-alt"></i></a>
              `;
            },
          },
          {
            orderable: false,
            searchable: false,
            data: function(row, type, set) {
              return `
                <a href="#" id="TablaFotosSalon" class="btn btn-info" ID_Seleccionado="${row.id_salon}">
                <i class="fas fa-images"></i></a>
              `;
            },
          },
        ],
        'language': idiomaEspañolTablas,
      });
    },
  });
}


$(document).on("click", "#InformacionSalon", function(e){
  e.preventDefault();

  var buscarID = $(this).attr("ID_Seleccionado");
  $.ajax({
    type: "post",
    url: base_url + 'Salones/ControlSalones/BuscarSalon',
    data:{
      buscarID: buscarID,
    },
    dataType: "json",
    success: function (informacionSalon){
      $('#ModalVisualizarSalon').modal('show');
      $('#visualizarNombre').val(informacionSalon.DatoSalon.nombre_salon)
      $('#visualizarDireccion').val(informacionSalon.DatoSalon.direccion)
      $('#visualizarCosto').val(informacionSalon.DatoSalon.costo_alquiler)
      $('#visualizarCapacidad').val(informacionSalon.DatoSalon.capacidad)
      $('#visualizarDescripcion').val(informacionSalon.DatoSalon.descripcion)
      $('#visualizarHorarios').val(informacionSalon.DatoSalon.horarios)
    },
  });
});


  $(document).on("click", "#AgregarSalon", function(e) {
    e.preventDefault();

    var agregarNombre = $('#AgregarNombre').val();
    var agregarDireccion = $('#AgregarDireccion').val();
    var agregarCosto = $('#AgregarCosto').val();
    var agregarCapacidad = $('#AgregarCapacidad').val();
    var agregarDescripcion = $('#AgregarDescripcion').val();
    var agregarHorarios = $('#AgregarHorarios').val();

    var agregarInformacion = new FormData();
    agregarInformacion.append("nombre_salon", agregarNombre);
    agregarInformacion.append("direccion", agregarDireccion);
    agregarInformacion.append("costo_alquiler", agregarCosto);
    agregarInformacion.append("capacidad", agregarCapacidad);
    agregarInformacion.append("descripcion", agregarDescripcion);
    agregarInformacion.append("horarios", agregarHorarios);

    $.ajax({
      type: "post",
      url: base_url + 'Salones/ControlSalones/crearSalon',
      data: agregarInformacion,
      processData: false,
      contentType: false,
      dataType: "json",
      enctype: 'multipart/form-data',
      success: function(response) {
        if (response.Resultado == "Exitoso") {
          toastr["success"](response.Mensaje);
          $('#ModalAgregarSalon').modal("hide");
          $('#FormularioAgregarSalon')[0].reset();
          $('#TablaSalones').DataTable().destroy();
          MostrarTablaSalones();
        } else {
          toastr["error"](response.Mensaje);
        }
      },
    });
  });


$(document).on('click', '#EditarSalon', function(e) {
  e.preventDefault();

  var buscarID = $(this).attr('ID_Seleccionado');

  $.ajax({
    type: 'post',
    url: base_url + 'Salones/ControlSalones/BuscarSalon',
    data: {
      buscarID: buscarID,
    },
    dataType: 'json',
    success: function(informacionSalon) {
      $('#ModalModificarSalon').modal('show');
      $('#ID_Actual').val(informacionSalon.DatoSalon.id_salon)
      $('#NombreModificado').val(informacionSalon.DatoSalon.nombre_salon)
      $('#DireccionModificada').val(informacionSalon.DatoSalon.direccion)
      $('#CostoModificado').val(informacionSalon.DatoSalon.costo_alquiler)
      $('#CapacidadModificada').val(informacionSalon.DatoSalon.capacidad)
      $('#DescripcionModificada').val(informacionSalon.DatoSalon.descripcion)
      $('#HorariosModificados').val(informacionSalon.DatoSalon.horarios)
    },
  });
});


  $(document).on("click", "#ActualizarSalon", function(e) {
    e.preventDefault();

    var actualID = $('#ID_Actual').val();
    var nombreModificado = $('#NombreModificado').val();
    var direccionModificada = $('#DireccionModificada').val();
    var costoModificado = $('#CostoModificado').val();
    var capacidadModificada = $('#CapacidadModificada').val();
    var descripcionModificada = $('#DescripcionModificada').val();
    var horariosModificados = $('#HorariosModificados').val();

    var modificarInformacion = new FormData();
    modificarInformacion.append("actualID", actualID);
    modificarInformacion.append("nombre_salon", nombreModificado);
    modificarInformacion.append("direccion", direccionModificada);
    modificarInformacion.append("costo_alquiler", costoModificado);
    modificarInformacion.append("capacidad", capacidadModificada);
    modificarInformacion.append("descripcion", descripcionModificada);
    modificarInformacion.append("horarios", horariosModificados);

    $.ajax({
      type: "post",
      url: base_url + 'Salones/ControlSalones/actualizarSalon',
      data: modificarInformacion,
      processData: false,
      contentType: false,
      dataType: "json",
      enctype: 'multipart/form-data',
      success: function(data) {
        if (data.Resultado == "Exitoso") {
          toastr["success"](data.Mensaje);
          $('#ModalModificarSalon').modal("hide");
          $('#FormularioEditarSalon')[0].reset();
          $('#TablaSalones').DataTable().destroy();
          MostrarTablaSalones();
        } else {
          toastr["error"](data.Mensaje);
          $('#ModalModificarSalon').modal("hide");
          $('#FormularioEditarSalon')[0].reset();
          $('#TablaSalones').DataTable().destroy();
        }
      },
    });
  });


$(document).on('click', '#BorrarSalon', function(e) {
  e.preventDefault();

  var eliminarID = $(this).attr('ID_Seleccionado');

  Swal.fire({
    title: "¿Estás seguro de eliminar el salón seleccionado?",
    text: "¡Esta acción es irreversible!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "¡Si, eliminalo!",
    cancelButtonText: "¡No, cancelar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: 'post',
        url: base_url + 'Salones/ControlSalones/EliminarSalon',
        data: {
          eliminarID: eliminarID,
        },
        dataType: 'json',
        success: function(consulta) {
          if (consulta.Resultado == "Exitoso") {
            Swal.fire(
              "¡Eliminado!",
              "El salón fue eliminado"
            );
            $('#TablaSalones').DataTable().destroy();
            MostrarTablaSalones();
          }
        },
      });
    }
  });
});


$(document).on("click", "#TablaFotosSalon", function(e){

  if ($('#ModalGaleriaSalon').is(':hidden')) {
    var buscarID = $(this).attr('ID_Seleccionado');
    $('#FotoID').val(buscarID);
  } else {
    var buscarID = $('#FotoID').val();
  }

  var enviarInformacion = new FormData();
  enviarInformacion.append('buscarID', buscarID);
  $.ajax({
    type: 'post',
    url: base_url + 'Salones/ControlSalones/VerFotos',
    data: enviarInformacion,
    processData: false,
    contentType: false,
    dataType: "json",
    success: function(fotosSalon) {
      $("#TablaFotos").DataTable().destroy();
      var contador = "1";
      $('#TablaFotos').DataTable({
        data: fotosSalon,
        responsive: true,
        columns: [
          /*{
            data: 'nombre_foto',
          },*/
          {
            data: 'nombre_foto',
            "className": "text-center",
            orderable: false,
            searchable: false,
            render: function(data, type, row, meta) {
              var fotoSalon = `<img src="ControlSalones/Foto/${row.id_foto}" width="350" height="200"/>`;
              return fotoSalon;
            },
          },
          {
            orderable: false,
            "className": "text-center",
            searchable: false,
            data: function(row, type, set) {
              return `
                <a href="#" id="BorrarFoto" class="btn btn-danger btn-remove" ID_Seleccionado="${row.id_foto}">
                <i class="fas fa-trash-alt"></i></a>
              `;
            },
          },
        ],
        'language': idiomaEspañolTablas,
      });
      $('#ModalGaleriaSalon').modal('show');
    },
    error: function (respuestaConsulta) {
      toastr["error"](respuestaConsulta.Mensaje);
    },
  });
});


$(document).on("click", "#AgregarFotoSalon", function(e) {
  e.preventDefault();

  var agregarFoto = $('#SeleccionarNuevaFoto')[0].files[0];
  var agregarID = $('#FotoID').val();

  var agregarInformacion = new FormData();
  agregarInformacion.append("foto", agregarFoto);
  agregarInformacion.append("id_salon", agregarID);

  $.ajax({
    type: "post",
    url: base_url + 'Salones/ControlSalones/CrearFoto',
    data: agregarInformacion,
    processData: false,
    contentType: false,
    dataType: "json",
    enctype: 'multipart/form-data',
    success: function(response) {
      if (response.Resultado == "Exitoso") {
        toastr["success"](response.Mensaje);
        $('#ModalAgregarFoto').modal("hide");
        $('#FormularioAgregarFoto')[0].reset();
        $('#TablaFotos').DataTable().destroy();
        $('#TablaFotosSalon').click();
      } else {
        toastr["error"](response.Mensaje);
      }
    },
  });
});


$(document).on('click', '#BorrarFoto', function(e) {
  e.preventDefault();

  var eliminarID = $(this).attr('ID_Seleccionado');

  Swal.fire({
    title: "¿Estás seguro de eliminar la foto seleccionada?",
    text: "¡Esta acción es irreversible!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#dd3333",
    confirmButtonText: "¡Si, eliminala!",
    cancelButtonText: "¡No, cancelar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: 'post',
        url: base_url + 'Salones/ControlSalones/EliminarFoto',
        data: {
          eliminarID: eliminarID,
        },
        dataType: 'json',
        success: function(consulta) {
          if (consulta.Resultado == "Exitoso") {
            Swal.fire(
              "¡Eliminada!",
              "La foto fue eliminada"
            );
            $('#TablaFotos').DataTable().destroy();
            $('#TablaFotosSalon').click();
          }
        },
      });
    }
  });
});

//
// $SeleccionarNuevaFoto.addEventListener('change', () => {
//   const archivos = $SeleccionarNuevaFoto.files;
//   if (!archivos || !archivos.length) {
//     $MostrarFotoSeleccionada.src = "";
//     $MostrarFotoSeleccionada.width = "0";
//     $MostrarFotoSeleccionada.height = "0";
//     return;
//   }
//   const primerArchivo = archivos[0];
//   const objectURL = URL.createObjectURL(primerArchivo);
//   $MostrarFotoSeleccionada.src = objectURL;
//   $MostrarFotoSeleccionada.width = "250";
//   $MostrarFotoSeleccionada.height = "250";
// });


var idiomaEspañolTablas = {
  'lengthMenu': "Mostrar _MENU_ registros por pagina",
  'zeroRecords': "No se encontraron resultados en su búsqueda",
  'searchPlaceholder': "Buscar registros",
  'info': "Total: _TOTAL_ registros",
  'infoEmpty': "No existen registros",
  'infoFiltered': "(filtrado de un total de _MAX_ registros)",
  'search': "Buscar:",
  'paginate': {
    'first': "Primero",
    'last': "Último",
    'next': "Siguiente",
    'previous': "Anterior"
  },
}
