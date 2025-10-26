<?php
require_once 'vistas/modulos/idiomas.php';

$titulo_pagina = idioma_actual() === 'es' ? 'Agendar Cita - Clínica Médica' : 'Book Appointment - Medical Clinic';
$pagina_activa = 'agendar-cita';

include 'vistas/modulos/componentes/head-publico.php';
include 'vistas/modulos/componentes/topbar-publico.php';
include 'vistas/modulos/componentes/navbar-publico.php';
?>

<style>
  .cita-section {
    background: white;
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 100px 0;
  }
  
  .cita-content {
    color: #333;
  }
  
  .cita-content h1 {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 1.5rem;
    line-height: 1.2;
  }
  
  .cita-content p {
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 2rem;
  }
  
  .cita-card {
    background: #f8f9fa;
    border-radius: 30px;
    padding: 3rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border: 1px solid #e0e0e0;
  }
  
  .cita-card h2 {
    color: #333;
    font-weight: bold;
    margin-bottom: 0.5rem;
    font-size: 2rem;
  }
  
  .cita-card .subtitle {
    color: #666;
    margin-bottom: 2rem;
    font-size: 1rem;
  }
  
  .form-label {
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
  }
  
  .form-control, .form-select {
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
    transition: all 0.3s;
    background: white;
  }
  
  .form-control:focus, .form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    background: white;
  }
  
  .form-control::placeholder {
    color: #999;
  }
  
  textarea.form-control {
    resize: none;
  }
  
  .btn-enviar {
    background: #007bff;
    color: white;
    border: none;
    padding: 0.75rem 2.5rem;
    border-radius: 50px;
    font-weight: bold;
    font-size: 1rem;
    transition: all 0.3s;
    box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
  }
  
  .btn-enviar:hover {
    background: #0056b3;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
  }
  
  .char-counter {
    font-size: 0.875rem;
    color: #999;
    text-align: right;
    margin-top: 0.25rem;
  }
  
  .row-inputs {
    display: flex;
    gap: 1rem;
  }
  
  .row-inputs > div {
    flex: 1;
  }
  
  @media (max-width: 768px) {
    .row-inputs {
      flex-direction: column;
    }
  }
</style>

<section class="cita-section">
  <div class="container">
    <div class="row align-items-center g-5">
      
      <!-- Columna Izquierda - Información -->
      <div class="col-lg-5">
        <div class="cita-content">
          <h1><?php echo idioma_actual() === 'es' ? 'Conéctese Con Nosotros Para Tus Necesidades De Atención Médica' : 'Connect With Us For Your Medical Care Needs'; ?></h1>
          <p><?php echo idioma_actual() === 'es' ? 'Alcanza apoyo, retroalimentación o programar una cita. Llene el formulario, y rápidamente le ayudaremos y confirmaremos su visita con nuestros profesionales de la salud.' : 'Reach out for support, feedback, or to schedule an appointment. Fill out the form, and we will quickly assist you and confirm your visit with our healthcare professionals.'; ?></p>
        </div>
      </div>
      
      <!-- Columna Derecha - Formulario -->
      <div class="col-lg-7">
        <div class="cita-card">
          <h2><?php echo idioma_actual() === 'es' ? 'Ponte En Contacto' : 'Get In Touch'; ?></h2>
          <p class="subtitle"><?php echo idioma_actual() === 'es' ? 'Escríbenos en cualquier momento' : 'Write to us anytime'; ?></p>
      
          <form id="formCita" method="POST" action="#">
            
            <!-- Fila 1: Nombre y Apellidos -->
            <div class="row-inputs mb-3">
              <div>
                <label for="nombreCompleto" class="form-label"><?php echo idioma_actual() === 'es' ? 'Nombres' : 'First Name'; ?></label>
                <input 
                  type="text" 
                  class="form-control" 
                  id="nombreCompleto" 
                  name="nombreCompleto" 
                  maxlength="60" 
                  required
                  placeholder="<?php echo idioma_actual() === 'es' ? 'Nombres' : 'First Name'; ?>">
              </div>
              <div>
                <label for="apellidos" class="form-label"><?php echo idioma_actual() === 'es' ? 'Apellidos' : 'Last Name'; ?></label>
                <input 
                  type="text" 
                  class="form-control" 
                  id="apellidos" 
                  name="apellidos" 
                  maxlength="60" 
                  required
                  placeholder="<?php echo idioma_actual() === 'es' ? 'Apellidos' : 'Last Name'; ?>">
              </div>
            </div>
            
            <!-- Fila 2: DNI y Teléfono -->
            <div class="row-inputs mb-3">
              <div>
                <label for="documento" class="form-label"><?php echo idioma_actual() === 'es' ? 'DNI / Pasaporte' : 'ID / Passport'; ?></label>
                <input 
                  type="text" 
                  class="form-control" 
                  id="documento" 
                  name="documento" 
                  maxlength="60" 
                  required
                  placeholder="<?php echo idioma_actual() === 'es' ? 'DNI / Pasaporte' : 'ID / Passport'; ?>">
              </div>
              <div>
                <label for="celular" class="form-label"><?php echo idioma_actual() === 'es' ? 'Teléfono' : 'Phone'; ?></label>
                <input 
                  type="tel" 
                  class="form-control" 
                  id="celular" 
                  name="celular" 
                  maxlength="60" 
                  required
                  placeholder="<?php echo idioma_actual() === 'es' ? 'Teléfono' : 'Phone'; ?>">
              </div>
            </div>
        
            <!-- Razón de Consulta -->
            <div class="mb-3">
              <label for="razonConsulta" class="form-label"><?php echo idioma_actual() === 'es' ? 'Mensaje' : 'Message'; ?></label>
              <textarea 
                class="form-control" 
                id="razonConsulta" 
                name="razonConsulta" 
                rows="5" 
                maxlength="300" 
                required
                placeholder="<?php echo idioma_actual() === 'es' ? 'Escribe tu mensaje aquí...' : 'Write your message here...'; ?>"></textarea>
              <div class="char-counter">
                <span id="razonCounter">0</span>/300
              </div>
            </div>
            
            <!-- Botón de Envío -->
            <div class="mt-4">
              <button type="submit" class="btn btn-enviar">
                <?php echo idioma_actual() === 'es' ? 'Enviar' : 'Send'; ?>
                <i class="bi bi-arrow-right"></i>
              </button>
            </div>
            
          </form>
        </div>
      </div>
      
    </div>
  </div>
</section>

<script>
// Contador de caracteres para cada campo
function setupCharCounter(inputId, counterId) {
  const input = document.getElementById(inputId);
  const counter = document.getElementById(counterId);
  
  input.addEventListener('input', function() {
    counter.textContent = this.value.length;
  });
}

// Inicializar contadores
setupCharCounter('razonConsulta', 'razonCounter');

// Manejar envío del formulario
document.getElementById('formCita').addEventListener('submit', function(e) {
  e.preventDefault();
  
  // Aquí puedes agregar la lógica para enviar el formulario
  // Por ahora mostramos un mensaje de confirmación
  alert('<?php echo idioma_actual() === 'es' ? '¡Solicitud enviada! Nos contactaremos contigo pronto.' : 'Request submitted! We will contact you soon.'; ?>');
  
  // Opcional: limpiar el formulario
  this.reset();
  document.querySelectorAll('.char-counter span').forEach(span => span.textContent = '0');
});
</script>

<?php include 'vistas/modulos/componentes/footer-publico.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
