<div class="container-fluid">
  
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-people"></i> Gestión de Pacientes</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevoPaciente">
      <i class="bi bi-plus-circle"></i> Nuevo Paciente
    </button>
  </div>
  
  <div class="table-container">
    <table id="tablaPacientes" class="table table-striped table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>DNI</th>
          <th>Nombre Completo</th>
          <th>Fecha Nacimiento</th>
          <th>Teléfono</th>
          <th>Email</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>12345678</td>
          <td>Juan Pérez García</td>
          <td>15/03/1985</td>
          <td>987654321</td>
          <td>juan.perez@email.com</td>
          <td>
            <button class="btn btn-sm btn-info"><i class="bi bi-eye"></i></button>
            <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  
</div>
