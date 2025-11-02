<?php

  // Realizar petición GET a la API para obtener todos los médicos
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => API_BASE_URL . 'medicos',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
      API_AUTH_HEADER
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  $data = json_decode($response, true);

?>
<div class="container-fluid">
  
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-person-badge"></i> Gestión de Médicos</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarMedico">
      <i class="bi bi-plus-circle"></i> Nuevo Médico
    </button>
  </div>
  
  <div class="table-container">
    <table id="tablaMedicos" class="table table-striped table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Foto</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
      <?php if (isset($data["data"]) && is_array($data["data"])): ?>
        <?php foreach($data["data"] as $key => $medico): ?>
          <tr>
            <td><?= ($key + 1) ?></td>
            <td><?= htmlspecialchars($medico["mediNombre"]) ?></td>
            <td><?= htmlspecialchars($medico["mediApellido"]) ?></td>
            <td>
              <?php if (!empty($medico["mediFotoUrl"])): ?>
                <img src="<?= htmlspecialchars($medico["mediFotoUrl"]) ?>" alt="Foto" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
              <?php else: ?>
                <span class="text-muted">Sin foto</span>
              <?php endif; ?>
            </td>
            
            <td>
              <?php 
                $estado = $medico["mediEstado"] ?? 'INACTIVO';
                $badgeClass = ($estado === 'ACTIVO') ? 'bg-success' : 'bg-secondary';
                echo "<span class='badge {$badgeClass}'>{$estado}</span>";
              ?>
            </td>
            <td>
              <button class="btn btn-sm btn-info btnVerMedico" mediId="<?= $medico["mediId"] ?>">
                <i class="bi bi-eye"></i>
              </button>
              <button class="btn btn-sm btn-warning btnEditarMedico" mediId="<?= $medico["mediId"] ?>">
                <i class="bi bi-pencil"></i>
              </button>
              <button class="btn btn-sm btn-danger btnEliminarMedico" eliminarMediId="<?= $medico["mediId"] ?>">
                <i class="bi bi-trash"></i>
              </button>
            </td>
          </tr>
        <?php endforeach ?>
      <?php else: ?>
        <tr>
          <td colspan="8" class="text-center">No se encontraron médicos</td>
        </tr>
      <?php endif ?>
    </tbody>


    </table>
  </div>
  
</div>

<!--=====================================
MODAL AGREGAR MÉDICO
======================================-->
<div id="modalAgregarMedico" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" id="formRegistrarMedico" method="post">

        <!--=====================================
        CABECERA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#003264; color:white">
          <h4 class="modal-title">Registrar Médico</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">

            <div class="row">
              <!-- Nombre -->
              <div class="form-group col-md-6">
                <label for="mediNombre">Nombre</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    name="mediNombre"
                    id="mediNombre"
                    placeholder="Ej: Carlos"
                    required>
                </div>
              </div>

              <!-- Apellido -->
              <div class="form-group col-md-6">
                <label for="mediApellido">Apellido</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    name="mediApellido"
                    id="mediApellido"
                    placeholder="Ej: Gómez"
                    required>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- DNI -->
              <div class="form-group col-md-4">
                <label for="mediDni">DNI</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    name="mediDni"
                    id="mediDni"
                    placeholder="74500985"
                    required>
                </div>
              </div>

              <!-- Teléfono -->
              <div class="form-group col-md-4">
                <label for="mediTelefono">Teléfono / Celular</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    name="mediTelefono"
                    id="mediTelefono"
                    placeholder="987654321"
                    required>
                </div>
              </div>

              <!-- Estado -->
              <div class="form-group col-md-4">
                <label for="mediEstado">Estado</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-toggle-on"></i></span>
                  <select
                    class="form-control input-lg"
                    name="mediEstado"
                    id="mediEstado"
                    required>
                    <option value="">Seleccionar...</option>
                    <option value="ACTIVO">Activo</option>
                    <option value="INACTIVO">Inactivo</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Email -->
              <div class="form-group col-md-8">
                <label for="mediEmail">Correo electrónico</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input
                    type="email"
                    class="form-control input-lg"
                    name="mediEmail"
                    id="mediEmail"
                    placeholder="ejemplo@correo.com"
                    required>
                </div>
              </div>

              <!-- Foto URL -->
              <div class="form-group col-md-4">
                <label for="mediFoto">Subir Foto</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-image"></i></span>
                  <input
                    type="file"
                    class="form-control input-lg"
                    name="mediFoto"
                    id="mediFoto"
                    accept="image/*">
                </div>
              </div>

            </div>

          </div><!-- /.box-body -->
        </div><!-- /.modal-body -->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar médico</button>
        </div>

      </form>

    </div>

  </div>
</div>



<!--=====================================
MODAL EDITAR MÉDICO
======================================-->
<div id="modalEditarMedico" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" id="formEditarMedico" method="post">

        <!--=====================================
        CABECERA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#003264; color:white">
          <h4 class="modal-title">Editar Médico</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">

            <input type="hidden" name="mediId" id="editarMediId">

            <div class="row">
              <!-- Nombre -->
              <div class="form-group col-md-6">
                <label for="editarMediNombre">Nombre</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    name="editarMediNombre"
                    id="editarMediNombre"
                    required>
                </div>
              </div>

              <!-- Apellido -->
              <div class="form-group col-md-6">
                <label for="editarMediApellido">Apellido</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    name="editarMediApellido"
                    id="editarMediApellido"
                    required>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- DNI -->
              <div class="form-group col-md-4">
                <label for="editarMediDni">DNI</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    name="editarMediDni"
                    id="editarMediDni"
                    required>
                </div>
              </div>

              <!-- Teléfono -->
              <div class="form-group col-md-4">
                <label for="editarMediTelefono">Teléfono / Celular</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    name="editarMediTelefono"
                    id="editarMediTelefono"
                    required>
                </div>
              </div>

              <!-- Estado -->
              <div class="form-group col-md-4">
                <label for="editarMediEstado">Estado</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-toggle-on"></i></span>
                  <select
                    class="form-control input-lg"
                    name="editarMediEstado"
                    id="editarMediEstado"
                    required>
                    <option value="">Seleccionar...</option>
                    <option value="ACTIVO">Activo</option>
                    <option value="INACTIVO">Inactivo</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Email -->
              <div class="form-group col-md-8">
                <label for="editarMediEmail">Correo electrónico</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input
                    type="email"
                    class="form-control input-lg"
                    name="editarMediEmail"
                    id="editarMediEmail"
                    required>
                </div>
              </div>

              <!-- Foto URL -->
              <div class="form-group col-md-4">
                <label for="editarMediFotoUrl">Foto URL</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-image"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    name="editarMediFotoUrl"
                    id="editarMediFotoUrl">
                </div>
              </div>
            </div>

          </div><!-- /.box-body -->
        </div><!-- /.modal-body -->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success">Guardar cambios</button>
        </div>

      </form>

    </div>

  </div>
</div>
