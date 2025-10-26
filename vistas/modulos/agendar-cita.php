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
    background: linear-gradient(to bottom, #ffffff, #f8fbff);
    border-radius: 30px;
    padding: 3rem;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.12), 
                0 0 0 1px rgba(56, 195, 196, 0.1) inset;
    border: 2px solid transparent;
    background-clip: padding-box;
    position: relative;
    overflow: hidden;
  }
  
  /* Borde degradado animado en la parte superior */
  .cita-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, 
      #38c3c4 0%, 
      #2a0287 25%, 
      #38c3c4 50%, 
      #2a0287 75%, 
      #38c3c4 100%);
    background-size: 200% 100%;
    animation: gradientFlow 4s linear infinite;
  }
  
  /* Efecto de brillo sutil en las esquinas */
  .cita-card::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(56, 195, 196, 0.08) 0%, transparent 70%);
    pointer-events: none;
  }
  
  @keyframes gradientFlow {
    0% { background-position: 0% 50%; }
    100% { background-position: 200% 50%; }
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
    border: 2px solid #e8eef5;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background: white;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
  }
  
  .form-control:focus, .form-select:focus {
    border-color: #38c3c4;
    box-shadow: 0 0 0 3px rgba(56, 195, 196, 0.15), 
                0 4px 12px rgba(56, 195, 196, 0.1);
    background: white;
    outline: none;
    transform: translateY(-1px);
  }
  
  .form-control::placeholder {
    color: #999;
  }
  
  textarea.form-control {
    resize: none;
  }
  
  .btn-enviar {
    background: linear-gradient(135deg, #38c3c4 0%, #2a0287 100%);
    color: white;
    border: none;
    padding: 0.85rem 3rem;
    border-radius: 50px;
    font-weight: bold;
    font-size: 1rem;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 6px 20px rgba(56, 195, 196, 0.35), 
                0 0 0 1px rgba(255, 255, 255, 0.1) inset;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    position: relative;
    overflow: hidden;
  }
  
  /* Efecto de brillo al pasar el cursor */
  .btn-enviar::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
      transparent, 
      rgba(255, 255, 255, 0.3), 
      transparent);
    transition: left 0.5s;
  }
  
  .btn-enviar:hover::before {
    left: 100%;
  }
  
  .btn-enviar:hover {
    background: linear-gradient(135deg, #2a0287 0%, #38c3c4 100%);
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 10px 30px rgba(56, 195, 196, 0.45), 
                0 0 0 1px rgba(255, 255, 255, 0.2) inset;
  }
  
  .btn-enviar:active {
    transform: translateY(-1px) scale(0.98);
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
                  maxlength="20" 
                  required
                  pattern="[0-9]+"
                  title="<?php echo idioma_actual() === 'es' ? 'Solo se permiten números' : 'Only numbers allowed'; ?>"
                  placeholder="<?php echo idioma_actual() === 'es' ? 'Solo números' : 'Numbers only'; ?>">
              </div>
              <div>
                <label for="celular" class="form-label"><?php echo idioma_actual() === 'es' ? 'Teléfono' : 'Phone'; ?></label>
                <input 
                  type="text" 
                  class="form-control" 
                  id="celular" 
                  name="celular" 
                  maxlength="15" 
                  required
                  pattern="[0-9]+"
                  title="<?php echo idioma_actual() === 'es' ? 'Solo se permiten números' : 'Only numbers allowed'; ?>"
                  placeholder="<?php echo idioma_actual() === 'es' ? 'Solo números' : 'Numbers only'; ?>">
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
                <?php echo idioma_actual() === 'es' ? 'Enviar por WhatsApp' : 'Send via WhatsApp'; ?>
                <i class="bi bi-whatsapp"></i>
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

// Validar que solo se ingresen números en DNI/Pasaporte y Teléfono
function validarSoloNumeros(inputId) {
  const input = document.getElementById(inputId);
  
  input.addEventListener('input', function(e) {
    // Remover cualquier caracter que no sea número
    this.value = this.value.replace(/[^0-9]/g, '');
  });
  
  // Prevenir pegar texto no numérico
  input.addEventListener('paste', function(e) {
    e.preventDefault();
    const pasteData = (e.clipboardData || window.clipboardData).getData('text');
    const soloNumeros = pasteData.replace(/[^0-9]/g, '');
    this.value = soloNumeros;
  });
}

// Aplicar validación a los campos
validarSoloNumeros('documento');
validarSoloNumeros('celular');

// Manejar envío del formulario y redireccionar a WhatsApp
document.getElementById('formCita').addEventListener('submit', function(e) {
  e.preventDefault();
  
  // Obtener los valores del formulario
  const nombre = document.getElementById('nombreCompleto').value.trim();
  const apellidos = document.getElementById('apellidos').value.trim();
  const documento = document.getElementById('documento').value.trim();
  const celular = document.getElementById('celular').value.trim();
  const mensaje = document.getElementById('razonConsulta').value.trim();
  
  // Validar que todos los campos estén completos
  if (!nombre || !apellidos || !documento || !celular || !mensaje) {
    alert('<?php echo idioma_actual() === 'es' ? 'Por favor complete todos los campos' : 'Please fill in all fields'; ?>');
    return;
  }
  
  // Construir el mensaje para WhatsApp
  const textoWhatsApp = `<?php echo idioma_actual() === 'es' ? 
    '*Nueva solicitud de contacto*%0A%0A' .
    '*Nombre:* ' : 
    '*New contact request*%0A%0A' .
    '*Name:* '; ?>` + nombre + ' ' + apellidos + `%0A` +
    `<?php echo idioma_actual() === 'es' ? '*DNI/Pasaporte:* ' : '*ID/Passport:* '; ?>` + documento + `%0A` +
    `<?php echo idioma_actual() === 'es' ? '*Teléfono:* ' : '*Phone:* '; ?>` + celular + `%0A%0A` +
    `<?php echo idioma_actual() === 'es' ? '*Mensaje:*%0A' : '*Message:*%0A'; ?>` + mensaje;
  
  // Número de WhatsApp de la clínica (el mismo que está en el footer)
  const numeroWhatsApp = '51937753923';
  
  // Crear URL de WhatsApp y abrir en nueva pestaña
  const urlWhatsApp = `https://wa.me/${numeroWhatsApp}?text=${textoWhatsApp}`;
  window.open(urlWhatsApp, '_blank');
  
  // Opcional: Limpiar el formulario después de enviar
  setTimeout(() => {
    this.reset();
    document.querySelectorAll('.char-counter span').forEach(span => span.textContent = '0');
  }, 500);
});
</script>

<?php include 'vistas/modulos/componentes/footer-publico.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
