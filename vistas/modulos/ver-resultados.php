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
<script>
  /**
   * Script para cargar y mostrar los resultados del paciente
   */
  $(document).ready(function() {
    // Obtener DNI del sessionStorage o localStorage
    var dniPaciente = sessionStorage.getItem('dniPaciente') || localStorage.getItem('dniPaciente');
    
    if (!dniPaciente) {
      // Si no hay DNI guardado, redirigir a la página de consulta
      Swal.fire({
        icon: 'warning',
        title: '<?php echo idioma_actual() === 'es' ? 'Acceso no autorizado' : 'Unauthorized access'; ?>',
        text: '<?php echo idioma_actual() === 'es' 
          ? 'Por favor ingresa tu DNI primero' 
          : 'Please enter your ID first'; ?>',
        confirmButtonColor: '#667eea'
      }).then(function() {
        window.location.href = 'resultados';
      });
      return;
    }
    
    // Cargar información del paciente
    cargarInfoPaciente(dniPaciente);
    
    // Cargar resultados del paciente
    cargarResultados(dniPaciente);
  });
  
  /**
   * Cargar información del paciente
   */
  function cargarInfoPaciente(dni) {
    $.ajax({
      url: `${CONFIG.API_BASE_URL}pacientes/dni/${dni}`,
      method: 'GET',
      headers: {
        'Authorization': CONFIG.API_AUTH_HEADER
      }
    })
    .done(function(respuesta) {
      if (respuesta && respuesta.data) {
        var paciente = respuesta.data;
        
        // Actualizar nombre en la barra de navegación
        $('#nombrePacienteNav').text(`${paciente.paciNombre} ${paciente.paciApellido}`);
        
        // Actualizar información en la tarjeta
        var html = `
          <div class="col-md-6">
            <p class="mb-2"><strong><i class="bi bi-person me-2"></i><?php echo idioma_actual() === 'es' ? 'Nombre:' : 'Name:'; ?></strong> ${paciente.paciNombre} ${paciente.paciApellido}</p>
            <p class="mb-2"><strong><i class="bi bi-card-text me-2"></i><?php echo idioma_actual() === 'es' ? 'DNI:' : 'ID:'; ?></strong> ${paciente.paciDni}</p>
          </div>
          <div class="col-md-6">
            <p class="mb-2"><strong><i class="bi bi-telephone me-2"></i><?php echo idioma_actual() === 'es' ? 'Teléfono:' : 'Phone:'; ?></strong> ${paciente.paciTelefono || 'N/A'}</p>
            <p class="mb-2"><strong><i class="bi bi-envelope me-2"></i><?php echo idioma_actual() === 'es' ? 'Email:' : 'Email:'; ?></strong> ${paciente.paciEmail || 'N/A'}</p>
          </div>
        `;
        $('#infoPaciente').html(html);
      }
    })
    .fail(function() {
      $('#nombrePacienteNav').text('<?php echo idioma_actual() === 'es' ? 'Error' : 'Error'; ?>');
      $('#infoPaciente').html('<p class="text-danger"><?php echo idioma_actual() === 'es' ? 'Error al cargar información' : 'Error loading information'; ?></p>');
    });
  }
  
  /**
   * Cargar resultados del paciente
   */
  function cargarResultados(dni) {
    // Por ahora mostrar mensaje de ejemplo
    // En el futuro aquí harías una petición al endpoint de resultados
    setTimeout(function() {
      var html = `
        <div class="col-12">
          <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>
            <?php echo idioma_actual() === 'es' 
              ? 'Esta funcionalidad está en desarrollo. Pronto podrás ver tus resultados aquí.' 
              : 'This feature is under development. Soon you will be able to see your results here.'; ?>
          </div>
          
          <!-- Ejemplo de tarjeta de resultado -->
          <div class="card mb-3">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <h6 class="mb-1"><i class="bi bi-file-medical me-2 text-primary"></i><?php echo idioma_actual() === 'es' ? 'Análisis de Sangre' : 'Blood Test'; ?></h6>
                  <p class="text-muted mb-2 small"><?php echo idioma_actual() === 'es' ? 'Fecha:' : 'Date:'; ?> 20/12/2024</p>
                  <p class="mb-0"><span class="badge bg-success"><?php echo idioma_actual() === 'es' ? 'Completado' : 'Completed'; ?></span></p>
                </div>
                <button class="btn btn-sm btn-outline-primary" disabled>
                  <i class="bi bi-download"></i> <?php echo idioma_actual() === 'es' ? 'Descargar' : 'Download'; ?>
                </button>
              </div>
            </div>
          </div>
          
          <div class="card mb-3">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <h6 class="mb-1"><i class="bi bi-file-medical me-2 text-primary"></i><?php echo idioma_actual() === 'es' ? 'Radiografía de Tórax' : 'Chest X-Ray'; ?></h6>
                  <p class="text-muted mb-2 small"><?php echo idioma_actual() === 'es' ? 'Fecha:' : 'Date:'; ?> 15/12/2024</p>
                  <p class="mb-0"><span class="badge bg-warning"><?php echo idioma_actual() === 'es' ? 'En proceso' : 'In process'; ?></span></p>
                </div>
                <button class="btn btn-sm btn-outline-primary" disabled>
                  <i class="bi bi-download"></i> <?php echo idioma_actual() === 'es' ? 'Descargar' : 'Download'; ?>
                </button>
              </div>
            </div>
          </div>
        </div>
      `;
      $('#listaResultados').html(html);
    }, 1000);
  }
</script>
</body>
</html>
