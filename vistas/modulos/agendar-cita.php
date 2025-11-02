<?php
require_once 'vistas/modulos/idiomas.php';

$titulo_pagina = idioma_actual() === 'es' ? 'Agendar Cita - Clínica Médica' : 'Book Appointment - Medical Clinic';
$pagina_activa = 'agendar-cita';

include 'vistas/modulos/componentes/head-publico.php';
include 'vistas/modulos/componentes/topbar-publico.php';
include 'vistas/modulos/componentes/navbar-publico.php';

$curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => API_BASE_URL . 'especialidades',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
      API_AUTH_HEADER
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  $data = json_decode($response, true);

?>
<link rel="stylesheet" href="vistas/css/agendar-cita.css">

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

            <!-- Fila 1: Nombre completo (ocupa ambos campos) -->
            <div class="row-inputs mb-3">
              <div style="flex:1 1 100%;">
                <label for="nombreCompleto" class="form-label">
                  <?php echo idioma_actual() === 'es' ? 'Nombre completo' : 'Full Name'; ?>
                </label>
                <input
                  type="text"
                  class="form-control"
                  id="nombreCompleto"
                  name="nombreCompleto"
                  maxlength="120"
                  required
                  placeholder="<?php echo idioma_actual() === 'es' ? 'Nombre y apellidos' : 'First and last name'; ?>">
              </div>
            </div>

            <!-- Fila 2: DNI y Teléfono -->
            <div class="row-inputs mb-3">
              <div>
                <label for="documento" class="form-label">
                  <?php echo idioma_actual() === 'es' ? 'DNI / Pasaporte' : 'ID / Passport'; ?>
                </label>
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
                <label for="celular" class="form-label">
                  <?php echo idioma_actual() === 'es' ? 'Teléfono' : 'Phone'; ?>
                </label>
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

            <!-- Fila 3: Correo (ancho completo) -->
            <div class="row-inputs mb-3">
              <div style="flex:1 1 100%;">
                <label for="correo" class="form-label">
                  <?php echo idioma_actual() === 'es' ? 'Correo electrónico' : 'Email'; ?>
                </label>
                <input
                  type="email"
                  class="form-control"
                  id="correo"
                  name="correo"
                  maxlength="120"
                  required
                  placeholder="<?php echo idioma_actual() === 'es' ? 'tucorreo@ejemplo.com' : 'you@example.com'; ?>">
              </div>
            </div>

            <!-- Fila 4: Especialidad (combo) -->
            <div class="mb-3">
              <label for="especialidad" class="form-label">
                <?php echo idioma_actual() === 'es' ? 'Especialidad' : 'Specialty'; ?>
              </label>
              <select class="form-control" id="especialidad" name="especialidad" required>
                <?php
                  $items = $data['data'] ?? [];

                  if (empty($items)) {
                    echo '<option value="" disabled selected>No hay especialidades</option>';
                  } else {
                    echo '<option value="" selected>Seleccione una especialidad...</option>';

                    foreach ($items as $item) {
                      $espeId  = htmlspecialchars($item['espeId'], ENT_QUOTES, 'UTF-8');
                      $espeNom = htmlspecialchars($item['espeNombre'], ENT_QUOTES, 'UTF-8');
                      echo "<option value='$espeId'>$espeNom</option>";
                    }
                  }
                ?>
              </select>


            </div>

            <!-- Mensaje -->
            <div class="mb-3">
              <label for="razonConsulta" class="form-label">
                <?php echo idioma_actual() === 'es' ? 'Mensaje' : 'Message'; ?>
              </label>
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
              <button id="saludo" type="submit" class="btn btn-enviar">
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

<script src="vistas/js/agendar-cita.js"></script>
<script src="vistas/js/config.js"></script>

<?php include 'vistas/modulos/componentes/footer-publico.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
