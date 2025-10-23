<aside class="sidebar">
  
  <!-- Cabecera del menú -->
  <div class="sidebar-header">
    <i class="bi bi-hospital fs-2"></i>
    <h4 class="mt-2">Clínica Médica</h4>
    <small class="text-muted">Sistema Integral</small>
  </div>
  
  <!-- Menú de navegación -->
  <ul class="sidebar-menu">
    
    <?php
    
    // Menú para Administrador (perfil 1)
    if ($_SESSION["perfil"] == "1") {
      echo '
      <li>
        <a href="dashboard" class="' . ((!isset($_GET["ruta"]) || $_GET["ruta"] == "dashboard") ? 'active' : '') . '">
          <i class="bi bi-speedometer2"></i>
          <span>Dashboard</span>
        </a>
      </li>
      
      <li>
        <a href="pacientes">
          <i class="bi bi-people"></i>
          <span>Pacientes</span>
        </a>
      </li>
      
      <li>
        <a href="medicos">
          <i class="bi bi-person-badge"></i>
          <span>Médicos</span>
        </a>
      </li>
      
      <li>
        <a href="citas">
          <i class="bi bi-calendar-check"></i>
          <span>Citas Médicas</span>
        </a>
      </li>
      
      <li>
        <a href="consultas">
          <i class="bi bi-clipboard2-pulse"></i>
          <span>Consultas</span>
        </a>
      </li>
      
      <li>
        <a href="historias-clinicas">
          <i class="bi bi-file-medical"></i>
          <span>Historias Clínicas</span>
        </a>
      </li>
      
      <li>
        <a href="especialidades">
          <i class="bi bi-hospital"></i>
          <span>Especialidades</span>
        </a>
      </li>
      
      <li>
        <a href="usuarios">
          <i class="bi bi-person-circle"></i>
          <span>Usuarios</span>
        </a>
      </li>
      
      <li>
        <a href="reportes">
          <i class="bi bi-file-earmark-bar-graph"></i>
          <span>Reportes</span>
        </a>
      </li>
      
      <li>
        <a href="configuracion">
          <i class="bi bi-gear"></i>
          <span>Configuración</span>
        </a>
      </li>
      ';
    }
    
    // Menú para Médico (perfil 2)
    if ($_SESSION["perfil"] == "2") {
      echo '
      <li>
        <a href="dashboard" class="' . ((!isset($_GET["ruta"]) || $_GET["ruta"] == "dashboard") ? 'active' : '') . '">
          <i class="bi bi-speedometer2"></i>
          <span>Dashboard</span>
        </a>
      </li>
      
      <li>
        <a href="pacientes">
          <i class="bi bi-people"></i>
          <span>Pacientes</span>
        </a>
      </li>
      
      <li>
        <a href="citas">
          <i class="bi bi-calendar-check"></i>
          <span>Mis Citas</span>
        </a>
      </li>
      
      <li>
        <a href="consultas">
          <i class="bi bi-clipboard2-pulse"></i>
          <span>Consultas</span>
        </a>
      </li>
      
      <li>
        <a href="historias-clinicas">
          <i class="bi bi-file-medical"></i>
          <span>Historias Clínicas</span>
        </a>
      </li>
      ';
    }
    
    // Menú para Recepcionista (perfil 3)
    if ($_SESSION["perfil"] == "3") {
      echo '
      <li>
        <a href="dashboard" class="' . ((!isset($_GET["ruta"]) || $_GET["ruta"] == "dashboard") ? 'active' : '') . '">
          <i class="bi bi-speedometer2"></i>
          <span>Dashboard</span>
        </a>
      </li>
      
      <li>
        <a href="pacientes">
          <i class="bi bi-people"></i>
          <span>Pacientes</span>
        </a>
      </li>
      
      <li>
        <a href="citas">
          <i class="bi bi-calendar-check"></i>
          <span>Citas Médicas</span>
        </a>
      </li>
      ';
    }
    
    ?>
    
    <!-- Perfil de usuario -->
    <li class="mt-4 border-top pt-3">
      <a href="#" class="d-flex align-items-center">
        <i class="bi bi-person-circle"></i>
        <div class="ms-2">
          <small class="d-block text-white-50">Bienvenido</small>
          <strong><?php echo $_SESSION["nombre"]; ?></strong>
        </div>
      </a>
    </li>
    
    <!-- Cerrar sesión -->
    <li>
      <a href="salir" class="text-danger">
        <i class="bi bi-box-arrow-right"></i>
        <span>Cerrar Sesión</span>
      </a>
    </li>
    
  </ul>
  
</aside>
