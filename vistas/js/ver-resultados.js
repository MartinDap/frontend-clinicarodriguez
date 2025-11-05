const LANG = "<?php echo idioma_actual(); ?>";

document.addEventListener("DOMContentLoaded", () => {
  const dniPaciente = sessionStorage.getItem('dniPaciente') || localStorage.getItem('dniPaciente');

  if (!dniPaciente) {
    Swal.fire({
      icon: 'warning',
      title: LANG === 'es' ? 'Acceso no autorizado' : 'Unauthorized access',
      text: LANG === 'es'
        ? 'Por favor ingresa tu DNI primero'
        : 'Please enter your ID first',
      confirmButtonColor: '#667eea'
    }).then(() => {
      window.location.href = 'resultados';
    });
    return;
  }

  cargarInfoPaciente(dniPaciente);
});

/**
 * Cargar información del paciente
 */
async function cargarInfoPaciente(dni) {
  try {
    const response = await fetch(`${CONFIG.API_BASE_URL}pacientes/dni/${dni}`, {
      method: 'GET',
      headers: { 'Authorization': CONFIG.API_AUTH_HEADER }
    });

    if (!response.ok) throw new Error('Error al obtener los datos del paciente');

    const respuesta = await response.json();
    if (respuesta && respuesta.data) {
      const paciente = respuesta.data;

      document.getElementById('nombrePacienteNav').textContent = paciente.paciNombrecompleto;

      const html = `
        <div class="col-md-6">
          <p><strong>Nombre:</strong> ${paciente.paciNombrecompleto}</p>
          <p><strong>DNI:</strong> ${paciente.paciDni}</p>
        </div>
        <div class="col-md-6">
          <p><strong>Teléfono:</strong> ${paciente.paciTelefono || 'N/A'}</p>
          <p><strong>Email:</strong> ${paciente.paciEmail || 'N/A'}</p>
        </div>`;
      document.getElementById('infoPaciente').innerHTML = html;

      // Llamar a los documentos del paciente
      cargarDocumentosPaciente(dni);
    }
  } catch (error) {
    console.error("Error al cargar información del paciente:", error);
    document.getElementById('nombrePacienteNav').textContent = 'Error';
    document.getElementById('infoPaciente').innerHTML =
      '<p class="text-danger">Error al cargar información</p>';
  }
}

/**
 * Cargar documentos del paciente
 */
async function cargarDocumentosPaciente(dni) {
  try {
    const response = await fetch(`${CONFIG.API_BASE_URL}documentos/paciente/dni/${dni}`, {
      method: 'GET',
      headers: { 'Authorization': CONFIG.API_AUTH_HEADER }
    });

    if (!response.ok) throw new Error('Error al cargar los documentos');

    const respuesta = await response.json();
    console.log('Documentos recibidos:', respuesta);

    let html = '';

    if (respuesta && Array.isArray(respuesta.data) && respuesta.data.length > 0) {
      respuesta.data.forEach(doc => {
        // Saltar documentos no visibles
        if (!doc.docuVisiblePaciente) return;

        const badgeClass = doc.docuEstado ? "bg-success" : "bg-warning";
        const badgeText = doc.docuEstado
          ? (LANG === 'es' ? 'Completado' : 'Completed')
          : (LANG === 'es' ? 'En proceso' : 'In process');
        const fecha = doc.docuFechaSubida
          ? new Date(doc.docuFechaSubida).toLocaleDateString("es-PE")
          : "—";

        html += `
          <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-start">
              <div>
                <h6><i class="bi bi-file-medical me-2 text-primary"></i>${doc.docuNombre}</h6>
                <p class="text-muted small">Tipo: ${doc.docuTipo || 'N/A'}</p>
                <p class="text-muted small">Fecha: ${fecha}</p>
                <span class="badge ${badgeClass}">${badgeText}</span>
              </div>
              ${
                doc.docuUrl
                  ? `<a href="${doc.docuUrl}" target="_blank" class="btn btn-sm btn-outline-primary">
                      <i class="bi bi-download"></i> ${LANG === 'es' ? 'Descargar' : 'Download'}
                    </a>`
                  : `<button class="btn btn-sm btn-outline-secondary" disabled>
                      <i class="bi bi-download"></i> ${LANG === 'es' ? 'Descargar' : 'Download'}
                    </button>`
              }
            </div>
          </div>`;
      });
    } else {
      html = `
        <div class="alert alert-info">
          <i class="bi bi-info-circle"></i>
          ${LANG === 'es' ? 'No se encontraron documentos.' : 'No documents found.'}
        </div>`;
    }

    document.getElementById('listaResultados').innerHTML = html;

  } catch (error) {
    console.error("Error al cargar documentos:", error);
    document.getElementById('listaResultados').innerHTML = `
      <div class="alert alert-warning">
        <i class="bi bi-exclamation-triangle"></i>
        ${LANG === 'es' ? 'Error al cargar documentos.' : 'Error loading documents.'}
      </div>`;
  }
}

