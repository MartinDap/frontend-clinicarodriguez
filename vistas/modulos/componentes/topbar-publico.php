<?php
/**
 * Componente Topbar Público
 * Barra superior de contacto reutilizable para todas las páginas públicas
 */
?>

<!-- Barra Superior de Contacto -->
<div class="topbar-info fixed-top">
  <div class="container">
    <div class="row align-items-center g-0">
      <!-- Teléfono -->
      <div class="col-lg-3 col-md-6 col-6">
        <a href="tel:997753923" class="topbar-item text-decoration-none d-flex align-items-center justify-content-center justify-content-lg-start">
          <div class="topbar-icon">
            <i class="bi bi-telephone-fill"></i>
          </div>
          <div class="topbar-content">
            <span class="topbar-label">Teléfonos</span>
            <span class="topbar-value">997 753 923</span>
          </div>
        </a>
      </div>
      
      <!-- Email -->
      <div class="col-lg-3 col-md-6 col-6">
        <a href="mailto:recepcion.centroneuroquirurgico@gmail.com" class="topbar-item text-decoration-none d-flex align-items-center justify-content-center">
          <div class="topbar-icon">
            <i class="bi bi-envelope-fill"></i>
          </div>
          <div class="topbar-content">
            <span class="topbar-label">Email</span>
            <span class="topbar-value d-none d-md-inline" style="font-size: 0.7rem;">recepcion.centroneuroquirurgico@gmail.com</span>
            <span class="topbar-value d-md-none">Contáctanos</span>
          </div>
        </a>
      </div>
      
      <!-- Cita Online -->
      <div class="col-lg-3 col-md-6 col-6">
        <a href="#citas" class="topbar-item topbar-highlight text-decoration-none d-flex align-items-center justify-content-center">
          <div class="topbar-icon">
            <i class="bi bi-calendar-check-fill"></i>
          </div>
          <div class="topbar-content">
            <span class="topbar-label">Cita Online</span>
            <span class="topbar-value">Agendar <i class="bi bi-arrow-right-short"></i></span>
          </div>
        </a>
      </div>
      
      <!-- Horarios -->
      <div class="col-lg-3 col-md-6 col-6">
        <div class="topbar-item d-flex align-items-center justify-content-center justify-content-lg-end">
          <div class="topbar-icon">
            <i class="bi bi-clock-fill"></i>
          </div>
          <div class="topbar-content">
            <span class="topbar-label">Atenciones</span>
            <span class="topbar-value">24x7</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
