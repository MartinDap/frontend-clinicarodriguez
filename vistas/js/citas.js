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

/*=============================================
MODAL EDITAR CITA
=============================================*/
  document.addEventListener("click", function (event) {

    // Delegación de eventos para botones con clase .btnEditarCita
    const btn = event.target.closest(".btnEditarCita");
    if (!btn) return;

    const citaId = btn.getAttribute("citaId");
    console.log("ID de la cita:", citaId);

    const url = `${CONFIG.API_BASE_URL}citas/${citaId}`;

    fetch(url, {
      method: "GET",
      headers: {
        "Authorization": CONFIG.API_AUTH_HEADER
      }
    })
    .then(async (res) => {
      // Leer como texto primero (por si el backend no siempre devuelve JSON)
      let responseText = await res.text();
      let response;

      try {
        response = JSON.parse(responseText);
      } catch (e) {
        console.warn("La respuesta no es un JSON válido:", responseText);
        throw new Error("Respuesta no válida del servidor");
      }

      console.log("Respuesta de la cita:", response);

      if (!response || !response.data) {
        throw new Error("La estructura del JSON no es la esperada (falta 'data').");
      }

      const cita = response.data;
      const paciente = cita.paciente || {};
      const pacientePersona = (paciente.persona) || {};
      const medico = cita.medico || {};
      const medicoPersona = (medico.persona) || {};

      // Helpers para formatos
      const formatDate = (value) => {
        if (!value) return "";
        // Si viene con hora tipo '2025-11-17T00:00:00' recortamos a 10
        return value.length > 10 ? value.slice(0, 10) : value;
      };

      const formatTime = (value) => {
        if (!value) return "";
        // '08:00:00' -> '08:00'
        return value.slice(0, 5);
      };

      // Llenar campos ocultos
      document.getElementById("editarCitaId").value      = cita.citaId || "";
      document.getElementById("editarCitaPaciId").value  = paciente.paciId || "";
      document.getElementById("editarCitaMediId").value  = medico.mediId || "";

      // Paciente
      document.getElementById("editarCitaPacienteNombre").value =
        pacientePersona.persNombrecompleto || "";

      document.getElementById("editarCitaPacienteDoc").value =
        (pacientePersona.persTipoDoc || "") + " " + (pacientePersona.persNroDoc || "");

      // Médico
      document.getElementById("editarCitaMedicoNombre").value =
        medicoPersona.persNombrecompleto || "";

      document.getElementById("editarCitaMedicoColegiatura").value =
        medico.mediNroColegiatura || "";

      // Fecha y horas
      document.getElementById("editarCitaFecha").value =
        formatDate(cita.citaFecha);

      document.getElementById("editarCitaHoraInicio").value =
        formatTime(cita.citaHora);

      document.getElementById("editarCitaHoraFin").value =
        formatTime(cita.citaHoraFin);

      // Tipo de cita y fecha de registro
      document.getElementById("editarCitaTipo").value =
        cita.citaTipo || "";

      document.getElementById("editarCitaFechaRegistro").value =
        formatDate(cita.citaFechaRegistro);

      // Motivo
      document.getElementById("editarCitaMotivo").value =
        cita.citaMotivo || "";

      // Estado (editable)
      const selectEstado = document.getElementById("editarCitaEstado");
      if (selectEstado) {
        selectEstado.value = cita.citaEstado || "";
      }

      // Abrir el modal con Bootstrap 5
      const modalElement = document.getElementById("modalEditarCita");
      const modal = new bootstrap.Modal(modalElement);
      modal.show();

    })
    .catch((error) => {
      console.error("Error al obtener la cita:", error);
      Swal.fire({
        icon: "error",
        title: "Error al cargar los datos de la cita",
        text: error.message || "Intente nuevamente.",
        showConfirmButton: true
      });
    });

    //confirmar edicion cita

    const formEditarCita = document.getElementById("formEditarCita");
    if (!formEditarCita) return;

    formEditarCita.addEventListener("submit", function (event) {
      event.preventDefault(); // Evita recarga

      // 1. Capturar valores del formulario
      const citaId        = document.getElementById("editarCitaId").value;
      const paciId        = document.getElementById("editarCitaPaciId").value;
      const mediId        = document.getElementById("editarCitaMediId").value;

      const citaFecha     = document.getElementById("editarCitaFecha").value;          // yyyy-MM-dd
      const citaHora      = document.getElementById("editarCitaHoraInicio").value;     // HH:mm
      const citaHoraFin   = document.getElementById("editarCitaHoraFin").value;        // HH:mm
      const citaTipo      = document.getElementById("editarCitaTipo").value;
      const citaMotivo    = document.getElementById("editarCitaMotivo").value;
      const citaEstado    = document.getElementById("editarCitaEstado").value;
      const citaFechaReg  = document.getElementById("editarCitaFechaRegistro").value;  // yyyy-MM-dd

      console.log("Cita a editar:", {
        citaId,
        paciId,
        mediId,
        citaFecha,
        citaHora,
        citaHoraFin,
        citaTipo,
        citaMotivo,
        citaEstado,
        citaFechaReg
      });

      // Validar que al menos el estado esté seleccionado
      if (!citaEstado) {
        Swal.fire({
          icon: "warning",
          title: "Debes seleccionar un estado para la cita.",
          showConfirmButton: true,
          confirmButtonText: "Cerrar"
        });
        return;
      }

      // 2. Armar el cuerpo EXACTO que necesita el backend
      const payload = {
        paciente: { paciId: Number(paciId) },
        medico:   { mediId: Number(mediId) },
        citaFecha: citaFecha,           // "2025-11-27"
        citaHora: citaHora,             // "08:00"
        citaHoraFin: citaHoraFin,       // "08:30"
        citaTipo: citaTipo,
        citaMotivo: citaMotivo,
        citaEstado: citaEstado,         // este es el que sí o sí se cambia
        citaFechaRegistro: citaFechaReg // normalmente igual a la original
      };

      console.log("Payload a enviar:", payload);

      // 3. Enviar al backend con fetch (PUT)
      fetch(`${CONFIG.API_BASE_URL}citas/${citaId}`, {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
          "Authorization": CONFIG.API_AUTH_HEADER
        },
        body: JSON.stringify(payload)
      })
      .then(async (res) => {
        let responseBody = {};
        try {
          responseBody = await res.json();
        } catch (e) {
          console.warn("La respuesta no es JSON válido.");
        }

        console.log("Respuesta del servidor:", responseBody);

        if (res.ok && responseBody.success) {
          Swal.fire({
            icon: "success",
            title: responseBody.message || "La cita ha sido modificada correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
          }).then((result) => {
            if (result.value) {
              // Redirigir a la lista de citas (ajusta la ruta si usas otra)
              window.location = "citas";
            }
          });
        } else {
          Swal.fire({
            icon: "warning",
            title: responseBody.message || "Hubo un problema al editar la cita",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
          });
        }
      })
      .catch((error) => {
        console.error("Error al editar la cita:", error);
        Swal.fire({
          icon: "error",
          title: "No se pudo editar la cita. Revisa los datos o inténtalo nuevamente.",
          showConfirmButton: true,
          confirmButtonText: "Cerrar"
        });
      });

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
