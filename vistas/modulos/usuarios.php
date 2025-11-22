<?php

$token = obtener_token_usuario();
  if ($token !== null) {
    // Realizar petición GET a la API para obtener todos los usuarios
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => API_BASE_URL . 'usuarios',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
          'Authorization: ' . $token,
          'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    $data = json_decode($response, true);

    /* roles */
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => API_BASE_URL . 'roles',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          'Authorization: ' . $token,
          'Content-Type: application/json'
      ),
      ));

      $roles = curl_exec($curl);

      curl_close($curl);
      $dataRoles = json_decode($roles, true);
  }


?>

<div class="container-fluid">

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-person-badge"></i> Gestión de Usuarios</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarUsuario">
      <i class="bi bi-plus-circle"></i> Nuevo Usuario
    </button>
  </div>

  <div class="table-container">
    <table id="tablaUsuarios" class="table table-striped table-hover align-middle">
      <thead class="table-light">
        <tr>
          <th>#</th>
          <th>Username</th>
          <th>Nombre completo</th>
          <th>DNI</th>
          <th>Email</th>
          <th>Teléfono</th>
          <th>Estado</th>
          <th>Última sesión</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (isset($data["data"]) && is_array($data["data"])): ?>
          <?php foreach ($data["data"] as $key => $usuario): ?>
            <tr>
              <td><?= $key + 1 ?></td>
              <td><?= htmlspecialchars($usuario["usuaUsername"]) ?></td>
              <td><?= htmlspecialchars($usuario["persona"]["persNombrecompleto"]) ?></td>
              <td><?= htmlspecialchars($usuario["persona"]["persNroDoc"]) ?></td>
              <td><?= htmlspecialchars($usuario["persona"]["persEmail"]) ?></td>
              <td><?= htmlspecialchars($usuario["persona"]["persTelefono"]) ?></td>
              
              <td>
                <?php 
                  $estado = $usuario["usuaEstado"] ? "ACTIVO" : "INACTIVO";
                  $badgeClass = $usuario["usuaEstado"] ? "bg-success" : "bg-secondary";
                  echo "<span class='badge {$badgeClass}'>{$estado}</span>";
                ?>
              </td>
              <td>
                <?php 
                  if (!empty($usuario["usuaUltimaSesion"])) {
                    $fecha = date("d/m/Y H:i", strtotime($usuario["usuaUltimaSesion"]));
                    echo htmlspecialchars($fecha);
                  } else {
                    echo "<span class='text-muted'>Nunca</span>";
                  }
                ?>
              </td>
              <td>
                <button class="btn btn-sm btn-info btnAsignarRoles me-1" usuaId="<?= $usuario["usuaId"] ?>" title="Ver">
                  <i class="bi bi-eye"></i>
                </button>
                <button class="btn btn-sm btn-warning btnEditarUsuario me-1" usuaId="<?= $usuario["usuaId"] ?>" title="Editar">
                  <i class="bi bi-pencil"></i>
                </button>
                <button class="btn btn-sm btn-danger btnEliminarUsuario" eliminarUsuaId="<?= $usuario["usuaId"] ?>" title="Eliminar">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="10" class="text-center">No se encontraron usuarios registrados</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" id="formRegistrarUsuario" method="post">

        <!--=====================================
        CABECERA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#003264; color:white">
          <h4 class="modal-title">Registrar Usuario</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">

            <div class="row">
              <!-- Nombre completo -->
              <div class="form-group col-md-6">
                <label for="nombrecompleto">Nombre completo</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    name="nombrecompleto"
                    id="nombrecompleto"
                    placeholder="Ej: Juan Carlos Pérez"
                    required>
                </div>
              </div>

              <!-- Username -->
              <div class="form-group col-md-6">
                <label for="username">Nombre de usuario</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    name="username"
                    id="username"
                    placeholder="Ej: jperez"
                    required>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Tipo Documento -->
              <div class="form-group col-md-4">
                <label for="tipoDoc">Tipo documento</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                  <select class="form-control input-lg" name="tipoDoc" id="tipoDoc" required>
                    <option value="">Seleccionar...</option>
                    <option value="DNI">DNI</option>
                    <option value="CE">Carné de Extranjería</option>
                    <option value="PASAPORTE">Pasaporte</option>
                  </select>
                </div>
              </div>

              <!-- Número Documento -->
              <div class="form-group col-md-4">
                <label for="nroDoc">Número de documento</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-id-badge"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    name="nroDoc"
                    id="nroDoc"
                    placeholder="12345678"
                    required>
                </div>
              </div>

              <!-- Sexo -->
              <div class="form-group col-md-4">
                <label for="sexo">Sexo</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
                  <select class="form-control input-lg" name="sexo" id="sexo" required>
                    <option value="">Seleccionar...</option>
                    <option value="MASCULINO">Masculino</option>
                    <option value="FEMENINO">Femenino</option>
                    <option value="OTRO">Otro</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Fecha de nacimiento -->
              <div class="form-group col-md-4">
                <label for="fecNacimiento">Fecha de nacimiento</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input
                    type="date"
                    class="form-control input-lg"
                    name="fecNacimiento"
                    id="fecNacimiento"
                    required>
                </div>
              </div>

              <!-- Estado civil -->
              <div class="form-group col-md-4">
                <label for="estadoCivil">Estado civil</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-heart"></i></span>
                  <select class="form-control input-lg" name="estadoCivil" id="estadoCivil" required>
                    <option value="">Seleccionar...</option>
                    <option value="SOLTERO">Soltero</option>
                    <option value="CASADO">Casado</option>
                    <option value="DIVORCIADO">Divorciado</option>
                    <option value="VIUDO">Viudo</option>
                  </select>
                </div>
              </div>

              <!-- Teléfono -->
              <div class="form-group col-md-4">
                <label for="telefono">Teléfono / Celular</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    name="telefono"
                    id="telefono"
                    placeholder="987654321"
                    required>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Email -->
              <div class="form-group col-md-6">
                <label for="email">Correo electrónico</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input
                    type="email"
                    class="form-control input-lg"
                    name="email"
                    id="email"
                    placeholder="ejemplo@correo.com"
                    required>
                </div>
              </div>

              <!-- Contraseña -->
              <div class="form-group col-md-6">
                <label for="password">Contraseña</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  <input
                    type="password"
                    class="form-control input-lg"
                    name="password"
                    id="password"
                    placeholder="********"
                    required>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Dirección -->
              <div class="form-group col-md-12">
                <label for="direccion">Dirección</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    name="direccion"
                    id="direccion"
                    placeholder="Av. Principal 123, Lima"
                    required>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar usuario</button>
        </div>

      </form>

    </div>

  </div>
</div>


<!--=====================================
MODAL ASIGNAR ROLES
======================================-->
<div id="modalAsignarRoles" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" id="formAsignarRoles" method="post">
        <input type="hidden" id="asignarUserId" name="asignarUserId">

        <!--=====================================
        CABECERA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#003264; color:white">
          <h4 class="modal-title">Asignar Roles a Usuario</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">

            <!-- Información del Usuario Seleccionado -->
            <div class="row" id="infoUsuario" style="display: none; margin-top: 15px; padding: 15px; background-color: #f8f9fa; border-radius: 5px;">
              <div class="col-md-12">
                <h5><i class="fa fa-info-circle"></i> Información del Usuario</h5>
                <p><strong>Nombre:</strong> <span id="infoNombreUsuario"></span></p>
              </div>
            </div>

            <div class="row" style="margin-top: 20px;">
              <!-- Roles Disponibles -->
              <div class="form-group col-md-12">
                <label><i class="fa fa-shield"></i> Seleccionar Roles (puede seleccionar múltiples)</label>
                <div style="border: 1px solid #ddd; padding: 15px; border-radius: 5px; max-height: 300px; overflow-y: auto;">

                  <?php
                  // Verificar si $dataRoles es válido y tiene datos
                  if (isset($dataRoles['success']) && $dataRoles['success'] === true && 
                      isset($dataRoles['data']) && is_array($dataRoles['data']) && !empty($dataRoles['data'])) {
                      
                      foreach ($dataRoles['data'] as $rol) {
                          // Validar que existan las claves esperadas
                          if (isset($rol['roleId']) && isset($rol['roleName']) && isset($rol['roleDescripcion'])) {
                  ?>
                              <div class="form-check" style="margin-bottom: 10px;">
                                  <input 
                                      class="form-check-input" 
                                      type="checkbox" 
                                      name="roles[]" 
                                      value="<?php echo htmlspecialchars($rol['roleId']); ?>" 
                                      id="rol<?php echo htmlspecialchars($rol['roleId']); ?>">
                                  <label class="form-check-label" for="rol<?php echo htmlspecialchars($rol['roleId']); ?>">
                                      <strong><?php echo htmlspecialchars($rol['roleName']); ?></strong> - 
                                      <?php echo htmlspecialchars($rol['roleDescripcion']); ?>
                                  </label>
                              </div>
                  <?php
                          }
                      }
                  } else {
                      echo '<p class="text-muted">No hay roles disponibles</p>';
                  }
                  ?>

                </div>
                <small class="form-text text-muted">
                  <i class="fa fa-info-circle"></i> Seleccione uno o más roles para asignar al usuario.
                </small>
              </div>
            </div>


            <!-- Roles actualmente asignados -->
            <div class="row" style="margin-top: 15px;">
              <div class="col-md-12">
                <div class="alert alert-info">
                  <strong><i class="fa fa-list"></i> Roles actualmente asignados:</strong>
                  <div id="rolesActuales">
                    <span class="badge bg-secondary">Ninguno</span>
                  </div>
                </div>
              </div>
            </div>

          </div><!-- /.box-body -->
        </div><!-- /.modal-body -->

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Asignar Roles
          </button>
        </div>

      </form>

    </div>

  </div>
</div>


