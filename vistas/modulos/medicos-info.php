<?php require_once 'vistas/modulos/idiomas.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo idioma_actual(); ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo idioma_actual() === 'es' ? 'Nuestros Médicos - Clínica Médica' : 'Our Doctors - Medical Clinic'; ?></title>
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
          <li class="nav-item"><a class="nav-link" href="servicios-info"><?php echo t('nav_servicios'); ?></a></li>
          <li class="nav-item"><a class="nav-link active" href="medicos-info"><?php echo t('nav_medicos'); ?></a></li>
          <li class="nav-item"><a class="nav-link" href="contacto"><?php echo t('nav_contacto'); ?></a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown">
              <i class="bi bi-globe"></i> <?php echo idioma_actual() === 'es' ? 'ES' : 'EN'; ?>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="?ruta=medicos-info&lang=es"><i class="bi bi-flag"></i> Español</a></li>
              <li><a class="dropdown-item" href="?ruta=medicos-info&lang=en"><i class="bi bi-flag"></i> English</a></li>
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
            <li><a href="servicios-info" class="text-white-50"><?php echo t('footer_servicios'); ?></a></li>
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
