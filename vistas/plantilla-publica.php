<!DOCTYPE html>
<html lang="es">
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
      <a class="navbar-brand fw-bold" href="/">
        <i class="bi bi-hospital fs-3 me-2"></i>
        CLÍNICA MÉDICA
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#conocenos">Conócenos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#especialidades">Especialidades</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#servicios">Servicios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#medicos">Médicos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contacto">Contacto</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-primary ms-2" href="login">
              <i class="bi bi-box-arrow-in-right"></i> Acceso Personal
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
          <h1 class="display-4 fw-bold mb-4">Bienvenido a Clínica Médica</h1>
          <p class="lead mb-4">Atención médica integral con tecnología de punta y el mejor equipo de especialistas</p>
          <div class="d-flex gap-3">
            <a href="#citas" class="btn btn-warning btn-lg">
              <i class="bi bi-calendar-plus"></i> Compra una Cita aquí
            </a>
            <a href="#resultados" class="btn btn-outline-primary btn-lg">
              <i class="bi bi-file-earmark-text"></i> Revisa tus resultados
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
              <h5 class="card-title">Unidad de Apoyo al Diagnóstico</h5>
              <p class="card-text">Tecnología actualizada y un equipo humano especializado para una experiencia técnica y científica constituyen el diagnóstico preciso para garantizar el seguimiento correspondiente.</p>
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
              <h5 class="card-title">Soporte Espiritual y Emocional</h5>
              <p class="card-text">Acompañamiento y presencia en momentos difíciles, un apoyo para cada persona cuando más lo necesite. Una esperanza asegura sostenidos de Jesús hacia del altísimo.</p>
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
              <h5 class="card-title">Unidades de Atención</h5>
              <p class="card-text">Una amplia gama de especialidades y servicios médicos equipados con tecnología sofisticada, ofrecen una óptima experiencia.</p>
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
              <h5 class="card-title">Servicios Adicionales</h5>
              <p class="card-text">Diversos servicios adicionales puestos a tu disposición, contribuyen a brindar soluciones especiales.</p>
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
              <h5 class="card-title">Hotelería Hospitalaria</h5>
              <p class="card-text">Combinando confort, bienestar, seguridad, esperanza, innovación y tecnología en la calidad de atención para alcanzar la plena satisfacción en ti y tu familia.</p>
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
              <h5 class="card-title">Productos Especiales</h5>
              <p class="card-text">Convencidos que el bienestar de la salud familiar es importante, desarrollamos estrategias para lograr tu tranquilidad.</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Especialidades (Carrusel) -->
  <section id="especialidades" class="py-5">
    <div class="container">
      <h2 class="text-center mb-5">Busca Especialidades (Carrusel)</h2>
      
      <div id="especialidadesCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          
          <!-- Slide 1 -->
          <div class="carousel-item active">
            <div class="row g-4">
              <div class="col-md-3">
                <div class="card especialidad-card bg-info text-white">
                  <div class="card-body">
                    <i class="bi bi-brain fs-1 mb-3"></i>
                    <h5>Neurocirugía</h5>
                    <p class="small">La neurocirugía es la especialidad médica dedicada al estudio, diagnóstico y tratamiento quirúrgico.</p>
                    <span class="badge bg-light text-dark">1+ Doctor</span>
                  </div>
                </div>
              </div>
              
              <div class="col-md-3">
                <div class="card especialidad-card">
                  <div class="card-body">
                    <i class="bi bi-gender-female fs-1 mb-3 text-primary"></i>
                    <h5>Ginecología y Obstetricia</h5>
                    <p class="small">La ginecología es la especialidad médica dedicada al cuidado integral de la salud femenina.</p>
                    <span class="badge bg-primary">1+ Doctor</span>
                  </div>
                </div>
              </div>
              
              <div class="col-md-3">
                <div class="card especialidad-card">
                  <div class="card-body">
                    <i class="bi bi-lungs fs-1 mb-3 text-primary"></i>
                    <h5>Neurología</h5>
                    <p class="small">La neurología es la especialidad médica que se enfoca en la prevención, diagnóstico y tratamiento.</p>
                    <span class="badge bg-primary">1+ Doctor</span>
                  </div>
                </div>
              </div>
              
              <div class="col-md-3">
                <div class="card especialidad-card">
                  <div class="card-body">
                    <i class="bi bi-capsule fs-1 mb-3 text-primary"></i>
                    <h5>Endocronología</h5>
                    <p class="small">La endocrinología es la especialidad médica dedicada al estudio, diagnóstico y tratamiento.</p>
                    <span class="badge bg-primary">6+ Doctor</span>
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
      <h2 class="text-center mb-5">Contáctanos</h2>
      <div class="row g-4 justify-content-center">
        
        <div class="col-md-3 text-center">
          <div class="contact-item">
            <div class="icon-circle bg-primary text-white mx-auto mb-3">
              <i class="bi bi-telephone-fill fs-3"></i>
            </div>
            <h5>Teléfono</h5>
            <p>+51 987 654 321</p>
          </div>
        </div>
        
        <div class="col-md-3 text-center">
          <div class="contact-item">
            <div class="icon-circle bg-primary text-white mx-auto mb-3">
              <i class="bi bi-envelope-fill fs-3"></i>
            </div>
            <h5>Email</h5>
            <p>atencion-centro@clinica.com</p>
          </div>
        </div>
        
        <div class="col-md-4 text-center">
          <div class="contact-item">
            <div class="icon-circle bg-primary text-white mx-auto mb-3">
              <i class="bi bi-clock-fill fs-3"></i>
            </div>
            <h5>Atenciones</h5>
            <p>Consultas entre desde<br>Lunes - Sabados 7:30 a 6:00<br>Emergencias las 24 horas</p>
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
          <p class="small">CLÍNICA RODRIGUEZ Y ESPECIALISTAS formó la Clínica Rodríguez, ofreciendo RECURSOS, FEA, SOAT, SCTR, SALUD OCUPACIONAL, etc.</p>
        </div>
        
        <div class="col-md-2">
          <h6>Servicios</h6>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white-50">Hospitalización</a></li>
            <li><a href="#" class="text-white-50">UVI</a></li>
            <li><a href="#" class="text-white-50">Emergencia</a></li>
            <li><a href="#" class="text-white-50">Laboratorio</a></li>
            <li><a href="#" class="text-white-50">Sala de Operaciones</a></li>
          </ul>
        </div>
        
        <div class="col-md-3">
          <h6>Especialidades</h6>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white-50">Neurocirugía</a></li>
            <li><a href="#" class="text-white-50">Ginecología y Obstetricia</a></li>
            <li><a href="#" class="text-white-50">Neurología</a></li>
            <li><a href="#" class="text-white-50">Endocronología</a></li>
            <li><a href="#" class="text-white-50">Cardiología</a></li>
          </ul>
        </div>
        
        <div class="col-md-2">
          <h6>Otros Links</h6>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white-50">Nosotros</a></li>
            <li><a href="#" class="text-white-50">Blogs</a></li>
            <li><a href="#" class="text-white-50">Contáctanos</a></li>
            <li><a href="#" class="text-white-50">Preguntas Frecuentes</a></li>
            <li><a href="#" class="text-white-50">Políticas De Privacidad</a></li>
          </ul>
        </div>
        
      </div>
      
      <hr class="my-4 bg-secondary">
      
      <div class="text-center">
        <p class="mb-0">&copy; 2025 CR Todos los derechos reservados</p>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
</body>
</html>
