/**
 * Script para gestión de horarios de atención
 * Sistema de Gestión Clínica
 *
 * Requiere:
 *  - CONFIG.API_BASE_URL
 *  - CONFIG.API_AUTH_HEADER  (por ejemplo "Bearer eyJh...")
 *  - SweetAlert2 (Swal)
 *  - Bootstrap 5
 *  - DataTables
 */

/*=============================================
EDITAR HORARIO (abrir modal con datos existentes)
=============================================*/
$(document).on("click", ".btnEditarDisponibilidad", function () {

  var diusId = $(this).attr("diusId");
  console.log("ID del horario a editar:", diusId);

  var settings = {
    url: `${CONFIG.API_BASE_URL}disponibilidad/${diusId}`, // GET /disponibilidad/{diusId}
    method: "GET",
    timeout: 0,
    headers: {
      "Authorization": CONFIG.API_AUTH_HEADER
    }
  };

  $.ajax(settings)
    .done(function (response) {

      // Soporte si backend responde string
      if (typeof response === 'string') {
        response = JSON.parse(response);
      }

      console.log("Respuesta del horario:", response);

      // Asumimos que la API responde algo tipo:
      // {
      //   "data": {
      //     "diusId": 12,
      //     "diusHoraInicio": "09:00",
      //     "diusHoraFin": "13:00",
      //     "diusDuracion": 20,
      //     "diusEstado": 1,
      //     "usuario": { "usuaNombrecompleto": "Dr. Juan", "usuaId": 5 },
      //     "dia": { "diaId": 1, "dia": "Lunes" }
      //   }
      // }

      if (response && response.data) {

        var horario = response.data;

        // Llenar el formulario del modal Editar
        $("#editDiusId").val(horario.diusId); // hidden
        $("#editUsuarioNombre").val(horario.usuario?.usuaNombrecompleto || ""); // lectura
        $("#editDiaNombre").val(horario.dia?.dia || ""); // lectura

        $("#editHoraInicio").val(horario.diusHoraInicio || "");
        $("#editHoraFin").val(horario.diusHoraFin || "");
        $("#editDuracion").val(horario.diusDuracion || "");

        // Estado (1 activo / 0 inactivo)
        $("#editEstado").val(horario.diusEstado != null ? horario.diusEstado : 1);

        // Abrir modal
        const modalElement = document.getElementById('modalEditarHorario');
        const modal = new bootstrap.Modal(modalElement);
        modal.show();

      } else {
        console.error("Estructura inesperada o sin datos.");
        Swal.fire({
          icon: "error",
          title: "No se pudo cargar el horario seleccionado",
          showConfirmButton: true
        });
      }
    })
    .fail(function (xhr, status, error) {
      console.error("Error al obtener horario:", error);
      console.error("Detalle:", xhr.responseText);
      Swal.fire({
        icon: "error",
        title: "Error al cargar los datos del horario",
        showConfirmButton: true
      });
    });
});


/*=============================================
CONFIRMAR EDICIÓN DEL HORARIO (PUT)
=============================================*/
$(document).ready(function () {

  $("#formEditarHorario").on("submit", function (event) {
    event.preventDefault(); // Evita recarga

    // Capturar valores del formulario
    var diusId        = $("#editDiusId").val();
    var horaInicio    = $("#editHoraInicio").val();
    var horaFin       = $("#editHoraFin").val();
    var duracion      = $("#editDuracion").val();
    var estado        = $("#editEstado").val(); // 1 activo, 0 inactivo

    console.log("Horario a editar:", {
      diusId,
      horaInicio,
      horaFin,
      duracion,
      estado
    });

    var settings = {
      url: `${CONFIG.API_BASE_URL}disponibilidad/${diusId}`, // PUT /disponibilidad/{diusId}
      method: "PUT",
      timeout: 0,
      headers: {
        "Content-Type": "application/json",
        "Authorization": CONFIG.API_AUTH_HEADER
      },
      data: JSON.stringify({
        diusHoraInicio: horaInicio,
        diusHoraFin: horaFin,
        diusDuracion: duracion,
        diusEstado: estado
      }),
      success: function (response) {
        console.log("Respuesta del servidor (editar horario):", response);

        if (response.success) {
          Swal.fire({
            icon: "success",
            title: response.message || "Horario actualizado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
          }).then(function (result) {
            if (result.value) {
              window.location = "horarios"; // recarga la vista
            }
          });
        } else {
          Swal.fire({
            icon: "warning",
            title: response.message || "Hubo un problema al actualizar el horario",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("Error al editar horario:", error);
        console.error("Detalle:", xhr.responseText);

        Swal.fire({
          icon: "error",
          title: "No se pudo actualizar el horario. Revisa los datos.",
          showConfirmButton: true,
          confirmButtonText: "Cerrar"
        });
      }
    };

    $.ajax(settings).done(function (response) {
      console.log("Respuesta final backend (PUT):", response);
    });

  });

});


/*=============================================
ELIMINAR HORARIO
=============================================*/
$(document).on("click", ".btnEliminarDisponibilidad", function () {

  var diusId = $(this).attr("diusId");
  console.log("ID del horario a eliminar:", diusId);

  Swal.fire({
    title: '¿Está seguro de eliminar este horario?',
    text: "Esta acción no se puede deshacer.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Sí, eliminar'
  }).then(function (result) {

    if (result.value) {

      console.log("Eliminando horario:", diusId);

      var settings = {
        url: `${CONFIG.API_BASE_URL}dia-usuario/${diusId}`, // DELETE /disponibilidad/{diusId}
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
            title: response.message || "Horario eliminado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
          }).then(function (result2) {
            if (result2.value) {
              window.location = "horarios";
            }
          });
        })
        .fail(function (xhr, status, error) {
          console.error("Error al eliminar horario:", error);
          console.error("Detalle:", xhr.responseText);

          Swal.fire({
            icon: "error",
            title: "No se pudo eliminar el horario",
            text: "Por favor, intente nuevamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
          });
        });
    }
  });
});


/*=============================================
REGISTRAR NUEVO HORARIO
=============================================*/
$(document).ready(function () {

  $("#formRegistrarHorario").on("submit", function (event) {
    event.preventDefault(); // evita reload

    // Capturar campos del nuevo horario
    var usuarioId  = $("#regUsuarioId").val();  // idusuario (doctor)
    var diaId      = $("#regDiaId").val();      // id del día
    var horaInicio = $("#regHoraInicio").val(); // HH:mm
    var horaFin    = $("#regHoraFin").val();    // HH:mm
    var duracion   = $("#regDuracion").val();   // duración (min)
    var estado     = $("#regEstado").val();     // 1/0

    console.log("Horario a registrar:", {
        usuarioId,
        diaId,
        horaInicio,
        horaFin,
        duracion,
        estado
    });

    // Armar el JSON con la estructura correcta
    var data = {
        usuario: {
        usuaId: parseInt(usuarioId)
        },
        dia: {
        diasId: parseInt(diaId)
        },
        diusEstado: parseInt(estado),
        diusHoraInicio: horaInicio + ":00", // agregar segundos si solo tienes HH:mm
        diusHoraFin: horaFin + ":00",
        diusDuracion: parseInt(duracion)
    };

    var settings = {
        url: `${CONFIG.API_BASE_URL}dia-usuario`, // POST /disponibilidad
        method: "POST",
        headers: {
        "Content-Type": "application/json",
        "Authorization": CONFIG.API_AUTH_HEADER
        },
        data: JSON.stringify(data),
        success: function (response) {
        console.log("Respuesta del servidor (registrar horario):", response);

        if (response.success) {
            Swal.fire({
            icon: "success",
            title: response.message || "Horario registrado correctamente",
            confirmButtonText: "Cerrar"
            }).then(() => window.location = "horarios");
        } else {
            Swal.fire({
            icon: "warning",
            title: response.message || "Hubo un problema al registrar el horario",
            confirmButtonText: "Cerrar"
            });
        }
        },
        error: function (xhr, status, error) {
        console.error("Error al registrar horario:", error);
        console.error("Detalle:", xhr.responseText);

        Swal.fire({
            icon: "error",
            title: "No se pudo registrar el horario. Revisa los datos.",
            confirmButtonText: "Cerrar"
        });
        }
    };

    $.ajax(settings);
    });


});


/*=============================================
DATATABLE
=============================================*/
$(document).ready(function () {
  if ($('#tablaHorario').length) {
    $('#tablaHorario').DataTable({
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
      },
      responsive: true,
      pageLength: 10
    });
  }
});
