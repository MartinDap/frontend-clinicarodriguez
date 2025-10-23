<div class="login-container">
  <div class="login-box">
    
    <div class="login-logo">
      <i class="bi bi-hospital"></i>
      <h3>Acceso al Panel</h3>
      <p class="text-muted">Sistema Interno - Clínica Médica</p>
    </div>
    
    <!-- Formulario de login tradicional -->
    <form method="post">
      
      <div class="mb-3">
        <label class="form-label">Usuario</label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="bi bi-person"></i>
          </span>
          <input type="text" class="form-control" placeholder="Ingresa tu usuario" name="ingUsuario" required>
        </div>
      </div>
      
      <div class="mb-3">
        <label class="form-label">Contraseña</label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="bi bi-lock"></i>
          </span>
          <input type="password" class="form-control" placeholder="Ingresa tu contraseña" name="ingPassword" required>
        </div>
      </div>
      
      <div class="d-grid mb-3">
        <button type="submit" class="btn btn-primary btn-custom">
          <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
        </button>
      </div>
      
      <?php
        $login = new ControladorUsuarios();
        $login->ctrLoginUsuario();
      ?>
      
    </form>
    
    <hr>
    
    <!-- Formulario de acceso directo -->
    <form method="post">
      <input type="hidden" name="acceso_directo" value="1">
      <div class="d-grid">
        <button type="submit" class="btn btn-success btn-custom">
          <i class="bi bi-unlock"></i> Acceso Directo (Demo)
        </button>
      </div>
      <?php
        $loginDirecto = new ControladorUsuarios();
        $loginDirecto->ctrLoginUsuario();
      ?>
    </form>
    
    <div class="text-center mt-4">
      <a href="/" class="text-muted">
        <i class="bi bi-arrow-left"></i> Volver al Inicio
      </a>
    </div>
    
    <div class="text-center mt-2">
      <small class="text-muted">© 2024 Sistema Clínico</small>
    </div>
    
  </div>
</div>
