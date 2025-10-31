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
