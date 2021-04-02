const $AgregarImagen = document.querySelector('#AgregarImagen');
      $MostrarImagenSeleccionada = document.querySelector('#MostrarImagenSeleccionada');
      $ImagenModificada = document.querySelector('#ImagenModificada');
      $MostrarImagenModificada = document.querySelector('#MostrarImagenModificada');


$(document).ready(function() {
  MostrarTablaPlatillos();
});


$('#ModalAgregarPlatillo').on('hide.bs.modal', function(e) {
  $('#FormularioAgregarPlatillo')[0].reset();
  $MostrarImagenSeleccionada.src = "";
  $MostrarImagenSeleccionada.width = "0";
  $MostrarImagenSeleccionada.height = "0";
});


$('#ModalModificarPlatillo').on('hide.bs.modal', function(e) {
  $('#FormularioEditarPlatillo')[0].reset();
  $MostrarImagenModificada.src = "";
  $MostrarImagenModificada.width = "0";
  $MostrarImagenModificada.height = "0";
});


function MostrarTablaPlatillos() {
  $.ajax({
    type: 'get',
    url: base_url + 'Platillos/ControlPlatillos/VerPlatillos',
    dataType: 'json',
    success: function(datosTablaPlatillos) {
      
      var contador = "1";
      $('#TablaPlatillos').DataTable({
        data: datosTablaPlatillos,
        responsive: true,
        columns: [{
          data: 'id_platillo',
            "visible": false,
            "searchable": false
          },
          {
            data: 'nombre_platillo',
          },
          {
            data: 'costo',
          },
          {
            data: 'descripcion',
            orderable: false,
          },
          {
            data: 'nombre_foto',
            orderable: false,
            searchable: false,
            render: function(data, type, row, meta) {
              //  var imagenPlatillo = `<img src="ControlPlatillos/Foto/${row.id_platillo}" width="150" height="150"/>`;
              //return imagenPlatillo;
              var foto = `${row.nombre_foto}`;
                            var imagenPlatillo="";
                            if(foto!="null"&&foto!="undefined"&&foto!=""){
                              var imagenPlatillo = `<img src="ControlPlatillos/Foto/${row.id_platillo}" width="150" height="150"/>`;
                                 
                            }
                            else{
                              imagenPlatillo="Sin imagen";
                            }
                             
                          return imagenPlatillo;
            },
          },
          {
            orderable: false,
            searchable: false,
            data: function(row, type, set) {
              return `
                <a href="#" id="EditarPlatillo" class="btn btn-success btn-remove" ID_Seleccionado="${row.id_platillo}">
                <i class="far fa-edit"></i></a>
                <a href="#" id="BorrarPlatillo" class="btn btn-danger btn-remove" ID_Seleccionado="${row.id_platillo}">
                <i class="fas fa-trash-alt"></i></a>
              `;
            },
          },
        ],
        'language': idiomaEspañolTablaPlatillos,
      });
    },
  });
}


$(document).on('click', '#AgregarPlatillo', function(e) {
  e.preventDefault();

  var agregarNombre = $('#AgregarNombre').val();
  var agregarCosto = $('#AgregarCosto').val();
  var agregarDescripcion = $('#AgregarDescripcion').val();
  var agregarImagen = $('#AgregarImagen')[0].files[0];

  var agregarInformacion = new FormData();
  agregarInformacion.append('nombre_platillo', agregarNombre);
  agregarInformacion.append('costo', agregarCosto);
  agregarInformacion.append('descripcion', agregarDescripcion);
  agregarInformacion.append('foto', agregarImagen);

  $.ajax({
    type: 'post',
    url: base_url + 'Platillos/ControlPlatillos/CrearPlatillo',
    data: agregarInformacion,
    processData: false,
    contentType: false,
    dataType: 'json',
    enctype: 'multipart/form-data',
    success: function(respuesta) {
      if (respuesta.Resultado == "Exitoso") {
        toastr['success'](respuesta.Mensaje);
        $('#ModalAgregarPlatillo').modal('hide');
        $('#FormularioAgregarPlatillo')[0].reset();
        $('#TablaPlatillos').DataTable().destroy();
        MostrarTablaPlatillos();
      } else {
        toastr['error'](respuesta.Mensaje);
      }
    },
  });
});


$(document).on('click', '#EditarPlatillo', function(e) {
  e.preventDefault();

  var buscarID = $(this).attr('ID_Seleccionado');

  $.ajax({
    type: 'post',
    url: base_url + 'Platillos/ControlPlatillos/BuscarPlatillo',
    data: {
      buscarID: buscarID,
    },
    dataType: 'json',
    success: function(informacionPlatillo) {
      $('#ModalModificarPlatillo').modal('show');
      $('#ID_Actual').val(informacionPlatillo.DatoPlatillo.id_platillo)
      $('#NombreModificado').val(informacionPlatillo.DatoPlatillo.nombre_platillo)
      $('#CostoModificado').val(informacionPlatillo.DatoPlatillo.costo)
      $('#DescripcionModificada').val(informacionPlatillo.DatoPlatillo.descripcion)
      $('#MostrarImagenActual').html(`
          <img class="rounded img-thumbnail" src="ControlPlatillos/Foto/${informacionPlatillo.DatoPlatillo.id_platillo}" width="250" height="250">
        `);
    },
  });
});


$(document).on('click', '#ActualizarPlatillo', function(e) {
  e.preventDefault();

  var actualID = $('#ID_Actual').val();
  var nombreModificado = $('#NombreModificado').val();
  var costoModificado = $('#CostoModificado').val();
  var descripcionModificada = $('#DescripcionModificada').val();
  var imagenModificada = $('#ImagenModificada')[0].files[0];

  var modificarInformacion = new FormData();
  modificarInformacion.append('actualID', actualID);
  modificarInformacion.append('nombre_platillo', nombreModificado);
  modificarInformacion.append('costo', costoModificado);
  modificarInformacion.append('descripcion', descripcionModificada);

  if ($('#ImagenModificada')[0].files.length > 0) {
    modificarInformacion.append('foto', imagenModificada);
  }

  $.ajax({
    type: 'post',
    url: base_url + 'Platillos/ControlPlatillos/ActualizarPlatillo',
    data: modificarInformacion,
    processData: false,
    contentType: false,
    dataType: 'json',
    enctype: 'multipart/form-data',
    success: function(respuesta) {
      if (respuesta.Resultado == "Exitoso") {
        toastr['success'](respuesta.Mensaje);
        $('#ModalModificarPlatillo').modal('hide');
        $('#FormularioEditarPlatillo')[0].reset();
        $('#TablaPlatillos').DataTable().destroy();
        MostrarTablaPlatillos();
      } else {
        toastr['error'](respuesta.Mensaje);
      }
    },
  });
});


$(document).on('click', '#BorrarPlatillo', function(e) {
  e.preventDefault();

  var eliminarID = $(this).attr('ID_Seleccionado');

  Swal.fire({
    title: "¿Estás seguro de eliminar el platillo seleccionado?",
    text: "¡Esta acción es irreversible!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#dd3333",
    confirmButtonText: "¡Si, eliminalo!",
    cancelButtonText: "¡No, cancelar!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: 'post',
        url: base_url + 'Platillos/ControlPlatillos/EliminarPlatillo',
        data: {
          eliminarID: eliminarID,
        },
        dataType: 'json',
        success: function(consulta) {
          if (consulta.Resultado == "Exitoso") {
            Swal.fire(
              "¡Eliminado!",
              "El platillo fue eliminado",
              'success'
            );
            $('#TablaPlatillos').DataTable().destroy();
            MostrarTablaPlatillos();
          }
        },
      });
    }
  });
});


$AgregarImagen.addEventListener('change', () => {
  const archivos = $AgregarImagen.files;
  if (!archivos || !archivos.length) {
    $MostrarImagenSeleccionada.src = "";
    $MostrarImagenSeleccionada.width = "0";
    $MostrarImagenSeleccionada.height = "0";
    return;
  }
  const primerArchivo = archivos[0];
  const objectURL = URL.createObjectURL(primerArchivo);
  $MostrarImagenSeleccionada.src = objectURL;
  $MostrarImagenSeleccionada.width = "250";
  $MostrarImagenSeleccionada.height = "250";
});


$ImagenModificada.addEventListener('change', () => {
  const archivos = $ImagenModificada.files;
  if (!archivos || !archivos.length) {
    $MostrarImagenModificada.src = "";
    $MostrarImagenModificada.width = "0";
    $MostrarImagenModificada.height = "0";
    return;
  }
  const primerArchivo = archivos[0];
  const objectURL = URL.createObjectURL(primerArchivo);
  $MostrarImagenModificada.src = objectURL;
  $MostrarImagenModificada.width = "250";
  $MostrarImagenModificada.height = "250";
});


var idiomaEspañolTablaPlatillos = {
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
