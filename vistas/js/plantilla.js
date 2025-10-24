/**
 * Script principal de la plantilla
 * Sistema de Gestión Clínica
 */

$(document).ready(function() {
  
  // Activar tooltips de Bootstrap
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
  
  // Marcar enlace activo en el menú
  var url = window.location.href;
  $('.sidebar-menu a').each(function() {
    if (this.href === url) {
      $(this).addClass('active');
    }
  });

  // Toggle sidebar
  const btn = document.getElementById('btnToggleSidebar');
  const sidebar = document.querySelector('.sidebar');
  const mainContent = document.getElementById('mainContent');
  if (btn && sidebar && mainContent) {
    btn.addEventListener('click', function() {
      sidebar.classList.toggle('hidden');
      mainContent.classList.toggle('expanded');
      this.classList.toggle('moved');
    });
  }
  
});
