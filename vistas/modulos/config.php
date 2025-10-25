<?php
/**
 * Configuración Global del Sistema
 * Define constantes para la conexión con el backend de la clínica
 * 
 * IMPORTANTE: En producción, estas credenciales deberían cargarse desde
 * variables de entorno (.env) y no estar hardcodeadas en el código.
 */

// URL base del API backend
define('API_BASE_URL', 'http://localhost:8080/api/');

// Header de autenticación (Basic Auth codificado en Base64)
// NOTA: Este valor debe ser reemplazado por variables de entorno en producción
define('API_AUTH_HEADER', 'authorization: Bearer eyJhbGciOiJIUzM4NCJ9.eyJzdWIiOiJtYXJ0aW4xMjMiLCJ1c3VhcmlvSWQiOjMsInJvbCI6IlVTRVIiLCJpYXQiOjE3NjE0MzI0NDIsImV4cCI6MTc2MTUxODg0Mn0.OS2bZ6HneVgiHNTAiw19mdRWvuOQdehNRJ792w9YhWn8v8PHczpDfLoMDDHu1KVE');
?>
