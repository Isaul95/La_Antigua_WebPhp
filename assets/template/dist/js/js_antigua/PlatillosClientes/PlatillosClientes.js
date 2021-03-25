$(document).ready(function() {
  VisualizarPlatillos();
});


function VisualizarPlatillos() {
  $.ajax({
    type: 'get',
    url: base_url + 'PlatillosClientes/ControlPlatillosClientes/MostrarPlatillos',
    dataType: 'json',
    success: function(tablaPlatillos) {
      var textoHTML='';
      for (var platillo = 0; platillo < tablaPlatillos.length; platillo++) {
        textoHTML+= ""
          + "<div class=\"col-sm-4 col-md-4\">"
            + "<div class=\"thumbnail\" style=\"width:100%;\">"
              + "<img id=\"Ima" + platillo + "\" src=\"ControlPlatillosClientes/Foto/" + tablaPlatillos[platillo].id_platillo + "\""
              + "class=\"img-fluid card-img-top\" style=\"width:100%; height: 300px !important;\">"
              + "<div class=\"caption\" style=\"width:100%;\">"
                + "<h3>" + tablaPlatillos[platillo].nombre_platillo + "</h3>"
                + "<h4>$" + tablaPlatillos[platillo].costo + "</h4>"
                + "<textarea class=\"text-justify\" style=\"border: none; resize: none; width:100%;\" rows=\"3\" readonly>"
                + tablaPlatillos[platillo].descripcion + "</textarea>"
              + "</div>"
            + "</div>"
          + "</div>"
      }
      $('#Platillos').html(textoHTML);
    },
  });
}
