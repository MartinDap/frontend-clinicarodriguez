<?php
/**
 * Componente Formulario de Login
 * Formulario reutilizable para login
 * 
 * @param bool $mostrar_volver - Si muestra el enlace "Volver al inicio"
 */

$mostrar_volver = $mostrar_volver ?? false;
?>
<div class="login-container">
  <div class="login-box">
    
    <div class="login-logo">
      <i class="bi bi-hospital"></i>
      <h3><?php echo t('Inicia sesion a nuestro sistema'); ?></h3>
    </div>
    <!-- Formulario de login tradicional -->
    <form method="post">
      <div class="mb-3">
        <label class="form-label"><?php echo t('Usuario'); ?></label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="bi bi-person"></i>
          </span>
          <input type="text" class="form-control" placeholder="<?php echo t('Usuario'); ?>" name="ingUsuario" required>
        </div>
      </div>
      
      <div class="mb-3">
        <label class="form-label"><?php echo t('Contraseña'); ?></label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="bi bi-lock"></i>
          </span>
          <input type="password" class="form-control" placeholder="<?php echo t('Contraseña'); ?>" name="ingPassword" required>
        </div>
      </div>
      
      <div class="d-grid mb-3">
        <button type="submit" class="btn btn-primary btn-custom">
          <i class="bi bi-box-arrow-in-right"></i> <?php echo t('login_btn_ingresar'); ?>
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
          <i class="bi bi-unlock"></i> <?php echo t('login_btn_demo'); ?>
        </button>
      </div>
      <?php
        $loginDirecto = new ControladorUsuarios();
        $loginDirecto->ctrLoginUsuario();
      ?>
    </form>
    
    <?php if($mostrar_volver): ?>
    <div class="text-center mt-4">
      <a href="/" class="text-muted">
        <i class="bi bi-arrow-left"></i> <?php echo idioma_actual() === 'es' ? 'Volver al Inicio' : 'Back to Home'; ?>
      </a>
    </div>
    <?php endif; ?>
    
    <div class="text-center mt-<?php echo $mostrar_volver ? '2' : '4'; ?>">
      <small class="text-muted">&copy; 2024 <?php echo t('login_footer'); ?></small>
    </div>
    
  </div>
</div>
