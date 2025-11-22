

/*=============================================
REGISTRAR NUEVO ACTIVO TECNOLÓGICO
=============================================*/
document.addEventListener("DOMContentLoaded", function () {

  const form = document.getElementById("formRegistrarActivo");

  // ================================
  // GENERAR CÓDIGO AUTOMÁTICO
  // ================================
  const btnCodigo = document.getElementById('btnGenerarCodigo');

  if (btnCodigo) {
    btnCodigo.addEventListener('click', function () {

      const ahora = new Date();

      const anio = ahora.getFullYear();
      const mes = String(ahora.getMonth() + 1).padStart(2, '0');
      const dia = String(ahora.getDate()).padStart(2, '0');
      const hora = String(ahora.getHours()).padStart(2, '0');
      const minuto = String(ahora.getMinutes()).padStart(2, '0');
      const segundo = String(ahora.getSeconds()).padStart(2, '0');

      const codigoGenerado = `${anio}${mes}${dia}${hora}${minuto}${segundo}`;

      const input = document.getElementById('acteCodigoActivo');
      input.value = codigoGenerado;

      input.style.backgroundColor = '#d4edda';
      setTimeout(() => {
        input.style.backgroundColor = '';
      }, 500);
    });
  }

  if (!form) return;

  form.addEventListener("submit", function (event) {
    event.preventDefault(); // evita recargar la página

    // Capturar campos del formulario
    const codigoActivo    = document.getElementById("acteCodigoActivo").value.trim();
    const nombreEquipo    = document.getElementById("acteNombreEquipo").value.trim();
    const categoriaId     = document.getElementById("caacId").value;
    const marca           = document.getElementById("acteMarca").value.trim();
    const modelo          = document.getElementById("acteModelo").value.trim();
    const numeroSerie     = document.getElementById("acteNumeroSerie").value.trim();
    const fechaCompra     = document.getElementById("acteFechaCompra").value;
    const estado          = document.getElementById("acteEstado").value;
    const ubicacion       = document.getElementById("acteUbicacion").value.trim();
    const usuarioId       = document.getElementById("usuaId").value;
    const vidaUtilAnios   = document.getElementById("acteVidaUtilAnios").value;
    const fechaBaja       = document.getElementById("acteFechaBaja").value;
    const observaciones   = document.getElementById("acteObservaciones").value.trim();
    const areaId          = document.getElementById("areaId") ? document.getElementById("areaId").value : null;

    // Validar campos obligatorios
    if (!codigoActivo || !nombreEquipo || !categoriaId || !usuarioId || !estado || !ubicacion || !fechaCompra || !areaId) {
      Swal.fire({
        icon: "warning",
        title: "Complete todos los campos obligatorios antes de registrar.",
        confirmButtonText: "Cerrar"
      });
      return;
    }

    // Construir el JSON con la estructura que espera el backend
    const data = {
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
      area: {
        areaId: parseInt(areaId)
      },
      usuario: {
        usuaId: parseInt(usuarioId)
      },
      acteVidaUtilAnios: vidaUtilAnios ? parseInt(vidaUtilAnios) : null,
      acteFechaBaja: fechaBaja || null,
      acteObservaciones: observaciones
    };

    // Llamada al backend con fetch (sin jQuery)
    fetch(`${CONFIG.API_BASE_URL}activos-tecnologicos`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "Authorization": CONFIG.API_AUTH_HEADER
      },
      body: JSON.stringify(data)
    })
    .then(async (response) => {
      const responseData = await response.json().catch(() => ({}));
      console.log("Respuesta del servidor (registrar activo):", responseData);

      if (response.ok && responseData.success) {
        Swal.fire({
          icon: "success",
          title: responseData.message || "Activo registrado correctamente",
          confirmButtonText: "Cerrar"
        }).then(() => {
          window.location.href = "activos"; // redirige o recarga la lista
        });
      } else {
        Swal.fire({
          icon: "warning",
          title: responseData.message || "Hubo un problema al registrar el activo",
          confirmButtonText: "Cerrar"
        });
      }
    })
    .catch((error) => {
      console.error("Error al registrar activo:", error);
      Swal.fire({
        icon: "error",
        title: "No se pudo registrar el activo. Revisa los datos.",
        confirmButtonText: "Cerrar"
      });
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
const btnDescargarTicket = document.getElementById('btnDescargarTicket');
if (btnDescargarTicket) {
  btnDescargarTicket.addEventListener('click', function() {
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
    
    // Convertir el canvas del QR a imagen antes de capturar
    const qrCanvas = document.querySelector('#qrcode canvas');
    
    if (!qrCanvas) {
      Swal.close();
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'No se encontró el código QR',
        showConfirmButton: true
      });
      return;
    }
    
    // Crear una imagen del QR
    const qrImage = new Image();
    qrImage.src = qrCanvas.toDataURL('image/png');
    
    qrImage.onload = function() {
      // Reemplazar temporalmente el canvas con la imagen
      const qrContainer = document.getElementById('qrcode');
      const originalContent = qrContainer.innerHTML;
      qrContainer.innerHTML = '';
      qrContainer.appendChild(qrImage);
      
      // Esperar un momento para que se renderice
      setTimeout(() => {
        // Opciones para html2canvas
        const opciones = {
          scale: 3,
          backgroundColor: '#ffffff',
          logging: false,
          useCORS: true,
          allowTaint: true
        };
        
        // Generar imagen del ticket
        html2canvas(ticketContainer, opciones)
          .then(canvas => {
            // Restaurar el QR original
            qrContainer.innerHTML = originalContent;
            
            // Cerrar loading
            Swal.close();
            
            // Convertir canvas a blob
            canvas.toBlob(function(blob) {
              const url = URL.createObjectURL(blob);
              const link = document.createElement('a');
              link.download = `sticker_activo_${codigo}.png`;
              link.href = url;
              document.body.appendChild(link);
              link.click();
              document.body.removeChild(link);
              URL.revokeObjectURL(url);
              
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
            // Restaurar el QR original en caso de error
            qrContainer.innerHTML = originalContent;
            Swal.close();
            console.error('Error al generar el sticker:', error);
            Swal.fire({
              icon: 'error',
              title: 'Error al generar el sticker',
              text: 'Por favor, intente nuevamente',
              showConfirmButton: true
            });
          });
      }, 100);
    };
  });
}

document.getElementById('btnGenerarReporte')?.addEventListener('click', async function() {
  Swal.fire({
    title: 'Preparando impresión...',
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading();
    }
  });
  
  try {
    const url = `${CONFIG.API_BASE_URL}activos-tecnologicos`;
    const headers = {
      "Authorization": CONFIG.API_AUTH_HEADER,
      "Content-Type": "application/json"
    };
    
    const response = await fetch(url, { method: 'GET', headers: headers });
    const data = await response.json();
    
    if (!data || !data.data || data.data.length === 0) {
      throw new Error('No hay activos para imprimir');
    }
    
    // Crear ventana de impresión
    const ventanaImpresion = window.open('', '_blank');
    ventanaImpresion.document.write(generarHTMLImpresion(data.data));
    ventanaImpresion.document.close();
    
    // Esperar a que carguen los QR
    setTimeout(() => {
      Swal.close();
      ventanaImpresion.print();
    }, 2000);
    
  } catch (error) {
    Swal.close();
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: error.message
    });
  }
});

function generarHTMLImpresion(activos) {
  let ticketsHTML = '';
  
  activos.forEach(activo => {
    const infoQR = `ACTIVO|${activo.acteCodigoActivo}|${activo.acteNombreEquipo}|${activo.acteUbicacion}`;
    const qrId = `qr_${activo.acteId}`;
    
    ticketsHTML += `
      <div class="ticket">
        <div class="ticket-info">
          <p><strong>Código:</strong> ${activo.acteCodigoActivo}</p>
          <p><strong>Activo:</strong> ${activo.acteNombreEquipo}</p>
          <p><strong>Área:</strong> ${activo.acteUbicacion}</p>
          <p><strong>Adquisición:</strong> ${activo.acteFechaCompra}</p>
        </div>
        <hr>
        <div id="${qrId}" class="qr-container"></div>
        <div class="ticket-footer">Sistema de Gestión de Activos</div>
      </div>
    `;
  });
  
  return `
    <!DOCTYPE html>
    <html>
    <head>
      <title>Reporte de Activos</title>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
      <style>
        @page { size: A4; margin: 10mm; }
        body { font-family: Arial, sans-serif; margin: 0; padding: 10px; }
        .tickets-grid { 
          display: grid;
          grid-template-columns: repeat(2, 1fr);
          gap: 10px;
        }
        .ticket {
          border: 2px dashed #003264;
          border-radius: 10px;
          padding: 15px;
          page-break-inside: avoid;
          background: white;
        }
        .ticket-info { font-size: 12px; line-height: 1.6; }
        .ticket-info p { margin: 5px 0; }
        hr { border-top: 1px solid #003264; margin: 10px 0; }
        .qr-container { text-align: center; margin: 10px 0; }
        .ticket-footer { text-align: center; font-size: 9px; color: #666; margin-top: 10px; }
        @media print {
          .tickets-grid { gap: 5mm; }
        }
      </style>
    </head>
    <body>
      <div class="tickets-grid">${ticketsHTML}</div>
      <script>
        ${activos.map(activo => `
          new QRCode(document.getElementById('qr_${activo.acteId}'), {
            text: 'ACTIVO|${activo.acteCodigoActivo}|${activo.acteNombreEquipo}|${activo.acteUbicacion}',
            width: 100,
            height: 100,
            colorDark: '#003264',
            colorLight: '#ffffff'
          });
        `).join('\n')}
      </script>
    </body>
    </html>
  `;
}