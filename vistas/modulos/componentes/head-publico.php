<?php
/**
 * Componente Head HTML
 * Meta tags y enlaces CSS comunes para páginas públicas
 * 
 * @param string $titulo_pagina - Título específico de la página
 */

$titulo_pagina = $titulo_pagina ?? 'Clínica Médica';
?>
<!DOCTYPE html>
<html lang="<?php echo idioma_actual(); ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $titulo_pagina; ?></title>
  
  <!-- Bootstrap 5.3.2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="vistas/css/estilos-publicos.css">
  <link rel="stylesheet" href="vistas/css/componentes.css">
</head>
<body>
