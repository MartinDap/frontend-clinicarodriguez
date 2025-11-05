<?php
require_once 'vistas/modulos/idiomas.php';
?>
<!DOCTYPE html>
<html lang="<?php echo idioma_actual(); ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo idioma_actual() === 'es' ? 'Mis Resultados' : 'My Results'; ?> - Clínica Médica</title>
  
  <!-- Bootstrap 5.3.2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="vistas/css/estilos-publicos.css">
  <link rel="stylesheet" href="vistas/css/componentes.css">
  
  <style>
    /* Eliminar espacio superior del body */
    body {
      padding-top: 0 !important;
    }
  </style>
</head>
<body>

<!-- Barra superior personalizada para paciente -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #38c3c4 0%, #2a0287 100%); box-shadow: 0 4px 15px rgba(56, 195, 196, 0.2);">
  <div class="container-fluid px-4">
    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center" href="./">
      <img src="vistas/img/logo-fondo-blanco.png" alt="Clínica Médica" style="height: 50px; object-fit: contain;">
    </a>
    
    <!-- Información del paciente y botón salir -->
    <div class="d-flex align-items-center gap-3">
      <!-- Nombre del paciente -->
      <div class="d-none d-md-flex align-items-center text-white">
        <i class="bi bi-person-circle me-2" style="font-size: 1.5rem;"></i>
        <div>
          <small class="d-block" style="font-size: 0.75rem; opacity: 0.9;"><?php echo idioma_actual() === 'es' ? 'Paciente' : 'Patient'; ?></small>
          <span class="fw-semibold" id="nombrePacienteNav"><?php echo idioma_actual() === 'es' ? 'Cargando...' : 'Loading...'; ?></span>
        </div>
      </div>
      
      <!-- Botón salir -->
      <a href="resultados" class="btn btn-light btn-sm d-flex align-items-center gap-2">
        <i class="bi bi-box-arrow-left"></i>
        <span><?php echo idioma_actual() === 'es' ? 'Salir' : 'Exit'; ?></span>
      </a>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero-section" style="min-height: 200px;">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-12 text-center">
        <h1 class="display-5 fw-bold mb-3">
          <i class="bi bi-file-earmark-medical me-2"></i>
          <?php echo idioma_actual() === 'es' ? 'Mis Resultados Médicos' : 'My Medical Results'; ?>
        </h1>
        <p class="lead"><?php echo idioma_actual() === 'es' ? 'Consulta tus resultados de pruebas recientes' : 'Check your recent test results'; ?></p>
      </div>
    </div>
  </div>
</section>

<!-- Sección de Resultados -->
<section class="py-5 bg-light">
  <div class="container">
    
    <!-- Información del Paciente -->
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-body p-4">
        <h5 class="card-title mb-3">
          <i class="bi bi-person-circle text-primary me-2"></i>
          <?php echo idioma_actual() === 'es' ? 'Información del Paciente' : 'Patient Information'; ?>
        </h5>
        <div id="infoPaciente" class="row">
          <div class="col-12">
            <div class="spinner-border text-primary" role="status">
              <span class="visually-hidden"><?php echo idioma_actual() === 'es' ? 'Cargando...' : 'Loading...'; ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Lista de Resultados -->
    <div class="card border-0 shadow-sm">
      <div class="card-body p-4">
        <h5 class="card-title mb-4">
          <i class="bi bi-clipboard-data text-success me-2"></i>
          <?php echo idioma_actual() === 'es' ? 'Resultados Recientes' : 'Recent Results'; ?>
        </h5>
        
        <div id="listaResultados" class="row">
          <!-- Los resultados se cargarán aquí dinámicamente -->
          <div class="col-12 text-center">
            <div class="spinner-border text-primary" role="status">
              <span class="visually-hidden"><?php echo idioma_actual() === 'es' ? 'Cargando...' : 'Loading...'; ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Botón Volver -->
    <div class="text-center mt-4">
      <a href="resultados" class="btn btn-outline-primary">
        <i class="bi bi-arrow-left me-2"></i>
        <?php echo idioma_actual() === 'es' ? 'Volver' : 'Back'; ?>
      </a>
    </div>

  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="vistas/js/config.js"></script>
<script src="vistas/js/ver-resultados.js"></script>
</body>
</html>
