

document.addEventListener("click", function(event) {
  const btn = event.target.closest("#btnCompletarPaciente");
  if (!btn) return;

  const pacId = btn.getAttribute("data-pacId");

  console.log("Cargando datos del paciente con ID:", pacId);
  // Aquí llamas a tu API para obtener los datos completos del paciente
  fetch(`${CONFIG.API_BASE_URL}pacientes/${pacId}`, {
    headers: {
      "Authorization": CONFIG.API_AUTH_HEADER
    }
  })
    .then(r => r.json())
    .then(res => {
      const p = res.data.persona;

      // Rellenar los inputs
      document.getElementById("pacIdEditar").value = res.data.paciId;
      document.getElementById("persIdEditar").value = p.persId;

      document.getElementById("editNombreCompleto").value = p.persNombrecompleto ?? "";
      document.getElementById("editTipoDoc").value = p.persTipoDoc ?? "";
      document.getElementById("editNroDoc").value = p.persNroDoc ?? "";
      document.getElementById("editSexo").value = p.persSexo ?? "";
      document.getElementById("editFecNacimiento").value = p.persFecNacimiento ?? "";
      document.getElementById("editEstadoCivil").value = p.persEstadoCivil ?? "";
      document.getElementById("editTelefono").value = p.persTelefono ?? "";
      document.getElementById("editEmail").value = p.persEmail ?? "";
      document.getElementById("editDireccion").value = p.persDireccion ?? "";
      document.getElementById("editFotoUrl").value = p.persFoto ?? "";
      document.getElementById("editApoderadoId").value = p.apoderadoPersId ?? "";
    });

});


/*=============================================
  CONFIRMAR EDITAR / COMPLETAR PACIENTE (VANILLA JS)
=============================================*/
document.addEventListener("DOMContentLoaded", function () {

  const formCompletar = document.getElementById("formCompletarPaciente");
  if (!formCompletar) return;

  formCompletar.addEventListener("submit", async function (event) {
    event.preventDefault(); // Evita recarga

    // 1. Capturar valores del formulario
    const pacId            = document.getElementById("pacIdEditar")?.value?.trim();
    const nombrecompleto   = document.getElementById("editNombreCompleto")?.value?.trim();
    const tipoDoc          = document.getElementById("editTipoDoc")?.value?.trim();
    const nroDoc           = document.getElementById("editNroDoc")?.value?.trim();
    const sexo             = document.getElementById("editSexo")?.value?.trim();
    const fecNacimiento    = document.getElementById("editFecNacimiento")?.value?.trim();
    const estadoCivil      = document.getElementById("editEstadoCivil")?.value?.trim();
    const telefono         = document.getElementById("editTelefono")?.value?.trim();
    const email            = document.getElementById("editEmail")?.value?.trim();
    const direccion        = document.getElementById("editDireccion")?.value?.trim();
    const fotoUrlInput     = document.getElementById("editFotoUrl")?.value?.trim();
    const apoderadoInput   = document.getElementById("editApoderadoId")?.value?.trim();

    const fotoUrl          = fotoUrlInput !== "" ? fotoUrlInput : null;
    const apoderadoPersId  = apoderadoInput !== "" ? apoderadoInput : null;

    console.log("Paciente a editar / completar:", {
      pacId,
      nombrecompleto,
      tipoDoc,
      nroDoc,
      sexo,
      fecNacimiento,
      estadoCivil,
      telefono,
      email,
      direccion,
      fotoUrl,
      apoderadoPersId
    });

    if (!pacId) {
      Swal.fire({
        icon: "warning",
        title: "Falta el ID del paciente",
        text: "No se puede editar sin el identificador del paciente.",
        confirmButtonText: "Cerrar"
      });
      return;
    }

    // 2. Confirmación antes de enviar
    const confirmResult = await Swal.fire({
      icon: "question",
      title: "¿Guardar cambios del paciente?",
      text: "Se actualizarán los datos del paciente en el sistema.",
      showCancelButton: true,
      confirmButtonText: "Sí, guardar",
      cancelButtonText: "Cancelar"
    });

    if (!confirmResult.isConfirmed) {
      return;
    }

    // 3. Construir payload según tu API
    const payload = {
      nombrecompleto: nombrecompleto,
      tipoDoc: tipoDoc,
      nroDoc: nroDoc,
      sexo: sexo,
      fecNacimiento: fecNacimiento,
      estadoCivil: estadoCivil,
      telefono: telefono,
      email: email,
      direccion: direccion,
      fotoUrl: fotoUrl,
      apoderadoPersId: apoderadoPersId
    };

    console.log("Payload enviado a backend:", payload);

    try {
      const response = await fetch(`${CONFIG.API_BASE_URL}pacientes/editar/${pacId}`, {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
          "Authorization": CONFIG.API_AUTH_HEADER
        },
        body: JSON.stringify(payload)
      });

      let data = null;
      try {
        data = await response.json();
      } catch (e) {
        // Si la respuesta no tiene JSON
        data = null;
      }

      console.log("Respuesta del servidor (editar paciente):", data);

      if (!response.ok || (data && data.success === false)) {
        const msg = (data && data.message) || `Error al editar paciente (HTTP ${response.status})`;
        Swal.fire({
          icon: "warning",
          title: "No se pudo editar el paciente",
          text: msg,
          confirmButtonText: "Cerrar"
        });
        return;
      }

      // Éxito
      Swal.fire({
        icon: "success",
        title: (data && data.message) || "El paciente ha sido modificado correctamente",
        confirmButtonText: "Cerrar"
      }).then((result) => {
        if (result.isConfirmed) {
          // Recargar o redirigir a la lista de pacientes
          window.location.reload();
        }
      });

    } catch (error) {
      console.error("Error al editar paciente:", error);

      Swal.fire({
        icon: "error",
        title: "No se pudo editar el paciente",
        text: error.message || "Ocurrió un error inesperado. Revisa los datos e inténtalo nuevamente.",
        confirmButtonText: "Cerrar"
      });
    }

  });
});


/*=============================================
INICIAR TRIAJE
=============================================*/
document.addEventListener('DOMContentLoaded', function () {
  const fechaTriaje = document.getElementById("triaFecha");
  
  fechaTriaje.value = new Date().toISOString().split("T")[0];

  const epclFecha = document.getElementById("epclFecha");
  const now = new Date();
  const year = now.getFullYear();
  const month = String(now.getMonth() + 1).padStart(2, "0");
  const day = String(now.getDate()).padStart(2, "0");
  const hours = String(now.getHours()).padStart(2, "0");
  const minutes = String(now.getMinutes()).padStart(2, "0");

  const formatted = `${year}-${month}-${day}T${hours}:${minutes}`;
  epclFecha.value = formatted;

  /* =============================================
     1) INICIAR ATENCIÓN MÉDICA (BOTÓN DE ARRIBA)
     ============================================= */
  const btnIniciarAtencion = document.getElementById("btnIniciarTriajeEpisodio");
  if (btnIniciarAtencion) {
    btnIniciarAtencion.addEventListener("click", function (event) {
      event.preventDefault();

      Swal.fire({
        title: "Iniciar atención médica",
        html: `
          <p>Vas a iniciar la atención médica de este paciente.</p>
          <p class="mb-2">
            <strong>Flujo:</strong><br>
            1. Primero se registrará el <strong>Triaje</strong> (signos vitales, peso, talla, etc).<br>
            2. Luego se registrará el <strong>Episodio Clínico</strong> (motivo, diagnóstico, tratamiento).
          </p>
          <small>Si continúas, se abrirá el formulario de triaje.</small>
        `,
        icon: "info",
        showCancelButton: true,
        confirmButtonText: "Sí, iniciar atención",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
          const modalTriajeEl = document.getElementById("modalIniciarTriaje");
          const modalTriaje = new bootstrap.Modal(modalTriajeEl);
          modalTriaje.show();
        }
      });
    });
  }

  const formTriaje = document.getElementById("formIniciarTriaje");

  if (formTriaje) {
    formTriaje.addEventListener("submit", function (event) {
      event.preventDefault();

      Swal.fire({
        title: "¿Guardar triaje y continuar?",
        html: `
          <p>Se guardará la información del triaje y luego pasarás a registrar el episodio clínico.</p>
          <p class="mb-0">
            <small>
              Si presionas <strong>Cancelar</strong>, la información registrada en este triaje se perderá.
            </small>
          </p>
        `,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, guardar y continuar",
        cancelButtonText: "Cancelar (perder datos)"
      }).then(async (result) => {

        const modalTriajeEl = document.getElementById("modalIniciarTriaje");
        const modalTriaje = bootstrap.Modal.getInstance(modalTriajeEl);

        if (result.isConfirmed) {

          // Capturar los valores del formulario
          const histId = document.getElementById("histIdTriaje").value.trim();
          const triaFecha = document.getElementById("triaFecha").value.trim();
          const triaTalla = document.getElementById("triaTalla").value.trim();
          const triaPeso = document.getElementById("triaPeso").value.trim();
          const triaTemp = document.getElementById("triaTemp").value.trim();
          const triaPresion = document.getElementById("triaPresion").value.trim();
          const triaFrecCardiaca = document.getElementById("triaFrecCardiaca").value.trim();
          const triaSaturacion = document.getElementById("triaSaturacion").value.trim();
          const triaObservaciones = document.getElementById("triaObservaciones").value.trim();

          // Validar que todos los campos estén llenos
          if (!triaFecha || !triaTalla || !triaPeso || !triaTemp || !triaPresion || !triaFrecCardiaca || !triaSaturacion) {
            Swal.fire({
              icon: "warning",
              title: "Por favor, complete todos los campos obligatorios.",
              confirmButtonText: "Cerrar"
            });
            return;
          }

          // Crear el objeto con los datos del triaje
          const data = {
            historia: { histId: histId },
            triaFecha: triaFecha,
            triaTalla: triaTalla,
            triaPeso: triaPeso,
            triaTemp: triaTemp,
            triaPresion: triaPresion,
            triaFrecCardiaca: triaFrecCardiaca,
            triaSaturacion: triaSaturacion,
            triaObservaciones: triaObservaciones,
            triaEstado: 1
          };

          console.log("Iniciando triaje:", data);

          // Realizar la solicitud POST con fetch
          fetch(`${CONFIG.API_BASE_URL}triaje`, {
            method: "POST",
            headers: {
              "Authorization": CONFIG.API_AUTH_HEADER,
              "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
          })
            .then(response => response.json())
            .then(data => {
              console.log("Respuesta del servidor (iniciar triaje):", data);

              Swal.fire({
                icon: "success",
                title: "Triaje guardado correctamente",
                confirmButtonText: "Continuar a episodio clínico"
              }).then(() => {
                // Cierra el modal de triaje
                if (modalTriaje) modalTriaje.hide();
                formTriaje.reset();

                // ABRIR MODAL DE EPISODIO CLÍNICO
                const modalEpisodioEl = document.getElementById("modalAgregarEpisodio");
                if (modalEpisodioEl) {
                  const modalEpisodio = new bootstrap.Modal(modalEpisodioEl);
                  modalEpisodio.show();
                } else {
                  // Si no existe el modal, como fallback recarga la página
                  window.location.reload();
                }
              });
            })
            .catch(error => {
              console.error("Error al iniciar triaje:", error);

              Swal.fire({
                icon: "error",
                title: "No se pudo guardar el triaje",
                text: error.message || "Verifica los datos e inténtalo nuevamente.",
                confirmButtonText: "Cerrar"
              });
            });

        } else if (result.dismiss === Swal.DismissReason.cancel) {
          // Canceló: perder datos y cerrar modal
          formTriaje.reset();
          if (modalTriaje) modalTriaje.hide();

          Swal.fire({
            icon: "info",
            title: "Triaje descartado",
            text: "La información ingresada en el triaje se ha perdido.",
            confirmButtonText: "Entendido"
          });
        }

      });
    });
  }

  /* =============================================
     3) FORMULARIO DE EPISODIO CLÍNICO
     - Confirmar antes de guardar
     ============================================= */
  const formEpisodio = document.getElementById("formAgregarEpisodio");

  if (formEpisodio) {
    formEpisodio.addEventListener("submit", function (event) {
      event.preventDefault();

      Swal.fire({
        title: "¿Guardar episodio clínico?",
        html: `
          <p>Se guardará el episodio clínico del paciente.</p>
          <p class="mb-0">
            <small>Podrás registrar nuevos episodios más adelante si es necesario.</small>
          </p>
        `,
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Sí, guardar",
        cancelButtonText: "Cancelar"
      }).then((result) => {

        const modalEpisodioEl = document.getElementById("modalAgregarEpisodio");
        const modalEpisodio = bootstrap.Modal.getInstance(modalEpisodioEl);

        if (result.isConfirmed) {

          // === AQUÍ VA TU CÓDIGO ORIGINAL DE EPISODIO CLÍNICO ===

          // Capturar los valores del formulario
          const histId = document.getElementById("histIdEpisodio").value.trim();
          const epclFecha = document.getElementById("epclFecha").value.trim();
          const epclTipo = document.getElementById("epclTipo").value.trim();
          const epclMotivoConsulta = document.getElementById("epclMotivoConsulta").value.trim();
          const epclDiagnostico = document.getElementById("epclDiagnostico").value.trim();
          const epclTratamiento = document.getElementById("epclTratamiento").value.trim();
          const epclObservaciones = document.getElementById("epclObservaciones").value.trim();

          // Validar que todos los campos estén llenos
          if (!epclFecha || !epclTipo || !epclMotivoConsulta || !epclDiagnostico || !epclTratamiento) {
            Swal.fire({
              icon: "warning",
              title: "Por favor, complete todos los campos obligatorios.",
              confirmButtonText: "Cerrar"
            });
            return;
          }

          // Crear el objeto con los datos del episodio clínico
          const data = {
            historia: { histId: histId },
            epclFecha: epclFecha,
            epclTipo: epclTipo,
            epclMotivoConsulta: epclMotivoConsulta,
            epclDiagnostico: epclDiagnostico,
            epclTratamiento: epclTratamiento,
            epclObservaciones: epclObservaciones,
            epclEstado: 1
          };

          console.log("Agregando episodio clínico:", data);

          // Realizar la solicitud POST con fetch
          fetch(`${CONFIG.API_BASE_URL}episodios-clinicos`, {
            method: "POST",
            headers: {
              "Authorization": CONFIG.API_AUTH_HEADER,
              "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
          })
            .then(response => response.json())
            .then(data => {
              console.log("Respuesta del servidor (agregar episodio clínico):", data);

              Swal.fire({
                icon: "success",
                title: "Episodio clínico agregado correctamente",
                confirmButtonText: "Aceptar"
              }).then(() => {
                if (modalEpisodio) modalEpisodio.hide();
                formEpisodio.reset();
                // Ahora sí recargas la página para actualizar tablas de triajes/episodios
                window.location.reload();
              });
            })
            .catch(error => {
              console.error("Error al agregar episodio clínico:", error);

              Swal.fire({
                icon: "error",
                title: "No se pudo guardar el episodio clínico",
                text: error.message || "Verifica los datos e inténtalo nuevamente.",
                confirmButtonText: "Cerrar"
              });
            });

        }

      });
    });
  }

  

});

/*=============================================
VER TRIAJE
=============================================*/
document.addEventListener("click", async function (event) {
  const btn = event.target.closest(".btnVerTriaje");
  if (!btn) return; // Si no se hizo clic en un botón de ver triaje, salir

  const triaId = btn.getAttribute("triaId");
  if (!triaId) {
    console.error("El botón no tiene atributo triaId");
    return;
  }

  console.log("Ver triaje con ID:", triaId);

  try {
    // Llamar al backend para obtener el triaje por ID
    const url = `${CONFIG.API_BASE_URL}triaje/${triaId}`;

    const response = await fetch(url, {
      method: "GET",
      headers: {
        "Authorization": CONFIG.API_AUTH_HEADER,
        "Content-Type": "application/json"
      }
    });

    if (!response.ok) {
      throw new Error(`Error HTTP ${response.status}`);
    }

    let data = await response.json();
    console.log("Respuesta detalle triaje:", data);

    // Manejar estructura: puede venir como { data: {...} } o directo {...}
    const triaje = data.data ? data.data : data;

    if (!triaje || typeof triaje !== "object") {
      throw new Error("La respuesta no contiene datos válidos de triaje");
    }

    // Llenar el modal con los datos del triaje
    const inputTriaId            = document.getElementById("verTriaId");
    const inputTriaFecha         = document.getElementById("verTriaFecha");
    const inputTriaTalla         = document.getElementById("verTriaTalla");
    const inputTriaPeso          = document.getElementById("verTriaPeso");
    const inputTriaTemp          = document.getElementById("verTriaTemp");
    const inputTriaPresion       = document.getElementById("verTriaPresion");
    const inputTriaFrecCardiaca  = document.getElementById("verTriaFrecCardiaca");
    const inputTriaSaturacion    = document.getElementById("verTriaSaturacion");
    const inputTriaObservaciones = document.getElementById("verTriaObservaciones");

    if (inputTriaId)            inputTriaId.value = triaje.triaId ?? "";
    if (inputTriaFecha)         inputTriaFecha.value = triaje.triaFecha ?? "";
    if (inputTriaTalla)         inputTriaTalla.value = triaje.triaTalla ?? "";
    if (inputTriaPeso)          inputTriaPeso.value = triaje.triaPeso ?? "";
    if (inputTriaTemp)          inputTriaTemp.value = triaje.triaTemp ?? "";
    if (inputTriaPresion)       inputTriaPresion.value = triaje.triaPresion ?? "";
    if (inputTriaFrecCardiaca)  inputTriaFrecCardiaca.value = triaje.triaFrecCardiaca ?? "";
    if (inputTriaSaturacion)    inputTriaSaturacion.value = triaje.triaSaturacion ?? "";
    if (inputTriaObservaciones) inputTriaObservaciones.value = triaje.triaObservaciones ?? "";
   

    // Mostrar el modal
    const modalElement = document.getElementById("modalVerTriaje");
    if (modalElement) {
      const modal = new bootstrap.Modal(modalElement);
      modal.show();
    } else {
      console.error("No se encontró el modal 'modalVerTriaje'.");
    }

  } catch (error) {
    console.error("Error al obtener detalle de triaje:", error);

    Swal.fire({
      icon: "error",
      title: "No se pudo cargar el detalle del triaje",
      text: error.message || "Intente nuevamente o recargue la página.",
      confirmButtonText: "Cerrar"
    });
  }
});

/*=============================================
VER EPISODIO CLINICO
=============================================*/
document.addEventListener("click", async function (event) {
  const btn = event.target.closest(".btnVerEpisodio");
  if (!btn) return; // Si el click no fue en un botón de ver episodio, salir

  const epclId = btn.getAttribute("epclId");
  if (!epclId) {
    console.error("El botón no tiene atributo epclId");
    return;
  }

  console.log("Ver recetas del episodio clínico con ID:", epclId);

  try {
    // 🔹 NUEVA URL: recetas por episodio
    const url = `${CONFIG.API_BASE_URL}recetas/episodio/${epclId}`;

    const response = await fetch(url, {
      method: "GET",
      headers: {
        "Authorization": CONFIG.API_AUTH_HEADER,
        "Content-Type": "application/json"
      }
    });

    if (!response.ok) {
      throw new Error(`Error HTTP ${response.status}`);
    }

    let resJson = await response.json();
    console.log("Respuesta recetas del episodio:", resJson);

    const recetas = Array.isArray(resJson.data) ? resJson.data : [];

    if (recetas.length === 0) {
      // Si no hay recetas, igual mostramos el modal con solo info del episodio básico
      Swal.fire({
        icon: "info",
        title: "Sin recetas registradas",
        text: "Este episodio clínico no tiene recetas asociadas.",
        confirmButtonText: "Cerrar"
      });
    }

    // Tomamos el episodio clínico desde la primera receta
    const episodio = recetas[0]?.episodioClinico;
    if (!episodio) {
      throw new Error("No se encontró información del episodio clínico en la respuesta.");
    }

    // ================================
    // 1) Llenar datos del episodio
    // ================================

    let fechaTexto = episodio.epclFecha || "";
    if (fechaTexto.includes("T")) {
      const [fecha, hora] = fechaTexto.split("T");
      fechaTexto = `${fecha} ${hora.substring(0, 5)}`; // HH:MM
    }

    const inputEpclId            = document.getElementById("verEpclId");
    const inputEpclFecha         = document.getElementById("verEpclFecha");
    const inputEpclTipo          = document.getElementById("verEpclTipo");
    const inputEpclMotivo        = document.getElementById("verEpclMotivoConsulta");
    const inputEpclDiagnostico   = document.getElementById("verEpclDiagnostico");
    const inputEpclTratamiento   = document.getElementById("verEpclTratamiento");
    const inputEpclObservaciones = document.getElementById("verEpclObservaciones");
    const inputEpclEstado        = document.getElementById("verEpclEstado");

    if (inputEpclId)            inputEpclId.value = episodio.epclId ?? "";
    if (inputEpclFecha)         inputEpclFecha.value = fechaTexto;
    if (inputEpclTipo)          inputEpclTipo.value = episodio.epclTipo ?? "";
    if (inputEpclMotivo)        inputEpclMotivo.value = episodio.epclMotivoConsulta ?? "";
    if (inputEpclDiagnostico)   inputEpclDiagnostico.value = episodio.epclDiagnostico ?? "";
    if (inputEpclTratamiento)   inputEpclTratamiento.value = episodio.epclTratamiento ?? "";
    if (inputEpclObservaciones) inputEpclObservaciones.value = episodio.epclObservaciones ?? "";

    if (inputEpclEstado) {
      const estadoTexto = episodio.epclEstado ? "Activo" : "Inactivo";
      inputEpclEstado.value = estadoTexto;
    }

    // =======================================
    // 2) Pintar las recetas y medicamentos
    // =======================================
    const contenedorRecetas = document.getElementById("listaRecetas");
    if (contenedorRecetas) {
      contenedorRecetas.innerHTML = ""; // limpiar antes de dibujar

      if (recetas.length === 0) {
        contenedorRecetas.innerHTML = `
          <div class="alert alert-warning mb-0">
            No hay recetas registradas para este episodio clínico.
          </div>
        `;
      } else {
        // Recorremos cada receta
        recetas.forEach((receta, index) => {
          let receFechaTexto = receta.receFecha || "";
          if (receFechaTexto.includes("T")) {
            const [f, h] = receFechaTexto.split("T");
            receFechaTexto = `${f} ${h.substring(0, 5)}`;
          }

          const estadoReceta = receta.receEstado ? "Activa" : "Inactiva";

          // Construimos las filas de medicamentos
          const filasMedicamentos = (receta.detalles || [])
            .map(detalle => `
              <tr>
                <td>${detalle.redeMedicamento ?? ""}</td>
                <td>${detalle.redePresentacion ?? ""}</td>
                <td>${detalle.redeDosis ?? ""}</td>
                <td>${detalle.redeFrecuencia ?? ""}</td>
                <td>${detalle.redeDuracion ?? ""}</td>
                <td>${detalle.redeViaAdministracion ?? ""}</td>
                <td>${detalle.redeObservaciones ?? ""}</td>
              </tr>
            `)
            .join("");

          const card = document.createElement("div");
          card.classList.add("card", "mb-3");

          card.innerHTML = `
            <div class="card-header d-flex justify-content-between align-items-center">
              <div>
                <strong>Receta #${receta.receId}</strong>
              </div>
              <small class="text-muted">
                Fecha: ${receFechaTexto}
              </small>
            </div>
            <div class="card-body">
              <p class="mb-1">
                <strong>Indicaciones:</strong><br>
                ${receta.receIndicaciones ?? ""}
              </p>
              <p class="mb-2">
                <strong>Estado de la receta:</strong> ${estadoReceta}
              </p>

              <div class="table-responsive">
                <table class="table table-sm table-bordered align-middle">
                  <thead class="table-light">
                    <tr>
                      <th>Medicamento</th>
                      <th>Presentación</th>
                      <th>Dosis</th>
                      <th>Frecuencia</th>
                      <th>Duración</th>
                      <th>Vía adm.</th>
                      <th>Observaciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    ${filasMedicamentos || `
                      <tr>
                        <td colspan="7" class="text-center text-muted">
                          Sin medicamentos registrados.
                        </td>
                      </tr>
                    `}
                  </tbody>
                </table>
              </div>
            </div>
          `;

          contenedorRecetas.appendChild(card);
        });
      }
    }

    // Mostrar el modal
    const modalElement = document.getElementById("modalVerEpisodio");
    if (modalElement) {
      const modal = new bootstrap.Modal(modalElement);
      modal.show();
    } else {
      console.error("No se encontró el modal 'modalVerEpisodio'.");
    }

  } catch (error) {
    console.error("Error al obtener recetas del episodio clínico:", error);

    Swal.fire({
      icon: "error",
      title: "No se pudo cargar la información",
      text: error.message || "Intente nuevamente o recargue la página.",
      confirmButtonText: "Cerrar"
    });
  }
});



/*=============================================
FUNCION OTROS
=============================================*/
document.addEventListener('DOMContentLoaded', function() {
    const selectTipo = document.getElementById('docTipo');
    const campoOtroContainer = document.getElementById('campoOtroContainer');
    const campoOtroInput = document.getElementById('docTipoOtro');
    
    selectTipo.addEventListener('change', function() {
        if (this.value === 'otro') {
            campoOtroContainer.style.display = 'block';
            campoOtroInput.setAttribute('required', 'required');
        } else {
            campoOtroContainer.style.display = 'none';
            campoOtroInput.removeAttribute('required');
        }
    });
    
    // Validación del formulario
    document.getElementById('formSubirDocumento').addEventListener('submit', function(e) {
        if (selectTipo.value === 'otro' && !campoOtroInput.value.trim()) {
            e.preventDefault();
            alert('Por favor, especifique el tipo de documento');
            campoOtroInput.focus();
        }
    });
});

/*=============================================
EDITAR DOCUMENTO
=============================================*/
let documentoActual = null;
document.addEventListener('click', function(e) {
    if (e.target.closest('.btnEditarDocumento')) {
        const btn = e.target.closest('.btnEditarDocumento');
        const docuId = btn.getAttribute('docuId');
        console.log("ID del documento:", docuId);
        
        // Hacer la petición GET para obtener los datos del documento
        fetch(`${CONFIG.API_BASE_URL}documentos/${docuId}`, {
            method: "GET",
            headers: {
                "Authorization": CONFIG.API_AUTH_HEADER
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log("Respuesta del documento:", data);
            
            // Validar que tenga las claves esperadas
            if (data && data.data && data.data.docuId) {
    
              // Guardar todos los datos en la variable global
              documentoActual = data.data;
              // Campos ocultos
              document.getElementById('editarDocId').value = data.data.docuId;
              document.getElementById('editarDocArchivo').value = data.data.docuUrl || '';
              
              // Campos de solo lectura (información del documento)
              document.getElementById('editarDocNombre').value = data.data.docuNombre || '';
              document.getElementById('editarDocTipo').value = data.data.docuTipo || '';
              
              // Enlace al archivo PDF
              const linkArchivo = document.getElementById('editarDocArchivoLink');
              if (data.data.docuUrl) {
                  linkArchivo.href = data.data.docuUrl;
                  linkArchivo.textContent = 'Ver documento actual';
              } else {
                  linkArchivo.href = '#';
                  linkArchivo.textContent = 'No hay archivo disponible';
              }
              
              // Campos editables (configuración de acceso)
              document.getElementById('editarVisiblePaciente').value = data.data.docuVisiblePaciente ? 'true' : 'false';
              document.getElementById('editarConfidencial').value = data.data.docuConfidencial ? 'true' : 'false';
              
              // Actualizar indicador de estado actual
              actualizarEstadoDocumento(data.data.docuVisiblePaciente, data.data.docuConfidencial);
              
              // Abrir el modal Bootstrap 5
              const modalElement = document.getElementById('modalEditarDocumento');
              const modal = new bootstrap.Modal(modalElement);
              modal.show();
              
          } else {
              console.error("La estructura del JSON no es la esperada o los datos están vacíos.");
              Swal.fire({
                  icon: "error",
                  title: "No se pudo cargar la información del documento",
                  showConfirmButton: true
              });
          }
        })
        .catch(error => {
            console.error("Error al obtener documento:", error);
            Swal.fire({
                icon: "error",
                title: "Error al cargar los datos del documento",
                showConfirmButton: true
            });
        });
    }
});

/*=============================================
ACTUALIZAR ESTADO DEL DOCUMENTO (UI)
=============================================*/
function actualizarEstadoDocumento(visiblePaciente, confidencial) {
    const textoEstado = document.getElementById('textoEstado');
    const estadoActual = document.getElementById('estadoActual');
    
    let mensaje = '';
    let claseAlerta = 'alert-info';
    
    if (visiblePaciente && !confidencial) {
        mensaje = 'El paciente puede ver este documento - Acceso estándar';
        claseAlerta = 'alert-success';
    } else if (visiblePaciente && confidencial) {
        mensaje = 'El paciente puede ver este documento - Marcado como confidencial';
        claseAlerta = 'alert-warning';
    } else if (!visiblePaciente && confidencial) {
        mensaje = 'Documento oculto para el paciente - Acceso restringido';
        claseAlerta = 'alert-danger';
    } else {
        mensaje = 'Documento oculto para el paciente - Acceso estándar del personal';
        claseAlerta = 'alert-secondary';
    }
    
    textoEstado.textContent = mensaje;
    estadoActual.className = `alert ${claseAlerta} p-2 small`;
}

/*=============================================
ACTUALIZAR ESTADO EN TIEMPO REAL (onChange)
=============================================*/
document.addEventListener('change', function(e) {
    if (e.target.id === 'editarVisiblePaciente' || e.target.id === 'editarConfidencial') {
        const visiblePaciente = document.getElementById('editarVisiblePaciente').value === 'true';
        const confidencial = document.getElementById('editarConfidencial').value === 'true';
        actualizarEstadoDocumento(visiblePaciente, confidencial);
    }
});

/*=============================================
CONFIRMAR EDITAR DOCUMENTO
=============================================*/
document.addEventListener('DOMContentLoaded', function() {
    const formEditarDocumento = document.getElementById('formEditarDocumento');
    
    if (formEditarDocumento) {
        formEditarDocumento.addEventListener('submit', function(event) {
            event.preventDefault(); // Evita recarga

            // Verificar que tenemos los datos del documento
            if (!documentoActual) {
                Swal.fire({
                    icon: "error",
                    title: "No se han cargado los datos del documento",
                    showConfirmButton: true
                });
                return;
            }
            
            // Capturar solo los valores editables del formulario
            const docuVisiblePaciente = document.getElementById('editarVisiblePaciente').value === 'true';
            const docuConfidencial = document.getElementById('editarConfidencial').value === 'true';
            
            // Construir el objeto completo con todos los campos requeridos
            const documentoActualizado = {
                historia: documentoActual.historia || { histId: documentoActual.histId },
                docuNombre: documentoActual.docuNombre,
                docuTipo: documentoActual.docuTipo,
                docuUrl: documentoActual.docuUrl,
                docuFechaSubida: documentoActual.docuFechaSubida,
                docuVisiblePaciente: docuVisiblePaciente,
                docuConfidencial: docuConfidencial,
                docuEstado: documentoActual.docuEstado !== undefined ? documentoActual.docuEstado : true
            };

            console.log("Documento a editar:");
            console.log(documentoActualizado);
            
            // Configurar la solicitud fetch
            fetch(`${CONFIG.API_BASE_URL}documentos/${documentoActual.docuId}`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": CONFIG.API_AUTH_HEADER
                },
                body: JSON.stringify(documentoActualizado)
            })
            .then(response => response.json())
            .then(data => {
                console.log("Respuesta del servidor:", data);
                
                if (data.success) {
                    Swal.fire({
                        icon: "success",
                        title: data.message || "El documento ha sido modificado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result) {
                        if (result.value || result.isConfirmed) {
                            // Cerrar el modal
                            const modalElement = document.getElementById('modalEditarDocumento');
                            const modal = bootstrap.Modal.getInstance(modalElement);
                            if (modal) {
                                modal.hide();
                            }
                            
                            // Recargar la página o actualizar la tabla
                            window.location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: data.message || "Hubo un problema al editar el documento",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    });
                }
            })
            .catch(error => {
                console.error("Error al editar documento:", error);
                
                Swal.fire({
                    icon: "error",
                    title: "No se pudo editar el documento. Revisa los datos.",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                });
            });
        });
    }
});

/*=============================================
SUBIR DOCUMENTO DEL PACIENTE
=============================================*/
document.addEventListener('DOMContentLoaded', function () {

  // Captura el evento de envío del formulario
  document.getElementById("formSubirDocumento").addEventListener("submit", function (event) {
    event.preventDefault(); // Evita recargar la página

    // Capturar los valores del formulario
    const histId = document.getElementById("histId").value.trim();
    const docNombre = document.getElementById("docNombre").value.trim();
    const archivo = document.getElementById("docArchivo").files[0];
    const docTipo = document.getElementById("docTipo").value.trim();
    const visiblePaciente = document.getElementById("visiblePaciente").value.trim();
    const confidencial = document.getElementById("confidencial").value.trim();

    // Validar que se haya seleccionado un archivo
    if (!archivo) {
      Swal.fire({
        icon: "warning",
        title: "Selecciona un archivo antes de subir.",
        confirmButtonText: "Cerrar"
      });
      return;
    }

    // Crear el FormData
    const formData = new FormData();
    formData.append("file", archivo);
    formData.append("histId", histId);
    formData.append("nombre", docNombre);
    formData.append("tipo", docTipo);
    formData.append("visiblePaciente", visiblePaciente);
    formData.append("confidencial", confidencial);

    console.log("Subiendo documento:", {
      histId,
      docNombre,
      archivo,
      docTipo,
      visiblePaciente,
      confidencial
    });

    // Realizar la solicitud POST con fetch
    fetch(`${CONFIG.API_BASE_URL}documentos/upload`, {
      method: "POST",
      headers: {
        "Authorization": CONFIG.API_AUTH_HEADER
      },
      body: formData
    })
      .then(response => response.json())
      .then(data => {
        console.log("Respuesta del servidor (subir documento):", data);

        Swal.fire({
          icon: "success",
          title: "Documento subido correctamente",
          confirmButtonText: "Aceptar"
        }).then(() => {
          // Cierra el modal
          const modal = bootstrap.Modal.getInstance(document.getElementById('modalSubirDocumento'));
          if (modal) modal.hide();

          // Recargar la página o la tabla de documentos
          window.location.reload();
        });
      })
      .catch(error => {
        console.error("Error al subir documento:", error);

        Swal.fire({
          icon: "error",
          title: "No se pudo subir el documento",
          text: error.message || "Verifica el archivo e inténtalo nuevamente.",
          confirmButtonText: "Cerrar"
        });
      });
  });

});

/*=============================================
ELIMINAR DOCUMENTO
=============================================*/
$(document).on("click", ".btnEliminarDocumento", function () {

  var docuId = $(this).attr("docuId");
  console.log("ID del DOCUMENTO  a eliminar:", docuId);

  Swal.fire({
    title: '¿Está seguro de eliminar este documento del paciente?',
    text: "Esta acción no se puede deshacer.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Sí, eliminar'
  }).then(function (result) {

    if (result.value) {

      console.log("Eliminando documento:", docuId);

      var settings = {
        url: `${CONFIG.API_BASE_URL}documentos/${docuId}`, // DELETE /disponibilidad/{diusId}
        method: "DELETE",
        timeout: 0,
        headers: {
          "Authorization": CONFIG.API_AUTH_HEADER
        }
      };

      $.ajax(settings)
        .done(function (response) {
          console.log("Respuesta (eliminar documento):", response);

          Swal.fire({
            icon: "success",
            title: response.message || "Documento eliminado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
          }).then(function (result2) {
            if (result2.value) {
              window.location.reload();
            }
          });
        })
        .fail(function (xhr, status, error) {
          console.error("Error al eliminar documento:", error);
          console.error("Detalle:", xhr.responseText);

          Swal.fire({
            icon: "error",
            title: "No se pudo eliminar el documento",
            text: "Por favor, intente nuevamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
          });
        });
    }
  });
});

async function cargarPdfEnModal(apiUrl) {
  const iframe = document.getElementById("iframeDocumento");

  try {
    const res = await fetch(apiUrl, {
      method: "GET",
      headers: {
        "Authorization": CONFIG.API_AUTH_HEADER
      }
    });

    if (!res.ok) {
      throw new Error("No se pudo cargar el documento");
    }

    const blob = await res.blob();
    const objectUrl = URL.createObjectURL(blob);

    iframe.src = objectUrl + "#toolbar=0&navpanes=0&scrollbar=0";

    const modalElement = document.getElementById("modalVerDocumento");
    const modal = new bootstrap.Modal(modalElement);
    modal.show();

    // Cuando se cierre el modal, limpiamos
    modalElement.addEventListener("hidden.bs.modal", () => {
      iframe.src = "";
      URL.revokeObjectURL(objectUrl);
    }, { once: true });

  } catch (error) {
    console.error("Error cargando documento:", error);
    Swal.fire({
      icon: "error",
      title: "No se pudo cargar el documento",
      text: "Intente nuevamente o contacte al administrador."
    });
  }
}

document.addEventListener("click", function (event) {
  const btn = event.target.closest(".btnVerDocumento");
  if (!btn) return;

  const apiUrl = btn.getAttribute("data-doc-url");
  if (!apiUrl) return;

  cargarPdfEnModal(apiUrl);
});


// Limpiar iframe al cerrar el modal
$('#modalVerDocumento').on('hidden.bs.modal', function () {
  $('#iframeDocumento').attr('src', '');
});

// Asignar el epclId al campo oculto cuando se abre el modal
$('.btnAgregarReceta').on('click', function() {
  const epclId = $(this).attr('epclId');
  $('#epclIdReceta').val(epclId);
  $('#modalAgregarReceta').modal('show');
});

// Agregar más medicamentos al formulario
$('#btnAgregarMedicamento').on('click', function() {
  const medicamentoRow = `
    <div class="row mb-3 medicamento-row">
      <div class="col-md-4">
        <label for="redeMedicamento" class="form-label">Medicamento</label>
        <input type="text" class="form-control" name="redeMedicamento[]" required>
      </div>
      <div class="col-md-4">
        <label for="redePresentacion" class="form-label">Presentación</label>
        <input type="text" class="form-control" name="redePresentacion[]" required>
      </div>
      <div class="col-md-4">
        <label for="redeDosis" class="form-label">Dosis</label>
        <input type="text" class="form-control" name="redeDosis[]" required>
      </div>
      <div class="col-md-4">
        <label for="redeFrecuencia" class="form-label">Frecuencia</label>
        <input type="text" class="form-control" name="redeFrecuencia[]" required>
      </div>
      <div class="col-md-4">
        <label for="redeDuracion" class="form-label">Duración</label>
        <input type="text" class="form-control" name="redeDuracion[]" required>
      </div>
      <div class="col-md-4">
        <label for="redeViaAdministracion" class="form-label">Vía de administración</label>
        <input type="text" class="form-control" name="redeViaAdministracion[]" required>
      </div>
      <div class="col-md-4">
        <label for="redeObservaciones" class="form-label">Observaciones</label>
        <input type="text" class="form-control" name="redeObservaciones[]" required>
      </div>
    </div>
  `;
  $('#detallesMedicamentos').append(medicamentoRow);
});

document.addEventListener('DOMContentLoaded', function () {

  // Asignar el epclId al campo oculto cuando se abre el modal
  $('.btnAgregarReceta').on('click', function() {
    const epclId = $(this).attr('epclId');
    $('#epclIdReceta').val(epclId);  // Asigna el epclId al campo oculto
    $('#modalAgregarReceta').modal('show');
  });

  const formReceta = document.getElementById("formAgregarReceta");

  if (formReceta) {
    formReceta.addEventListener("submit", function (event) {
      event.preventDefault();

      Swal.fire({
        title: "¿Guardar receta y continuar?",
        html: `
          <p>Se guardará la receta con los detalles de los medicamentos.</p>
          <p class="mb-0">
            <small>Si presionas <strong>Cancelar</strong>, la información registrada se perderá.</small>
          </p>
        `,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, guardar y continuar",
        cancelButtonText: "Cancelar (perder datos)"
      }).then(async (result) => {
        const modalRecetaEl = document.getElementById("modalAgregarReceta");
        const modalReceta = bootstrap.Modal.getInstance(modalRecetaEl);

        if (result.isConfirmed) {

          // Capturar los valores del formulario
          const epclId = document.getElementById("epclIdReceta").value.trim();
          const receFecha = document.getElementById("receFecha").value.trim();
          const receIndicaciones = document.getElementById("receIndicaciones").value.trim();
          const receEstado = document.getElementById("receEstado").value.trim();

          // Obtener todos los detalles de los medicamentos
          const detalles = [];
          const medicamentos = document.getElementsByName("redeMedicamento[]");
          const presentaciones = document.getElementsByName("redePresentacion[]");
          const dosis = document.getElementsByName("redeDosis[]");
          const frecuencias = document.getElementsByName("redeFrecuencia[]");
          const duraciones = document.getElementsByName("redeDuracion[]");
          const vias = document.getElementsByName("redeViaAdministracion[]");
          const observaciones = document.getElementsByName("redeObservaciones[]");

          // Recopilar los datos de cada medicamento en el array detalles
          for (let i = 0; i < medicamentos.length; i++) {
            detalles.push({
              redeMedicamento: medicamentos[i].value.trim(),
              redePresentacion: presentaciones[i].value.trim(),
              redeDosis: dosis[i].value.trim(),
              redeFrecuencia: frecuencias[i].value.trim(),
              redeDuracion: duraciones[i].value.trim(),
              redeViaAdministracion: vias[i].value.trim(),
              redeObservaciones: observaciones[i].value.trim()
            });
          }

          // Validar que todos los campos obligatorios estén llenos
          if (!receFecha || !receIndicaciones || detalles.length === 0) {
            Swal.fire({
              icon: "warning",
              title: "Por favor, complete todos los campos obligatorios.",
              confirmButtonText: "Cerrar"
            });
            return;
          }

          // Crear el objeto con los datos de la receta
          const data = {
            episodioClinico: { epclId: epclId },
            receFecha: receFecha,
            receIndicaciones: receIndicaciones,
            receEstado: receEstado === "true",  // Convertir a booleano
            detalles: detalles
          };

          console.log("Enviando receta:", data);

          // Realizar la solicitud POST con fetch
          fetch(`${CONFIG.API_BASE_URL}recetas`, {
            method: "POST",
            headers: {
              "Authorization": "Bearer your-token",  // Aquí deberías agregar tu token de autorización
              "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
          })
            .then(response => response.json())
            .then(data => {
              console.log("Respuesta del servidor (agregar receta):", data);

              Swal.fire({
                icon: "success",
                title: "Receta guardada correctamente",
                confirmButtonText: "Aceptar"
              }).then(() => {
                if (modalReceta) modalReceta.hide();
                formReceta.reset();  // Limpiar el formulario

                // Aquí puedes realizar cualquier acción posterior, como recargar la página o mostrar un mensaje adicional.
              });
            })
            .catch(error => {
              console.error("Error al agregar receta:", error);

              Swal.fire({
                icon: "error",
                title: "No se pudo guardar la receta",
                text: error.message || "Verifica los datos e inténtalo nuevamente.",
                confirmButtonText: "Cerrar"
              });
            });

        } else if (result.dismiss === Swal.DismissReason.cancel) {
          // Canceló: perder datos y cerrar modal
          formReceta.reset();
          if (modalReceta) modalReceta.hide();

          Swal.fire({
            icon: "info",
            title: "Receta descartada",
            text: "La información ingresada se ha perdido.",
            confirmButtonText: "Entendido"
          });
        }

      });
    });
  }
});

