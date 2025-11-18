document.addEventListener("DOMContentLoaded", function () {

  const form = document.getElementById("formRegistrarArea");
  if (!form) return;

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    const areaNombre     = document.getElementById("areaNombre").value.trim();
    const areaDescripcion = document.getElementById("areaDescripcion").value.trim();
    const areaPadreId    = document.getElementById("areaPadreId").value;

    if (!areaNombre) {
      Swal.fire({
        icon: "warning",
        title: "El nombre del área es obligatorio.",
        confirmButtonText: "Cerrar"
      });
      return;
    }

    const data = {
      areaNombre: areaNombre,
      areaDescripcion: areaDescripcion || null
    };

    if (areaPadreId) {
      data.areaPadre = {
        areaId: parseInt(areaPadreId)
      };
    }

    fetch(`${CONFIG.API_BASE_URL}areas`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "Authorization": CONFIG.API_AUTH_HEADER
      },
      body: JSON.stringify(data)
    })
    .then(async (response) => {
      const responseData = await response.json().catch(() => ({}));
      console.log("Respuesta servidor (registrar área):", responseData);

      if (response.ok && responseData.success) {
        Swal.fire({
          icon: "success",
          title: responseData.message || "Área registrada correctamente",
          confirmButtonText: "Cerrar"
        }).then(() => {
          window.location.reload(); // recarga la lista de áreas
        });
      } else {
        Swal.fire({
          icon: "warning",
          title: responseData.message || "Hubo un problema al registrar el área",
          confirmButtonText: "Cerrar"
        });
      }
    })
    .catch((error) => {
      console.error("Error al registrar área:", error);
      Swal.fire({
        icon: "error",
        title: "No se pudo registrar el área. Revisa los datos.",
        confirmButtonText: "Cerrar"
      });
    });

  });

  // Delegación de eventos: escucha clicks en toda la página
  document.addEventListener("click", function (event) {

    // Verificar si el click fue en un botón .btnEliminarArea o dentro de él (ícono)
    const btn = event.target.closest(".btnEliminarArea");
    if (!btn) return; // si no es ese botón, no hacemos nada

    const areaId = btn.getAttribute("areaId");
    console.log("ID del área a eliminar:", areaId);

    if (!areaId) {
      console.error("No se encontró el areaId en el botón.");
      return;
    }

    Swal.fire({
      title: '¿Está seguro de borrar el área?',
      text: "¡Si no lo está puede cancelar la acción!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Sí, borrar área'
    }).then(function(result) {

      if (result.isConfirmed) {
        console.log("Eliminando área:", areaId);

        fetch(`${CONFIG.API_BASE_URL}areas/${areaId}`, {
          method: "DELETE",
          headers: {
            "Authorization": CONFIG.API_AUTH_HEADER
          }
        })
        .then(async (response) => {
          const responseData = await response.json().catch(() => ({}));
          console.log("Respuesta eliminar área:", responseData);

          if (response.ok && (responseData.success === true || responseData.message)) {
            Swal.fire({
              icon: "success",
              title: responseData.message || "El área ha sido eliminada correctamente",
              confirmButtonText: "Cerrar"
            }).then((r) => {
              if (r.isConfirmed) {
                // Ajusta "areas" por la ruta de tu vista si se llama distinto
                window.location.href = "organigrama";
              }
            });
          } else {
            Swal.fire({
              icon: "error",
              title: responseData.message || "No se pudo eliminar el área",
              text: "Por favor, intente nuevamente",
              confirmButtonText: "Cerrar"
            });
          }
        })
        .catch((error) => {
          console.error("Error al eliminar área:", error);
          Swal.fire({
            icon: "error",
            title: "No se pudo eliminar el área",
            text: "Por favor, intente nuevamente",
            confirmButtonText: "Cerrar"
          });
        });
      }
    });

  });

});
