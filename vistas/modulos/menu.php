<aside class="sidebar">
  
  <!-- Cabecera del menú -->
  <div class="sidebar-header">
    <i class="bi bi-hospital fs-2"></i>
    <h4 class="mt-2">Clinica Rodriguez</h4>
    <small class="text-muted">Sistema Integral</small>
  </div>
  
  <!-- Menú de navegación -->
  <ul class="sidebar-menu">
    <?php
    
if (isset($_SESSION["roles"]) && is_array($_SESSION["roles"])) {
    $roles = $_SESSION["roles"];  // Obtener todos los roles del usuario

    // Verificar si el usuario tiene el rol SUPERADMIN
    if (in_array("SUPERADMIN", $roles)) {
        // Mostrar todo el menú para SUPERADMIN
        echo '
        <li>
            <a href="dashboard" class="' . ((!isset($_GET["ruta"]) || $_GET["ruta"] == "dashboard") ? 'active' : '') . '">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="has-submenu">
            <a href="#" onclick="toggleSubmenu(event, this)">
                <i class="bi bi-people-fill"></i>
                <span>Gestión de Usuarios</span>
            </a>
            <ul class="submenu">
                <li>
                    <a href="medicos">
                        <i class="bi bi-person-badge"></i>
                        <span>Médicos</span>
                    </a>
                </li>
                <li>
                    <a href="usuarios">
                        <i class="bi bi-person-circle"></i>
                        <span>Usuarios del Sistema</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="has-submenu">
            <a href="#" onclick="toggleSubmenu(event, this)">
                <i class="bi bi-calendar-event"></i>
                <span>Gestión de Citas</span>
            </a>
            <ul class="submenu">
                <li>
                    <a href="horarios">
                        <i class="bi bi-clock-history"></i>
                        <span>Definir Horario</span>
                    </a>
                </li>
                <li>
                    <a href="citas">
                        <i class="bi bi-calendar-check"></i>
                        <span>Citas</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="has-submenu">
            <a href="#" onclick="toggleSubmenu(event, this)">
                <i class="bi bi-file-medical-fill"></i>
                <span>Gestión de Historias Médicas</span>
            </a>
            <ul class="submenu">
                <li>
                    <a href="historias-clinicas">
                        <i class="bi bi-file-earmark-plus"></i>
                        <span>Crear Historia</span>
                    </a>
                </li>
                <li>
                    <a href="pacientes">
                        <i class="bi bi-people"></i>
                        <span>Pacientes</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="has-submenu">
            <a href="#" onclick="toggleSubmenu(event, this)">
                <i class="bi bi-building"></i>
                <span>Gestión de Activos</span>
            </a>
            <ul class="submenu">
                <li>
                    <a href="activos">
                        <i class="bi bi-hospital"></i>
                        <span>Activos</span>
                    </a>
                </li>
                <li>
                    <a href="organigrama">
                        <i class="bi bi-diagram-3"></i>
                        <span>Organigrama</span>
                    </a>
                </li>
            </ul>
        </li>

       
        ';
    } else {
        // Si no es SUPERADMIN, mostrar el menú según los roles del usuario
        // Gestión de Usuarios (solo para ADMINISTRADOR, ADMIN_SISTEMAS, DIRECTOR_CLINICO)
        if (in_array("ADMINISTRADOR", $roles) || in_array("ADMIN_SISTEMAS", $roles) || in_array("DIRECTOR_CLINICO", $roles)) {
            echo '
            <li class="has-submenu">
                <a href="#" onclick="toggleSubmenu(event, this)">
                    <i class="bi bi-people-fill"></i>
                    <span>Gestión de Usuarios</span>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="medicos">
                            <i class="bi bi-person-badge"></i>
                            <span>Médicos</span>
                        </a>
                    </li>
                    <li>
                        <a href="usuarios">
                            <i class="bi bi-person-circle"></i>
                            <span>Usuarios del Sistema</span>
                        </a>
                    </li>
                </ul>
            </li>';
        }

        // Gestión de Citas (solo para DIRECTOR_CLINICO, RECEPCIONISTA, MEDICO)
        if (in_array("DIRECTOR_CLINICO", $roles) || in_array("RECEPCIONISTA", $roles) || in_array("MEDICO", $roles)) {
            echo '
            <li class="has-submenu">
                <a href="#" onclick="toggleSubmenu(event, this)">
                    <i class="bi bi-calendar-event"></i>
                    <span>Gestión de Citas</span>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="horarios">
                            <i class="bi bi-clock-history"></i>
                            <span>Definir Horario</span>
                        </a>
                    </li>
                    <li>
                        <a href="citas">
                            <i class="bi bi-calendar-check"></i>
                            <span>Citas</span>
                        </a>
                    </li>
                </ul>
            </li>';
        }

        // Gestión de Historias Médicas (solo para DIRECTOR_CLINICO, RECEPCIONISTA, ENFERMERIA, MEDICO)
        if (in_array("DIRECTOR_CLINICO", $roles) || in_array("RECEPCIONISTA", $roles) || in_array("ENFERMERIA", $roles) || in_array("MEDICO", $roles)) {
            echo '
            <li class="has-submenu">
                <a href="#" onclick="toggleSubmenu(event, this)">
                    <i class="bi bi-file-medical-fill"></i>
                    <span>Gestión de Historias Médicas</span>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="historias-clinicas">
                            <i class="bi bi-file-earmark-plus"></i>
                            <span>Crear Historia</span>
                        </a>
                    </li>
                    <li>
                        <a href="pacientes">
                            <i class="bi bi-people"></i>
                            <span>Pacientes</span>
                        </a>
                    </li>
                </ul>
            </li>';
        }

        // Gestión de Activos (solo para RECEPCIONISTA, ADMIN_SISTEMAS, DIRECTOR_CLINICO)
        if (in_array("RECEPCIONISTA", $roles) || in_array("ADMIN_SISTEMAS", $roles) || in_array("DIRECTOR_CLINICO", $roles)) {
            echo '
            <li class="has-submenu">
                <a href="#" onclick="toggleSubmenu(event, this)">
                    <i class="bi bi-building"></i>
                    <span>Gestión de Activos</span>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="activos">
                            <i class="bi bi-hospital"></i>
                            <span>Activos</span>
                        </a>
                    </li>
                    <li>
                        <a href="organigrama">
                            <i class="bi bi-diagram-3"></i>
                            <span>Organigrama</span>
                        </a>
                    </li>
                </ul>
            </li>';
        }
;
    }
}
    
    ?>
    
    <!-- Perfil de usuario -->
    <li class="mt-4 border-top pt-3">
      <a href="#" class="d-flex align-items-center">
        <i class="bi bi-person-circle"></i>
        <div class="ms-2">
          <small class="d-block text-white-50">Bienvenido</small>
          <strong><?php echo obtener_nombre_usuario(); ?></strong>
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
