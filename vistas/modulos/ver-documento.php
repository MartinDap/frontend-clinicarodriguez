<?php
session_start();

// Verificar autenticación (ajusta según tu sistema)
if (!isset($_SESSION['usuario'])) {
    http_response_code(401);
    die('No autorizado');
}

// Validar que se recibió el ID del documento
if (!isset($_GET['docuId'])) {
    http_response_code(400);
    die('Documento no especificado');
}

$docuId = $_GET['docuId'];

// Incluir configuración de la API (ajusta la ruta según tu proyecto)
require_once 'config.php'; // o donde tengas definidas tus constantes API_BASE_URL y API_AUTH_HEADER

// Obtener información del documento desde la API
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => API_BASE_URL . 'documentos/' . $docuId,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        API_AUTH_HEADER
    ),
));

$response = curl_exec($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

if ($httpCode !== 200) {
    http_response_code(404);
    die('Documento no encontrado');
}

$documento = json_decode($response, true);

if (!isset($documento['docuUrl'])) {
    http_response_code(500);
    die('URL del documento no disponible');
}

$docuUrl = $documento['docuUrl'];
$docuNombre = $documento['docuNombre'] ?? 'documento.pdf';

// Descargar el archivo desde la URL
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => $docuUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

$fileContent = curl_exec($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$contentType = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);
curl_close($curl);

if ($httpCode !== 200 || empty($fileContent)) {
    http_response_code(500);
    die('Error al descargar el documento');
}

// Configurar cabeceras para permitir visualización en iframe
header('X-Frame-Options: SAMEORIGIN'); // Permite iframe solo del mismo dominio
header('Content-Type: ' . ($contentType ?: 'application/pdf'));
header('Content-Disposition: inline; filename="' . $docuNombre . '"');
header('Content-Length: ' . strlen($fileContent));
header('Cache-Control: private, max-age=3600'); // Cache de 1 hora

// Enviar el contenido del archivo
echo $fileContent;
exit;
?>