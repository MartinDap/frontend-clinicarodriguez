<?php

// Destruir todas las sesiones
session_unset();
session_destroy();

// Redirigir al login
echo '<script>window.location = "login";</script>';

?>
