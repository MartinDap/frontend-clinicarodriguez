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

  console.log("Ver episodio clínico con ID:", epclId);

  try {
    const url = `${CONFIG.API_BASE_URL}episodios-clinicos/${epclId}`;

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
    console.log("Respuesta detalle episodio clínico:", data);

    // Puede venir como { data: {...} } o {...}
    const episodio = data.data ? data.data : data;

    if (!episodio || typeof episodio !== "object") {
      throw new Error("La respuesta no contiene datos válidos del episodio clínico");
    }

    // Opcional: formatear fecha (epclFecha) a algo más legible
    let fechaTexto = episodio.epclFecha || "";
    // Si quieres, puedes recortar segundos: "2025-11-16T00:54:00" -> "2025-11-16 00:54"
    if (fechaTexto.includes("T")) {
      const [fecha, hora] = fechaTexto.split("T");
      fechaTexto = `${fecha} ${hora.substring(0,5)}`; // HH:MM
    }

    // Llenar el modal
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

    // Mostrar el modal
    const modalElement = document.getElementById("modalVerEpisodio");
    if (modalElement) {
      const modal = new bootstrap.Modal(modalElement);
      modal.show();
    } else {
      console.error("No se encontró el modal 'modalVerEpisodio'.");
    }

  } catch (error) {
    console.error("Error al obtener detalle de episodio clínico:", error);

    Swal.fire({
      icon: "error",
      title: "No se pudo cargar el episodio clínico",
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
GUARDAR CAMBIOS DEL DOCUMENTO
=============================================*/





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