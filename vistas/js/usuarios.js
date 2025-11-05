/*=============================================
REGISTRAR NUEVO USUARIO
=============================================*/
$(document).ready(function () {

  $("#formRegistrarUsuario").on("submit", function (event) {
    event.preventDefault();

    // Capturar campos
    var data = {
      usuaUsername: $("#usuaUsername").val(),
      usuaNombrecompleto: $("#usuaNombrecompleto").val(),
      usuaClave: $("#usuaClave").val(),
      usuaEmail: $("#usuaEmail").val(),
      usuaTelefono: $("#usuaTelefono").val(),
      usuaDni: $("#usuaDni").val()
    };

    // Validar campos
    if (!data.usuaUsername || !data.usuaNombrecompleto || !data.usuaClave ||
        !data.usuaEmail || !data.usuaTelefono || !data.usuaDni) {
      Swal.fire({
        icon: "warning",
        title: "Complete todos los campos antes de registrar.",
        confirmButtonText: "Cerrar"
      });
      return;
    }

    // Enviar al backend
    $.ajax({
      url: `${CONFIG.API_BASE_URL}auth/registro`,
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "Authorization": CONFIG.API_AUTH_HEADER
      },
      data: JSON.stringify(data),
      success: function (response) {
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Usuario registrado correctamente",
            confirmButtonText: "Cerrar"
          }).then(() => window.location = "usuarios");
        } else {
          Swal.fire({
            icon: "warning",
            title: response.message || "No se pudo registrar el usuario",
            confirmButtonText: "Cerrar"
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("Error al registrar usuario:", error);
        Swal.fire({
          icon: "error",
          title: "Error al registrar el usuario. Revisa los datos.",
          confirmButtonText: "Cerrar"
        });
      }
    });

  });

});


document.addEventListener('DOMContentLoaded', function() {

    // Evento para abrir modal de asignar roles
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('btnAsignarRoles') || 
            event.target.closest('.btnAsignarRoles')) {
            
            const button = event.target.classList.contains('btnAsignarRoles') 
                ? event.target 
                : event.target.closest('.btnAsignarRoles');
            
            const usuaId = button.getAttribute('usuaId');
            console.log("ID del usuario:", usuaId);
            
            cargarDatosUsuarioParaRoles(usuaId);
        }
    });

    // Función para cargar datos del usuario
    async function cargarDatosUsuarioParaRoles(usuaId) {
      try {
          const response = await fetch(`${CONFIG.API_BASE_URL}usuarios/${usuaId}`, {
              method: 'GET',
              headers: {
                  'Authorization': CONFIG.API_AUTH_HEADER
              }
          });

          let result = await response.json();

          // Si la respuesta viene como texto, intenta parsearla
          if (typeof result === 'string') {
              try {
                  result = JSON.parse(result);
              } catch (e) {
                  console.error("No se pudo parsear la respuesta en JSON:", e, result);
                  throw new Error("Error al parsear respuesta");
              }
          }

          console.log("Respuesta del usuario:", result);

          // ✅ Verificamos si el usuario existe
          if (result && result.usuaId) {
              // Guardar ID en el campo oculto
              const hiddenusuaId = document.getElementById('asignarUserId');
              if (hiddenusuaId) {
                  hiddenusuaId.value = result.usuaId;
              }

              // Mostrar nombre del usuario
              document.getElementById('infoNombreUsuario').textContent = result.usuaNombrecompleto || '';

              // Mostrar sección de información
              document.getElementById('infoUsuario').style.display = 'block';

              // Cargar roles actuales
              await cargarRolesActuales(result.usuaId);

              // Mostrar modal
              const modalElement = document.getElementById('modalAsignarRoles');
              const modal = new bootstrap.Modal(modalElement);
              modal.show();

          } else {
              console.error("Estructura del JSON no esperada o vacía.");
              Swal.fire({
                  icon: "error",
                  title: "No se pudo cargar la información del usuario",
                  confirmButtonText: "Cerrar"
              });
          }

      } catch (error) {
          console.error("Error al obtener usuario:", error);
          Swal.fire({
              icon: "error",
              title: "Error al cargar los datos del usuario",
              text: error.message,
              confirmButtonText: "Cerrar"
          });
      }
  }

    // Función para cargar roles actuales del usuario
    async function cargarRolesActuales(userId) {
      try {
          const response = await fetch(`${CONFIG.API_BASE_URL}usuarios-roles/usuario/${userId}`, {
              headers: {
                  'Authorization': CONFIG.API_AUTH_HEADER
              }
          });

          const result = await response.json();
          const rolesActualesDiv = document.getElementById('rolesActuales');

          if (result.success && result.data && result.data.length > 0) {
              // Limpiar todos los checkboxes
              const checkboxes = document.querySelectorAll('input[name="roles[]"]');
              checkboxes.forEach(cb => cb.checked = false);

              // Marcar roles actuales
              result.data.forEach(item => {
                  const role = item.role; // ← ahora se llama 'role'
                  const checkbox = document.getElementById(`rol${role.roleId}`);
                  if (checkbox) {
                      checkbox.checked = true;
                  }
              });

              // Mostrar roles actuales como badges
              rolesActualesDiv.innerHTML = result.data.map(item =>
                  `<span class="badge bg-primary" style="margin-right: 5px;">${item.role.roleName}</span>`
              ).join('');

          } else {
              rolesActualesDiv.innerHTML = '<span class="badge bg-secondary">Ninguno</span>';
              const checkboxes = document.querySelectorAll('input[name="roles[]"]');
              checkboxes.forEach(cb => cb.checked = false);
          }

      } catch (error) {
          console.error('Error al cargar roles actuales:', error);
          document.getElementById('rolesActuales').innerHTML = '<span class="badge bg-secondary">Error al cargar</span>';
      }
  }


    // Enviar formulario de asignación de roles
    const formAsignarRoles = document.getElementById('formAsignarRoles');
    if (formAsignarRoles) {
        formAsignarRoles.addEventListener('submit', async function(event) {
          event.preventDefault();

          try {
              const userId = document.getElementById('asignarUserId').value;

              if (!userId) {
                  Swal.fire({
                      icon: 'warning',
                      title: 'Error: No se identificó el usuario',
                      confirmButtonText: 'Cerrar'
                  });
                  return;
              }

              const checkboxes = document.querySelectorAll('input[name="roles[]"]:checked');
              const rolesSeleccionados = Array.from(checkboxes).map(cb => parseInt(cb.value));

              if (rolesSeleccionados.length === 0) {
                  Swal.fire({
                      icon: 'warning',
                      title: 'Debe seleccionar al menos un rol',
                      confirmButtonText: 'Cerrar'
                  });
                  return;
              }

              // Enviar una petición por cada rol seleccionado
              for (const roleId of rolesSeleccionados) {
                  const url = `${CONFIG.API_BASE_URL}usuarios-roles/asignar?usuarioId=${userId}&roleId=${roleId}`;

                  const response = await fetch(url, {
                      method: 'POST',
                      headers: {
                          'Authorization': CONFIG.API_AUTH_HEADER
                      }
                  });

                  const result = await response.json();
                  console.log('Respuesta del servidor:', result);

                  if (!response.ok) {
                      throw new Error(result.message || 'Error al asignar rol');
                  }
              }

              Swal.fire({
                  icon: 'success',
                  title: 'Roles asignados correctamente',
                  confirmButtonText: 'Cerrar'
              }).then(() => {
                  const modalElement = document.getElementById('modalAsignarRoles');
                  const modal = bootstrap.Modal.getInstance(modalElement);
                  if (modal) modal.hide();
                  window.location.reload();
              });

          } catch (error) {
              console.error('Error al asignar roles:', error);
              Swal.fire({
                  icon: 'error',
                  title: 'No se pudo asignar los roles',
                  text: error.message,
                  confirmButtonText: 'Cerrar'
              });
          }
      });

    }

});




$(document).ready(function() {
  
  // Inicializar DataTable si existe
  if ($('#tablaUsuarios').length) {
    $('#tablaUsuarios').DataTable({
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
      },
      responsive: true
    });
  }
  
});
