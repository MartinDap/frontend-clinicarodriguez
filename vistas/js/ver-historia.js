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