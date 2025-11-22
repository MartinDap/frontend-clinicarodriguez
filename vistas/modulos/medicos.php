<?php

  $token = obtener_token_usuario();
  if ($token !== null) {
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
          'Authorization: ' . $token,
          'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $data = json_decode($response, true);

    /* especialidades */
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => API_BASE_URL . 'especialidades',
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

    $responseespeci = curl_exec($curl);

    curl_close($curl);
    $dataEspe = json_decode($responseespeci, true);

  }else {
      echo "Token no disponible, no se puede realizar la solicitud.";
  }

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
          <th>Nombres y Apellidos</th>
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
              <button class="btn btn-sm btn-info btnAsignarEspecialidades" mediId="<?= $medico["mediId"] ?>">
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
                  <input type="text" class="form-control input-lg" id="mediNombre" placeholder="Ej: Carlos" required>
                </div>
              </div>

              <!-- Apellido -->
              <div class="form-group col-md-6">
                <label for="mediApellido">Apellido</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-lg" id="mediApellido" placeholder="Ej: Gómez" required>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Tipo Doc -->
              <div class="form-group col-md-4">
                <label for="mediTipoDoc">Tipo Doc</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-id-badge"></i></span>
                  <select class="form-control input-lg" id="mediTipoDoc" required>
                    <option value="">Seleccionar...</option>
                    <option value="DNI">DNI</option>
                    <option value="CE">CE</option>
                    <option value="PAS">PAS</option>
                  </select>
                </div>
              </div>

              <!-- Nro Doc -->
              <div class="form-group col-md-4">
                <label for="mediDni">Nro Doc</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                  <input type="text" class="form-control input-lg" id="mediDni" placeholder="74500985" required>
                </div>
              </div>

              <!-- Sexo -->
              <div class="form-group col-md-4">
                <label for="mediSexo">Sexo</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
                  <select class="form-control input-lg" id="mediSexo" required>
                    <option value="">Seleccionar...</option>
                    <option value="MASCULINO">Masculino</option>
                    <option value="FEMENINO">Femenino</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Fec Nacimiento -->
              <div class="form-group col-md-4">
                <label for="mediFecNac">Fecha de Nacimiento</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input type="date" class="form-control input-lg" id="mediFecNac" required>
                </div>
              </div>

              <!-- Estado Civil -->
              <div class="form-group col-md-4">
                <label for="mediEstadoCivil">Estado civil</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-heart"></i></span>
                  <select class="form-control input-lg" id="mediEstadoCivil" required>
                    <option value="">Seleccionar...</option>
                    <option value="SOLTERO">Soltero</option>
                    <option value="CASADO">Casado</option>
                    <option value="DIVORCIADO">Divorciado</option>
                    <option value="VIUDO">Viudo</option>
                  </select>
                </div>
              </div>

              <!-- Dirección -->
              <div class="form-group col-md-4">
                <label for="mediDireccion">Dirección</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                  <input type="text" class="form-control input-lg" id="mediDireccion" placeholder="Av. Médicos 789, Lima" required>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Teléfono -->
              <div class="form-group col-md-4">
                <label for="mediTelefono">Teléfono / Celular</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control input-lg" id="mediTelefono" placeholder="987654321" required>
                </div>
              </div>

              <!-- Email -->
              <div class="form-group col-md-4">
                <label for="mediEmail">Correo electrónico</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="email" class="form-control input-lg" id="mediEmail" placeholder="ejemplo@correo.com" required>
                </div>
              </div>

            </div>

            <div class="row">
              <!-- Usuario -->
              <div class="form-group col-md-4">
                <label for="mediUsuario">Usuario</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                  <input type="text" class="form-control input-lg" id="mediUsuario" placeholder="Ej: cgomez" required>
                </div>
              </div>

              <!-- Contraseña -->
              <div class="form-group col-md-4">
                <label for="mediPassword">Contraseña</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  <input type="password" class="form-control input-lg" id="mediPassword" placeholder="Contraseña" required>
                </div>
              </div>

              <!-- N° Colegiatura -->
              <div class="form-group col-md-4">
                <label for="mediNroColegiatura">N° Colegiatura</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-id-badge"></i></span>
                  <input type="text" class="form-control input-lg" id="mediNroColegiatura" placeholder="CMP-1234" required>
                </div>
              </div>
            </div>

            <div class="row">

              <!-- Foto -->
              <div class="form-group col-md-4">
                <label for="mediFoto">Subir Foto</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-image"></i></span>
                  <input type="file" class="form-control input-lg" id="mediFoto" accept="image/*">
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
                  <input type="text" class="form-control input-lg" name="editarMediFotoUrl" id="editarMediFotoUrl">
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

<!--=====================================
MODAL ASIGNAR ESPECIALIDADES
======================================-->
<div id="modalAsignarEspecialidades" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" id="formAsignarEspecialidades" method="post">
      <input type="hidden" id="asignarMediId" name="asignarMediId">
        <!--=====================================
        CABECERA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#003264; color:white">
          <h4 class="modal-title">Asignar Roles a Médico</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">

            <!-- Información del Médico Seleccionado -->
            <div class="row" id="infoMedico" style="display: none; margin-top: 15px; padding: 15px; background-color: #f8f9fa; border-radius: 5px;">
              <div class="col-md-12">
                <h5><i class="fa fa-info-circle"></i> Información del Médico</h5>
                <p><strong>Nombre:</strong> <span id="infoNombre"></span></p>
              </div>
            </div>

            <div class="row" style="margin-top: 20px;">
              <!-- Roles Disponibles -->
              <div class="form-group col-md-12">
                  <label><i class="fa fa-shield"></i> Seleccionar Especialidades (puede seleccionar múltiples)</label>
                  <div style="border: 1px solid #ddd; padding: 15px; border-radius: 5px; max-height: 300px; overflow-y: auto;">
                      
                      <?php
                      // Verificar si $dataEspe es válido y tiene datos
                      if (isset($dataEspe['success']) && $dataEspe['success'] === true && isset($dataEspe['data']) && is_array($dataEspe['data']) && !empty($dataEspe['data'])) {
                          foreach ($dataEspe['data'] as $especialidad) {
                              // Asegurarse de que cada especialidad tenga los campos necesarios
                              if (isset($especialidad['espeId']) && isset($especialidad['espeNombre']) && isset($especialidad['espeDescripcion'])) {
                      ?>
                                  <div class="form-check" style="margin-bottom: 10px;">
                                      <input 
                                          class="form-check-input" 
                                          type="checkbox" 
                                          name="especialidades[]" 
                                          value="<?php echo htmlspecialchars($especialidad['espeId']); ?>" 
                                          id="especialidades<?php echo htmlspecialchars($especialidad['espeId']); ?>">
                                      <label class="form-check-label" for="rol<?php echo htmlspecialchars($especialidad['espeId']); ?>">
                                          <strong><?php echo htmlspecialchars($especialidad['espeNombre']); ?></strong> - <?php echo htmlspecialchars($especialidad['espeDescripcion']); ?>
                                      </label>
                                  </div>
                      <?php
                              }
                          }
                      } else {
                          // Mensaje si no hay datos
                          echo '<p class="text-muted">No hay especialidades disponibles</p>';
                      }
                      ?>

                  </div>
                  <small class="form-text text-muted">
                      <i class="fa fa-info-circle"></i> Seleccione una o más especialidades para asignar al médico
                  </small>
              </div>
          </div>

            <!-- Especialidades Actualmente Asignados -->
            <div class="row" style="margin-top: 15px;">
              <div class="col-md-12">
                <div class="alert alert-info">
                  <strong><i class="fa fa-list"></i> Especialidades actualmente asignados:</strong>
                  <div id="especialidadesActuales">
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
