<?php
// Cargar configuración
require_once 'vistas/modulos/config.php';

// Controladores
require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";

// Determinar si estamos en el panel administrativo o la página pública
$ruta = isset($_GET['ruta']) ? $_GET['ruta'] : '';

// Rutas públicas con contenido detallado
if ($ruta == 'conocenos' || 
    $ruta == 'especialidades-info' || 
    $ruta == 'servicios-info' ||
    $ruta == 'medicos-info' ||
    $ruta == 'contacto' ||
    $ruta == 'agendar-cita' ||
    $ruta == 'resultados' ||
    $ruta == 'ver-resultados') {
    
    // Cargar página pública detallada
    include "vistas/modulos/" . $ruta . ".php";
    
// Si la ruta es 'dashboard' o cualquier ruta del panel, cargar plantilla del sistema
} elseif ($ruta == 'dashboard' || 
    $ruta == 'pacientes' || 
    $ruta == 'medicos' || 
    $ruta == 'horarios' || 
    $ruta == 'citas' ||
    $ruta == 'historias-clinicas' ||
    $ruta == 'ver-historia' ||
    $ruta == 'usuarios' ||
    $ruta == 'activos' ||
    $ruta == 'organigrama' ||
    $ruta == 'configuracion' ||
    $ruta == 'salir' ||
    $ruta == 'login') {
    
    // Cargar plantilla del panel administrativo
    $plantilla = new ControladorPlantilla();
    $plantilla->ctrPlantilla();
    
} else {
    
    // Cargar página pública (landing page)
    include "vistas/plantilla-publica.php";
    
}
