

/*=============================================
VISUALIZAR HISTORIA
=============================================*/
// Ya no se necesita, ahora usamos enlaces directos <a href="">

$(document).on("click", ".btnVerHistoria", function() {
  var histId = $(this).attr("histId");
  window.location.href = `index.php?ruta=ver-historia&histId=${histId}`;
});




$(document).ready(function() {
  
  // Inicializar DataTable de citas
  if ($('#tablaHistorias').length) {
    $('#tablaHistorias').DataTable({
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
      },
      responsive: true,
      order: [[3, 'desc']] // Ordenar por fecha descendente
    });
  }
  
});