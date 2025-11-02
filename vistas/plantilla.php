<?php
// Iniciar sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cargar helper de sesión
require_once 'vistas/modulos/session-helper.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title>Sistema de Gestión Clínica</title>
  
  <!-- Favicon -->
  <link rel="icon" href="vistas/img/favicon.ico">
  
  <!-- Bootstrap 5.3.2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  
  <!-- DataTables Bootstrap 5 -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
  
  
  
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="vistas/css/estilos.css">
  
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  
  <!-- Bootstrap 5.3.2 JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- DataTables -->
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
  
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css">
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
  
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

  <!-- CDN Flatpickr (en el <head> o antes de cerrar el </body>) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  
</head>

<body>

<?php

// Si se intenta acceder al login
if(isset($_GET["ruta"]) && $_GET["ruta"] == "login"){
  // Cerrar cualquier sesión activa
  if(tiene_sesion_activa()){
    cerrar_sesion();
    session_start(); // Reiniciar sesión para el sistema de idiomas
  }
  include "modulos/login-panel.php";
  
}elseif(tiene_sesion_activa()){
  
  // Botón para ocultar/mostrar sidebar
  echo '<button id="btnToggleSidebar" class="sidebar-toggle" title="Mostrar/Ocultar menú">
          <i class="bi bi-list"></i>
        </button>';
  
  echo '<div class="d-flex">';
  
  // MENÚ LATERAL
  include "modulos/menu.php";
  
  echo '<div id="mainContent" class="flex-grow-1 main-content">';
  
  // CABEZOTE
  include "modulos/cabezote.php";
  
  // CONTENIDO PRINCIPAL
  echo '<main class="p-4">';
  
  if(isset($_GET["ruta"])){
    
    // Rutas permitidas del sistema
    $rutas_permitidas = [
      "dashboard", "pacientes", "medicos", "citas", 
      "historias-clinicas", "ver-historia", "consultas", "usuarios",
      "activos", "configuracion", "salir", "horarios"
    ];
    
    if(in_array($_GET["ruta"], $rutas_permitidas)){
      include "modulos/".$_GET["ruta"].".php";
    }else{
      include "modulos/404.php";
    }
    
  }else{
    include "modulos/dashboard.php";
  }
  
  echo '</main>';
  
  // FOOTER
  include "modulos/footer.php";
  
  echo '</div>';
  echo '</div>';
  
}else{
  // Si no hay sesión, redirigir al login
  requerir_sesion();
}

?>

<!-- Scripts personalizados -->
<script src="vistas/js/plantilla.js"></script>
<script src="vistas/js/usuarios.js"></script>
<script src="vistas/js/pacientes.js"></script>
<script src="vistas/js/medicos.js"></script>
<script src="vistas/js/horarios.js"></script>
<script src="vistas/js/citas.js"></script>
<script src="vistas/js/activos.js"></script>
<script src="vistas/js/historias-clinicas.js"></script>
<script src="vistas/js/ver-historia.js"></script>
<script src="vistas/js/api.js"></script>
<script src="vistas/js/config.js"></script>
</body>
</html>
