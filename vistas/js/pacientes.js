/**
 * Script para gestión de pacientes
 * Sistema de Gestión Clínica
 */

/*=============================================
EDITAR PACIENTE
=============================================*/
$(document).on("click", ".btnEditarPaciente", function(){
	var paciId = $(this).attr("paciId");
	console.log("ID del paciente:", paciId);
	
	var settings = {
		"url": `${CONFIG.API_BASE_URL}pacientes/${paciId}`,
		"method": "GET",
		"timeout": 0,
		"headers": {
			"Authorization": CONFIG.API_AUTH_HEADER
		},
	};
	
	$.ajax(settings).done(function (response) {
		// Si la respuesta es una cadena de texto, conviértela a un objeto JSON
		if (typeof response === 'string') {
			response = JSON.parse(response);
		}
		
		console.log("Respuesta del paciente:", response);
		
		// Ajusta según la estructura de tu API
		if (response && response.data) {
			var paciente = response.data;
			
			// Llenar el formulario con los datos del paciente
			$("#editarPaciId").val(paciente.paciId);
			$("#editarPaciNombrecompleto").val(paciente.paciNombrecompleto);
			$("#editarPaciDni").val(paciente.paciDni);
			$("#editarPaciSexo").val(paciente.paciSexo);
			$("#editarPaciFecNacimiento").val(paciente.paciFecNacimiento);
			$("#editarPaciEstadoCivil").val(paciente.paciEstadoCivil);
			$("#editarPaciTelefono").val(paciente.paciTelefono);
			$("#editarPaciEmail").val(paciente.paciEmail);
			$("#editarPaciDireccion").val(paciente.paciDireccion);
			$("#editarPaciApoderado").val(paciente.paciApoderado);
			
			// Abrir el modal con Bootstrap 5
			const modalElement = document.getElementById('modalEditarPaciente');
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
	}).fail(function(xhr, status, error) {
		console.error("Error al obtener paciente:", error);
		Swal.fire({
			type: "error",
			title: "Error al cargar los datos del paciente",
			showConfirmButton: true
		});
	});
})

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
$(document).ready(function() {
    $("#formRegistrarPaciente").on("submit", function(event) {
        event.preventDefault(); // Evita recarga

        // 1. Capturar los valores del formulario
        var paciNombrecompleto  = $("#paciNombrecompleto").val();
        var paciSexo            = $("#paciSexo").val();
        var paciFecNacimiento   = $("#paciFecNacimiento").val();
        var paciDni             = $("#paciDni").val();
        var paciEstadoCivil     = $("#paciEstadoCivil").val();
        var paciDireccion       = $("#paciDireccion").val();
        var paciTelefono        = $("#paciTelefono").val();
        var paciEmail           = $("#paciEmail").val();
        var paciApoderado       = $("#paciApoderado").val();
        var paciNumhistoria     = $("#paciNumhistoria").val() || ""; // opcional
        var paciEstado          = 1; // si quieres que siempre entre activo

        console.log("Paciente a registrar:");
        console.log({
            paciNombrecompleto,
            paciSexo,
            paciFecNacimiento,
            paciDni,
            paciEstadoCivil,
            paciDireccion,
            paciTelefono,
            paciEmail,
            paciApoderado,
            paciNumhistoria,
            paciEstado
        });

        // 2. Configurar la solicitud AJAX
        var settings = {
        url: `${CONFIG.API_BASE_URL}pacientes`,
        method: "POST",
        timeout: 0,
        headers: {
            "Content-Type": "application/json",
            "Authorization": CONFIG.API_AUTH_HEADER // debe tener el 'Bearer ...'
        },
        data: JSON.stringify({
            paciNombrecompleto: paciNombrecompleto,
            paciSexo: paciSexo,
            paciFecNacimiento: paciFecNacimiento,
            paciDni: paciDni,
            paciEstadoCivil: paciEstadoCivil,
            paciDireccion: paciDireccion,
            paciTelefono: paciTelefono,
            paciEmail: paciEmail,
            paciApoderado: paciApoderado,
            paciNumhistoria: paciNumhistoria,
            paciEstado: paciEstado
        }),
        success: function(response) {
          console.log("Respuesta del servidor:", response);

          if (response.success) {
              Swal.fire({
                  type: "success",
                  title: response.message || "El paciente ha sido registrado correctamente",
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
                  title: response.message || "Hubo un problema al registrar el paciente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
              });
          }
      },
      error: function(xhr, status, error) {
          console.error("Error al registrar paciente:", error);
          console.error("Detalle:", xhr.responseText);

          swal({
              type: "error",
              title: "No se pudo registrar el paciente. Revisa los datos.",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
          }).then(function(result) {
              if (result.value) {
                  // puedes quedarte en la misma vista o recargar
              }
          });
      }

    };


        // 3. Ejecutar AJAX
        $.ajax(settings).done(function (response) {
            console.log("Respuesta final backend:", response);
        });
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

