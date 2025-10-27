/*=============================================
SUBIR DOCUMENTO DEL PACIENTE
=============================================*/
$(document).ready(function () {

  $("#formSubirDocumento").on("submit", function (event) {
    event.preventDefault(); // Evita recargar la página

    // Capturar datos del formulario
    var paciId = $("#paciId").val();
    var docNombre = $("#docNombre").val();
    var archivo = $("#docArchivo")[0].files[0];

    if (!archivo) {
      Swal.fire({
        icon: "warning",
        title: "Selecciona un archivo antes de subir.",
        confirmButtonText: "Cerrar"
      });
      return;
    }

    // Crear el FormData
    var formData = new FormData();
    formData.append("file", archivo);
    formData.append("paciId", paciId);
    formData.append("nombre", docNombre);
    formData.append("tipo", "Otro"); // Puedes cambiarlo dinámicamente si tienes un campo tipo
    formData.append("visiblePaciente", "true");
    formData.append("confidencial", "true");

    console.log("Subiendo documento:", {
      paciId,
      docNombre,
      archivo
    });

    // Configurar la solicitud AJAX
    $.ajax({
      async: true,
      crossDomain: true,
      url: `${CONFIG.API_BASE_URL}documentos/upload`,
      method: "POST",
      headers: {
        "Authorization": CONFIG.API_AUTH_HEADER
      },
      processData: false,
      contentType: false,
      mimeType: "multipart/form-data",
      data: formData,
      success: function (response) {
        console.log("Respuesta del servidor (subir documento):", response);

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
      },
      error: function (xhr, status, error) {
        console.error("Error al subir documento:", error);
        console.error("Detalle:", xhr.responseText);

        Swal.fire({
          icon: "error",
          title: "No se pudo subir el documento",
          text: xhr.responseText || "Verifica el archivo e inténtalo nuevamente.",
          confirmButtonText: "Cerrar"
        });
      }
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