<?php
require_once 'vistas/modulos/idiomas.php';

$titulo_pagina = idioma_actual() === 'es' ? 'Nuestros Médicos - Clínica Médica' : 'Our Doctors - Medical Clinic';
$pagina_activa = 'medicos-info';

include 'vistas/modulos/componentes/head-publico.php';
include 'vistas/modulos/componentes/topbar-publico.php';
include 'vistas/modulos/componentes/navbar-publico.php';
?>

  <!-- Hero Section -->
  <section class="hero-section" style="min-height: 300px;">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 text-center">
          <h1 class="display-4 fw-bold mb-4"><?php echo t('nav_medicos'); ?></h1>
          <p class="lead"><?php echo idioma_actual() === 'es' ? 'Equipo médico altamente calificado y comprometido' : 'Highly qualified and committed medical team'; ?></p>
        </div>
      </div>
    </div>
  </section>

  <!-- Sección de Médicos -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row g-4" id="contenedorMedicos">
        <!-- Los médicos se cargarán dinámicamente aquí -->
        <div class="col-12 text-center">
          <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Cargando...</span>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php include 'vistas/modulos/componentes/footer-publico.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="vistas/js/config.js"></script>
<script>
  /**
   * Script para cargar y mostrar médicos dinámicamente desde el backend
   */
  $(document).ready(function() {
    // Configuración de la petición AJAX
    var configuracion = {
      url: `${CONFIG.API_BASE_URL}medicos`,
      method: "GET",
      timeout: 0,
      headers: {
        "Authorization": CONFIG.API_AUTH_HEADER
      }
    };

    // Realizar petición al backend
    $.ajax(configuracion)
      .done(function(respuesta) {
        console.log("Médicos recibidos:", respuesta);
        
        // Limpiar el contenedor
        $('#contenedorMedicos').empty();
        
        // Validar que existan datos
        if (respuesta && respuesta.data && respuesta.data.length > 0) {
          respuesta.data.forEach(function(medico) {
            
            // Construir las etiquetas de especialidades
            let etiquetasEspecialidades = '';
            if (Array.isArray(medico.especialidades) && medico.especialidades.length > 0) {
              etiquetasEspecialidades = medico.especialidades
                .map(espe => `<span class="badge bg-primary me-1">${espe.espeNombre}</span>`)
                .join('');
            } else {
              etiquetasEspecialidades = `<span class="badge bg-secondary">Sin especialidad</span>`;
            }

            // Construir la tarjeta del médico
            const tarjetaMedico = `
              <div class="col-md-6 col-lg-3 mb-4">
                <div class="card medico-card border-0 shadow-sm h-100">
                  <div class="medico-photo-wrapper">
                    <img src="${medico.mediFotoUrl || 'vistas/img/default-doctor.jpg'}" 
                        alt="${medico.mediNombre}" 
                        class="medico-photo-img w-100 rounded-top">
                  </div>
                  <div class="card-body text-center">
                    <h5 class="medico-nombre mb-1">${medico.mediNombre}</h5>
                    <div class="medico-especialidades mb-2">
                      ${etiquetasEspecialidades}
                    </div>
                  </div>
                </div>
              </div>
            `;

            // Agregar la tarjeta al contenedor
            $('#contenedorMedicos').append(tarjetaMedico);
          });
        } else {
          $('#contenedorMedicos').html('<p class="text-center text-muted">No hay médicos disponibles.</p>');
        }

      })
      .fail(function(xhr, estado, error) {
        console.error("Error al cargar médicos:", error);
        
        // Mostrar mensaje de error
        $('#contenedorMedicos').html(`
          <div class="col-12 text-center">
            <p class="text-danger">Error al cargar la información de los médicos.</p>
          </div>
        `);
      });
  });
</script>
</body>
</html>
