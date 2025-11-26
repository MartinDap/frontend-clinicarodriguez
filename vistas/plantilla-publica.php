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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  
  <!-- Estilos personalizados para página pública -->
  <link rel="stylesheet" href="vistas/css/estilos-publicos.css">
  <link rel="stylesheet" href="vistas/css/componentes.css">
  
</head>

<body>

  <?php
  // Incluir componentes reutilizables
  include 'vistas/modulos/componentes/topbar-publico.php';
  include 'vistas/modulos/componentes/navbar-publico.php';
  ?>

  <!-- Hero Section -->
  <section class="hero-section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <h1 class="display-4 fw-bold mb-4"><?php echo t('hero_titulo'); ?></h1>
          <p class="lead mb-4"><?php echo t('hero_descripcion'); ?></p>
          <div class="d-flex gap-3">
            <a href="agendar-cita" class="btn btn-warning btn-lg">
              <i class="bi bi-calendar-plus"></i> <?php echo t('hero_btn_cita'); ?>
            </a>
            <a href="resultados" class="btn btn-outline-primary btn-lg">
              <i class="bi bi-file-earmark-text"></i> <?php echo t('hero_btn_resultados'); ?>
            </a>
          </div>
        </div>
        <div class="col-lg-6">
        </div>
      </div>
    </div>
  </section>

  <!-- Sección Misión, Visión y Valores -->
  <section id="servicios" class="py-5 bg-light mision-vision-valores">
    <div class="container">
      <!-- Título de la clínica -->
      <div class="mb-5">
        <h2 class="fw-bold mb-3 text-primary">CLINICA RODRIGUEZ Y ESPECIALISTAS</h2>
        <p class="text-muted lead">Somos la Clínica Rodríguez, atendemos SEGUROS, PES, SOAT, SCTR, SALUD OCUPACIONAL, etc. todo en un solo lugar, con un Equipamiento de última tecnología, Especialistas de alto nivel y lo mejor de todo con la mejor Atención.</p>
      </div>

      <div class="row g-4">
        
        <!-- Misión -->
        <div class="col-lg-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body p-4">
              <div class="d-flex align-items-start mb-3">
                <div class="me-3">
                  <div class="icon-box">
                    <i class="bi bi-bullseye text-primary fs-1"></i>
                  </div>
                </div>
                <div>
                  <h4 class="fw-bold mb-3">Misión</h4>
                  <p class="text-muted mb-0">Brindar atención médica integral de calidad, con tecnología de vanguardia y un equipo de especialistas altamente calificados, garantizando el bienestar de nuestros pacientes a través de un servicio cálido, humano y comprometido con la excelencia en salud.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Visión -->
        <div class="col-lg-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body p-4">
              <div class="d-flex align-items-start mb-3">
                <div class="me-3">
                  <div class="icon-box">
                    <i class="bi bi-eye text-info fs-1"></i>
                  </div>
                </div>
                <div>
                  <h4 class="fw-bold mb-3">Visión</h4>
                  <p class="text-muted mb-0">Ser reconocidos como la clínica líder en atención médica integral, destacando por nuestra innovación tecnológica, excelencia profesional y compromiso con la salud de la comunidad, siendo la primera opción en servicios de salud ocupacional y especializada.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Valores -->
        <div class="col-lg-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body p-4">
              <div class="d-flex align-items-start mb-3">
                <div class="me-3">
                  <div class="icon-box">
                    <i class="bi bi-gem text-success fs-1"></i>
                  </div>
                </div>
                <div>
                  <h4 class="fw-bold mb-3">Valores</h4>
                  <ul class="list-unstyled mb-0 text-muted">
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Solidaridad</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Puntualidad</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Honestidad</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Compromiso</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Innovación</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Especialidades -->
  <section id="especialidades" class="py-5 bg-light">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="fw-bold"><?php echo idioma_actual() === 'es' ? 'Empieza A Sentirte Mejor' : 'Start Feeling Better'; ?></h2>
        <p class="lead text-muted"><?php echo idioma_actual() === 'es' ? 'Explora Nuestras Especialidades' : 'Explore Our Specialties'; ?></p>
      </div>
      
      <!-- Carrusel de Especialidades -->
      <div id="especialidadesCarousel" class="carousel slide" data-bs-ride="false">
            <div class="carousel-inner">
              
                <!-- Slide 1: Primeras 4 especialidades -->
                <div class="carousel-item active">
                    <div class="row g-4">
                        <!-- Neurocirugía -->
                        <div class="col-md-6 col-lg-3">
                            <div class="card especialidad-card text-center h-100">
                                <div class="card-body d-flex flex-column">
                                    <div class="especialidad-icon mb-3">
                                        <i class="bi bi-cpu text-primary"></i>
                                    </div>
                                    <h5 class="card-title">Neurocirugía</h5>
                                    <p class="card-text flex-grow-1">Diagnóstico y tratamiento quirúrgico de enfermedades del sistema nervioso.</p>
                                    <div class="mt-3">
                                        <span class="badge bg-light text-primary">1+ Doctores</span>
                                    </div>
                                    <a href="especialidades-info" class="btn-arrow">
                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                    </a>
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
                                    <h5 class="card-title">Ginecología y Obstetricia</h5>
                                    <p class="card-text flex-grow-1">Cuidado integral de la salud femenina, embarazo y parto.</p>
                                    <div class="mt-3">
                                        <span class="badge bg-light text-danger">1+ Doctores</span>
                                    </div>
                                    <a href="especialidades-info" class="btn-arrow">
                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                    </a>
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
                                    <h5 class="card-title">Neurología</h5>
                                    <p class="card-text flex-grow-1">Diagnóstico y tratamiento de enfermedades del sistema nervioso.</p>
                                    <div class="mt-3">
                                        <span class="badge bg-light text-info">1+ Doctores</span>
                                    </div>
                                    <a href="especialidades-info" class="btn-arrow">
                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                    </a>
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
                                    <h5 class="card-title">Cardiología</h5>
                                    <p class="card-text flex-grow-1">Diagnóstico y tratamiento de enfermedades del corazón y sistema circulatorio.</p>
                                    <div class="mt-3">
                                        <span class="badge bg-light text-danger">2+ Doctores</span>
                                    </div>
                                    <a href="especialidades-info" class="btn-arrow">
                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Slide 2: Siguientes 4 especialidades -->
                <div class="carousel-item">
                    <div class="row g-4">
                        <!-- Cirugía General -->
                        <div class="col-md-6 col-lg-3">
                            <div class="card especialidad-card text-center h-100">
                                <div class="card-body d-flex flex-column">
                                    <div class="especialidad-icon mb-3">
                                        <i class="bi bi-scissors text-secondary"></i>
                                    </div>
                                    <h5 class="card-title">Cirugía General</h5>
                                    <p class="card-text flex-grow-1">Tratamiento quirúrgico de diversas enfermedades y condiciones médicas.</p>
                                    <div class="mt-3">
                                        <span class="badge bg-light text-secondary">2+ Doctores</span>
                                    </div>
                                    <a href="especialidades-info" class="btn-arrow">
                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                    </a>
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
                                    <h5 class="card-title">Dermatología</h5>
                                    <p class="card-text flex-grow-1">Diagnóstico y tratamiento de enfermedades de la piel, cabello y uñas.</p>
                                    <div class="mt-3">
                                        <span class="badge bg-light text-warning">1+ Doctores</span>
                                    </div>
                                    <a href="especialidades-info" class="btn-arrow">
                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                    </a>
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
                                    <h5 class="card-title">Pediatría</h5>
                                    <p class="card-text flex-grow-1">Cuidado integral de la salud de niños y adolescentes.</p>
                                    <div class="mt-3">
                                        <span class="badge bg-light text-success">1+ Doctores</span>
                                    </div>
                                    <a href="especialidades-info" class="btn-arrow">
                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                    </a>
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
                                    <h5 class="card-title">Endocrinología</h5>
                                    <p class="card-text flex-grow-1">Diagnóstico y tratamiento de trastornos hormonales y metabólicos.</p>
                                    <div class="mt-3">
                                        <span class="badge bg-light text-success">6+ Doctores</span>
                                    </div>
                                    <a href="especialidades-info" class="btn-arrow">
                                        <i class="bi bi-arrow-right-circle-fill"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Controles del carrusel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#especialidadesCarousel" data-bs-slide="prev">
                <span class="carousel-control-icon">
                    <i class="bi bi-chevron-left"></i>
                </span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#especialidadesCarousel" data-bs-slide="next">
                <span class="carousel-control-icon">
                    <i class="bi bi-chevron-right"></i>
                </span>
            </button>
            
            <!-- Indicadores -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#especialidadesCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#especialidadesCarousel" data-bs-slide-to="1"></button>
            </div>
        </div>
    </div>
      
      <div class="text-center mt-5">
        <a href="especialidades-info" class="btn btn-primary btn-lg rounded-pill px-5">
          <?php echo idioma_actual() === 'es' ? 'Ver Todas' : 'View All'; ?>
          <i class="bi bi-arrow-right ms-2"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- Sección ¿Por qué Elegirnos? con imagen de la clínica -->
  <section class="py-5 bg-white">
    <div class="container">
      <div class="row align-items-center g-4">
        <!-- Columna izquierda: Preguntas frecuentes -->
        <div class="col-lg-6">
          <h2 class="fw-bold mb-4"><?php echo idioma_actual() === 'es' ? '¿Por qué Elegirnos?' : 'Why Choose Us?'; ?></h2>
          <p class="text-muted mb-4">---</p>
          
          <!-- Acordeón de preguntas -->
          <div class="accordion accordion-elegirnos" id="accordionElegirnos">
            
            <!-- Pregunta 1 -->
            <div class="accordion-item border rounded mb-3">
              <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <?php echo idioma_actual() === 'es' ? '¿Por qué debería elegir la clínica?' : 'Why should I choose the clinic?'; ?>
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionElegirnos">
                <div class="accordion-body">
                  <p class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> 
                    <?php echo idioma_actual() === 'es' 
                      ? 'Porque en nuestra clínica no solo tratamos enfermedades, cuidamos personas. Contamos con especialistas altamente calificados, equipos médicos modernos y un enfoque integral que combina prevención, diagnóstico y tratamiento en un solo lugar.' 
                      : 'Because in our clinic we don\'t just treat diseases, we care for people. We have highly qualified specialists, modern medical equipment and a comprehensive approach that combines prevention, diagnosis and treatment in one place.'; ?>
                  </p>
                </div>
              </div>
            </div>
            
            <!-- Pregunta 2 -->
            <div class="accordion-item border rounded mb-3">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <?php echo idioma_actual() === 'es' ? '¿Puedo confiar en sus médicos?' : 'Can I trust your doctors?'; ?>
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionElegirnos">
                <div class="accordion-body">
                  <p><?php echo idioma_actual() === 'es' 
                    ? 'Sí, todos nuestros médicos cuentan con certificaciones nacionales e internacionales, experiencia comprobada y un compromiso genuino con la salud de nuestros pacientes.' 
                    : 'Yes, all our doctors have national and international certifications, proven experience and a genuine commitment to the health of our patients.'; ?>
                  </p>
                </div>
              </div>
            </div>
            
            <!-- Pregunta 3 -->
            <div class="accordion-item border rounded mb-3">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  <?php echo idioma_actual() === 'es' ? '¿Es seguro atenderme aquí?' : 'Is it safe to get treated here?'; ?>
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionElegirnos">
                <div class="accordion-body">
                  <p><?php echo idioma_actual() === 'es' 
                    ? 'Absolutamente. Cumplimos con los más altos estándares de seguridad, protocolos de higiene rigurosos y tecnología de última generación para garantizar tu bienestar en todo momento.' 
                    : 'Absolutely. We meet the highest safety standards, rigorous hygiene protocols and state-of-the-art technology to ensure your well-being at all times.'; ?>
                  </p>
                </div>
              </div>
            </div>
            
          </div>
        </div>
        
        <!-- Columna derecha: Imagen de la clínica -->
        <div class="col-lg-6">
          <img src="vistas/img/clinica-afuera.jpg" alt="Clínica por fuera" class="img-fluid rounded-4 shadow-lg">
        </div>
      </div>
    </div>
  </section>

  <!-- Contacto -->
  <section id="contacto" class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-5"><?php echo idioma_actual() === 'es' ? 'Nuestra Ubicación' : 'Our Location'; ?></h2>
      
      <!-- Mapa de ubicación -->
      <div class="row">
        <div class="col-12">
          <div class="card border-0 shadow-lg ubicacion-card">
            <div class="card-body p-0">
              <div class="d-flex align-items-center ubicacion-header text-white p-3">
                <i class="bi bi-geo-alt-fill fs-4 me-2"></i>
                <div>
                  <h5 class="mb-0"><?php echo idioma_actual() === 'es' ? 'Nuestra Ubicación' : 'Our Location'; ?></h5>
                  <p class="mb-0 small">Brasil 262, Tarapoto 22202</p>
                </div>
              </div>
              <!-- Google Maps Iframe -->
              <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.324357617814!2d-76.37805014848706!3d-6.4805410768226155!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91ba0b894b1b0f9b%3A0x9705ade9141630e8!2sCLINICA%20RODRIGUEZ%20Y%20ESPECIALISTAS!5e0!3m2!1ses!2spe!4v1761439669151!5m2!1ses!2spe" 
                width="100%" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
              </iframe>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </section>

  <?php
  // Incluir footer reutilizable
  include 'vistas/modulos/componentes/footer-publico.php';
  ?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
</body>
</html>
