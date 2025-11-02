



// Función para generar código automático basado en fecha y hora
document.getElementById('btnGenerarCodigo').addEventListener('click', function() {
  const ahora = new Date();
  
  // Obtener componentes de fecha y hora
  const anio = ahora.getFullYear();
  const mes = String(ahora.getMonth() + 1).padStart(2, '0');
  const dia = String(ahora.getDate()).padStart(2, '0');
  const hora = String(ahora.getHours()).padStart(2, '0');
  const minuto = String(ahora.getMinutes()).padStart(2, '0');
  const segundo = String(ahora.getSeconds()).padStart(2, '0');
  
  // Crear código concatenado: AAAAMMDDHHMMSS
  const codigoGenerado = `${anio}${mes}${dia}${hora}${minuto}${segundo}`;
  
  // Asignar al campo
  document.getElementById('acteCodigoActivo').value = codigoGenerado;
  
  // Opcional: Efecto visual de confirmación
  const input = document.getElementById('acteCodigoActivo');
  input.style.backgroundColor = '#d4edda';
  setTimeout(() => {
    input.style.backgroundColor = '';
  }, 500);
});


/*=============================================
REGISTRAR NUEVO ACTIVO TECNOLÓGICO
=============================================*/
$(document).ready(function () {

  $("#formRegistrarActivo").submit(function (event) {
    event.preventDefault(); // evita recargar la página

    // Capturar campos del formulario
    var codigoActivo    = $("#acteCodigoActivo").val().trim();
    var nombreEquipo    = $("#acteNombreEquipo").val().trim();
    var categoriaId     = $("#caacId").val();
    var marca           = $("#acteMarca").val().trim();
    var modelo          = $("#acteModelo").val().trim();
    var numeroSerie     = $("#acteNumeroSerie").val().trim();
    var fechaCompra     = $("#acteFechaCompra").val();
    var estado          = $("#acteEstado").val();
    var ubicacion       = $("#acteUbicacion").val().trim();
    var usuarioId       = $("#usuaId").val();
    var vidaUtilAnios   = $("#acteVidaUtilAnios").val();
    var fechaBaja       = $("#acteFechaBaja").val();
    var observaciones   = $("#acteObservaciones").val().trim();

    // Validar campos obligatorios
    if (!codigoActivo || !nombreEquipo || !categoriaId || !usuarioId || !estado || !ubicacion || !fechaCompra) {
      Swal.fire({
        icon: "warning",
        title: "Complete todos los campos obligatorios antes de registrar.",
        confirmButtonText: "Cerrar"
      });
      return;
    }

    // Construir el JSON con la estructura que espera el backend
    var data = {
      acteCodigoActivo: codigoActivo,
      acteNombreEquipo: nombreEquipo,
      categoria: {
        caacId: parseInt(categoriaId)
      },
      acteMarca: marca,
      acteModelo: modelo,
      acteNumeroSerie: numeroSerie,
      acteFechaCompra: fechaCompra,
      acteEstado: estado,
      acteUbicacion: ubicacion,
      usuario: {
        usuaId: parseInt(usuarioId)
      },
      acteVidaUtilAnios: vidaUtilAnios ? parseInt(vidaUtilAnios) : null,
      acteFechaBaja: fechaBaja || null,
      acteObservaciones: observaciones
    };

    // Configuración del AJAX
    $.ajax({
      url: `${CONFIG.API_BASE_URL}activos-tecnologicos`, // cambia si tu endpoint tiene otro nombre
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "Authorization": CONFIG.API_AUTH_HEADER
      },
      data: JSON.stringify(data),
      success: function (response) {
        console.log("Respuesta del servidor (registrar activo):", response);

        if (response.success) {
          Swal.fire({
            icon: "success",
            title: response.message || "Activo registrado correctamente",
            confirmButtonText: "Cerrar"
          }).then(() => window.location = "activos"); // redirige o recarga la lista
        } else {
          Swal.fire({
            icon: "warning",
            title: response.message || "Hubo un problema al registrar el activo",
            confirmButtonText: "Cerrar"
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("Error al registrar activo:", error);
        console.error("Detalle:", xhr.responseText);

        Swal.fire({
          icon: "error",
          title: "No se pudo registrar el activo. Revisa los datos.",
          confirmButtonText: "Cerrar"
        });
      }
    });
  });

});



$(document).ready(function() {
  if ($('#tablaActivos').length) {

    // Si ya existe una instancia, destrúyela antes
    if ($.fn.DataTable.isDataTable('#tablaActivos')) {
      $('#tablaActivos').DataTable().clear().destroy();
    }

    // Luego inicializa normalmente
    $('#tablaActivos').DataTable({
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
      },
      responsive: true,
      pageLength: 10
    });
  }
});


// Event delegation para manejar el click en el botón Ver Activo
document.addEventListener('click', function(e) {
  if (e.target.closest('.btnVerActivo')) {
    const button = e.target.closest('.btnVerActivo');
    const acteId = button.getAttribute('acteId');
    console.log("ID del activo:", acteId);
    
    // Mostrar loading
    Swal.fire({
      title: 'Cargando...',
      text: 'Generando ticket del activo',
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      }
    });
    
    // Configuración de la petición
    const url = `${CONFIG.API_BASE_URL}activos-tecnologicos/${acteId}`;
    const headers = {
      "Authorization": CONFIG.API_AUTH_HEADER,
      "Content-Type": "application/json"
    };
    
    // Realizar petición fetch
    fetch(url, {
      method: 'GET',
      headers: headers,
      timeout: 0
    })
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      // Cerrar loading
      Swal.close();
      
      console.log("Respuesta del activo:", data);
      
      // Verificar estructura de la respuesta
      if (data && data.data) {
        const activo = data.data;
        
        // Preparar datos para el ticket
        const datosTicket = {
          codigo: activo.acteCodigoActivo || 'N/A',
          nombre: activo.acteNombreEquipo || 'N/A',
          ubicacion: activo.acteUbicacion || 'N/A',
          fechaCompra: activo.acteFechaCompra || 'N/A'
        };
        
        // Abrir modal con los datos del ticket
        abrirModalTicket(datosTicket);
        
      } else {
        console.error("La estructura del JSON no es la esperada o los datos están vacíos.");
        Swal.fire({
          icon: "error",
          title: "No se pudo cargar la información del activo",
          showConfirmButton: true
        });
      }
    })
    .catch(error => {
      Swal.close();
      console.error("Error al obtener activo:", error);
      Swal.fire({
        icon: "error",
        title: "Error al cargar los datos del activo",
        text: error.message,
        showConfirmButton: true
      });
    });
  }
});

// Función para abrir el modal y generar el ticket
function abrirModalTicket(datosActivo) {
  // Limpiar QR anterior si existe
  document.getElementById('qrcode').innerHTML = '';
  
  // Cargar datos en el ticket
  document.getElementById('ticketCodigo').textContent = datosActivo.codigo;
  document.getElementById('ticketNombre').textContent = datosActivo.nombre;
  document.getElementById('ticketUbicacion').textContent = datosActivo.ubicacion;
  document.getElementById('ticketFechaCompra').textContent = datosActivo.fechaCompra;
  
  // Generar código QR con la información del activo
  const infoQR = `ACTIVO|${datosActivo.codigo}|${datosActivo.nombre}|${datosActivo.ubicacion}`;
  
  const qrcodeInstance = new QRCode(document.getElementById('qrcode'), {
    text: infoQR,
    width: 120,
    height: 120,
    colorDark: "#003264",
    colorLight: "#ffffff",
    correctLevel: QRCode.CorrectLevel.H
  });
  
  // Abrir el modal con Bootstrap 5
  const modalElement = document.getElementById('modalTicketActivo');
  const modal = new bootstrap.Modal(modalElement);
  modal.show();
}

// Método para descargar el ticket como imagen
document.getElementById('btnDescargarTicket').addEventListener('click', function() {
  const ticketContainer = document.getElementById('ticketContainer');
  const codigo = document.getElementById('ticketCodigo').textContent;
  
  // Mostrar loading
  Swal.fire({
    title: 'Generando sticker...',
    text: 'Por favor espere',
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading();
    }
  });
  
  // Esperar a que el QR se renderice completamente
  setTimeout(() => {
    // Opciones para html2canvas
    const opciones = {
      scale: 3, // Mayor calidad (3x)
      backgroundColor: '#ffffff',
      logging: false,
      useCORS: true,
      allowTaint: true,
      foreignObjectRendering: false,
      imageTimeout: 0,
      // Importante para capturar el canvas del QR
      onclone: function(clonedDoc) {
        // Asegurar que el QR canvas esté visible en el clon
        const qrCanvas = clonedDoc.querySelector('#qrcode canvas');
        if (qrCanvas) {
          qrCanvas.style.display = 'block';
          qrCanvas.style.margin = '0 auto';
        }
      }
    };
    
    // Generar imagen del ticket
    html2canvas(ticketContainer, opciones)
      .then(canvas => {
        // Cerrar loading
        Swal.close();
        
        // Convertir canvas a blob
        canvas.toBlob(function(blob) {
          // Crear URL temporal del blob
          const url = URL.createObjectURL(blob);
          
          // Crear enlace de descarga
          const link = document.createElement('a');
          link.download = `sticker_activo_${codigo}.png`;
          link.href = url;
          
          // Simular click para descargar
          document.body.appendChild(link);
          link.click();
          
          // Limpiar
          document.body.removeChild(link);
          URL.revokeObjectURL(url);
          
          // Notificación de éxito
          Swal.fire({
            icon: 'success',
            title: '¡Descarga exitosa!',
            text: 'El sticker se ha descargado correctamente',
            timer: 2000,
            showConfirmButton: false
          });
        }, 'image/png', 1.0);
      })
      .catch(error => {
        Swal.close();
        console.error('Error al generar el sticker:', error);
        Swal.fire({
          icon: 'error',
          title: 'Error al generar el sticker',
          text: 'Por favor, intente nuevamente',
          showConfirmButton: true
        });
      });
  }, 500); // Esperar 500ms para que el QR se renderice
});