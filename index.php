<?php
// Cargar configuración
require_once 'vistas/modulos/config.php';

// Controladores
require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";

// Determinar si estamos en el panel administrativo o la página pública
$ruta = isset($_GET['ruta']) ? $_GET['ruta'] : '';

// Si la ruta es 'dashboard' o cualquier ruta del panel, cargar plantilla del sistema
if ($ruta == 'dashboard' || 
    $ruta == 'pacientes' || 
    $ruta == 'medicos' || 
    $ruta == 'citas' ||
    $ruta == 'historias-clinicas' ||
    $ruta == 'consultas' ||
    $ruta == 'usuarios' ||
    $ruta == 'especialidades' ||
    $ruta == 'reportes' ||
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
