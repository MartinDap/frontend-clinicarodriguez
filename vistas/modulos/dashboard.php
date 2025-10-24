<div class="container-fluid">
  
  <!-- Título de la página -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-speedometer2"></i> Dashboard</h2>
    <span class="text-muted">Bienvenido, <?php echo obtener_nombre_usuario(); ?></span>
  </div>
  
  <!-- Tarjetas de estadísticas -->
  <div class="row g-4 mb-4">
    
    <!-- Total Pacientes -->
    <div class="col-md-3">
      <div class="card stat-card bg-primary text-white">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="card-subtitle mb-2">Total Pacientes</h6>
              <h2 class="card-title mb-0">1,250</h2>
            </div>
            <i class="bi bi-people stat-icon"></i>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Citas Hoy -->
    <div class="col-md-3">
      <div class="card stat-card bg-success text-white">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="card-subtitle mb-2">Citas Hoy</h6>
              <h2 class="card-title mb-0">48</h2>
            </div>
            <i class="bi bi-calendar-check stat-icon"></i>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Médicos Activos -->
    <div class="col-md-3">
      <div class="card stat-card bg-info text-white">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="card-subtitle mb-2">Médicos Activos</h6>
              <h2 class="card-title mb-0">25</h2>
            </div>
            <i class="bi bi-person-badge stat-icon"></i>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Consultas del Mes -->
    <div class="col-md-3">
      <div class="card stat-card bg-warning text-white">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="card-subtitle mb-2">Consultas del Mes</h6>
              <h2 class="card-title mb-0">856</h2>
            </div>
            <i class="bi bi-clipboard2-pulse stat-icon"></i>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  
  <!-- Gráficos y tablas -->
  <div class="row g-4">
    
    <!-- Citas Recientes -->
    <div class="col-md-8">
      <div class="table-container">
        <h5 class="mb-3"><i class="bi bi-calendar-week"></i> Citas Recientes</h5>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Paciente</th>
                <th>Médico</th>
                <th>Especialidad</th>
                <th>Fecha</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Juan Pérez García</td>
                <td>Dr. Carlos Rodríguez</td>
                <td>Cardiología</td>
                <td>23/10/2024 10:00</td>
                <td><span class="badge bg-success">Completada</span></td>
              </tr>
              <tr>
                <td>María López Torres</td>
                <td>Dra. Ana Martínez</td>
                <td>Pediatría</td>
                <td>23/10/2024 11:30</td>
                <td><span class="badge bg-warning">En espera</span></td>
              </tr>
              <tr>
                <td>Pedro Sánchez Cruz</td>
                <td>Dr. Luis Fernández</td>
                <td>Traumatología</td>
                <td>23/10/2024 14:00</td>
                <td><span class="badge bg-info">Programada</span></td>
              </tr>
              <tr>
                <td>Carmen Ruiz Díaz</td>
                <td>Dra. Patricia González</td>
                <td>Ginecología</td>
                <td>23/10/2024 15:30</td>
                <td><span class="badge bg-info">Programada</span></td>
              </tr>
              <tr>
                <td>José Ramírez Luna</td>
                <td>Dr. Miguel Ángel Vega</td>
                <td>Neurología</td>
                <td>23/10/2024 16:00</td>
                <td><span class="badge bg-danger">Cancelada</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
    <!-- Actividad Reciente -->
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><i class="bi bi-activity"></i> Actividad Reciente</h5>
          <div class="list-group list-group-flush">
            <div class="list-group-item d-flex align-items-start">
              <i class="bi bi-check-circle text-success me-2 mt-1"></i>
              <div>
                <p class="mb-0"><small>Consulta completada - Juan Pérez</small></p>
                <small class="text-muted">Hace 5 minutos</small>
              </div>
            </div>
            <div class="list-group-item d-flex align-items-start">
              <i class="bi bi-calendar-plus text-primary me-2 mt-1"></i>
              <div>
                <p class="mb-0"><small>Nueva cita agendada - María López</small></p>
                <small class="text-muted">Hace 15 minutos</small>
              </div>
            </div>
            <div class="list-group-item d-flex align-items-start">
              <i class="bi bi-file-medical text-info me-2 mt-1"></i>
              <div>
                <p class="mb-0"><small>Historia clínica actualizada</small></p>
                <small class="text-muted">Hace 30 minutos</small>
              </div>
            </div>
            <div class="list-group-item d-flex align-items-start">
              <i class="bi bi-person-plus text-warning me-2 mt-1"></i>
              <div>
                <p class="mb-0"><small>Nuevo paciente registrado</small></p>
                <small class="text-muted">Hace 1 hora</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  
</div>
