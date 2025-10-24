/**
 * Script para gestión de usuarios
 * Sistema de Gestión Clínica
 */

$(document).ready(function() {
  
  // Inicializar DataTable si existe
  if ($('#tablaUsuarios').length) {
    $('#tablaUsuarios').DataTable({
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
      },
      responsive: true
    });
  }
  
});
