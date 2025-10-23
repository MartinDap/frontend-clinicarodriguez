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
  
  <title>Clínica Médica - Atención Integral</title>
  
  <!-- Bootstrap 5.3.2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  
  <!-- Estilos personalizados para página pública -->
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
              <li><a class="dropdown-item" href="?lang=es"><i class="bi bi-flag"></i> Español</a></li>
              <li><a class="dropdown-item" href="?lang=en"><i class="bi bi-flag"></i> English</a></li>
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
  <section class="hero-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <h1 class="display-4 fw-bold mb-4"><?php echo t('hero_titulo'); ?></h1>
          <p class="lead mb-4"><?php echo t('hero_descripcion'); ?></p>
          <div class="d-flex gap-3">
            <a href="#citas" class="btn btn-warning btn-lg">
              <i class="bi bi-calendar-plus"></i> <?php echo t('hero_btn_cita'); ?>
            </a>
            <a href="#resultados" class="btn btn-outline-primary btn-lg">
              <i class="bi bi-file-earmark-text"></i> <?php echo t('hero_btn_resultados'); ?>
            </a>
          </div>
        </div>
        <div class="col-lg-6">
          <img src="https://via.placeholder.com/500x400/87CEEB/FFFFFF?text=Clinica+Medica" alt="Clínica" class="img-fluid rounded shadow-lg">
        </div>
      </div>
    </div>
  </section>

  <!-- Servicios Principales -->
  <section id="servicios" class="py-5 bg-light">
    <div class="container">
      <div class="row g-4">
        
        <!-- Unidad de Apoyo al Diagnóstico -->
        <div class="col-md-4">
          <div class="card h-100 text-center shadow-sm">
            <div class="card-body">
              <div class="icon-box mb-3">
                <i class="bi bi-heart-pulse-fill text-primary fs-1"></i>
              </div>
              <h5 class="card-title"><?php echo t('servicio_diagnostico_titulo'); ?></h5>
              <p class="card-text"><?php echo t('servicio_diagnostico_desc'); ?></p>
            </div>
          </div>
        </div>

        <!-- Soporte Espiritual y Emocional -->
        <div class="col-md-4">
          <div class="card h-100 text-center shadow-sm">
            <div class="card-body">
              <div class="icon-box mb-3">
                <i class="bi bi-heart text-danger fs-1"></i>
              </div>
              <h5 class="card-title"><?php echo t('servicio_espiritual_titulo'); ?></h5>
              <p class="card-text"><?php echo t('servicio_espiritual_desc'); ?></p>
            </div>
          </div>
        </div>

        <!-- Unidades de Atención -->
        <div class="col-md-4">
          <div class="card h-100 text-center shadow-sm">
            <div class="card-body">
              <div class="icon-box mb-3">
                <i class="bi bi-activity text-info fs-1"></i>
              </div>
              <h5 class="card-title"><?php echo t('servicio_atencion_titulo'); ?></h5>
              <p class="card-text"><?php echo t('servicio_atencion_desc'); ?></p>
            </div>
          </div>
        </div>

        <!-- Servicios Adicionales -->
        <div class="col-md-4">
          <div class="card h-100 text-center shadow-sm">
            <div class="card-body">
              <div class="icon-box mb-3">
                <i class="bi bi-clipboard2-plus text-success fs-1"></i>
              </div>
              <h5 class="card-title"><?php echo t('servicio_adicionales_titulo'); ?></h5>
              <p class="card-text"><?php echo t('servicio_adicionales_desc'); ?></p>
            </div>
          </div>
        </div>

        <!-- Hotelería Hospitalaria -->
        <div class="col-md-4">
          <div class="card h-100 text-center shadow-sm">
            <div class="card-body">
              <div class="icon-box mb-3">
                <i class="bi bi-building text-warning fs-1"></i>
              </div>
              <h5 class="card-title"><?php echo t('servicio_hoteleria_titulo'); ?></h5>
              <p class="card-text"><?php echo t('servicio_hoteleria_desc'); ?></p>
            </div>
          </div>
        </div>

        <!-- Productos Especiales -->
        <div class="col-md-4">
          <div class="card h-100 text-center shadow-sm">
            <div class="card-body">
              <div class="icon-box mb-3">
                <i class="bi bi-truck text-secondary fs-1"></i>
              </div>
              <h5 class="card-title"><?php echo t('servicio_productos_titulo'); ?></h5>
              <p class="card-text"><?php echo t('servicio_productos_desc'); ?></p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Especialidades (Carrusel) -->
  <section id="especialidades" class="py-5">
    <div class="container">
      <h2 class="text-center mb-5"><?php echo t('especialidades_titulo'); ?></h2>
      
      <div id="especialidadesCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          
          <!-- Slide 1 -->
          <div class="carousel-item active">
            <div class="row g-4">
              <div class="col-md-3">
                <div class="card especialidad-card bg-info text-white">
                  <div class="card-body">
                    <i class="bi bi-brain fs-1 mb-3"></i>
                    <h5><?php echo t('especialidad_neurocirugia'); ?></h5>
                    <p class="small"><?php echo t('especialidad_neurocirugia_desc'); ?></p>
                    <span class="badge bg-light text-dark">1+ <?php echo t('especialidad_doctor'); ?></span>
                  </div>
                </div>
              </div>
              
              <div class="col-md-3">
                <div class="card especialidad-card">
                  <div class="card-body">
                    <i class="bi bi-gender-female fs-1 mb-3 text-primary"></i>
                    <h5><?php echo t('especialidad_ginecologia'); ?></h5>
                    <p class="small"><?php echo t('especialidad_ginecologia_desc'); ?></p>
                    <span class="badge bg-primary">1+ <?php echo t('especialidad_doctor'); ?></span>
                  </div>
                </div>
              </div>
              
              <div class="col-md-3">
                <div class="card especialidad-card">
                  <div class="card-body">
                    <i class="bi bi-lungs fs-1 mb-3 text-primary"></i>
                    <h5><?php echo t('especialidad_neurologia'); ?></h5>
                    <p class="small"><?php echo t('especialidad_neurologia_desc'); ?></p>
                    <span class="badge bg-primary">1+ <?php echo t('especialidad_doctor'); ?></span>
                  </div>
                </div>
              </div>
              
              <div class="col-md-3">
                <div class="card especialidad-card">
                  <div class="card-body">
                    <i class="bi bi-capsule fs-1 mb-3 text-primary"></i>
                    <h5><?php echo t('especialidad_endocrinologia'); ?></h5>
                    <p class="small"><?php echo t('especialidad_endocrinologia_desc'); ?></p>
                    <span class="badge bg-primary">6+ <?php echo t('especialidad_doctor'); ?></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
        
        <button class="carousel-control-prev" type="button" data-bs-target="#especialidadesCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bg-primary rounded-circle p-3"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#especialidadesCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon bg-primary rounded-circle p-3"></span>
        </button>
      </div>
    </div>
  </section>

  <!-- Contacto -->
  <section id="contacto" class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-5"><?php echo t('contacto_titulo'); ?></h2>
      <div class="row g-4 justify-content-center">
        
        <div class="col-md-3 text-center">
          <div class="contact-item">
            <div class="icon-circle bg-primary text-white mx-auto mb-3">
              <i class="bi bi-telephone-fill fs-3"></i>
            </div>
            <h5><?php echo t('contacto_telefono'); ?></h5>
            <p>+51 987 654 321</p>
          </div>
        </div>
        
        <div class="col-md-3 text-center">
          <div class="contact-item">
            <div class="icon-circle bg-primary text-white mx-auto mb-3">
              <i class="bi bi-envelope-fill fs-3"></i>
            </div>
            <h5><?php echo t('contacto_email'); ?></h5>
            <p>atencion-centro@clinica.com</p>
          </div>
        </div>
        
        <div class="col-md-4 text-center">
          <div class="contact-item">
            <div class="icon-circle bg-primary text-white mx-auto mb-3">
              <i class="bi bi-clock-fill fs-3"></i>
            </div>
            <h5><?php echo t('contacto_atenciones'); ?></h5>
            <p><?php echo t('contacto_horario'); ?></p>
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
        
        <div class="col-md-2">
          <h6><?php echo t('footer_servicios'); ?></h6>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white-50"><?php echo t('footer_hospitalizacion'); ?></a></li>
            <li><a href="#" class="text-white-50"><?php echo t('footer_ubi'); ?></a></li>
            <li><a href="#" class="text-white-50"><?php echo t('footer_emergencia'); ?></a></li>
            <li><a href="#" class="text-white-50"><?php echo t('footer_laboratorio'); ?></a></li>
            <li><a href="#" class="text-white-50"><?php echo t('footer_sala_operaciones'); ?></a></li>
          </ul>
        </div>
        
        <div class="col-md-3">
          <h6><?php echo t('footer_especialidades'); ?></h6>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white-50"><?php echo t('especialidad_neurocirugia'); ?></a></li>
            <li><a href="#" class="text-white-50"><?php echo t('especialidad_ginecologia'); ?></a></li>
            <li><a href="#" class="text-white-50"><?php echo t('especialidad_neurologia'); ?></a></li>
            <li><a href="#" class="text-white-50"><?php echo t('especialidad_endocrinologia'); ?></a></li>
            <li><a href="#" class="text-white-50"><?php echo t('footer_cardiologia'); ?></a></li>
          </ul>
        </div>
        
        <div class="col-md-2">
          <h6><?php echo t('footer_otros_links'); ?></h6>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white-50"><?php echo t('footer_nosotros'); ?></a></li>
            <li><a href="#" class="text-white-50"><?php echo t('footer_blogs'); ?></a></li>
            <li><a href="#" class="text-white-50"><?php echo t('footer_contactanos'); ?></a></li>
            <li><a href="#" class="text-white-50"><?php echo t('footer_faq'); ?></a></li>
            <li><a href="#" class="text-white-50"><?php echo t('footer_privacidad'); ?></a></li>
          </ul>
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
