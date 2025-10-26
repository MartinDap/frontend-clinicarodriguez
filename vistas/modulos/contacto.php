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
      <div class="row g-4 justify-content-center">
        
        <!-- Información de contacto -->
        <div class="col-lg-6">
          <div class="card shadow-sm h-100">
            <div class="card-body p-4">
              <h3 class="mb-4"><?php echo idioma_actual() === 'es' ? 'Información de Contacto' : 'Contact Information'; ?></h3>
              
              <div class="mb-4">
                <div class="d-flex align-items-start mb-3">
                  <div class="icon-circle bg-success text-white me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                    <i class="bi bi-geo-alt-fill fs-5"></i>
                  </div>
                  <div>
                    <h5 class="mb-1"><?php echo idioma_actual() === 'es' ? 'Dirección' : 'Address'; ?></h5>
                    <p class="mb-0 text-muted">JR. BRASIL 262, Tarapoto, Peru</p>
                  </div>
                </div>
              </div>

              <div class="mb-4">
                <div class="d-flex align-items-start mb-3">
                  <div class="icon-circle bg-primary text-white me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                    <i class="bi bi-telephone-fill fs-5"></i>
                  </div>
                  <div>
                    <h5 class="mb-1"><?php echo idioma_actual() === 'es' ? 'Teléfono' : 'Phone'; ?></h5>
                    <p class="mb-0 text-muted">+51 937 753 923</p>
                  </div>
                </div>
              </div>

              <div class="mb-4">
                <div class="d-flex align-items-start mb-3">
                  <div class="icon-circle bg-info text-white me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                    <i class="bi bi-envelope-fill fs-5"></i>
                  </div>
                  <div>
                    <h5 class="mb-1">Email</h5>
                    <p class="mb-0 text-muted">recepcion.centroneuroquirurgico@gmail.com</p>
                  </div>
                </div>
              </div>

              <div class="mb-4">
                <div class="d-flex align-items-start">
                  <div class="icon-circle bg-warning text-white me-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                    <i class="bi bi-clock-fill fs-5"></i>
                  </div>
                  <div>
                    <h5 class="mb-1"><?php echo idioma_actual() === 'es' ? 'Horario' : 'Schedule'; ?></h5>
                    <p class="mb-0 text-muted"><?php echo idioma_actual() === 'es' ? 'Consultas externas desde:' : 'External consultations from:'; ?></p>
                    <p class="mb-0 text-muted small"><?php echo idioma_actual() === 'es' ? 'Lunes - Sábados 7:30 a 6:00' : 'Monday - Saturday 7:30 AM to 6:00 PM'; ?></p>
                    <p class="mb-0 text-muted small"><?php echo idioma_actual() === 'es' ? 'Emergencias las 24 horas' : 'Emergencies 24 hours'; ?></p>
                  </div>
                </div>
              </div>

              <hr>

              <div class="mt-4">
                <h5 class="mb-3"><?php echo idioma_actual() === 'es' ? 'Síguenos' : 'Follow Us'; ?></h5>
                <div class="d-flex gap-2">
                  <a href="https://www.facebook.com/RodriguezyEspecialistas/?locale=es_LA" target="_blank" class="btn btn-outline-primary btn-sm"><i class="bi bi-facebook"></i></a>
                  <a href="https://wa.me/51937753923" target="_blank" class="btn btn-outline-success btn-sm"><i class="bi bi-whatsapp"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Mapa -->
        <div class="col-lg-6">
          <div class="card shadow-sm">
            <div class="card-body p-0">
              <div class="d-flex align-items-center text-white p-3" style="background: linear-gradient(135deg, #38c3c4 0%, #2a0287 100%);">
                <i class="bi bi-geo-alt-fill fs-4 me-2"></i>
                <div>
                  <h5 class="mb-0"><?php echo idioma_actual() === 'es' ? 'Nuestra Ubicación' : 'Our Location'; ?></h5>
                  <p class="mb-0 small">JR. BRASIL 262, Tarapoto, Peru</p>
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

<?php include 'vistas/modulos/componentes/footer-publico.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
