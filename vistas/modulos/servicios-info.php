<?php
require_once 'vistas/modulos/idiomas.php';

$titulo_pagina = idioma_actual() === 'es' ? 'Servicios - Clínica Médica' : 'Services - Medical Clinic';
$pagina_activa = 'servicios-info';

include 'vistas/modulos/componentes/head-publico.php';
include 'vistas/modulos/componentes/navbar-publico.php';
?>

  <section class="hero-section" style="min-height: 300px;">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 text-center">
          <h1 class="display-4 fw-bold mb-4"><?php echo t('nav_servicios'); ?></h1>
          <p class="lead"><?php echo idioma_actual() === 'es' ? 'Servicios médicos integrales para tu bienestar' : 'Comprehensive medical services for your well-being'; ?></p>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-6">
          <div class="card h-100 shadow">
            <div class="card-body p-4">
              <div class="d-flex align-items-center mb-3">
                <i class="bi bi-hospital text-primary fs-1 me-3"></i>
                <h3 class="mb-0"><?php echo t('footer_hospitalizacion'); ?></h3>
              </div>
              <p><?php echo idioma_actual() === 'es' ? 'Habitaciones cómodas y equipadas con tecnología moderna para su recuperación' : 'Comfortable rooms equipped with modern technology for your recovery'; ?></p>
              <ul>
                <li><?php echo idioma_actual() === 'es' ? 'Habitaciones individuales y compartidas' : 'Single and shared rooms'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Atención 24/7' : '24/7 care'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Monitoreo constante' : 'Constant monitoring'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card h-100 shadow">
            <div class="card-body p-4">
              <div class="d-flex align-items-center mb-3">
                <i class="bi bi-heart-pulse-fill text-danger fs-1 me-3"></i>
                <h3 class="mb-0"><?php echo t('footer_emergencia'); ?></h3>
              </div>
              <p><?php echo idioma_actual() === 'es' ? 'Atención de emergencias médicas las 24 horas del día' : '24-hour emergency medical care'; ?></p>
              <ul>
                <li><?php echo idioma_actual() === 'es' ? 'Respuesta inmediata' : 'Immediate response'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Ambulancia disponible' : 'Ambulance available'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Personal especializado' : 'Specialized staff'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card h-100 shadow">
            <div class="card-body p-4">
              <div class="d-flex align-items-center mb-3">
                <i class="bi bi-eyedropper text-success fs-1 me-3"></i>
                <h3 class="mb-0"><?php echo t('footer_laboratorio'); ?></h3>
              </div>
              <p><?php echo idioma_actual() === 'es' ? 'Análisis clínicos con resultados rápidos y precisos' : 'Clinical analysis with fast and accurate results'; ?></p>
              <ul>
                <li><?php echo idioma_actual() === 'es' ? 'Análisis de sangre' : 'Blood tests'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Exámenes de orina' : 'Urine tests'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Microbiología' : 'Microbiology'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card h-100 shadow">
            <div class="card-body p-4">
              <div class="d-flex align-items-center mb-3">
                <i class="bi bi-bandaid text-warning fs-1 me-3"></i>
                <h3 class="mb-0"><?php echo t('footer_sala_operaciones'); ?></h3>
              </div>
              <p><?php echo idioma_actual() === 'es' ? 'Quirófanos modernos equipados con tecnología de última generación' : 'Modern operating rooms equipped with state-of-the-art technology'; ?></p>
              <ul>
                <li><?php echo idioma_actual() === 'es' ? 'Cirugías programadas' : 'Scheduled surgeries'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Cirugías de emergencia' : 'Emergency surgeries'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Equipos especializados' : 'Specialized equipment'; ?></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php include 'vistas/modulos/componentes/footer-publico.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
