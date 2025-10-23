/**
 * Script para gestión de pacientes
 * Sistema de Gestión Clínica
 */

$(document).ready(function() {
  
  // Inicializar DataTable de pacientes
  if ($('#tablaPacientes').length) {
    $('#tablaPacientes').DataTable({
      language: {
        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
      },
      responsive: true,
      pageLength: 10
    });
  }
  
  console.log('Módulo de Pacientes cargado');
  
});
