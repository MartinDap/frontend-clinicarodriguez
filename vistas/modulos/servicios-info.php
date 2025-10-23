<?php require_once 'vistas/modulos/idiomas.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo idioma_actual(); ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo idioma_actual() === 'es' ? 'Servicios - Clínica Médica' : 'Services - Medical Clinic'; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="vistas/css/estilos-publicos.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light-blue fixed-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="http://localhost/pe/"><i class="bi bi-hospital fs-3 me-2"></i>CLÍNICA MÉDICA</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="conocenos"><?php echo t('nav_conocenos'); ?></a></li>
          <li class="nav-item"><a class="nav-link" href="especialidades-info"><?php echo t('nav_especialidades'); ?></a></li>
          <li class="nav-item"><a class="nav-link active" href="servicios-info"><?php echo t('nav_servicios'); ?></a></li>
          <li class="nav-item"><a class="nav-link" href="medicos-info"><?php echo t('nav_medicos'); ?></a></li>
          <li class="nav-item"><a class="nav-link" href="contacto"><?php echo t('nav_contacto'); ?></a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown">
              <i class="bi bi-globe"></i> <?php echo idioma_actual() === 'es' ? 'ES' : 'EN'; ?>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="?ruta=servicios-info&lang=es"><i class="bi bi-flag"></i> Español</a></li>
              <li><a class="dropdown-item" href="?ruta=servicios-info&lang=en"><i class="bi bi-flag"></i> English</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="btn btn-primary ms-2" href="login"><i class="bi bi-box-arrow-in-right"></i> <?php echo t('nav_acceso_personal'); ?></a></li>
        </ul>
      </div>
    </div>
  </nav>

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

  <footer class="bg-dark text-white py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h5><i class="bi bi-hospital text-info"></i> Clínica Médica</h5>
          <p class="small"><?php echo t('footer_clinica_desc'); ?></p>
        </div>
        <div class="col-md-4">
          <h6><?php echo t('footer_otros_links'); ?></h6>
          <ul class="list-unstyled">
            <li><a href="conocenos" class="text-white-50"><?php echo t('footer_nosotros'); ?></a></li>
            <li><a href="especialidades-info" class="text-white-50"><?php echo t('footer_especialidades'); ?></a></li>
            <li><a href="medicos-info" class="text-white-50"><?php echo t('nav_medicos'); ?></a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <h6><?php echo t('contacto_titulo'); ?></h6>
          <p class="small"><i class="bi bi-telephone"></i> +51 987 654 321<br><i class="bi bi-envelope"></i> atencion-centro@clinica.com</p>
        </div>
      </div>
      <hr class="my-4">
      <div class="text-center">
        <p class="mb-0">&copy; 2025 CR <?php echo t('footer_derechos'); ?></p>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
