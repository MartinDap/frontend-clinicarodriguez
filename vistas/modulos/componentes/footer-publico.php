<?php
/**
 * Componente Footer Público
 * Footer reutilizable para todas las páginas públicas
 */
?>
<footer class="bg-dark text-white py-5">
  <div class="container">
    
    <!-- Información de contacto destacada -->
    <div class="row g-4 justify-content-center mb-5 pb-4 border-bottom border-secondary border-opacity-10">
      
      <div class="col-md-4 text-center">
        <div class="contact-item">
          <div class="footer-contact-icon mx-auto mb-3">
            <i class="bi bi-telephone-fill fs-2"></i>
          </div>
          <h5 class="text-white"><?php echo idioma_actual() === 'es' ? 'Teléfono' : 'Phone'; ?></h5>
          <p class="text-white-50 mb-0">+51 997 753 923</p>
        </div>
      </div>
      
      <div class="col-md-4 text-center">
        <div class="contact-item">
          <div class="footer-contact-icon mx-auto mb-3">
            <i class="bi bi-envelope-fill fs-2"></i>
          </div>
          <h5 class="text-white">Email</h5>
          <p class="text-white-50 small mb-0">recepcion.centroneuroquirurgico@gmail.com</p>
        </div>
      </div>
      
      <div class="col-md-4 text-center">
        <div class="contact-item">
          <div class="footer-contact-icon mx-auto mb-3">
            <i class="bi bi-clock-fill fs-2"></i>
          </div>
          <h5 class="text-white"><?php echo idioma_actual() === 'es' ? 'Atenciones' : 'Office Hours'; ?></h5>
          <p class="text-white-50 mb-0"><?php echo idioma_actual() === 'es' ? 'Consultas entre desde<br>Lunes - Sabados 7:30 a 6:00<br>Emergencias las 24 horas' : 'Consultations from<br>Monday - Saturday 7:30 to 6:00<br>Emergencies 24 hours'; ?></p>
        </div>
      </div>
      
    </div>
    
    <div class="row justify-content-center">
      
      <!-- Logo -->
      <div class="col-md-3 mb-4">
        <img src="vistas/img/logo-fondo-blanco.png" alt="Logo Clínica" class="img-fluid mb-3" style="max-width: 180px;">
        <p class="text-white-50 small"><?php echo idioma_actual() === 'es' ? 'Tu salud, nuestra prioridad' : 'Your health, our priority'; ?></p>
        <li class="nav-item">
            <a class="btn btn-outline-primary ms-2" href="login" title="<?php echo t('nav_acceso_personal'); ?>">
                <i class="bi bi-box-arrow-in-right"></i>
            </a>
        </li>
      </div>
      
      <div class="col-md-3">
        <h6><?php echo t('footer_servicios'); ?></h6>
        <ul class="list-unstyled">
          <li><a href="#" class="text-white-50"><?php echo t('footer_hospitalizacion'); ?></a></li>
          <li><a href="#" class="text-white-50"><?php echo t('footer_ubi'); ?></a></li>
          <li><a href="#" class="text-white-50"><?php echo t('footer_emergencia'); ?></a></li>
          <li><a href="#" class="text-white-50"><?php echo t('footer_laboratorio'); ?></a></li>
          <li><a href="#" class="text-white-50"><?php echo t('footer_sala_operaciones'); ?></a></li>
        </ul>
      </div>
      
      <div class="col-md-3">
        <h6><?php echo t('footer_especialidades'); ?></h6>
        <ul class="list-unstyled">
          <li><a href="#" class="text-white-50"><?php echo t('especialidad_neurocirugia'); ?></a></li>
          <li><a href="#" class="text-white-50"><?php echo t('especialidad_ginecologia'); ?></a></li>
          <li><a href="#" class="text-white-50"><?php echo t('especialidad_neurologia'); ?></a></li>
          <li><a href="#" class="text-white-50"><?php echo t('especialidad_endocrinologia'); ?></a></li>
          <li><a href="#" class="text-white-50"><?php echo t('footer_cardiologia'); ?></a></li>
        </ul>
      </div>
      
    </div>
    
    <hr class="my-4 bg-secondary">
    
    <div class="text-center">
      <p class="mb-0">&copy; 2025 CR <?php echo t('footer_derechos'); ?></p>
    </div>
  </div>
</footer>
