<?php
/**
 * Componente Footer Público
 * Footer reutilizable para todas las páginas públicas
 */
?>
<footer class="bg-dark text-white py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h5><i class="bi bi-hospital text-info"></i> Clínica Médica</h5>
        <p class="small"><?php echo t('footer_clinica_desc'); ?></p>
      </div>
      <div class="col-md-4">
        <h6><?php echo t('footer_otros_links'); ?></h6>
        <ul class="list-unstyled">
          <li><a href="conocenos" class="text-white-50"><?php echo t('footer_nosotros'); ?></a></li>
          <li><a href="especialidades-info" class="text-white-50"><?php echo t('footer_especialidades'); ?></a></li>
          <li><a href="servicios-info" class="text-white-50"><?php echo t('footer_servicios'); ?></a></li>
          <li><a href="medicos-info" class="text-white-50"><?php echo t('nav_medicos'); ?></a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <h6><?php echo t('contacto_titulo'); ?></h6>
        <p class="small">
          <i class="bi bi-telephone"></i> +51 987 654 321<br>
          <i class="bi bi-envelope"></i> atencion-centro@clinica.com
        </p>
      </div>
    </div>
    <hr class="my-4">
    <div class="text-center">
      <p class="mb-0">&copy; 2025 CR <?php echo t('footer_derechos'); ?></p>
    </div>
  </div>
</footer>
