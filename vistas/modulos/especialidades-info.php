<?php
// Cargar sistema de idiomas
require_once 'vistas/modulos/idiomas.php';
?>
<!DOCTYPE html>
<html lang="<?php echo idioma_actual(); ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title><?php echo idioma_actual() === 'es' ? 'Especialidades - Clínica Médica' : 'Specialties - Medical Clinic'; ?></title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="vistas/css/estilos-publicos.css">
</head>

<body>

  <!-- Navbar -->
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
            <a class="nav-link active" href="especialidades-info"><?php echo t('nav_especialidades'); ?></a>
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
            <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown">
              <i class="bi bi-globe"></i> <?php echo idioma_actual() === 'es' ? 'ES' : 'EN'; ?>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="?ruta=especialidades-info&lang=es"><i class="bi bi-flag"></i> Español</a></li>
              <li><a class="dropdown-item" href="?ruta=especialidades-info&lang=en"><i class="bi bi-flag"></i> English</a></li>
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

  <!-- Footer -->
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
            <li><a href="servicios-info" class="text-white-50"><?php echo t('footer_servicios'); ?></a></li>
            <li><a href="medicos-info" class="text-white-50"><?php echo t('nav_medicos'); ?></a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <h6><?php echo t('contacto_titulo'); ?></h6>
          <p class="small">
            <i class="bi bi-telephone"></i> +51 987 654 321<br>
            <i class="bi bi-envelope"></i> atencion-centro@clinica.com
          </p>
        </div>
      </div>
      <hr class="my-4">
      <div class="text-center">
        <p class="mb-0">&copy; 2025 CR <?php echo t('footer_derechos'); ?></p>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
  <style>
    .hover-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15)!important;
    }
  </style>
  
</body>
</html>
