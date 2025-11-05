<?php

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => API_BASE_URL . 'dias-medico',
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

  /* medicos */
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

  $responsemedicos = curl_exec($curl);

  curl_close($curl);
  $dataMedicos = json_decode($responsemedicos, true);


?>
<div class="container-fluid">
  
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-people"></i> Gestión de Horario</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRegistrarHorario">
      <i class="bi bi-plus-circle"></i> Registrar horario
    </button>
  </div>
  
  <div class="table-container">
    <table id="tablaHorario" class="table table-striped table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombre Completo</th>
          <th>Día</th>
          <th>Hora Inicio</th>
          <th>Hora Fin</th>
          <th>Duración (hrs)</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (isset($data["data"]) && is_array($data["data"])): ?>
          <?php foreach($data["data"] as $key => $item): ?>
            <tr>
              <td><?= ($key + 1) ?></td>
              <td><?= htmlspecialchars($item["medico"]["mediNombre"]) ?></td>
              <td><?= htmlspecialchars($item["dia"]["dia"]) ?></td>
              <td><?= htmlspecialchars($item["dimeHoraInicio"]) ?></td>
              <td><?= htmlspecialchars($item["dimeHoraFin"]) ?></td>
              <td><?= htmlspecialchars($item["dimeDuracion"]) ?></td>
              <td>
                <?php if ($item["dimeEstado"] == 1): ?>
                  <span class="label label-success">Activo</span>
                <?php else: ?>
                  <span class="label label-danger">Inactivo</span>
                <?php endif; ?>
              </td>
              <td>
                <button class="btn btn-sm btn-warning btnEditarDisponibilidad" dimeId="<?= $item["dimeId"] ?>">
                  <i class="bi bi-pencil"></i>
                </button>
                <button class="btn btn-sm btn-danger btnEliminarDisponibilidad" dimeId="<?= $item["dimeId"] ?>">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>
          <?php endforeach ?>
        <?php else: ?>
          <tr>
            <td colspan="9" class="text-center">No hay horarios disponibles</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  
</div>

<!--=====================================
MODAL REGISTRAR HORARIO
======================================-->
<div id="modalRegistrarHorario" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <form role="form" id="formRegistrarHorario" method="post">

        <!-- CABECERA -->
        <div class="modal-header" style="background:#003264; color:white">
          <h4 class="modal-title">Registrar Horario</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- CUERPO -->
        <div class="modal-body">
          <div class="box-body">

            <!-- Usuario -->
            <div class="form-group mb-3">
              <label for="regMedicoId">Seleccionar Usuario / Doctor</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user-md"></i></span>
                <select class="form-control input-lg" name="regMedicoId" id="regMedicoId" required>
                  <option value="">Seleccione un usuario...</option>
                  <?php if (isset($dataMedicos["data"]) && is_array($dataMedicos["data"])): ?>
                    <?php foreach ($dataMedicos["data"] as $medico): ?>
                      <option value="<?= htmlspecialchars($medico["mediId"]) ?>">
                        <?= htmlspecialchars($medico["mediNombre"]) ?>
                      </option>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <option value="">No hay usuarios disponibles</option>
                  <?php endif; ?>
                </select>
              </div>
            </div>

            <!-- Día -->
            <div class="form-group mb-3">
              <label for="regDiaId">Día</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <select class="form-control input-lg" name="regDiaId" id="regDiaId" required>
                  <option value="">Seleccionar día...</option>
                  <option value="1">Lunes</option>
                  <option value="2">Martes</option>
                  <option value="3">Miércoles</option>
                  <option value="4">Jueves</option>
                  <option value="5">Viernes</option>
                  <option value="6">Sábado</option>
                  <option value="7">Domingo</option>
                </select>
              </div>
            </div>

            <!-- Hora inicio y fin -->
            <div class="row">
              <div class="form-group col-md-6">
                <label for="regHoraInicio">Hora de inicio</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                  <input type="time" class="form-control input-lg" name="regHoraInicio" id="regHoraInicio" required>
                </div>
              </div>

              <div class="form-group col-md-6">
                <label for="regHoraFin">Hora de fin</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                  <input type="time" class="form-control input-lg" name="regHoraFin" id="regHoraFin" required>
                </div>
              </div>
            </div>

            <!-- Duración -->
            <div class="form-group mb-3">
              <label for="regDuracion">Duración (en horas)</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-hourglass-half"></i></span>
                <input type="number" class="form-control input-lg" name="regDuracion" id="regDuracion" min="1" step="0.5" placeholder="Ej: 2" required>
              </div>
            </div>

            <!-- Estado -->
            <div class="form-group mb-3">
              <label for="regEstado">Estado</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-toggle-on"></i></span>
                <select class="form-control input-lg" name="regEstado" id="regEstado" required>
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
            </div>

          </div>
        </div>

        <!-- PIE -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar horario</button>
        </div>

      </form>

    </div>
  </div>
</div>



<!--=====================================
MODAL EDITAR HORARIO
======================================-->
<div id="modalEditarHorario" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" id="formEditarHorario" method="post">

        <!--=====================================
        CABECERA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#003264; color:white">
          <h4 class="modal-title">Editar Horario</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">

            <input type="hidden" name="paciId" id="editarPaciId">

            <div class="row">
              <!-- Nombre completo -->
              <div class="form-group col-md-8">
                <label for="editarPaciNombrecompleto">Nombre completo</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    name="editarPaciNombrecompleto"
                    id="editarPaciNombrecompleto"
                    required>
                </div>
              </div>

              <!-- DNI -->
              <div class="form-group col-md-4">
                <label for="editarPaciDni">DNI</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                  <input
                    type="number"
                    class="form-control input-lg"
                    name="editarPaciDni"
                    id="editarPaciDni"
                    required>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Sexo -->
              <div class="form-group col-md-4">
                <label for="editarPaciSexo">Sexo</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
                  <select
                    class="form-control input-lg"
                    name="editarPaciSexo"
                    id="editarPaciSexo"
                    required>
                    <option value="">Seleccionar...</option>
                    <option value="MASCULINO">Masculino</option>
                    <option value="FEMENINO">Femenino</option>
                  </select>
                </div>
              </div>

              <!-- Fecha de nacimiento -->
              <div class="form-group col-md-4">
                <label for="editarPaciFecNacimiento">Fecha de nacimiento</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input
                    type="date"
                    class="form-control input-lg"
                    name="editarPaciFecNacimiento"
                    id="editarPaciFecNacimiento"
                    required>
                </div>
              </div>

              <!-- Estado civil -->
              <div class="form-group col-md-4">
                <label for="editarPaciEstadoCivil">Estado civil</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-heart"></i></span>
                  <select
                    class="form-control input-lg"
                    name="editarPaciEstadoCivil"
                    id="editarPaciEstadoCivil"
                    required>
                    <option value="">Seleccionar...</option>
                    <option value="SOLTERO">Soltero(a)</option>
                    <option value="CASADO">Casado(a)</option>
                    <option value="DIVORCIADO">Divorciado(a)</option>
                    <option value="VIUDO">Viudo(a)</option>
                    <option value="CONVIVIENTE">Conviviente</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Teléfono -->
              <div class="form-group col-md-4">
                <label for="editarPaciTelefono">Teléfono / Celular</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    name="editarPaciTelefono"
                    id="editarPaciTelefono"
                    required>
                </div>
              </div>

              <!-- Correo -->
              <div class="form-group col-md-8">
                <label for="editarPaciEmail">Correo electrónico</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input
                    type="email"
                    class="form-control input-lg"
                    name="editarPaciEmail"
                    id="editarPaciEmail"
                    required>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Dirección -->
              <div class="form-group col-md-8">
                <label for="editarPaciDireccion">Dirección</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-home"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    name="editarPaciDireccion"
                    id="editarPaciDireccion"
                    required>
                </div>
              </div>

              <!-- Apoderado -->
              <div class="form-group col-md-4">
                <label for="editarPaciApoderado">Apoderado / Responsable</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user-shield"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    name="editarPaciApoderado"
                    id="editarPaciApoderado">
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

