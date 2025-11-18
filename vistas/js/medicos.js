/**
 * Script para gestión de médicos
 * Sistema de Gestión Clínica
 */

document.addEventListener('DOMContentLoaded', function() {
  const formRegistrarMedico = document.getElementById('formRegistrarMedico');
  if (!formRegistrarMedico) return;

  formRegistrarMedico.addEventListener('submit', async function (event) {
    event.preventDefault();

    try {
      // 1) Obtener valores
      const nombre       = document.getElementById('mediNombre').value.trim();
      const apellido     = document.getElementById('mediApellido').value.trim();
      const tipoDoc      = document.getElementById('mediTipoDoc').value.trim();
      const nroDoc       = document.getElementById('mediDni').value.trim();
      const sexo         = document.getElementById('mediSexo').value.trim();
      const fecNac       = document.getElementById('mediFecNac').value; // YYYY-MM-DD
      const estadoCivil  = document.getElementById('mediEstadoCivil').value.trim();
      const direccion    = document.getElementById('mediDireccion').value.trim();
      const telefono     = document.getElementById('mediTelefono').value.trim();
      const email        = document.getElementById('mediEmail').value.trim();
      const username     = document.getElementById('mediUsuario').value.trim();
      const password     = document.getElementById('mediPassword').value;
      const nroCol       = document.getElementById('mediNroColegiatura').value.trim();
      const fotoFile     = document.getElementById('mediFoto').files[0] || null;

      // 2) Mapear a la estructura que el backend espera (usando los nombres correctos)
      const medicoPayload = {
        nombrecompleto: `${nombre} ${apellido}`.trim(),
        tipoDoc: tipoDoc,
        nroDoc: nroDoc,
        sexo: sexo,
        fecNacimiento: fecNac,      // "YYYY-MM-DD"
        estadoCivil: estadoCivil,
        telefono: telefono,
        email: email,
        direccion: direccion,
        username: username,
        password: password,
        nroColegiatura: nroCol
      };

      // 3) Armar FormData
      const formData = new FormData();
      formData.append('medico', JSON.stringify(medicoPayload));
      if (fotoFile) {
        formData.append('foto', fotoFile);
      }

      // 4) Enviar
      const resp = await fetch(`${CONFIG.API_BASE_URL}medicos/registrar`, {
        method: 'POST',
        headers: {
          'Authorization': CONFIG.API_AUTH_HEADER
          // NO pongas 'Content-Type': multipart lo maneja el navegador
        },
        body: formData
      });

      const result = await resp.json();
      console.log('Respuesta registro médico:', result);

      if (result.success) {
        Swal.fire({
          icon: 'success',
          title: result.message || 'El médico ha sido registrado correctamente',
          confirmButtonText: 'Cerrar'
        }).then(() => {
          window.location = 'medicos';
        });
      } else {
        throw new Error(result.message || 'Hubo un problema al registrar el médico');
      }

    } catch (err) {
      console.error(err);
      Swal.fire({
        icon: 'error',
        title: err.message || 'No se pudo completar el registro. Revisa los datos.',
        confirmButtonText: 'Cerrar'
      });
    }
  });
});



/*=============================================
EDITAR MÉDICO
=============================================*/
$(document).on("click", ".btnEditarMedico", function(){
	var mediId = $(this).attr("mediId");
	console.log("ID del médico:", mediId);
	
	var settings = {
		"url": `${CONFIG.API_BASE_URL}medicos/${mediId}`,
		"method": "GET",
		"timeout": 0,
		"headers": {
			"Authorization": CONFIG.API_AUTH_HEADER
		},
	};
	
	$.ajax(settings).done(function (response) {
		// Si la respuesta es una cadena de texto, conviértela a un objeto JSON
		// Si la respuesta viene como string plano tipo JSON, la parseamos
        if (typeof response === 'string') {
            try {
                response = JSON.parse(response);
            } catch (e) {
                console.error("No se pudo parsear la respuesta en JSON:", e, response);
            }
        }
		
		console.log("Respuesta del médico:", response);
		
		// Ajusta según la estructura de tu API
		// Validamos que tenga las claves esperadas
        if (response && response.mediId) {

            // Llenar el formulario del modal con los datos del médico
            $("#editarMediId").val(response.mediId);
            $("#editarMediNombre").val(response.mediNombre);
            $("#editarMediApellido").val(response.mediApellido);
            $("#editarMediDni").val(response.mediDni);
            $("#editarMediTelefono").val(response.mediTelefono);
            $("#editarMediEmail").val(response.mediEmail);
            $("#editarMediEstado").val(response.mediEstado);

            // Si quieres mostrar la URL actual (solo lectura o editable)
            $("#editarMediFotoUrl").val(response.mediFotoUrl);

            // Y si quieres previsualizar la foto existente:
            if (response.mediFotoUrl) {
                $("#previewEditarMediFoto").attr("src", response.mediFotoUrl).show();
            }

            // Abrir el modal Bootstrap 5
            const modalElement = document.getElementById('modalEditarMedico');
            const modal = new bootstrap.Modal(modalElement);
            modal.show();

        } else {
			console.error("La estructura del JSON no es la esperada o los datos están vacíos.");
			Swal.fire({
				type: "error",
				title: "No se pudo cargar la información del médico",
				showConfirmButton: true
			});
		}
	}).fail(function(xhr, status, error) {
		console.error("Error al obtener médico:", error);
		Swal.fire({
			type: "error",
			title: "Error al cargar los datos del médico",
			showConfirmButton: true
		});
	});
})

/*=============================================
CONFIRMAR EDITAR MÉDICO
=============================================*/
$(document).ready(function() {
    $("#formEditarMedico").on("submit", function(event) {
        event.preventDefault(); // Evita recarga

        // 1. Capturar los valores del formulario
        var mediId              = $("#editarMediId").val();
        var mediNombre          = $("#editarMediNombre").val();
        var mediApellido        = $("#editarMediApellido").val();
        var mediDni             = $("#editarMediDni").val();
        var mediTelefono        = $("#editarMediTelefono").val();
        var mediEmail           = $("#editarMediEmail").val();
        var mediEstado          = $("#editarMediEstado").val();
        var mediFotoUrl         = $("#editarMediFotoUrl").val();

        console.log("Médico a editar:");
        console.log({
            mediId,
            mediNombre,
            mediApellido,
            mediDni,
            mediTelefono,
            mediEmail,
            mediEstado,
            mediFotoUrl
        });

        // 2. Configurar la solicitud AJAX
        var settings = {
            url: `${CONFIG.API_BASE_URL}medicos/${mediId}`,
            method: "PUT",
            timeout: 0,
            headers: {
                "Content-Type": "application/json",
                "Authorization": CONFIG.API_AUTH_HEADER
            },
            data: JSON.stringify({
                mediNombre: mediNombre,
                mediApellido: mediApellido,
                mediDni: mediDni,
                mediTelefono: mediTelefono,
                mediEmail: mediEmail,
                mediEstado: mediEstado,
                mediFotoUrl: mediFotoUrl
            }),
            success: function(response) {
                console.log("Respuesta del servidor:", response);

                if (response.success) {
                    Swal.fire({
                        type: "success",
                        title: response.message || "El médico ha sido modificado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result) {
                        if (result.value) {
                            window.location = "medicos";
                        }
                    });
                } else {
                    Swal.fire({
                        type: "warning",
                        title: response.message || "Hubo un problema al editar el médico",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("Error al editar médico:", error);
                console.error("Detalle:", xhr.responseText);

                Swal.fire({
                    type: "error",
                    title: "No se pudo editar el médico. Revisa los datos.",
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
ELIMINAR MÉDICO
=============================================*/
$(document).on("click", ".btnEliminarMedico", function(){
    var eliminarMediId = $(this).attr("eliminarMediId");
    console.log("ID del médico a eliminar:", eliminarMediId);

    Swal.fire({
        title: '¿Está seguro de borrar el médico?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí, borrar médico!'
    }).then(function(result){
        
        if(result.value){
            console.log("Eliminando médico:", eliminarMediId);
            
            var settings = {
                url: `${CONFIG.API_BASE_URL}medicos/${eliminarMediId}`,
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
                        title: response.message || "El médico ha sido eliminado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
                            window.location = "medicos";
                        }
                    });
                })
                .fail(function(xhr, status, error) {
                    console.error("Error al eliminar médico:", error);
                    console.error("Detalle:", xhr.responseText);
                    
                    Swal.fire({
                        type: "error",
                        icon: "error",
                        title: "No se pudo eliminar el médico",
                        text: "Por favor, intente nuevamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    });
                });
        }
    });
});

/*=============================================
ASIGNAR ESPECIALIDADES
=============================================*/
document.addEventListener('DOMContentLoaded', function() {
    
    // Evento para abrir modal de asignar especialidades
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('btnAsignarEspecialidades') || 
            event.target.closest('.btnAsignarEspecialidades')) {
            
            const button = event.target.classList.contains('btnAsignarEspecialidades') 
                ? event.target 
                : event.target.closest('.btnAsignarEspecialidades');
            
            const mediId = button.getAttribute('mediId');
            console.log("ID del médico:", mediId);
            
            cargarDatosMedicoParaEspecialidades(mediId);
        }
    });

    // Función para cargar datos del médico
    async function cargarDatosMedicoParaEspecialidades(mediId) {
        try {
            const response = await fetch(`${CONFIG.API_BASE_URL}medicos/${mediId}`, {
                method: 'GET',
                headers: {
                    'Authorization': CONFIG.API_AUTH_HEADER
                }
            });

            let result = await response.json();

            // Si la respuesta es una cadena de texto, conviértela a un objeto JSON
            if (typeof result === 'string') {
                try {
                    result = JSON.parse(result);
                } catch (e) {
                    console.error("No se pudo parsear la respuesta en JSON:", e, result);
                    throw new Error("Error al parsear respuesta");
                }
            }

            console.log("Respuesta del médico:", result);

            // Validamos que tenga las claves esperadas
            if (result && result.data && result.data.mediId) {
                
                // Guardar el ID del médico en el formulario
                const hiddenMediId = document.getElementById('asignarMediId');
                if (hiddenMediId) {
                    hiddenMediId.value = result.data.mediId;
                }

                // Llenar la información del médico en el modal
                document.getElementById('infoNombre').textContent = `${result.data.mediNombre} ${result.data.mediApellido}`;
                
                // Mostrar la sección de información
                document.getElementById('infoMedico').style.display = 'block';

                // Si tienes foto, mostrarla
                if (result.data.mediFotoUrl) {
                    const fotoMedico = document.getElementById('fotoMedicoAsignar');
                    if (fotoMedico) {
                        fotoMedico.src = result.data.mediFotoUrl;
                        fotoMedico.style.display = 'block';
                    }
                }

                // Cargar las especialidades actuales del médico
                await cargarEspecialidadesActuales(result.data.mediId);

                // Abrir el modal Bootstrap 5
                const modalElement = document.getElementById('modalAsignarEspecialidades');
                const modal = new bootstrap.Modal(modalElement);
                modal.show();

            } else {
                console.error("La estructura del JSON no es la esperada o los datos están vacíos.");
                Swal.fire({
                    type: "error",
                    title: "No se pudo cargar la información del médico",
                    showConfirmButton: true
                });
            }

        } catch (error) {
            console.error("Error al obtener médico:", error);
            Swal.fire({
                type: "error",
                title: "Error al cargar los datos del médico",
                text: error.message,
                showConfirmButton: true
            });
        }
    }

    // Función para cargar especialidades actuales del médico
    async function cargarEspecialidadesActuales(medicoId) {
        try {
            const response = await fetch(`${CONFIG.API_BASE_URL}medicos-especialidades/medico/${medicoId}`, {
                headers: {
                    'Authorization': CONFIG.API_AUTH_HEADER
                }
            });
            const result = await response.json();

            const especialidadesActualesDiv = document.getElementById('especialidadesActuales');

            if (result.success && result.data && result.data.length > 0) {
                // Limpiar checkboxes primero
                const checkboxes = document.querySelectorAll('input[name="especialidades[]"]');
                checkboxes.forEach(cb => cb.checked = false);

                // Marcar las especialidades actuales
                result.data.forEach(item => {
                    const espe = item.especialidad;
                    const checkbox = document.getElementById(`espe${espe.espeId}`);
                    if (checkbox) {
                        checkbox.checked = true;
                    }
                });

                // Mostrar badges de especialidades actuales
                especialidadesActualesDiv.innerHTML = result.data.map(item =>
                    `<span class="badge bg-primary" style="margin-right: 5px;">${item.especialidad.espeNombre}</span>`
                ).join('');
            } else {
                especialidadesActualesDiv.innerHTML = '<span class="badge bg-secondary">Ninguna</span>';

                // Limpiar todos los checkboxes
                const checkboxes = document.querySelectorAll('input[name="especialidades[]"]');
                checkboxes.forEach(cb => cb.checked = false);
            }
        } catch (error) {
            console.error('Error al cargar especialidades actuales:', error);
            document.getElementById('especialidadesActuales').innerHTML = '<span class="badge bg-secondary">Error al cargar</span>';
        }
    }

    // Enviar formulario de asignación de especialidades
    const formAsignarEspecialidades = document.getElementById('formAsignarEspecialidades');
    if (formAsignarEspecialidades) {
        formAsignarEspecialidades.addEventListener('submit', async function(event) {
            event.preventDefault();

            try {
                const medicoId = document.getElementById('asignarMediId').value;

                if (!medicoId) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Error: No se identificó el médico',
                    confirmButtonText: 'Cerrar'
                });
                return;
                }

                const checkboxes = document.querySelectorAll('input[name="especialidades[]"]:checked');
                const especialidadesSeleccionadas = Array.from(checkboxes).map(cb => parseInt(cb.value));

                if (especialidadesSeleccionadas.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Debe seleccionar al menos una especialidad',
                    confirmButtonText: 'Cerrar'
                });
                return;
                }

                // Enviar una petición por cada especialidad seleccionada
                for (const espeId of especialidadesSeleccionadas) {
                const dataToSend = {
                    medico: { mediId: parseInt(medicoId) },
                    especialidad: { espeId }
                };

                const response = await fetch(`${CONFIG.API_BASE_URL}medicos-especialidades`, {
                    method: 'POST',
                    headers: {
                    'Content-Type': 'application/json',
                    'Authorization': CONFIG.API_AUTH_HEADER
                    },
                    body: JSON.stringify(dataToSend)
                });

                const result = await response.json();
                console.log('Respuesta del servidor:', result);
                }

                Swal.fire({
                icon: 'success',
                title: 'Especialidades asignadas correctamente',
                confirmButtonText: 'Cerrar'
                }).then(() => {
                const modalElement = document.getElementById('modalAsignarEspecialidades');
                const modal = bootstrap.Modal.getInstance(modalElement);
                if (modal) modal.hide();
                window.location.reload();
                });

            } catch (error) {
                console.error('Error al asignar especialidades:', error);
                Swal.fire({
                icon: 'error',
                title: 'No se pudo asignar las especialidades',
                text: error.message,
                confirmButtonText: 'Cerrar'
                });
            }
            });

    }
});

function mostrarError(mensaje) {
    // Asumiendo que tienes SweetAlert disponible globalmente
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            icon: "error",
            title: mensaje,
            showConfirmButton: true
        });
    } else {
        // Fallback si SweetAlert no está disponible
        alert(mensaje);
    }
}





$(document).ready(function() {
  
  // Inicializar DataTable de médicos
  if ($('#tablaMedicos').length) {
    $('#tablaMedicos').DataTable({
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
      },
      responsive: true,
      pageLength: 10
    });
  }
  
});
