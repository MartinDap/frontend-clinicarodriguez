<?php
// Cargar sistema de idiomas
require_once 'vistas/modulos/idiomas.php';
?>
<!DOCTYPE html>
<html lang="<?php echo idioma_actual(); ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title><?php echo idioma_actual() === 'es' ? 'Conócenos - Clínica Médica' : 'About Us - Medical Clinic'; ?></title>
  
  <!-- Bootstrap 5.3.2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="vistas/css/estilos-publicos.css">
  
</head>

<body>

  <!-- Navbar Superior -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light-blue fixed-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="http://localhost/pe/">
        <i class="bi bi-hospital fs-3 me-2"></i>
        CLÍNICA MÉDICA
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="conocenos"><?php echo t('nav_conocenos'); ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="especialidades-info"><?php echo t('nav_especialidades'); ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="servicios-info"><?php echo t('nav_servicios'); ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="medicos-info"><?php echo t('nav_medicos'); ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contacto"><?php echo t('nav_contacto'); ?></a>
          </li>
          
          <!-- Selector de idioma -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-globe"></i> <?php echo idioma_actual() === 'es' ? 'ES' : 'EN'; ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="languageDropdown">
              <li><a class="dropdown-item" href="?ruta=conocenos&lang=es"><i class="bi bi-flag"></i> Español</a></li>
              <li><a class="dropdown-item" href="?ruta=conocenos&lang=en"><i class="bi bi-flag"></i> English</a></li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a class="btn btn-primary ms-2" href="login">
              <i class="bi bi-box-arrow-in-right"></i> <?php echo t('nav_acceso_personal'); ?>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

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

  <!-- Footer -->
  <footer class="bg-dark text-white py-5">
    <div class="container">
      <div class="row">
        
        <div class="col-md-3">
          <h5 class="mb-3">
            <i class="bi bi-hospital text-info"></i>
            Clínica Médica
          </h5>
          <p class="small"><?php echo t('footer_clinica_desc'); ?></p>
        </div>
        
        <div class="col-md-3">
          <h6><?php echo t('footer_servicios'); ?></h6>
          <ul class="list-unstyled">
            <li><a href="servicios-info" class="text-white-50"><?php echo t('footer_hospitalizacion'); ?></a></li>
            <li><a href="servicios-info" class="text-white-50"><?php echo t('footer_emergencia'); ?></a></li>
            <li><a href="servicios-info" class="text-white-50"><?php echo t('footer_laboratorio'); ?></a></li>
          </ul>
        </div>
        
        <div class="col-md-3">
          <h6><?php echo t('footer_otros_links'); ?></h6>
          <ul class="list-unstyled">
            <li><a href="conocenos" class="text-white-50"><?php echo t('footer_nosotros'); ?></a></li>
            <li><a href="especialidades-info" class="text-white-50"><?php echo t('footer_especialidades'); ?></a></li>
            <li><a href="medicos-info" class="text-white-50"><?php echo t('nav_medicos'); ?></a></li>
          </ul>
        </div>
        
        <div class="col-md-3">
          <h6><?php echo t('contacto_titulo'); ?></h6>
          <p class="small">
            <i class="bi bi-telephone"></i> +51 987 654 321<br>
            <i class="bi bi-envelope"></i> atencion-centro@clinica.com
          </p>
        </div>
        
      </div>
      
      <hr class="my-4 bg-secondary">
      
      <div class="text-center">
        <p class="mb-0">&copy; 2025 CR <?php echo t('footer_derechos'); ?></p>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
</body>
</html>
