/**
 * Script para gestión de médicos
 * Sistema de Gestión Clínica
 */

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
		if (typeof response === 'string') {
			response = JSON.parse(response);
		}
		
		console.log("Respuesta del médico:", response);
		
		// Ajusta según la estructura de tu API
		if (response && response.data) {
			var medico = response.data;
			
			// Llenar el formulario con los datos del médico
			$("#editarMediId").val(medico.mediId);
			$("#editarMediNombre").val(medico.mediNombre);
			$("#editarMediApellido").val(medico.mediApellido);
			$("#editarMediDni").val(medico.mediDni);
			$("#editarMediTelefono").val(medico.mediTelefono);
			$("#editarMediEmail").val(medico.mediEmail);
			$("#editarMediEstado").val(medico.mediEstado);
			$("#editarMediFotoUrl").val(medico.mediFotoUrl);
			
			// Abrir el modal con Bootstrap 5
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
REGISTRAR MÉDICO
=============================================*/
$(document).ready(function() {
    $("#formRegistrarMedico").on("submit", function(event) {
        event.preventDefault(); // Evita recarga

        // 1. Capturar los valores del formulario
        var mediNombre      = $("#mediNombre").val();
        var mediApellido    = $("#mediApellido").val();
        var mediDni         = $("#mediDni").val();
        var mediTelefono    = $("#mediTelefono").val();
        var mediEmail       = $("#mediEmail").val();
        var mediEstado      = $("#mediEstado").val();
        var mediFotoUrl     = $("#mediFotoUrl").val() || "";

        console.log("Médico a registrar:");
        console.log({
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
        url: `${CONFIG.API_BASE_URL}medicos`,
        method: "POST",
        timeout: 0,
        headers: {
            "Content-Type": "application/json",
            "Authorization": CONFIG.API_AUTH_HEADER
        },
        data: JSON.stringify({
            mediNombre: mediNombre,
            mediApellido: mediApellido,
            mediDni: mediDni,
            mediEmail: mediEmail,
            mediTelefono: mediTelefono,
            mediFotoUrl: mediFotoUrl,
            mediEstado: mediEstado
        }),
        success: function(response) {
          console.log("Respuesta del servidor:", response);

          if (response.success) {
              Swal.fire({
                  type: "success",
                  title: response.message || "El médico ha sido registrado correctamente",
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
                  title: response.message || "Hubo un problema al registrar el médico",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
              });
          }
      },
      error: function(xhr, status, error) {
          console.error("Error al registrar médico:", error);
          console.error("Detalle:", xhr.responseText);

          Swal.fire({
              type: "error",
              title: "No se pudo registrar el médico. Revisa los datos.",
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
