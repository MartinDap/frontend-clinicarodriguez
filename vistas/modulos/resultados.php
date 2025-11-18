<?php
require_once 'vistas/modulos/idiomas.php';
?>
<!DOCTYPE html>
<html lang="<?php echo idioma_actual(); ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo idioma_actual() === 'es' ? 'Consulta de Resultados' : 'Results Query'; ?> - Clínica Médica</title>
  
  <!-- Bootstrap 5.3.2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="vistas/css/estilos.css">
</head>
<body>

<div class="login-container">
  <div class="login-box">
    
    <!-- Icono y Título -->
    <div class="login-logo">
      <i class="bi bi-hospital"></i>
      <h3><?php echo idioma_actual() === 'es' ? 'Consulta de Resultados' : 'Results Query'; ?></h3>
      <p class="text-muted"><?php echo idioma_actual() === 'es' ? 'Ingresa tu DNI para consultar tus resultados médicos' : 'Enter your ID to check your medical results'; ?></p>
    </div>

    <!-- Formulario -->
    <form id="formConsultaResultados" method="post">
      
      <!-- Campo DNI -->
      <div class="mb-3">
        <label for="dniConsulta" class="form-label"><?php echo idioma_actual() === 'es' ? 'DNI del Paciente' : 'Patient ID'; ?></label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="bi bi-person-badge"></i>
          </span>
          <input type="text" class="form-control" id="dniConsulta" name="dniConsulta" placeholder="<?php echo idioma_actual() === 'es' ? 'Ingresa tu DNI' : 'Enter your ID'; ?>" 
            required
            maxlength="8"
            pattern="[0-9]{8}"
          >
        </div>
      </div>

      <!-- Botón de Consulta -->
      <div class="d-grid mb-3">
        <button type="submit" class="btn btn-primary btn-custom">
          <i class="bi bi-search"></i> <?php echo idioma_actual() === 'es' ? 'Consultar Resultados' : 'Check Results'; ?>
        </button>
      </div>
    </form>
    
    <hr>
    
    <!-- Botón para Ver Resultados Recientes -->
    <div class="d-grid">
      <button type="button" id="btnVerResultadosRecientes" class="btn btn-success btn-custom">
        <i class="bi bi-file-earmark-medical"></i> <?php echo idioma_actual() === 'es' ? 'Ver Resultados Recientes' : 'View Recent Results'; ?>
      </button>
    </div>
    
    <!-- Enlace Volver -->
    <div class="text-center mt-4">
      <a href="./" class="text-muted">
        <i class="bi bi-arrow-left"></i> <?php echo idioma_actual() === 'es' ? 'Volver al Inicio' : 'Back to Home'; ?>
      </a>
    </div>
    
    <!-- Footer -->
    <div class="text-center mt-2">
      <small class="text-muted">&copy; <?php echo date('Y'); ?> <?php echo idioma_actual() === 'es' ? 'Sistema Seguro' : 'Secure System'; ?></small>
    </div>
    
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="vistas/js/config.js"></script>
<script>
  /**
   * Script para consultar resultados médicos por DNI
   */
  $(document).ready(function() {
    // Validación del formulario
    $('#formConsultaResultados').on('submit', function(e) {
      e.preventDefault();
      
      // Obtener el DNI ingresado
      var dni = $('#dniConsulta').val().trim();
      
      // Validar formato de DNI (8 dígitos)
      if (dni.length !== 8 || !/^\d{8}$/.test(dni)) {
        Swal.fire({
          icon: 'warning',
          title: '<?php echo idioma_actual() === 'es' ? 'DNI inválido' : 'Invalid ID'; ?>',
          text: '<?php echo idioma_actual() === 'es' 
            ? 'Por favor ingresa un DNI válido de 8 dígitos' 
            : 'Please enter a valid 8-digit ID'; ?>',
          confirmButtonColor: '#667eea'
        });
        return;
      }
      
      // Mostrar loading
      Swal.fire({
        title: '<?php echo idioma_actual() === 'es' ? 'Consultando...' : 'Checking...'; ?>',
        text: '<?php echo idioma_actual() === 'es' ? 'Por favor espera' : 'Please wait'; ?>',
        allowOutsideClick: false,
        showConfirmButton: false,
        willOpen: () => {
          Swal.showLoading();
        }
      });
      
      // Realizar petición al backend
      var configuracion = {
        url: `${CONFIG.API_BASE_URL}pacientes/dni/${dni}`,
        method: 'GET',
        timeout: 0,
        headers: {
          'Authorization': CONFIG.API_AUTH_HEADER
        }
      };
      
      $.ajax(configuracion)
        .done(function(respuesta) {
          console.log('Respuesta recibida:', respuesta);
          
          // Si se encontró el paciente
          if (respuesta && respuesta.data) {
            Swal.fire({
              icon: 'success',
              title: '<?php echo idioma_actual() === 'es' ? '¡Paciente Encontrado!' : 'Patient Found!'; ?>',
              html: `
                <div class="text-start">
                  <p><strong><?php echo idioma_actual() === 'es' ? 'Nombre:' : 'Name:'; ?></strong> ${respuesta.data.persona.persNombrecompleto}</p>
                  <p><strong><?php echo idioma_actual() === 'es' ? 'DNI:' : 'ID:'; ?></strong> ${respuesta.data.persona.persNroDoc}</p>
                  <hr>
                  <p class="text-muted small"><?php echo idioma_actual() === 'es' 
                    ? 'Para consultar resultados específicos, comunícate con recepción.' 
                    : 'To check specific results, contact reception.'; ?></p>
                </div>
              `,
              confirmButtonColor: '#667eea',
              confirmButtonText: '<?php echo idioma_actual() === 'es' ? 'Entendido' : 'Got it'; ?>'
            });
              sessionStorage.setItem('dniPaciente', respuesta.data.persona.persNroDoc);
              window.location.href = 'ver-resultados';
          } else {
            Swal.fire({
              icon: 'info',
              title: '<?php echo idioma_actual() === 'es' ? 'No encontrado' : 'Not found'; ?>',
              text: '<?php echo idioma_actual() === 'es' 
                ? 'No se encontraron registros con ese DNI' 
                : 'No records found with that ID'; ?>',
              confirmButtonColor: '#667eea'
            });
          }
        })
        .fail(function(xhr, estado, error) {
          console.error('Error:', error);
          
          Swal.fire({
            icon: 'error',
            title: '<?php echo idioma_actual() === 'es' ? 'Error de Consulta' : 'Query Error'; ?>',
            text: '<?php echo idioma_actual() === 'es' 
              ? 'No se pudo realizar la consulta. Intenta nuevamente.' 
              : 'Could not perform the query. Try again.'; ?>',
            confirmButtonColor: '#667eea'
          });
        });
    });
    
    // Permitir solo números en el campo DNI
    $('#dniConsulta').on('keypress', function(e) {
      var charCode = (e.which) ? e.which : e.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        e.preventDefault();
      }
    });
    
    // Botón verde: Ver Resultados Recientes sin DNI
    $('#btnVerResultadosRecientes').on('click', function() {
      // Guardar un DNI de ejemplo para demostrar la funcionalidad
      sessionStorage.setItem('dniPaciente', '12345678');
      window.location.href = 'ver-resultados';
    });
  });
</script>
</body>
</html>
