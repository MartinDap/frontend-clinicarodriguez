<div class="container-fluid">
  
  <!-- Título de la página -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-house-door"></i> Inicio</h2>
    <span class="text-muted">Bienvenido, <?php echo obtener_nombre_usuario(); ?></span>
  </div>
  
  <!-- Tarjetas de bienvenida e información importante -->
  <div class="row g-4 mb-4">
    
    <!-- Horario de Atención -->
    <div class="col-md-4">
      <div class="card stat-card bg-primary text-white">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="card-subtitle mb-2">Horario de Atención</h6>
              <h5 class="card-title mb-0">Lun - Vie: 8:00 - 18:00</h5>
              <small>Sábados: 8:00 - 13:00</small>
            </div>
            <i class="bi bi-clock stat-icon"></i>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  
  <!-- Información importante del sistema -->
  <div class="row g-4">
    
    <!-- Accesos Rápidos -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><i class="bi bi-lightning"></i> Accesos Rápidos</h5>
          <div class="row g-3">
            <div class="col-6">
              <a href="pacientes" class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center p-3">
                <i class="bi bi-people fs-4 me-2"></i>
                <div>
                  <small>Gestión de</small><br>
                  <strong>Pacientes</strong>
                </div>
              </a>
            </div>
            <div class="col-6">
              <a href="citas" class="btn btn-outline-success w-100 d-flex align-items-center justify-content-center p-3">
                <i class="bi bi-calendar-check fs-4 me-2"></i>
                <div>
                  <small>Gestión de</small><br>
                  <strong>Citas</strong>
                </div>
              </a>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    
    <!-- Información del Sistema -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><i class="bi bi-info-circle"></i> Información del Sistema</h5>
          <div class="list-group list-group-flush">
            <div class="list-group-item d-flex justify-content-between align-items-center">
              <span><i class="bi bi-shield-check text-success me-2"></i> Estado del Sistema</span>
              <span class="badge bg-success">Operativo</span>
            </div>
            <div class="list-group-item d-flex justify-content-between align-items-center">
              <span><i class="bi bi-patch-check text-warning me-2"></i> Versión</span>
              <small class="text-muted">v2.1.0</small>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  
</div>