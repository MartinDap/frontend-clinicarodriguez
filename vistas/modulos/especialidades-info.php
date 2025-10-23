<?php
require_once 'vistas/modulos/idiomas.php';

$titulo_pagina = idioma_actual() === 'es' ? 'Especialidades - Clínica Médica' : 'Specialties - Medical Clinic';
$pagina_activa = 'especialidades-info';

include 'vistas/modulos/componentes/head-publico.php';
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
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 shadow-sm hover-card">
            <div class="card-body p-4">
              <div class="text-center mb-3">
                <i class="bi bi-brain text-primary" style="font-size: 3rem;"></i>
              </div>
              <h4 class="card-title text-center"><?php echo t('especialidad_neurocirugia'); ?></h4>
              <p class="card-text"><?php echo t('especialidad_neurocirugia_desc'); ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Cirugía cerebral' : 'Brain surgery'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Cirugía de columna' : 'Spine surgery'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Tratamiento de tumores' : 'Tumor treatment'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Ginecología -->
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 shadow-sm hover-card">
            <div class="card-body p-4">
              <div class="text-center mb-3">
                <i class="bi bi-gender-female text-danger" style="font-size: 3rem;"></i>
              </div>
              <h4 class="card-title text-center"><?php echo t('especialidad_ginecologia'); ?></h4>
              <p class="card-text"><?php echo t('especialidad_ginecologia_desc'); ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Control prenatal' : 'Prenatal care'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Partos y cesáreas' : 'Deliveries and cesareans'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Salud reproductiva' : 'Reproductive health'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Neurología -->
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 shadow-sm hover-card">
            <div class="card-body p-4">
              <div class="text-center mb-3">
                <i class="bi bi-activity text-info" style="font-size: 3rem;"></i>
              </div>
              <h4 class="card-title text-center"><?php echo t('especialidad_neurologia'); ?></h4>
              <p class="card-text"><?php echo t('especialidad_neurologia_desc'); ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Migrañas y cefaleas' : 'Migraines and headaches'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Epilepsia' : 'Epilepsy'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Trastornos del movimiento' : 'Movement disorders'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Endocrinología -->
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 shadow-sm hover-card">
            <div class="card-body p-4">
              <div class="text-center mb-3">
                <i class="bi bi-capsule text-success" style="font-size: 3rem;"></i>
              </div>
              <h4 class="card-title text-center"><?php echo t('especialidad_endocrinologia'); ?></h4>
              <p class="card-text"><?php echo t('especialidad_endocrinologia_desc'); ?></p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Diabetes' : 'Diabetes'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Tiroides' : 'Thyroid'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Obesidad' : 'Obesity'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Cardiología -->
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 shadow-sm hover-card">
            <div class="card-body p-4">
              <div class="text-center mb-3">
                <i class="bi bi-heart-pulse text-danger" style="font-size: 3rem;"></i>
              </div>
              <h4 class="card-title text-center"><?php echo t('footer_cardiologia'); ?></h4>
              <p class="card-text">
                <?php echo idioma_actual() === 'es' ? 'Especialidad dedicada al diagnóstico y tratamiento de enfermedades del corazón.' : 'Specialty dedicated to the diagnosis and treatment of heart diseases.'; ?>
              </p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Ecocardiogramas' : 'Echocardiograms'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Electrocardiogramas' : 'Electrocardiograms'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Hipertensión arterial' : 'Arterial hypertension'; ?></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Pediatría -->
        <div class="col-md-6 col-lg-4">
          <div class="card h-100 shadow-sm hover-card">
            <div class="card-body p-4">
              <div class="text-center mb-3">
                <i class="bi bi-emoji-smile text-warning" style="font-size: 3rem;"></i>
              </div>
              <h4 class="card-title text-center">
                <?php echo idioma_actual() === 'es' ? 'Pediatría' : 'Pediatrics'; ?>
              </h4>
              <p class="card-text">
                <?php echo idioma_actual() === 'es' ? 'Atención médica especializada para niños y adolescentes.' : 'Specialized medical care for children and adolescents.'; ?>
              </p>
              <ul class="small">
                <li><?php echo idioma_actual() === 'es' ? 'Control de crecimiento' : 'Growth monitoring'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Vacunación' : 'Vaccination'; ?></li>
                <li><?php echo idioma_actual() === 'es' ? 'Enfermedades infantiles' : 'Childhood diseases'; ?></li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

<?php include 'vistas/modulos/componentes/footer-publico.php'; ?>

<style>
  .hover-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15)!important;
  }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
