<?php
// Cargar sistema de idiomas
require_once 'vistas/modulos/idiomas.php';
?>
<div class="login-container">
  <div class="login-box">
    
    <div class="login-logo">
      <i class="bi bi-hospital"></i>
      <h3><?php echo t('login_titulo'); ?></h3>
      <p class="text-muted"><?php echo t('login_subtitulo'); ?></p>
    </div>
    
    <!-- Formulario de login tradicional -->
    <form method="post">
      
      <div class="mb-3">
        <label class="form-label"><?php echo t('login_usuario'); ?></label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="bi bi-person"></i>
          </span>
          <input type="text" class="form-control" placeholder="<?php echo t('login_usuario_placeholder'); ?>" name="ingUsuario" required>
        </div>
      </div>
      
      <div class="mb-3">
        <label class="form-label"><?php echo t('login_password'); ?></label>
        <div class="input-group">
          <span class="input-group-text">
            <i class="bi bi-lock"></i>
          </span>
          <input type="password" class="form-control" placeholder="<?php echo t('login_password_placeholder'); ?>" name="ingPassword" required>
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
    
    <div class="text-center mt-4">
      <small class="text-muted">&copy; 2024 <?php echo t('login_footer'); ?></small>
    </div>
    
  </div>
</div>
