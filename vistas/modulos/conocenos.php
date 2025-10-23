<?php
require_once 'vistas/modulos/idiomas.php';

$titulo_pagina = idioma_actual() === 'es' ? 'Conócenos - Clínica Médica' : 'About Us - Medical Clinic';
$pagina_activa = 'conocenos';

include 'vistas/modulos/componentes/head-publico.php';
include 'vistas/modulos/componentes/navbar-publico.php';
?>

  <!-- Hero Section -->
  <section class="hero-section" style="min-height: 300px;">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 text-center">
          <h1 class="display-4 fw-bold mb-4">
            <?php echo idioma_actual() === 'es' ? 'Conócenos' : 'About Us'; ?>
          </h1>
          <p class="lead">
            <?php echo idioma_actual() === 'es' ? 'Tu salud, nuestra prioridad' : 'Your health, our priority'; ?>
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Contenido Principal -->
  <section class="py-5">
    <div class="container">
      
      <!-- Nuestra Historia -->
      <div class="row mb-5">
        <div class="col-lg-6 mb-4">
          <img src="https://via.placeholder.com/600x400/87CEEB/FFFFFF?text=Clinica" alt="Clínica" class="img-fluid rounded shadow">
        </div>
        <div class="col-lg-6">
          <h2 class="mb-4"><?php echo idioma_actual() === 'es' ? 'Nuestra Historia' : 'Our Story'; ?></h2>
          <p>
            <?php if(idioma_actual() === 'es'): ?>
              CLÍNICA RODRIGUEZ Y ESPECIALISTAS formó la Clínica Rodríguez con el objetivo de ofrecer atención médica de calidad con recursos modernos y personal altamente capacitado.
            <?php else: ?>
              CLINIC RODRIGUEZ AND SPECIALISTS formed Rodriguez Clinic with the goal of offering quality medical care with modern resources and highly trained staff.
            <?php endif; ?>
          </p>
          <p>
            <?php if(idioma_actual() === 'es'): ?>
              Desde nuestros inicios, nos hemos comprometido a brindar servicios médicos integrales que combinan tecnología de punta con un trato humano y personalizado.
            <?php else: ?>
              Since our beginnings, we have been committed to providing comprehensive medical services that combine cutting-edge technology with humane and personalized care.
            <?php endif; ?>
          </p>
        </div>
      </div>

      <!-- Misión y Visión -->
      <div class="row g-4 mb-5">
        <div class="col-md-6">
          <div class="card h-100 shadow-sm">
            <div class="card-body p-4">
              <div class="mb-3">
                <i class="bi bi-bullseye text-primary fs-1"></i>
              </div>
              <h3><?php echo idioma_actual() === 'es' ? 'Nuestra Misión' : 'Our Mission'; ?></h3>
              <p>
                <?php if(idioma_actual() === 'es'): ?>
                  Brindar atención médica integral de calidad, combinando tecnología avanzada con calidez humana, para mejorar la salud y bienestar de nuestros pacientes y sus familias.
                <?php else: ?>
                  To provide comprehensive quality medical care, combining advanced technology with human warmth, to improve the health and well-being of our patients and their families.
                <?php endif; ?>
              </p>
            </div>
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="card h-100 shadow-sm">
            <div class="card-body p-4">
              <div class="mb-3">
                <i class="bi bi-eye text-info fs-1"></i>
              </div>
              <h3><?php echo idioma_actual() === 'es' ? 'Nuestra Visión' : 'Our Vision'; ?></h3>
              <p>
                <?php if(idioma_actual() === 'es'): ?>
                  Ser la clínica líder en servicios de salud, reconocida por nuestra excelencia médica, innovación tecnológica y compromiso con el bienestar integral de nuestros pacientes.
                <?php else: ?>
                  To be the leading health services clinic, recognized for our medical excellence, technological innovation and commitment to the comprehensive well-being of our patients.
                <?php endif; ?>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Valores -->
      <div class="row mb-5">
        <div class="col-12">
          <h2 class="text-center mb-4">
            <?php echo idioma_actual() === 'es' ? 'Nuestros Valores' : 'Our Values'; ?>
          </h2>
        </div>
        
        <div class="col-md-3 mb-3">
          <div class="text-center">
            <div class="mb-3">
              <i class="bi bi-heart-fill text-danger fs-1"></i>
            </div>
            <h5><?php echo idioma_actual() === 'es' ? 'Compromiso' : 'Commitment'; ?></h5>
            <p class="small text-muted">
              <?php echo idioma_actual() === 'es' ? 'Con la salud y bienestar de cada paciente' : 'To the health and well-being of each patient'; ?>
            </p>
          </div>
        </div>
        
        <div class="col-md-3 mb-3">
          <div class="text-center">
            <div class="mb-3">
              <i class="bi bi-shield-check text-success fs-1"></i>
            </div>
            <h5><?php echo idioma_actual() === 'es' ? 'Calidad' : 'Quality'; ?></h5>
            <p class="small text-muted">
              <?php echo idioma_actual() === 'es' ? 'En todos nuestros servicios médicos' : 'In all our medical services'; ?>
            </p>
          </div>
        </div>
        
        <div class="col-md-3 mb-3">
          <div class="text-center">
            <div class="mb-3">
              <i class="bi bi-people-fill text-primary fs-1"></i>
            </div>
            <h5><?php echo idioma_actual() === 'es' ? 'Humanidad' : 'Humanity'; ?></h5>
            <p class="small text-muted">
              <?php echo idioma_actual() === 'es' ? 'Trato cálido y personalizado' : 'Warm and personalized treatment'; ?>
            </p>
          </div>
        </div>
        
        <div class="col-md-3 mb-3">
          <div class="text-center">
            <div class="mb-3">
              <i class="bi bi-lightbulb-fill text-warning fs-1"></i>
            </div>
            <h5><?php echo idioma_actual() === 'es' ? 'Innovación' : 'Innovation'; ?></h5>
            <p class="small text-muted">
              <?php echo idioma_actual() === 'es' ? 'Tecnología médica de vanguardia' : 'Cutting-edge medical technology'; ?>
            </p>
          </div>
        </div>
      </div>

    </div>
  </section>

<?php include 'vistas/modulos/componentes/footer-publico.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
