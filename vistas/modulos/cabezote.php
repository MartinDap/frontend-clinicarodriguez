<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
  <div class="container-fluid">
    
    <button class="btn btn-link d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
      <i class="bi bi-list fs-4"></i>
    </button>
    
    <span class="navbar-brand mb-0 h1 d-none d-md-block">
      Sistema de Gestión Clínica
    </span>
    
    <div class="ms-auto d-flex align-items-center">
      
      <!-- Notificaciones -->
      <div class="dropdown me-3">
        <button class="btn btn-link position-relative" type="button" data-bs-toggle="dropdown">
          <i class="bi bi-bell fs-5"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            3
          </span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><h6 class="dropdown-header">Notificaciones</h6></li>
          <li><a class="dropdown-item" href="#">Nueva cita agendada</a></li>
          <li><a class="dropdown-item" href="#">Paciente en espera</a></li>
          <li><a class="dropdown-item" href="#">Reporte generado</a></li>
        </ul>
      </div>
      
      <!-- Usuario -->
      <div class="dropdown">
        <button class="btn btn-link d-flex align-items-center" type="button" data-bs-toggle="dropdown">
          <i class="bi bi-person-circle fs-4 me-2"></i>
          <span class="d-none d-md-inline"><?php echo obtener_nombre_usuario(); ?></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><h6 class="dropdown-header">Mi Cuenta</h6></li>
          <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Perfil</a></li>
          <li><a class="dropdown-item" href="configuracion"><i class="bi bi-gear"></i> Configuración</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item text-danger" href="salir"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a></li>
        </ul>
      </div>
      
    </div>
  </div>
</nav>
