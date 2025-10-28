<?php
/**
 * Configuración Global del Sistema
 * Define constantes para la conexión con el backend de la clínica
 * 
 * IMPORTANTE: En producción, estas credenciales deberían cargarse desde
 * variables de entorno (.env) y no estar hardcodeadas en el código.
 */

// URL base del API backend
#define('API_BASE_URL', 'https://backend-clinicarodriguez.onrender.com/api/');
define('API_BASE_URL', 'http://localhost:8080/api/');

// Header de autenticación (Basic Auth codificado en Base64)
// NOTA: Este valor debe ser reemplazado por variables de entorno en producción
define('API_AUTH_HEADER', 'Authorization: Bearer eyJhbGciOiJIUzM4NCJ9.eyJzdWIiOiJqb3JnZWRhcCIsInVzdWFyaW9JZCI6Miwicm9sIjoiVVNFUiIsImlhdCI6MTc2MTQ0ODc4NywiZXhwIjoxNzYxNTM1MTg3fQ.3S9LjKp5cwP4LK2wfGl_1fzMmm77XxhuzpUy5gWC8C1yVTDf2JSx5eipfJf_V_8m');
?>
