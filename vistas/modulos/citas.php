<?php

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => API_BASE_URL . 'citas',
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

  /* USUARIO */
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
      API_AUTH_HEADER
    ),
  ));

  $responseusuario = curl_exec($curl);

  curl_close($curl);
  $dataUsuario = json_decode($responseusuario, true);

    /* PACIENTE */
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => API_BASE_URL . 'pacientes',
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

  $responsepacientes = curl_exec($curl);

  curl_close($curl);
  $dataPacientes = json_decode($responsepacientes, true);


?>
<div class="container-fluid">
  
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-calendar-check"></i> Gestión de Citas</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRegistrarCita">
      <i class="bi bi-plus-circle"></i> Registrar cita
    </button>
  </div>
  
  <div class="table-container">
    <table id="tablaCitas" class="table table-striped table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Paciente</th>
          <th>Doctor</th>
          <th>Especialidad</th>
          <th>Fecha</th>
          <th>Hora</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (isset($data["data"]) && is_array($data["data"])): ?>
          <?php foreach($data["data"] as $key => $item): ?>
            <tr>
              <td><?= ($key + 1) ?></td>
              <td>
                <?= htmlspecialchars($item["paciente"]["persona"]["persNombrecompleto"]) ?><br>
                <small class="text-muted">DNI: <?= htmlspecialchars($item["paciente"]["persona"]["persNroDoc"]) ?></small>
              </td>
              <td>
                <?= htmlspecialchars($item["medico"]["persona"]["persNombrecompleto"]) ?><br>
              </td>
              <td><?= htmlspecialchars($item["citaTipo"]) ?></td>
              <td><?= htmlspecialchars($item["citaFecha"]) ?></td>
              <td><?= htmlspecialchars(substr($item["citaHora"], 0, 5)) ?></td> <!-- Muestra solo HH:MM -->
              <td>
                <span class="badge 
                  <?= $item["citaEstado"] == 'RESERVADO POR PACIENTE' ? 'bg-primary' : '' ?>
                  <?= $item["citaEstado"] == 'CONFIRMADO' ? 'bg-success' : '' ?>
                  <?= $item["citaEstado"] == 'ATENDIDO' ? 'bg-success' : '' ?>
                  <?= $item["citaEstado"] == 'CANCELADO' ? 'bg-danger' : '' ?>
                  <?= $item["citaEstado"] == 'COMPLETADA' ? 'bg-secondary' : '' ?>
                  <?= $item["citaEstado"] == 'PENDIENTE' ? 'bg-warning' : '' ?>
                  <?= $item["citaEstado"] == 'NO ASISTIÓ' ? 'bg-danger' : '' ?>">
                 
                  <?= htmlspecialchars($item["citaEstado"]) ?>
                </span>
              </td>
              <td>
                <button class="btn btn-sm btn-warning btnEditarCita" citaId="<?= $item["citaId"] ?>">
                  <i class="bi bi-pencil"></i>
                </button>
                <button class="btn btn-sm btn-danger btnEliminarCita" citaId="<?= $item["citaId"] ?>">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="8" class="text-center">No hay citas registradas</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  
</div>


<!--=====================================
MODAL REGISTRAR CITA
======================================-->
<div id="modalRegistrarCita" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <form role="form" id="formRegistrarCita" method="post">
        <div class="modal-header" style="background:#003264; color:white">
          <h4 class="modal-title">Registrar Cita</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="box-body">
            <!-- Doctor -->
            <div class="form-group mb-3">
              <label for="doctorId">Seleccionar Doctor</label>
              <select class="form-control" name="doctorId" id="doctorId" required>
                <option value="">Seleccione un doctor...</option>
                <?php foreach ($dataUsuario["data"] as $doctor): ?>
                  <option value="<?= $doctor["usuaId"] ?>"><?= $doctor["usuaNombrecompleto"] ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <!-- Paciente -->
            <div class="form-group mb-3">
              <label for="pacienteId">Seleccionar Paciente</label>
              <select class="form-control" name="pacienteId" id="pacienteId" required>
                <option value="">Seleccione un paciente...</option>
                <?php foreach ($dataPacientes["data"] as $paciente): ?>
                  <option value="<?= $paciente["paciId"] ?>"><?= $paciente["paciNombrecompleto"] ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <!-- Fecha -->
            <div class="form-group mb-3">
              <label for="fecha">Fecha de cita</label>
              <input type="date" class="form-control" name="fecha" id="fecha" required>
            </div>

            <!-- Hora -->
            <div class="form-group mb-3">
              <label for="hora">Hora</label>
              <input type="time" class="form-control" name="hora" id="hora" required>
            </div>

            <!-- Estado -->
            <div class="form-group mb-3">
              <label for="estado">Estado</label>
              <select class="form-control" name="estado" id="estado" required>
                <option value="1">Activa</option>
                <option value="0">Cancelada</option>
              </select>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar Cita</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--=====================================
MODAL EDITAR CITA
======================================-->
<div id="modalEditarCita" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" id="formEditarCita" method="post">

        <!--=====================================
        CABECERA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#003264; color:white">
          <h4 class="modal-title">Detalle y Estado de Cita</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">

            <!-- IDs ocultos -->
            <input type="hidden" name="citaId" id="editarCitaId">
            <input type="hidden" name="paciId" id="editarCitaPaciId">
            <input type="hidden" name="mediId" id="editarCitaMediId">

            <!-- Información del paciente -->
            <div class="row">
              <div class="form-group col-md-8">
                <label for="editarCitaPacienteNombre">Paciente</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    id="editarCitaPacienteNombre"
                    name="editarCitaPacienteNombre"
                    readonly>
                </div>
              </div>

              <div class="form-group col-md-4">
                <label for="editarCitaPacienteDoc">Documento</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    id="editarCitaPacienteDoc"
                    name="editarCitaPacienteDoc"
                    readonly>
                </div>
              </div>
            </div>

            <!-- Información del médico -->
            <div class="row">
              <div class="form-group col-md-8">
                <label for="editarCitaMedicoNombre">Médico</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user-md"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    id="editarCitaMedicoNombre"
                    name="editarCitaMedicoNombre"
                    readonly>
                </div>
              </div>

              <div class="form-group col-md-4">
                <label for="editarCitaMedicoColegiatura">N° Colegiatura</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-certificate"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    id="editarCitaMedicoColegiatura"
                    name="editarCitaMedicoColegiatura"
                    readonly>
                </div>
              </div>
            </div>

            <!-- Fecha y hora -->
            <div class="row">
              <div class="form-group col-md-4">
                <label for="editarCitaFecha">Fecha de la cita</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input
                    type="date"
                    class="form-control input-lg"
                    id="editarCitaFecha"
                    name="editarCitaFecha"
                    readonly>
                </div>
              </div>

              <div class="form-group col-md-4">
                <label for="editarCitaHoraInicio">Hora inicio</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                  <input
                    type="time"
                    class="form-control input-lg"
                    id="editarCitaHoraInicio"
                    name="editarCitaHoraInicio"
                    readonly>
                </div>
              </div>

              <div class="form-group col-md-4">
                <label for="editarCitaHoraFin">Hora fin</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                  <input
                    type="time"
                    class="form-control input-lg"
                    id="editarCitaHoraFin"
                    name="editarCitaHoraFin"
                    readonly>
                </div>
              </div>
            </div>

            <!-- Tipo de cita y motivo -->
            <div class="row">
              <div class="form-group col-md-6">
                <label for="editarCitaTipo">Tipo de cita</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-stethoscope"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    id="editarCitaTipo"
                    name="editarCitaTipo"
                    readonly>
                </div>
              </div>

              <div class="form-group col-md-6">
                <label for="editarCitaFechaRegistro">Fecha de registro</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></span>
                  <input
                    type="date"
                    class="form-control input-lg"
                    id="editarCitaFechaRegistro"
                    name="editarCitaFechaRegistro"
                    readonly>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Motivo de consulta -->
              <div class="form-group col-md-12">
                <label for="editarCitaMotivo">Motivo de la consulta</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                  <textarea
                    class="form-control input-lg"
                    id="editarCitaMotivo"
                    name="editarCitaMotivo"
                    rows="3"
                    readonly></textarea>
                </div>
              </div>
            </div>

            <!-- Estado de la cita  -->
            <div class="row">
              <div class="form-group col-md-6">
                <label for="editarCitaEstado">Estado de la cita</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-flag"></i></span>
                  <select
                    class="form-control input-lg"
                    id="editarCitaEstado"
                    name="editarCitaEstado"
                    required>
                    <option value="">Seleccionar...</option>
                    <option value="RESERVADO POR PACIENTE">Reservado por paciente</option>
                    <option value="CONFIRMADO">Confirmado</option>
                    <option value="ATENDIDO">Atendido</option>
                    <option value="NO ASISTIÓ">No asistió</option>
                    <option value="CANCELADO">Cancelado</option>
                  </select>
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
          <button type="submit" class="btn btn-success">Actualizar estado</button>
        </div>

      </form>

    </div>

  </div>
</div>

