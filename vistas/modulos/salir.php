<?php
/**
 * Módulo de Cierre de Sesión
 * Cierra la sesión del usuario de forma segura
 */

// Cerrar sesión usando helper
cerrar_sesion();

// Redirigir al login
echo '<script>window.location = "login";</script>';

?>
