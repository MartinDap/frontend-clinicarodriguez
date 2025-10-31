


/*=============================================
REGISTRAR NUEVO ACTIVO TECNOLÓGICO
=============================================*/
$(document).ready(function () {

  $("#formRegistrarActivo").submit(function (event) {
    event.preventDefault(); // evita recargar la página

    // Capturar campos del formulario
    var codigoActivo    = $("#acteCodigoActivo").val().trim();
    var nombreEquipo    = $("#acteNombreEquipo").val().trim();
    var categoriaId     = $("#caacId").val();
    var marca           = $("#acteMarca").val().trim();
    var modelo          = $("#acteModelo").val().trim();
    var numeroSerie     = $("#acteNumeroSerie").val().trim();
    var fechaCompra     = $("#acteFechaCompra").val();
    var estado          = $("#acteEstado").val();
    var ubicacion       = $("#acteUbicacion").val().trim();
    var usuarioId       = $("#usuaId").val();
    var vidaUtilAnios   = $("#acteVidaUtilAnios").val();
    var fechaBaja       = $("#acteFechaBaja").val();
    var observaciones   = $("#acteObservaciones").val().trim();

    // Validar campos obligatorios
    if (!codigoActivo || !nombreEquipo || !categoriaId || !usuarioId || !estado || !ubicacion || !fechaCompra) {
      Swal.fire({
        icon: "warning",
        title: "Complete todos los campos obligatorios antes de registrar.",
        confirmButtonText: "Cerrar"
      });
      return;
    }

    // Construir el JSON con la estructura que espera el backend
    var data = {
      acteCodigoActivo: codigoActivo,
      acteNombreEquipo: nombreEquipo,
      categoria: {
        caacId: parseInt(categoriaId)
      },
      acteMarca: marca,
      acteModelo: modelo,
      acteNumeroSerie: numeroSerie,
      acteFechaCompra: fechaCompra,
      acteEstado: estado,
      acteUbicacion: ubicacion,
      usuario: {
        usuaId: parseInt(usuarioId)
      },
      acteVidaUtilAnios: vidaUtilAnios ? parseInt(vidaUtilAnios) : null,
      acteFechaBaja: fechaBaja || null,
      acteObservaciones: observaciones
    };

    // Configuración del AJAX
    $.ajax({
      url: `${CONFIG.API_BASE_URL}activos-tecnologicos`, // cambia si tu endpoint tiene otro nombre
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "Authorization": CONFIG.API_AUTH_HEADER
      },
      data: JSON.stringify(data),
      success: function (response) {
        console.log("Respuesta del servidor (registrar activo):", response);

        if (response.success) {
          Swal.fire({
            icon: "success",
            title: response.message || "Activo registrado correctamente",
            confirmButtonText: "Cerrar"
          }).then(() => window.location = "activos"); // redirige o recarga la lista
        } else {
          Swal.fire({
            icon: "warning",
            title: response.message || "Hubo un problema al registrar el activo",
            confirmButtonText: "Cerrar"
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("Error al registrar activo:", error);
        console.error("Detalle:", xhr.responseText);

        Swal.fire({
          icon: "error",
          title: "No se pudo registrar el activo. Revisa los datos.",
          confirmButtonText: "Cerrar"
        });
      }
    });
  });

});



$(document).ready(function() {
  if ($('#tablaActivos').length) {

    // Si ya existe una instancia, destrúyela antes
    if ($.fn.DataTable.isDataTable('#tablaActivos')) {
      $('#tablaActivos').DataTable().clear().destroy();
    }

    // Luego inicializa normalmente
    $('#tablaActivos').DataTable({
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
      },
      responsive: true,
      pageLength: 10
    });
  }
});