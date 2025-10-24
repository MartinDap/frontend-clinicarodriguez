<?php
require_once 'vistas/modulos/idiomas.php';

$titulo_pagina = idioma_actual() === 'es' ? 'Contacto - Clínica Médica' : 'Contact - Medical Clinic';
$pagina_activa = 'contacto';

include 'vistas/modulos/componentes/head-publico.php';
include 'vistas/modulos/componentes/topbar-publico.php';
include 'vistas/modulos/componentes/navbar-publico.php';
?>

  <section class="hero-section" style="min-height: 300px;">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 text-center">
          <h1 class="display-4 fw-bold mb-4"><?php echo t('contacto_titulo'); ?></h1>
          <p class="lead"><?php echo idioma_actual() === 'es' ? 'Estamos aquí para atenderte' : 'We are here to serve you'; ?></p>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
      <div class="row g-4">
        
        <!-- Información de contacto -->
        <div class="col-lg-4">
          <div class="card shadow-sm h-100">
            <div class="card-body p-4">
              <h3 class="mb-4"><?php echo idioma_actual() === 'es' ? 'Información de Contacto' : 'Contact Information'; ?></h3>
              
              <div class="mb-4">
                <div class="d-flex align-items-start mb-3">
                  <div class="icon-circle bg-primary text-white me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                    <i class="bi bi-telephone-fill fs-5"></i>
                  </div>
                  <div>
                    <h5 class="mb-1"><?php echo t('contacto_telefono'); ?></h5>
                    <p class="mb-0 text-muted">+51 987 654 321</p>
                    <p class="mb-0 text-muted small"><?php echo idioma_actual() === 'es' ? 'Lun - Sáb: 7:30 AM - 6:00 PM' : 'Mon - Sat: 7:30 AM - 6:00 PM'; ?></p>
                  </div>
                </div>
              </div>

              <div class="mb-4">
                <div class="d-flex align-items-start mb-3">
                  <div class="icon-circle bg-danger text-white me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                  </div>
                  <div>
                    <h5 class="mb-1"><?php echo idioma_actual() === 'es' ? 'Emergencias' : 'Emergency'; ?></h5>
                    <p class="mb-0 text-muted">+51 987 654 322</p>
                    <p class="mb-0 text-muted small"><?php echo idioma_actual() === 'es' ? '24 horas / 7 días' : '24 hours / 7 days'; ?></p>
                  </div>
                </div>
              </div>

              <div class="mb-4">
                <div class="d-flex align-items-start mb-3">
                  <div class="icon-circle bg-info text-white me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                    <i class="bi bi-envelope-fill fs-5"></i>
                  </div>
                  <div>
                    <h5 class="mb-1"><?php echo t('contacto_email'); ?></h5>
                    <p class="mb-0 text-muted">atencion-centro@clinica.com</p>
                    <p class="mb-0 text-muted small">info@clinica.com</p>
                  </div>
                </div>
              </div>

              <div class="mb-4">
                <div class="d-flex align-items-start">
                  <div class="icon-circle bg-success text-white me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                    <i class="bi bi-geo-alt-fill fs-5"></i>
                  </div>
                  <div>
                    <h5 class="mb-1"><?php echo idioma_actual() === 'es' ? 'Dirección' : 'Address'; ?></h5>
                    <p class="mb-0 text-muted">Av. Principal 123<br>Lima, Perú</p>
                  </div>
                </div>
              </div>

              <hr>

              <div class="mt-4">
                <h5 class="mb-3"><?php echo idioma_actual() === 'es' ? 'Síguenos' : 'Follow Us'; ?></h5>
                <div class="d-flex gap-2">
                  <a href="#" class="btn btn-outline-primary btn-sm"><i class="bi bi-facebook"></i></a>
                  <a href="#" class="btn btn-outline-info btn-sm"><i class="bi bi-twitter"></i></a>
                  <a href="#" class="btn btn-outline-danger btn-sm"><i class="bi bi-instagram"></i></a>
                  <a href="#" class="btn btn-outline-success btn-sm"><i class="bi bi-whatsapp"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Formulario de contacto -->
        <div class="col-lg-8">
          <div class="card shadow-sm">
            <div class="card-body p-4">
              <h3 class="mb-4"><?php echo idioma_actual() === 'es' ? 'Envíanos un mensaje' : 'Send us a message'; ?></h3>
              
              <form id="contactForm">
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label"><?php echo idioma_actual() === 'es' ? 'Nombre completo' : 'Full name'; ?> *</label>
                    <input type="text" class="form-control" required>
                  </div>
                  
                  <div class="col-md-6">
                    <label class="form-label"><?php echo t('contacto_email'); ?> *</label>
                    <input type="email" class="form-control" required>
                  </div>
                  
                  <div class="col-md-6">
                    <label class="form-label"><?php echo t('contacto_telefono'); ?></label>
                    <input type="tel" class="form-control">
                  </div>
                  
                  <div class="col-md-6">
                    <label class="form-label"><?php echo idioma_actual() === 'es' ? 'Asunto' : 'Subject'; ?> *</label>
                    <select class="form-select" required>
                      <option value=""><?php echo idioma_actual() === 'es' ? 'Seleccione una opción' : 'Select an option'; ?></option>
                      <option><?php echo idioma_actual() === 'es' ? 'Información general' : 'General information'; ?></option>
                      <option><?php echo idioma_actual() === 'es' ? 'Agendar cita' : 'Schedule appointment'; ?></option>
                      <option><?php echo idioma_actual() === 'es' ? 'Consulta médica' : 'Medical consultation'; ?></option>
                      <option><?php echo idioma_actual() === 'es' ? 'Resultados de exámenes' : 'Test results'; ?></option>
                      <option><?php echo idioma_actual() === 'es' ? 'Otro' : 'Other'; ?></option>
                    </select>
                  </div>
                  
                  <div class="col-12">
                    <label class="form-label"><?php echo idioma_actual() === 'es' ? 'Mensaje' : 'Message'; ?> *</label>
                    <textarea class="form-control" rows="5" required></textarea>
                  </div>
                  
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-lg">
                      <i class="bi bi-send"></i> <?php echo idioma_actual() === 'es' ? 'Enviar mensaje' : 'Send message'; ?>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <!-- Mapa -->
          <div class="card shadow-sm mt-4">
            <div class="card-body p-0">
              <div style="width: 100%; height: 350px; background: linear-gradient(135deg, #38c3c4 0%, #2a0287 100%); display: flex; align-items: center; justify-content: center; color: white;">
                <div class="text-center">
                  <i class="bi bi-geo-alt-fill" style="font-size: 4rem;"></i>
                  <h4 class="mt-3"><?php echo idioma_actual() === 'es' ? 'Mapa de ubicación' : 'Location map'; ?></h4>
                  <p><?php echo idioma_actual() === 'es' ? 'Av. Principal 123, Lima, Perú' : 'Principal Ave. 123, Lima, Peru'; ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

<?php include 'vistas/modulos/componentes/footer-publico.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('<?php echo idioma_actual() === 'es' ? '¡Gracias por tu mensaje! Te contactaremos pronto.' : 'Thank you for your message! We will contact you soon.'; ?>');
    this.reset();
  });
</script>
</body>
</html>
