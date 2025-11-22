<?php
/**
 * Helper de Sesión
 * Funciones centralizadas para gestión segura de sesiones
 * Sistema de Gestión Clínica
 */

/**
 * Verifica si existe una sesión activa válida
 * @return bool True si hay sesión activa, false en caso contrario
 */
function tiene_sesion_activa() {
    return isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] === "ok";
}

/**
 * Obtiene el nombre del usuario de la sesión actual
 * @return string|null Nombre del usuario o null si no existe
 */
function obtener_nombre_usuario() {
    return isset($_SESSION["nombre"]) ? htmlspecialchars($_SESSION["nombre"], ENT_QUOTES, 'UTF-8') : null;
}

/**
 * Obtiene el perfil del usuario de la sesión actual
 * @return string|null ID del perfil del usuario o null si no existe
 */
function obtener_perfil_usuario() {
    //return isset($_SESSION["perfil"]) ? $_SESSION["perfil"] : null;
    return isset($_SESSION["roles"]) ? $_SESSION["roles"] : [];
}

/**
 * Obtiene el ID del usuario de la sesión actual
 * @return int|null ID del usuario o null si no existe
 */
function obtener_id_usuario() {
    return isset($_SESSION["id"]) ? (int)$_SESSION["id"] : null;
}

/**
 * Obtiene el TOKEN de la sesión actual
 * @return int|null TOKEN del usuario o null si no existe
 */
function obtener_token_usuario() {
    return isset($_SESSION["authHeader"]) ? $_SESSION["authHeader"] : null;
}
/**
 * Verifica si el usuario tiene un perfil específico
 * @param string $perfil_id ID del perfil a verificar (1=Administrador, 2=Médico, 3=Recepcionista)
 * @return bool True si el usuario tiene ese perfil
 */
function es_perfil($role) {
    //return obtener_perfil_usuario() === $role;
    return in_array($role, obtener_perfil_usuario());
}

function tiene_rol($roles, $rol) {
    return in_array($rol, $roles);
}


/**
 * Cierra la sesión actual de forma segura
 * @return void
 */
function cerrar_sesion() {
    session_unset();
    session_destroy();
}

/**
 * Redirige al login si no hay sesión activa
 * @return void
 */
function requerir_sesion() {
    if (!tiene_sesion_activa()) {
        echo '<script>window.location = "login";</script>';
        exit;
    }
}
?>
