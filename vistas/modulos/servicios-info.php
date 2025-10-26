<?php
require_once 'vistas/modulos/idiomas.php';

$titulo_pagina = idioma_actual() === 'es' ? 'Servicios - Clínica Médica' : 'Services - Medical Clinic';
$pagina_activa = 'servicios-info';

include 'vistas/modulos/componentes/head-publico.php';
include 'vistas/modulos/componentes/topbar-publico.php';
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
      <div class="row g-4 justify-content-center">
        
        <!-- Hospitalizacion -->
        <div class="col-md-6 col-lg-4">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column" style="padding: 2.5rem;">
              <div class="especialidad-icon mb-4" style="font-size: 4rem;">
                <i class="bi bi-hospital text-primary"></i>
              </div>
              <h5 class="card-title" style="font-size: 1.5rem; margin-bottom: 1rem;"><?php echo idioma_actual() === 'es' ? 'Hospitalización' : 'Hospitalization'; ?></h5>
              <p class="card-text flex-grow-1" style="font-size: 1rem;"><?php echo idioma_actual() === 'es' ? 'Hospitalización disponible las 24 horas del día' : 'Hospitalization available 24 hours a day'; ?></p>
            </div>
          </div>
        </div>

        <!-- UVI -->
        <div class="col-md-6 col-lg-4">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column" style="padding: 2.5rem;">
              <div class="especialidad-icon mb-4" style="font-size: 4rem;">
                <i class="bi bi-heart-pulse text-danger"></i>
              </div>
              <h5 class="card-title" style="font-size: 1.5rem; margin-bottom: 1rem;"><?php echo idioma_actual() === 'es' ? 'UVI' : 'ICU'; ?></h5>
              <p class="card-text flex-grow-1" style="font-size: 1rem;"><?php echo idioma_actual() === 'es' ? 'Unidad de Vigilancia Intensiva totalmente equipada' : 'Fully equipped Intensive Care Unit'; ?></p>
            </div>
          </div>
        </div>

        <!-- Emergencia -->
        <div class="col-md-6 col-lg-4">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column" style="padding: 2.5rem;">
              <div class="especialidad-icon mb-4" style="font-size: 4rem;">
                <i class="bi bi-activity text-danger"></i>
              </div>
              <h5 class="card-title" style="font-size: 1.5rem; margin-bottom: 1rem;"><?php echo idioma_actual() === 'es' ? 'Emergencia' : 'Emergency'; ?></h5>
              <p class="card-text flex-grow-1" style="font-size: 1rem;"><?php echo idioma_actual() === 'es' ? 'Emergencias las 24 horas del día' : 'Emergencies 24 hours a day'; ?></p>
            </div>
          </div>
        </div>

        <!-- Laboratorio -->
        <div class="col-md-6 col-lg-4">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column" style="padding: 2.5rem;">
              <div class="especialidad-icon mb-4" style="font-size: 4rem;">
                <i class="bi bi-eyedropper text-info"></i>
              </div>
              <h5 class="card-title" style="font-size: 1.5rem; margin-bottom: 1rem;"><?php echo idioma_actual() === 'es' ? 'Laboratorio' : 'Laboratory'; ?></h5>
              <p class="card-text flex-grow-1" style="font-size: 1rem;"><?php echo idioma_actual() === 'es' ? 'Laboratorio 24 horas' : 'Laboratory 24 hours'; ?></p>
            </div>
          </div>
        </div>

        <!-- Sala de Operaciones -->
        <div class="col-md-6 col-lg-4">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column" style="padding: 2.5rem;">
              <div class="especialidad-icon mb-4" style="font-size: 4rem;">
                <i class="bi bi-hospital-fill text-success"></i>
              </div>
              <h5 class="card-title" style="font-size: 1.5rem; margin-bottom: 1rem;"><?php echo idioma_actual() === 'es' ? 'Sala de Operaciones' : 'Operating Room'; ?></h5>
              <p class="card-text flex-grow-1" style="font-size: 1rem;"><?php echo idioma_actual() === 'es' ? 'Cirugías programadas y no programadas en el momento preciso' : 'Scheduled and unscheduled surgeries at the precise moment'; ?></p>
            </div>
          </div>
        </div>

        <!-- Tomografía -->
        <div class="col-md-6 col-lg-4">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column" style="padding: 2.5rem;">
              <div class="especialidad-icon mb-4" style="font-size: 4rem;">
                <i class="bi bi-images text-primary"></i>
              </div>
              <h5 class="card-title" style="font-size: 1.5rem; margin-bottom: 1rem;"><?php echo idioma_actual() === 'es' ? 'Tomografía' : 'Tomography'; ?></h5>
              <p class="card-text flex-grow-1" style="font-size: 1rem;"><?php echo idioma_actual() === 'es' ? 'Tomografía Computarizada' : 'Computed Tomography'; ?></p>
            </div>
          </div>
        </div>

        <!-- Densitometría -->
        <div class="col-md-6 col-lg-4">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column" style="padding: 2.5rem;">
              <div class="especialidad-icon mb-4" style="font-size: 4rem;">
                <i class="bi bi-clipboard2-pulse text-warning"></i>
              </div>
              <h5 class="card-title" style="font-size: 1.5rem; margin-bottom: 1rem;"><?php echo idioma_actual() === 'es' ? 'Densitometría' : 'Densitometry'; ?></h5>
              <p class="card-text flex-grow-1" style="font-size: 1rem;"><?php echo idioma_actual() === 'es' ? 'Densitometría ósea' : 'Bone densitometry'; ?></p>
            </div>
          </div>
        </div>

        <!-- Ecografía -->
        <div class="col-md-6 col-lg-4">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column" style="padding: 2.5rem;">
              <div class="especialidad-icon mb-4" style="font-size: 4rem;">
                <i class="bi bi-soundwave text-info"></i>
              </div>
              <h5 class="card-title" style="font-size: 1.5rem; margin-bottom: 1rem;"><?php echo idioma_actual() === 'es' ? 'Ecografía' : 'Ultrasound'; ?></h5>
              <p class="card-text flex-grow-1" style="font-size: 1rem;"><?php echo idioma_actual() === 'es' ? 'Ecografía de todo tipo' : 'All types of ultrasound'; ?></p>
            </div>
          </div>
        </div>

        <!-- Radiología -->
        <div class="col-md-6 col-lg-4">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column" style="padding: 2.5rem;">
              <div class="especialidad-icon mb-4" style="font-size: 4rem;">
                <i class="bi bi-x-lg text-secondary"></i>
              </div>
              <h5 class="card-title" style="font-size: 1.5rem; margin-bottom: 1rem;"><?php echo idioma_actual() === 'es' ? 'Radiología' : 'Radiology'; ?></h5>
              <p class="card-text flex-grow-1" style="font-size: 1rem;"><?php echo idioma_actual() === 'es' ? 'Rayos X computarizados' : 'Computerized X-rays'; ?></p>
            </div>
          </div>
        </div>

        <!-- Farmacia -->
        <div class="col-md-6 col-lg-4">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column" style="padding: 2.5rem;">
              <div class="especialidad-icon mb-4" style="font-size: 4rem;">
                <i class="bi bi-capsule text-success"></i>
              </div>
              <h5 class="card-title" style="font-size: 1.5rem; margin-bottom: 1rem;"><?php echo idioma_actual() === 'es' ? 'Farmacia' : 'Pharmacy'; ?></h5>
              <p class="card-text flex-grow-1" style="font-size: 1rem;"><?php echo idioma_actual() === 'es' ? 'Farmacia 24 horas' : 'Pharmacy 24 hours'; ?></p>
            </div>
          </div>
        </div>

        <!-- Banco de Sangre -->
        <div class="col-md-6 col-lg-4">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column" style="padding: 2.5rem;">
              <div class="especialidad-icon mb-4" style="font-size: 4rem;">
                <i class="bi bi-droplet-fill text-danger"></i>
              </div>
              <h5 class="card-title" style="font-size: 1.5rem; margin-bottom: 1rem;"><?php echo idioma_actual() === 'es' ? 'Banco de Sangre' : 'Blood Bank'; ?></h5>
              <p class="card-text flex-grow-1" style="font-size: 1rem;"><?php echo idioma_actual() === 'es' ? 'Banco de Sangre Tipo I-B' : 'Blood Bank Type I-B'; ?></p>
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
