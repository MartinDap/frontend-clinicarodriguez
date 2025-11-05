

/*=============================================
VISUALIZAR HISTORIA
=============================================*/
// Ya no se necesita, ahora usamos enlaces directos <a href="">

$(document).on("click", ".btnVerHistoria", function() {
  var histId = $(this).attr("histId");
  window.location.href = `index.php?ruta=ver-historia&histId=${histId}`;
});



/*=============================================
REGISTRAR HISTORIA
=============================================*/
document.addEventListener("DOMContentLoaded", () => {

  const formRegistrarHistoria = document.getElementById("formRegistrarHistoria");
  if(formRegistrarHistoria){
    formRegistrarHistoria.addEventListener("submit", async (event) => {
        event.preventDefault(); // evita recargar la página

        // Capturar los valores del formulario
        const doctorId        = document.getElementById("doctorId").value.trim();
        const pacienteId      = document.getElementById("pacienteId").value.trim();
        const histNumHistoria = document.getElementById("histNumHistoria").value.trim();
        const histFecha       = document.getElementById("histFecha").value.trim();
        const histTalle       = document.getElementById("histTalle").value.trim();
        const histPeso        = document.getElementById("histPeso").value.trim();
        const histTemperaturaC= document.getElementById("histTemperaturaC").value.trim();
        const histFrecCardiaca= document.getElementById("histFrecCardiaca").value.trim();

        // Validar campos obligatorios
        if (!doctorId || !pacienteId || !histNumHistoria || !histFecha || !histTalle || !histPeso || !histTemperaturaC || !histFrecCardiaca) {
          Swal.fire({
            icon: "warning",
            title: "Complete los campos obligatorios antes de registrar.",
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
          histFecha: `${histFecha}T00:00:00`, // formato ISO (ajusta si tu backend espera hora)
          histTalle: parseFloat(histTalle),
          histPeso: parseFloat(histPeso),
          histTemperaturaC: parseFloat(histTemperaturaC),
          histFrecCardiaca: parseFloat(histFrecCardiaca),
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