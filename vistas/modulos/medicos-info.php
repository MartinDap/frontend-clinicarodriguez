<?php
require_once 'vistas/modulos/idiomas.php';

$titulo_pagina = idioma_actual() === 'es' ? 'Nuestros Médicos - Clínica Médica' : 'Our Doctors - Medical Clinic';
$pagina_activa = 'medicos-info';

include 'vistas/modulos/componentes/head-publico.php';
include 'vistas/modulos/componentes/topbar-publico.php';
include 'vistas/modulos/componentes/navbar-publico.php';
?>

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

  <section class="py-5">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-6 col-lg-4">
          <div class="card text-center shadow h-100">
            <div class="card-body p-4">
              <div class="mb-3">
                <i class="bi bi-person-circle text-primary" style="font-size: 5rem;"></i>
              </div>
              <h4>Dr. Carlos Rodríguez</h4>
              <p class="text-muted"><?php echo t('especialidad_neurocirugia'); ?></p>
              <p class="small"><?php echo idioma_actual() === 'es' ? '15 años de experiencia en cirugía cerebral y columna vertebral' : '15 years of experience in brain and spine surgery'; ?></p>
              <div class="mt-3">
                <span class="badge bg-info me-1"><?php echo idioma_actual() === 'es' ? 'Especialista' : 'Specialist'; ?></span>
                <span class="badge bg-secondary"><?php echo idioma_actual() === 'es' ? 'Certificado' : 'Certified'; ?></span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card text-center shadow h-100">
            <div class="card-body p-4">
              <div class="mb-3">
                <i class="bi bi-person-circle text-danger" style="font-size: 5rem;"></i>
              </div>
              <h4>Dra. María González</h4>
              <p class="text-muted"><?php echo t('especialidad_ginecologia'); ?></p>
              <p class="small"><?php echo idioma_actual() === 'es' ? '12 años de experiencia en salud reproductiva y obstetricia' : '12 years of experience in reproductive health and obstetrics'; ?></p>
              <div class="mt-3">
                <span class="badge bg-info me-1"><?php echo idioma_actual() === 'es' ? 'Especialista' : 'Specialist'; ?></span>
                <span class="badge bg-secondary"><?php echo idioma_actual() === 'es' ? 'Certificado' : 'Certified'; ?></span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card text-center shadow h-100">
            <div class="card-body p-4">
              <div class="mb-3">
                <i class="bi bi-person-circle text-success" style="font-size: 5rem;"></i>
              </div>
              <h4>Dr. Roberto Pérez</h4>
              <p class="text-muted"><?php echo t('footer_cardiologia'); ?></p>
              <p class="small"><?php echo idioma_actual() === 'es' ? '18 años de experiencia en cardiología clínica e intervencionista' : '18 years of experience in clinical and interventional cardiology'; ?></p>
              <div class="mt-3">
                <span class="badge bg-info me-1"><?php echo idioma_actual() === 'es' ? 'Especialista' : 'Specialist'; ?></span>
                <span class="badge bg-secondary"><?php echo idioma_actual() === 'es' ? 'Certificado' : 'Certified'; ?></span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card text-center shadow h-100">
            <div class="card-body p-4">
              <div class="mb-3">
                <i class="bi bi-person-circle text-warning" style="font-size: 5rem;"></i>
              </div>
              <h4>Dra. Ana Torres</h4>
              <p class="text-muted"><?php echo idioma_actual() === 'es' ? 'Pediatría' : 'Pediatrics'; ?></p>
              <p class="small"><?php echo idioma_actual() === 'es' ? '10 años de experiencia en atención pediátrica integral' : '10 years of experience in comprehensive pediatric care'; ?></p>
              <div class="mt-3">
                <span class="badge bg-info me-1"><?php echo idioma_actual() === 'es' ? 'Especialista' : 'Specialist'; ?></span>
                <span class="badge bg-secondary"><?php echo idioma_actual() === 'es' ? 'Certificado' : 'Certified'; ?></span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card text-center shadow h-100">
            <div class="card-body p-4">
              <div class="mb-3">
                <i class="bi bi-person-circle text-info" style="font-size: 5rem;"></i>
              </div>
              <h4>Dr. Luis Martínez</h4>
              <p class="text-muted"><?php echo t('especialidad_neurologia'); ?></p>
              <p class="small"><?php echo idioma_actual() === 'es' ? '14 años de experiencia en trastornos neurológicos' : '14 years of experience in neurological disorders'; ?></p>
              <div class="mt-3">
                <span class="badge bg-info me-1"><?php echo idioma_actual() === 'es' ? 'Especialista' : 'Specialist'; ?></span>
                <span class="badge bg-secondary"><?php echo idioma_actual() === 'es' ? 'Certificado' : 'Certified'; ?></span>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="card text-center shadow h-100">
            <div class="card-body p-4">
              <div class="mb-3">
                <i class="bi bi-person-circle text-secondary" style="font-size: 5rem;"></i>
              </div>
              <h4>Dra. Patricia Sánchez</h4>
              <p class="text-muted"><?php echo t('especialidad_endocrinologia'); ?></p>
              <p class="small"><?php echo idioma_actual() === 'es' ? '11 años de experiencia en diabetes y trastornos hormonales' : '11 years of experience in diabetes and hormonal disorders'; ?></p>
              <div class="mt-3">
                <span class="badge bg-info me-1"><?php echo idioma_actual() === 'es' ? 'Especialista' : 'Specialist'; ?></span>
                <span class="badge bg-secondary"><?php echo idioma_actual() === 'es' ? 'Certificado' : 'Certified'; ?></span>
              </div>
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
