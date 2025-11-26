

/*=============================================
VISUALIZAR HISTORIA
=============================================*/

$(document).on("click", ".btnVerHistoria", function() {
  var histId = $(this).attr("histId");
  window.location.href = `index.php?ruta=ver-historia&histId=${histId}`;
});



/*=============================================
REGISTRAR HISTORIA
=============================================*/
document.addEventListener("DOMContentLoaded", () => {

    const inputDni        = document.getElementById("inputDniPaciente");
    const inputNombre     = document.getElementById("inputNombrePaciente");
    const inputPaciId     = document.getElementById("inputPaciId");
    const suggestionsBox  = document.getElementById("dniSuggestions");

    let debounceTimer = null;

    // Limpia la lista de sugerencias
    function clearSuggestions() {
      suggestionsBox.innerHTML = "";
    }

    // Escuchar lo que escribe en el DNI
    inputDni.addEventListener("input", function () {
      const dni = inputDni.value.trim();

      // Si tiene menos de 2 caracteres, no buscamos
      if (dni.length < 2) {
        clearSuggestions();
        return;
      }

      // Debounce: espera un poquito antes de llamar al backend
      clearTimeout(debounceTimer);
      debounceTimer = setTimeout(() => {
        buscarPacientesPorDni(dni);
      }, 300);
    });

    function buscarPacientesPorDni(dni) {
      const url = `${CONFIG.API_BASE_URL}pacientes/buscar/dni?dni=${encodeURIComponent(dni)}`;
      fetch(url, {
        method: "GET",
        headers: {
          "Authorization": CONFIG.API_AUTH_HEADER
        }
      })
      .then(res => res.json())
      .then(response => {
        console.log("Respuesta búsqueda DNI:", response);
        clearSuggestions();

        if (!response || !response.success || !response.data || response.data.length === 0) {
          return; // No hay resultados
        }

        // Pintar cada resultado como opción clicable
        response.data.forEach(p => {
          const item = document.createElement("button");
          item.type = "button";
          item.className = "list-group-item list-group-item-action";
          item.textContent = `${p.nroDoc} - ${p.nombrecompleto}`;

          item.addEventListener("click", () => {
            // Al seleccionar: llenar campos
            inputDni.value    = p.nroDoc;
            inputNombre.value = p.nombrecompleto;
            inputPaciId.value = p.paciId;

            clearSuggestions();
          });

          suggestionsBox.appendChild(item);
        });
      })
      .catch(err => {
        console.error("Error buscando pacientes por DNI:", err);
        clearSuggestions();
      });
    }

    // Ocultar sugerencias al hacer click fuera
    document.addEventListener("click", function (e) {
      if (!suggestionsBox.contains(e.target) && e.target !== inputDni) {
        clearSuggestions();
      }
    });

  const formRegistrarHistoria = document.getElementById("formRegistrarHistoria");
  if(formRegistrarHistoria){
    formRegistrarHistoria.addEventListener("submit", async (event) => {
      event.preventDefault(); // evita recargar la página

        // Capturar los valores del formulario
        const doctorId        = document.getElementById("doctorId").value.trim();
        const pacienteId      = document.getElementById("inputPaciId").value.trim();          // <-- ahora sale del hidden
        const dniPaciente     = document.getElementById("inputDniPaciente").value.trim();     // opcional, solo para validar mejor
        const nombrePaciente  = document.getElementById("inputNombrePaciente").value.trim();  // opcional
        const histNumHistoria = document.getElementById("histNumHistoria").value.trim();
        const histFecha       = document.getElementById("histFecha").value.trim();

        // Validar campos obligatorios
        if (!doctorId || !pacienteId || !histNumHistoria || !histFecha) {
          Swal.fire({
            icon: "warning",
            title: "Complete los campos obligatorios antes de registrar.",
            confirmButtonText: "Cerrar"
          });
          return;
        }

        // Validar que realmente se haya seleccionado un paciente de la lista
        if (!dniPaciente || !nombrePaciente) {
          Swal.fire({
            icon: "warning",
            title: "Busque y seleccione un paciente por DNI antes de registrar.",
            confirmButtonText: "Cerrar"
          });
          return;
        }

        // Construir el JSON con la estructura esperada por tu backend
        const data = {
          usuario: {
            usuaId: parseInt(doctorId)
          },
          paciente: {
            paciId: parseInt(pacienteId)
          },
          histNumHistoria: parseInt(histNumHistoria), // Número de historia
          histRegistrofecha: histFecha,
          histEstado: 1
        };

        try {
          const response = await fetch(`${CONFIG.API_BASE_URL}historias`, {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              "Authorization": CONFIG.API_AUTH_HEADER
            },
            body: JSON.stringify(data)
          });

          const result = await response.json();
          console.log("Respuesta del servidor (registrar historia):", result);

          if (response.ok) {
            Swal.fire({
              icon: "success",
              title: result.message || "Historia registrada correctamente",
              confirmButtonText: "Cerrar"
            }).then(() => {
              // Cierra el modal y recarga la lista si es necesario
              const modal = bootstrap.Modal.getInstance(document.getElementById("modalRegistrarHistoria"));
              modal.hide();
              window.location.reload(); // o redirige según tu flujo
            });
          } else {
            Swal.fire({
              icon: "warning",
              title: result.message || "Hubo un problema al registrar la historia",
              confirmButtonText: "Cerrar"
            });
          }
        } catch (error) {
          console.error("Error al registrar historia:", error);
          Swal.fire({
            icon: "error",
            title: "No se pudo registrar la historia. Revisa los datos o la conexión.",
            confirmButtonText: "Cerrar"
          });
        }
    });


    }
    
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