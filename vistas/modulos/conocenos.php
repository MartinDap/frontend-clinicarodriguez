<?php
require_once 'vistas/modulos/idiomas.php';

$titulo_pagina = idioma_actual() === 'es' ? 'Conócenos - Clínica Médica' : 'About Us - Medical Clinic';
$pagina_activa = 'conocenos';

include 'vistas/modulos/componentes/head-publico.php';
include 'vistas/modulos/componentes/topbar-publico.php';
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
          <img src="vistas/img/logo.png" alt="Logo Clínica" class="img-fluid rounded shadow">
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

      <!-- Misión, Visión y Valores -->
      <div class="row g-4 mb-5">
        
        <!-- Misión -->
        <div class="col-lg-4">
          <div class="card h-100 border-0 shadow-sm" style="background: #f8f9fa;">
            <div class="card-body p-4">
              <div class="d-flex align-items-start mb-3">
                <div class="me-3">
                  <div class="icon-box">
                    <i class="bi bi-bullseye text-primary fs-1"></i>
                  </div>
                </div>
                <div>
                  <h4 class="fw-bold mb-3" style="color: #1a1a5e;"><?php echo idioma_actual() === 'es' ? 'Misión' : 'Mission'; ?></h4>
                  <p class="text-muted mb-0">
                    <?php if(idioma_actual() === 'es'): ?>
                      Brindar atención médica integral de calidad, con tecnología de vanguardia y un equipo de especialistas altamente calificados, garantizando el bienestar de nuestros pacientes a través de un servicio cálido, humano y comprometido con la excelencia en salud.
                    <?php else: ?>
                      To provide comprehensive quality medical care, with cutting-edge technology and a team of highly qualified specialists, guaranteeing the well-being of our patients through a warm, humane service committed to excellence in health.
                    <?php endif; ?>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Visión -->
        <div class="col-lg-4">
          <div class="card h-100 border-0 shadow-sm" style="background: #f8f9fa;">
            <div class="card-body p-4">
              <div class="d-flex align-items-start mb-3">
                <div class="me-3">
                  <div class="icon-box">
                    <i class="bi bi-eye text-info fs-1"></i>
                  </div>
                </div>
                <div>
                  <h4 class="fw-bold mb-3" style="color: #1a1a5e;"><?php echo idioma_actual() === 'es' ? 'Visión' : 'Vision'; ?></h4>
                  <p class="text-muted mb-0">
                    <?php if(idioma_actual() === 'es'): ?>
                      Ser reconocidos como la clínica líder en atención médica integral, destacando por nuestra innovación tecnológica, excelencia profesional y compromiso con la salud de la comunidad, siendo la primera opción en servicios de salud ocupacional y especializada.
                    <?php else: ?>
                      To be recognized as the leading clinic in comprehensive medical care, standing out for our technological innovation, professional excellence and commitment to the health of the community, being the first choice in occupational and specialized health services.
                    <?php endif; ?>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Valores -->
        <div class="col-lg-4">
          <div class="card h-100 border-0 shadow-sm" style="background: #f8f9fa;">
            <div class="card-body p-4">
              <div class="d-flex align-items-start mb-3">
                <div class="me-3">
                  <div class="icon-box">
                    <i class="bi bi-gem text-success fs-1"></i>
                  </div>
                </div>
                <div>
                  <h4 class="fw-bold mb-3" style="color: #1a1a5e;"><?php echo idioma_actual() === 'es' ? 'Valores' : 'Values'; ?></h4>
                  <ul class="list-unstyled mb-0 text-muted">
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i><?php echo idioma_actual() === 'es' ? 'Solidaridad' : 'Solidarity'; ?></li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i><?php echo idioma_actual() === 'es' ? 'Puntualidad' : 'Punctuality'; ?></li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i><?php echo idioma_actual() === 'es' ? 'Honestidad' : 'Honesty'; ?></li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i><?php echo idioma_actual() === 'es' ? 'Compromiso' : 'Commitment'; ?></li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i><?php echo idioma_actual() === 'es' ? 'Innovación' : 'Innovation'; ?></li>
                  </ul>
                </div>
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
