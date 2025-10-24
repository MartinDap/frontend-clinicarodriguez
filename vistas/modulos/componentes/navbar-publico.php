<?php
/**
 * Componente Navbar Público
 * Navbar reutilizable para todas las páginas públicas
 * 
 * @param string $pagina_activa - Nombre de la página activa (conocenos, especialidades-info, etc.)
 */

$pagina_activa = $pagina_activa ?? '';
$ruta_actual = $_GET['ruta'] ?? '';
?>

<!-- Navbar Superior -->
<nav class="navbar navbar-expand-lg navbar-light bg-light-blue fixed-top navbar-fixed-custom">
  <div class="container">
    <a class="navbar-brand fw-bold" href="http://localhost/pe/">
      <img src="vistas/img/logo.png" alt="Logo Clínica" style="height: 50px; width: auto;" class="me-2">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link <?php echo $pagina_activa === 'conocenos' ? 'active' : ''; ?>" href="conocenos">
            <?php echo t('nav_conocenos'); ?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $pagina_activa === 'especialidades-info' ? 'active' : ''; ?>" href="especialidades-info">
            <?php echo t('nav_especialidades'); ?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $pagina_activa === 'servicios-info' ? 'active' : ''; ?>" href="servicios-info">
            <?php echo t('nav_servicios'); ?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $pagina_activa === 'medicos-info' ? 'active' : ''; ?>" href="medicos-info">
            <?php echo t('nav_medicos'); ?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $pagina_activa === 'contacto' ? 'active' : ''; ?>" href="contacto">
            <?php echo t('nav_contacto'); ?>
          </a>
        </li>
        
        <!-- Selector de idioma -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-globe"></i> <?php echo idioma_actual() === 'es' ? 'ES' : 'EN'; ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="languageDropdown">
            <li><a class="dropdown-item" href="?ruta=<?php echo $ruta_actual; ?>&lang=es"><i class="bi bi-flag"></i> Español</a></li>
            <li><a class="dropdown-item" href="?ruta=<?php echo $ruta_actual; ?>&lang=en"><i class="bi bi-flag"></i> English</a></li>
          </ul>
        </li>
        
        <li class="nav-item">
          <a class="btn btn-primary ms-2" href="login">
            <i class="bi bi-box-arrow-in-right"></i> <?php echo t('nav_acceso_personal'); ?>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
