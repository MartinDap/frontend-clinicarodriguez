<?php
require_once 'vistas/modulos/idiomas.php';

$titulo_pagina = idioma_actual() === 'es' ? 'Especialidades - Clínica Médica' : 'Specialties - Medical Clinic';
$pagina_activa = 'especialidades-info';

include 'vistas/modulos/componentes/head-publico.php';
include 'vistas/modulos/componentes/topbar-publico.php';
include 'vistas/modulos/componentes/navbar-publico.php';
?>

  <!-- Hero -->
  <section class="hero-section" style="min-height: 300px;">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 text-center">
          <h1 class="display-4 fw-bold mb-4"><?php echo t('nav_especialidades'); ?></h1>
          <p class="lead">
            <?php echo idioma_actual() === 'es' ? 'Contamos con especialistas altamente calificados' : 'We have highly qualified specialists'; ?>
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Especialidades -->
  <section class="py-5">
    <div class="container">
      <div class="row g-4">

        <!-- Neurocirugía -->
        <div class="col-md-6 col-lg-3">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column">
              <div class="especialidad-icon mb-3">
                <i class="bi bi-cpu text-primary"></i>
              </div>
              <h5 class="card-title"><?php echo t('especialidad_neurocirugia'); ?></h5>
              <p class="card-text flex-grow-1"><?php echo t('especialidad_neurocirugia_desc'); ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Cirugía cerebral' : 'Brain surgery'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Cirugía de columna' : 'Spine surgery'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Tratamiento de tumores' : 'Tumor treatment'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Ginecología y Obstetricia -->
        <div class="col-md-6 col-lg-3">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column">
              <div class="especialidad-icon mb-3">
                <i class="bi bi-gender-female text-danger"></i>
              </div>
              <h5 class="card-title"><?php echo idioma_actual() === 'es' ? 'Ginecología y Obstetricia' : 'Gynecology & Obstetrics'; ?></h5>
              <p class="card-text flex-grow-1"><?php echo idioma_actual() === 'es' ? 'Atención especializada para la salud femenina y el embarazo.' : 'Specialized care for women’s health and pregnancy.'; ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Control prenatal' : 'Prenatal care'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Partos y cesáreas' : 'Deliveries and C-sections'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Salud reproductiva' : 'Reproductive health'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Neurología -->
        <div class="col-md-6 col-lg-3">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column">
              <div class="especialidad-icon mb-3">
                <i class="bi bi-activity text-info"></i>
              </div>
              <h5 class="card-title"><?php echo t('especialidad_neurologia'); ?></h5>
              <p class="card-text flex-grow-1"><?php echo t('especialidad_neurologia_desc'); ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Migrañas y cefaleas' : 'Migraines and headaches'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Epilepsia' : 'Epilepsy'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Trastornos del movimiento' : 'Movement disorders'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Cardiología -->
        <div class="col-md-6 col-lg-3">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column">
              <div class="especialidad-icon mb-3">
                <i class="bi bi-heart-pulse text-danger"></i>
              </div>
              <h5 class="card-title"><?php echo t('footer_cardiologia'); ?></h5>
              <p class="card-text flex-grow-1">
                <?php echo idioma_actual() === 'es'
                  ? 'Especialidad dedicada al diagnóstico y tratamiento de enfermedades del corazón.'
                  : 'Specialty dedicated to the diagnosis and treatment of heart diseases.'; ?>
              </p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Ecocardiogramas' : 'Echocardiograms'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Electrocardiogramas' : 'Electrocardiograms'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Hipertensión arterial' : 'Arterial hypertension'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Cirugía General -->
        <div class="col-md-6 col-lg-3">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column">
              <div class="especialidad-icon mb-3">
                <i class="bi bi-scissors text-secondary"></i>
              </div>
              <h5 class="card-title"><?php echo idioma_actual() === 'es' ? 'Cirugía General' : 'General Surgery'; ?></h5>
              <p class="card-text flex-grow-1"><?php echo idioma_actual() === 'es' ? 'Prevención, diagnóstico y tratamiento quirúrgico de diversas enfermedades.' : 'Prevention, diagnosis and surgical treatment of various diseases.'; ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Cirugía abdominal' : 'Abdominal surgery'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Cirugía laparoscópica' : 'Laparoscopic surgery'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Cirugía de urgencia' : 'Emergency surgery'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Dermatología -->
        <div class="col-md-6 col-lg-3">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column">
              <div class="especialidad-icon mb-3">
                <i class="bi bi-person-check text-warning"></i>
              </div>
              <h5 class="card-title"><?php echo idioma_actual() === 'es' ? 'Dermatología' : 'Dermatology'; ?></h5>
              <p class="card-text flex-grow-1"><?php echo idioma_actual() === 'es' ? 'Especialidad que estudia y trata enfermedades de la piel.' : 'Specialty that studies and treats skin diseases.'; ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Enfermedades de la piel' : 'Skin diseases'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Acné' : 'Acne'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Psoriasis' : 'Psoriasis'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Pediatría -->
        <div class="col-md-6 col-lg-3">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column">
              <div class="especialidad-icon mb-3">
                <i class="bi bi-emoji-smile text-success"></i>
              </div>
              <h5 class="card-title"><?php echo idioma_actual() === 'es' ? 'Pediatría' : 'Pediatrics'; ?></h5>
              <p class="card-text flex-grow-1"><?php echo idioma_actual() === 'es' ? 'Atención integral de salud para niños y adolescentes.' : 'Comprehensive health care for children and adolescents.'; ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Control de crecimiento' : 'Growth monitoring'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Vacunación' : 'Vaccination'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Enfermedades infantiles' : 'Childhood diseases'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Endocrinología -->
        <div class="col-md-6 col-lg-3">
          <div class="card especialidad-card text-center h-100">
            <div class="card-body d-flex flex-column">
              <div class="especialidad-icon mb-3">
                <i class="bi bi-capsule text-success"></i>
              </div>
              <h5 class="card-title"><?php echo t('especialidad_endocrinologia'); ?></h5>
              <p class="card-text flex-grow-1"><?php echo t('especialidad_endocrinologia_desc'); ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Diabetes' : 'Diabetes'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Tiroides' : 'Thyroid'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Obesidad' : 'Obesity'; ?></li>
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
