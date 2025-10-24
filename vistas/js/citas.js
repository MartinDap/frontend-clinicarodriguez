/**
 * Script para gestión de citas médicas
 * Sistema de Gestión Clínica
 */

$(document).ready(function() {
  
  // Inicializar DataTable de citas
  if ($('#tablaCitas').length) {
    $('#tablaCitas').DataTable({
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
      },
      responsive: true,
      order: [[3, 'desc']] // Ordenar por fecha descendente
    });
  }
  
});
