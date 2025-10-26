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
      <div class="row g-4">
        
        <!-- Médico 1 -->
        <div class="col-md-6 col-lg-3">
          <div class="card medico-card border-0 h-100">
            <div class="medico-photo-wrapper">
              <img src="vistas/img/doc-neurocirugia.jpg" alt="OSWALDO RODRIGUEZ MEDINA" class="medico-photo-img">
            </div>
            <div class="card-body text-center">
              <h5 class="medico-nombre mb-1">OSWALDO RODRIGUEZ MEDINA</h5>
              <p class="medico-especialidad mb-3"><?php echo t('especialidad_neurocirugia'); ?></p>
            </div>
          </div>
        </div>

        <!-- Médico 2 -->
        <div class="col-md-6 col-lg-3">
          <div class="card medico-card border-0 h-100">
            <div class="medico-photo-wrapper">
              <img src="vistas/img/dco-ginecologia-obstetricia.jpg" alt="DANIELL VILLAMIZAR HERNANDEZ" class="medico-photo-img">
            </div>
            <div class="card-body text-center">
              <h5 class="medico-nombre mb-1">DANIELL VILLAMIZAR HERNANDEZ</h5>
              <p class="medico-especialidad mb-3"><?php echo t('especialidad_ginecologia'); ?></p>
            </div>
          </div>
        </div>

        <!-- Médico 3 -->
        <div class="col-md-6 col-lg-3">
          <div class="card medico-card border-0 h-100">
            <div class="medico-photo-wrapper">
              <img src="vistas/img/doc-neurologia.jpg" alt="MOISES RAFAEL ANGELES SOTELO" class="medico-photo-img">
            </div>
            <div class="card-body text-center">
              <h5 class="medico-nombre mb-1">MOISES RAFAEL ANGELES SOTELO</h5>
              <p class="medico-especialidad mb-3"><?php echo t('especialidad_neurologia'); ?></p>
            </div>
          </div>
        </div>

        <!-- Médico 4 -->
        <div class="col-md-6 col-lg-3">
          <div class="card medico-card border-0 h-100">
            <div class="medico-photo-wrapper">
              <img src="vistas/img/doc-neumologia.jpg" alt="HYMAN TOM ROJAS NAVARRO" class="medico-photo-img">
            </div>
            <div class="card-body text-center">
              <h5 class="medico-nombre mb-1">HYMAN TOM ROJAS NAVARRO</h5>
              <p class="medico-especialidad mb-3"><?php echo t('footer_cardiologia'); ?></p>
            </div>
          </div>
        </div>

        <!-- Médico 5 -->
        <div class="col-md-6 col-lg-3">
          <div class="card medico-card border-0 h-100">
            <div class="medico-photo-wrapper">
              <img src="vistas/img/doc-cirugia-general.jpg" alt="HECTOR MARTIN NUÑEZ DE LA CRUZ" class="medico-photo-img">
            </div>
            <div class="card-body text-center">
              <h5 class="medico-nombre mb-1">HECTOR MARTIN NUÑEZ DE LA CRUZ</h5>
              <p class="medico-especialidad mb-3"><?php echo idioma_actual() === 'es' ? 'Cirugía General' : 'General Surgery'; ?></p>
            </div>
          </div>
        </div>

        <!-- Médico 6 -->
        <div class="col-md-6 col-lg-3">
          <div class="card medico-card border-0 h-100">
            <div class="medico-photo-wrapper">
              <img src="vistas/img/doc-dermatologia.jpg" alt="JOSE ONTON REYNAGA" class="medico-photo-img">
            </div>
            <div class="card-body text-center">
              <h5 class="medico-nombre mb-1">JOSE ONTON REYNAGA</h5>
              <p class="medico-especialidad mb-3"><?php echo idioma_actual() === 'es' ? 'Dermatología' : 'Dermatology'; ?></p>
            </div>
          </div>
        </div>

        <!-- Médico 7 -->
        <div class="col-md-6 col-lg-3">
          <div class="card medico-card border-0 h-100">
            <div class="medico-photo-wrapper">
              <img src="vistas/img/doc-pediatria.jpg" alt="YENIFER ALEJANDRA PARRA BARBOZA" class="medico-photo-img">
            </div>
            <div class="card-body text-center">
              <h5 class="medico-nombre mb-1">YENIFER ALEJANDRA PARRA BARBOZA</h5>
              <p class="medico-especialidad mb-3"><?php echo idioma_actual() === 'es' ? 'Pediatría' : 'Pediatrics'; ?></p>
            </div>
          </div>
        </div>

        <!-- Médico 8 -->
        <div class="col-md-6 col-lg-3">
          <div class="card medico-card border-0 h-100">
            <div class="medico-photo-wrapper">
              <img src="vistas/img/doc-cirugia-general-roxana.jpg" alt="ROXANA ELIZABETH SOTELO DIESTRA" class="medico-photo-img">
            </div>
            <div class="card-body text-center">
              <h5 class="medico-nombre mb-1">ROXANA ELIZABETH SOTELO DIESTRA</h5>
              <p class="medico-especialidad mb-3"><?php echo t('especialidad_endocrinologia'); ?></p>
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
