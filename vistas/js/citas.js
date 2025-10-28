/**
 * Script para gestión de citas médicas
 * Sistema de Gestión Clínica
 */

/*=============================================
ELIMINAR HORARIO
=============================================*/
$(document).on("click", ".btnEliminarCita", function () {

  var citaId = $(this).attr("citaId");
  console.log("ID de la cita a eliminar:", citaId);

  Swal.fire({
    title: '¿Está seguro de eliminar esta cita?',
    text: "Esta acción no se puede deshacer.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Sí, eliminar'
  }).then(function (result) {

    if (result.value) {

      console.log("Eliminando cita:", citaId);

      var settings = {
        url: `${CONFIG.API_BASE_URL}citas/${citaId}`, // DELETE /disponibilidad/{citaId}
        method: "DELETE",
        timeout: 0,
        headers: {
          "Authorization": CONFIG.API_AUTH_HEADER
        }
      };

      $.ajax(settings)
        .done(function (response) {
          console.log("Respuesta (eliminar horario):", response);

          Swal.fire({
            icon: "success",
            title: response.message || "Cita eliminado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
          }).then(function (result2) {
            if (result2.value) {
              window.location = "citas";
            }
          });
        })
        .fail(function (xhr, status, error) {
          console.error("Error al eliminar cita:", error);
          console.error("Detalle:", xhr.responseText);

          Swal.fire({
            icon: "error",
            title: "No se pudo eliminar la cita",
            text: "Por favor, intente nuevamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
          });
        });
    }
  });
});


/*=============================================
REGISTRAR NUEVA CITA
=============================================*/
$(document).ready(function () {

    $("#formRegistrarCita").submit(function (event) {
    event.preventDefault(); // evita recarga del formulario

    // Capturar campos del formulario
    var doctorId   = $("#doctorId").val();
    var pacienteId = $("#pacienteId").val();
    var fecha      = $("#fecha").val();
    var hora       = $("#hora").val();
    var estado     = $("#estado").val();

    // Validar campos básicos
    if (!doctorId || !pacienteId || !fecha || !hora) {
      Swal.fire({
        icon: "warning",
        title: "Complete todos los campos antes de registrar.",
        confirmButtonText: "Cerrar"
      });
      return;
    }

    // Construir JSON con estructura esperada por el backend
    var data = {
      usuario: {
        usuaId: parseInt(doctorId)
      },
      paciente: {
        paciId: parseInt(pacienteId)
      },
      citaFecha: fecha,
      citaFechaImpresion: fecha, // puedes ajustarlo si cambia
      citaHora: hora + ":00",
      citaCupo: 1,
      citaEstado: estado
    };

    // Configuración AJAX
    var settings = {
      url: `${CONFIG.API_BASE_URL}citas`, // tu endpoint
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "Authorization": CONFIG.API_AUTH_HEADER // el token Bearer que usas
      },
      data: JSON.stringify(data),
      success: function (response) {
        console.log("Respuesta del servidor (registrar cita):", response);

        if (response.success) {
          Swal.fire({
            icon: "success",
            title: response.message || "Cita registrada correctamente",
            confirmButtonText: "Cerrar"
          }).then(() => window.location = "citas"); // redirige si deseas
        } else {
          Swal.fire({
            icon: "warning",
            title: response.message || "Hubo un problema al registrar la cita",
            confirmButtonText: "Cerrar"
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("Error al registrar cita:", error);
        console.error("Detalle:", xhr.responseText);

        Swal.fire({
          icon: "error",
          title: "No se pudo registrar la cita. Revisa los datos.",
          confirmButtonText: "Cerrar"
        });
      }
    };

    $.ajax(settings);
  });


});


$(document).ready(function() {
  
  // Inicializar DataTable de citas
  if ($('#tablaCitas').length) {
    $('#tablaCitas').DataTable({
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
      },
      responsive: true,
      order: [[3, 'desc']] // Ordenar por fecha descendente
    });
  }
  
});
