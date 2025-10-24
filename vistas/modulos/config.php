<?php
/**
 * Configuración Global del Sistema
 * Define constantes para la conexión con el backend de la clínica
 * 
 * IMPORTANTE: En producción, estas credenciales deberían cargarse desde
 * variables de entorno (.env) y no estar hardcodeadas en el código.
 */

// URL base del API backend
define('API_BASE_URL', 'http://localhost:8080/clinica-backend/');

// Header de autenticación (Basic Auth codificado en Base64)
// NOTA: Este valor debe ser reemplazado por variables de entorno en producción
define('API_AUTH_HEADER', 'Authorization: Basic JDJhJDA3JGRmaGRmcmV4ZmhnZGZoZGZlcnR0Z2Vwd2RCVk12aVdXRXdLQkZiMjJoTDZNVWtyRk5xRzhPOiQyYSQwNyRkZmhkZnJleGZoZ2RmaGRmZXJ0dGdlZ2N5cFFKZ2JFZ083TGouWGMyNTRnOXYuemtiTGJoeQ==');
?>
