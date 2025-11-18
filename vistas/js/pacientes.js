/**
 * Script para gestión de pacientes
 * Sistema de Gestión Clínica


document.addEventListener("DOMContentLoaded", async () => {
    const productos = await apiGet("pacientes"); // 👉 Llama a tu API GET /productos
    const tbody = document.querySelector("#tablaPacientes tbody");
    console.log("Productos obtenidos:", productos);
    if (productos) {
        productos.data.forEach(paciente => {
            console.log("Productos obtenidos:", paciente);
            tbody.innerHTML += `
            <tr>
                <td>${paciente.paciId}</td>
                <td>${paciente.paciNombrecompleto}</td>
                <td>${paciente.paciDni}</td>
                <td>${paciente.paciTelefono}</td>
                <td>${paciente.paciEmail}</td>
                <td>${paciente.paciDireccion}</td>
            </tr>
            `;
        });
    } else {
      tbody.innerHTML = `<tr><td colspan="3">No hay productos disponibles</td></tr>`;
    }
  });

 */
/*=============================================
EDITAR PACIENTE 
=============================================*/
document.addEventListener("click", function (event) {

  // Delegación de eventos para botones con clase .btnEditarPaciente
  const btn = event.target.closest(".btnEditarPaciente");
  if (!btn) return;

  const paciId = btn.getAttribute("paciId");
  console.log("ID del paciente:", paciId);

  const url = `${CONFIG.API_BASE_URL}pacientes/${paciId}`;

  fetch(url, {
    method: "GET",
    headers: {
      "Authorization": CONFIG.API_AUTH_HEADER
    }
  })
  .then(async (res) => {
    // Intentar leer la respuesta como texto primero
    let response = await res.text();
    
    try {
      // Si es un JSON válido, lo parseamos
      response = JSON.parse(response);
    } catch (e) {
      // Si no es JSON parseable, dejamos el texto tal cual
      console.warn("La respuesta no es un JSON válido, se deja como texto:", response);
    }

    console.log("Respuesta del paciente:", response);

    // Misma lógica que tenías con jQuery:
    if (response && response.data) {
      const paciente = response.data;

      // Llenar el formulario con los datos del paciente
      document.getElementById("editarPaciId").value              = paciente.paciId;
      document.getElementById("editarPaciNombrecompleto").value  = paciente.paciNombrecompleto;
      document.getElementById("editarPaciDni").value             = paciente.paciDni;
      document.getElementById("editarPaciSexo").value            = paciente.paciSexo;
      document.getElementById("editarPaciFecNacimiento").value   = paciente.paciFecNacimiento;
      document.getElementById("editarPaciEstadoCivil").value     = paciente.paciEstadoCivil;
      document.getElementById("editarPaciTelefono").value        = paciente.paciTelefono;
      document.getElementById("editarPaciEmail").value           = paciente.paciEmail;
      document.getElementById("editarPaciDireccion").value       = paciente.paciDireccion;
      document.getElementById("editarPaciApoderado").value       = paciente.paciApoderado;

      // Abrir el modal con Bootstrap 5
      const modalElement = document.getElementById("modalEditarPaciente");
      const modal = new bootstrap.Modal(modalElement);
      modal.show();

    } else {
      console.error("La estructura del JSON no es la esperada o los datos están vacíos.");
      Swal.fire({
        type: "error",
        title: "No se pudo cargar la información del paciente",
        showConfirmButton: true
      });
    }
  })
  .catch((error) => {
    console.error("Error al obtener paciente:", error);
    Swal.fire({
      type: "error",
      title: "Error al cargar los datos del paciente",
      showConfirmButton: true
    });
  });

});


/*=============================================
CONFIRMAR EDITAR PACIENTE
=============================================*/
$(document).ready(function() {
    $("#formEditarPaciente").on("submit", function(event) {
        event.preventDefault(); // Evita recarga

        // 1. Capturar los valores del formulario
        var paciId              = $("#editarPaciId").val();
        var paciNombrecompleto  = $("#editarPaciNombrecompleto").val();
        var paciDni             = $("#editarPaciDni").val();
        var paciSexo            = $("#editarPaciSexo").val();
        var paciFecNacimiento   = $("#editarPaciFecNacimiento").val();
        var paciEstadoCivil     = $("#editarPaciEstadoCivil").val();
        var paciTelefono        = $("#editarPaciTelefono").val();
        var paciEmail           = $("#editarPaciEmail").val();
        var paciDireccion       = $("#editarPaciDireccion").val();
        var paciApoderado       = $("#editarPaciApoderado").val();

        console.log("Paciente a editar:");
        console.log({
            paciId,
            paciNombrecompleto,
            paciDni,
            paciSexo,
            paciFecNacimiento,
            paciEstadoCivil,
            paciTelefono,
            paciEmail,
            paciDireccion,
            paciApoderado
        });

        // 2. Configurar la solicitud AJAX
        var settings = {
            url: `${CONFIG.API_BASE_URL}pacientes/${paciId}`,
            method: "PUT",
            timeout: 0,
            headers: {
                "Content-Type": "application/json",
                "Authorization": CONFIG.API_AUTH_HEADER
            },
            data: JSON.stringify({
                paciNombrecompleto: paciNombrecompleto,
                paciDni: paciDni,
                paciSexo: paciSexo,
                paciFecNacimiento: paciFecNacimiento,
                paciEstadoCivil: paciEstadoCivil,
                paciTelefono: paciTelefono,
                paciEmail: paciEmail,
                paciDireccion: paciDireccion,
                paciApoderado: paciApoderado
            }),
            success: function(response) {
                console.log("Respuesta del servidor:", response);

                if (response.success) {
                    Swal.fire({
                        type: "success",
                        title: response.message || "El paciente ha sido modificado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result) {
                        if (result.value) {
                            window.location = "pacientes";
                        }
                    });
                } else {
                    Swal.fire({
                        type: "warning",
                        title: response.message || "Hubo un problema al editar el paciente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("Error al editar paciente:", error);
                console.error("Detalle:", xhr.responseText);

                Swal.fire({
                    type: "error",
                    title: "No se pudo editar el paciente. Revisa los datos.",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                });
            }
        };

        // 3. Ejecutar AJAX
        $.ajax(settings).done(function (response) {
            console.log("Respuesta final backend:", response);
        });
    });
});

/*=============================================
ELIMINAR PACIENTE
=============================================*/
$(document).on("click", ".btnEliminarPaciente", function(){
    var eliminarPaciId = $(this).attr("eliminarPaciId");
    console.log("ID del paciente a eliminar:", eliminarPaciId);

    Swal.fire({
        title: '¿Está seguro de borrar el paciente?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí, borrar paciente!'
    }).then(function(result){
        
        if(result.value){
            console.log("Eliminando paciente:", eliminarPaciId);
            
            var settings = {
                url: `${CONFIG.API_BASE_URL}pacientes/${eliminarPaciId}`,
                method: "DELETE",
                timeout: 0,
                headers: {
                    "Authorization": CONFIG.API_AUTH_HEADER
                }
            };
            
            $.ajax(settings)
                .done(function (response) {
                    console.log("Respuesta:", response);
                    
                    Swal.fire({
                        type: "success",
                        icon: "success",
                        title: response.message || "El paciente ha sido eliminado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "pacientes";
                        }
                    });
                })
                .fail(function(xhr, status, error) {
                    console.error("Error al eliminar paciente:", error);
                    console.error("Detalle:", xhr.responseText);
                    
                    Swal.fire({
                        type: "error",
                        icon: "error",
                        title: "No se pudo eliminar el paciente",
                        text: "Por favor, intente nuevamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    });
                });
        }
    });
});


/*=============================================
REGISTRAR PACIENTE 
=============================================*/
document.addEventListener('DOMContentLoaded', function() {
    const formRegistrarPaciente = document.getElementById('formRegistrarPaciente');
    
    if (!formRegistrarPaciente) return;

    formRegistrarPaciente.addEventListener('submit', async function(event) {
        event.preventDefault(); // Evita recarga

        try {
            // 1. Capturar los valores del formulario con los nombres correctos
            const nombrecompleto = document.getElementById('paciNombrecompleto').value.trim();
            const tipoDoc = document.getElementById('paciTipoDoc').value.trim();
            const nroDoc = document.getElementById('paciNroDoc').value.trim();
            const sexo = document.getElementById('paciSexo').value.trim();
            const fecNacimiento = document.getElementById('paciFecNacimiento').value;
            const estadoCivil = document.getElementById('paciEstadoCivil').value.trim();
            const direccion = document.getElementById('paciDireccion').value.trim();
            const telefono = document.getElementById('paciTelefono').value.trim();
            const email = document.getElementById('paciEmail').value.trim();

            console.log("Paciente a registrar:");
            console.log({
                nombrecompleto,
                tipoDoc,
                nroDoc,
                sexo,
                fecNacimiento,
                estadoCivil,
                direccion,
                telefono,
                email
            });

            // 2. Preparar el payload según la estructura del backend
            const pacienteData = {
                nombrecompleto: nombrecompleto,
                tipoDoc: tipoDoc,
                nroDoc: nroDoc,
                sexo: sexo,
                fecNacimiento: fecNacimiento,
                estadoCivil: estadoCivil,
                telefono: telefono,
                email: email,
                direccion: direccion,
                fotoUrl: "default.png" // Valor por defecto o puedes manejarlo con la foto
            };

            // 3. Enviar la solicitud
            const response = await fetch(`${CONFIG.API_BASE_URL}pacientes/registrar`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': CONFIG.API_AUTH_HEADER,
                    'accept': '*/*'
                },
                body: JSON.stringify(pacienteData)
            });

            const result = await response.json();
            console.log("Respuesta del servidor:", result);

            // 4. Manejar la respuesta
            if (result.success) {
                await Swal.fire({
                    icon: 'success',
                    title: result.message || 'El paciente ha sido registrado correctamente',
                    showConfirmButton: true,
                    confirmButtonText: 'Cerrar'
                });
                
                // Redirigir a la lista de pacientes
                window.location.href = 'pacientes';
                
            } else {
                throw new Error(result.message || 'Hubo un problema al registrar el paciente');
            }

        } catch (error) {
            console.error('Error al registrar paciente:', error);
            
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'No se pudo registrar el paciente. Revisa los datos.',
                confirmButtonText: 'Cerrar'
            });
        }
    });
});



$(document).ready(function() {
  if ($('#tablaPacientes').length) {

    // Si ya existe una instancia, destrúyela antes
    if ($.fn.DataTable.isDataTable('#tablaPacientes')) {
      $('#tablaPacientes').DataTable().clear().destroy();
    }

    // Luego inicializa normalmente
    $('#tablaPacientes').DataTable({
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
      },
      responsive: true,
      pageLength: 10
    });
  }
});

