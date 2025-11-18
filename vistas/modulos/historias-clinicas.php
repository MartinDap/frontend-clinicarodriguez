<?php

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => API_BASE_URL . 'historias',
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

  /* usuarios */
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

    /* paciente */
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

  $responsepaciente = curl_exec($curl);

  curl_close($curl);
  $dataPacientes = json_decode($responsepaciente, true);
?>

<div class="container-fluid">
  
  <!-- Encabezado -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-journal-medical"></i> Gestión de Historias Clinicas</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRegistrarHistoria">
      <i class="bi bi-plus-circle"></i> Registrar historia
    </button>
  </div>

  <!-- Tabla de Historias Cl├¡nicas -->
  <div class="table-container">
    <table id="tablaHistorias" class="table table-striped table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Paciente</th>
          <th>Doctor</th>
          <th>Fecha</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (isset($data["data"]) && is_array($data["data"])): ?>
          <?php foreach ($data["data"] as $key => $item): ?>
            <tr>
              <td><?= ($key + 1) ?></td>
              <td><?= htmlspecialchars($item["paciente"]["persona"]["persNombrecompleto"]) ?></td>
              <td><?= htmlspecialchars($item["usuario"]["persona"]["persNombrecompleto"]) ?></td>
              <td><?= htmlspecialchars(date("d/m/Y", strtotime($item["histRegistrofecha"]))) ?></td>
              <td>
                <button class="btn btn-sm btn-info btnVerHistoria me-1" histId="<?= $item["histId"] ?>" title="Ver historia">
                  <i class="bi bi-eye"></i>  Detalle
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="9" class="text-center">No hay historias registradas</td>
          </tr>
        <?php endif; ?>
      </tbody>


    </table>
  </div>

</div>

<!-- Modal para registrar historia clinica -->
 <div class="modal fade" id="modalRegistrarHistoria" tabindex="-1" aria-labelledby="modalRegistrarHistoriaLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="formRegistrarHistoria">
        <div class="modal-header">
          <h5 class="modal-title" id="modalRegistrarHistoriaLabel">Registrar Historia Clínica</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>

        <div class="modal-body">
          <!-- Doctor -->
          <div class="form-group mb-3">
            <label for="doctorId">Doctor</label>
            <select class="form-control" name="doctorId" id="doctorId" required>
              <option value="">Seleccione un doctor...</option>
              <?php foreach ($dataMedicos["data"] as $doctor): ?>
                <option value="<?= $doctor["usuario"]["usuaId"] ?>"><?= $doctor["mediNombre"] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Paciente: búsqueda por DNI -->
          <div class="form-group mb-3">
            <label for="inputDniPaciente">Paciente (buscar por DNI)</label>

            <!-- Contenedor relativo para manejar bien el dropdown -->
            <div class="position-relative">
              <!-- DNI del paciente -->
              <input
                type="text"
                class="form-control mb-2"
                id="inputDniPaciente"
                name="inputDniPaciente"
                placeholder="Escriba el DNI del paciente..."
                autocomplete="off">

              <!-- Lista de sugerencias (se llenará por JS) -->
              <div
                id="dniSuggestions"
                class="list-group"
                style="position:absolute; z-index:1050; width:100%; max-height:200px; overflow-y:auto;">
                <!-- Aquí se insertan las opciones con JS -->
              </div>
            </div>

            <!-- Nombre del paciente (solo lectura) -->
            <label for="inputNombrePaciente" class="mt-2">Nombre del paciente</label>
            <input
              type="text"
              class="form-control"
              id="inputNombrePaciente"
              name="inputNombrePaciente"
              placeholder="Nombre del paciente"
              readonly>

            <!-- ID del paciente (oculto, este se envía al backend) -->
            <input type="hidden" id="inputPaciId" name="pacienteId">
          </div>

          <!-- Número de Historia -->
          <div class="form-group mb-3">
            <label for="histNumHistoria">Número de Historia</label>
            <input type="number" class="form-control" id="histNumHistoria" name="histNumHistoria" required>
          </div>

          <!-- Fecha -->
          <div class="form-group mb-3">
            <label for="histFecha">Fecha</label>
            <input type="date" class="form-control" id="histFecha" name="histFecha" required>
          </div>

        </div> <!-- /.modal-body -->

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Guardar historia</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalRegistrarHistoria2" tabindex="-1" aria-labelledby="modalRegistrarHistoriaLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="formRegistrarHistoria">
        <div class="modal-header">
          <h5 class="modal-title" id="modalRegistrarHistoriaLabel">Registrar Historia Clínica</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>

        <div class="modal-body">
          <!-- Doctor -->
          <div class="form-group mb-3">
            <label for="doctorId">Doctor</label>
            <select class="form-control" name="doctorId" id="doctorId" required>
              <option value="">Seleccione un doctor...</option>
              <?php foreach ($dataMedicos["data"] as $doctor): ?>
                <option value="<?= $doctor["usuario"]["usuaId"] ?>"><?= $doctor["mediNombre"] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Paciente -->
          <div class="form-group mb-3">
            <label for="pacienteId">Paciente</label>
            <select class="form-control" name="pacienteId" id="pacienteId" required>
              <option value="">Seleccione un paciente...</option>
              <?php foreach ($dataPacientes["data"] as $paciente): ?>
                <option value="<?= $paciente["paciId"] ?>"><?= $paciente["persona"]["persNombrecompleto"] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Número de Historia -->
          <div class="form-group mb-3">
            <label for="histNumHistoria">Número de Historia</label>
            <input type="number" class="form-control" id="histNumHistoria" name="histNumHistoria" required>
          </div>

          <!-- Fecha -->
          <div class="form-group mb-3">
            <label for="histFecha">Fecha</label>
            <input type="date" class="form-control" id="histFecha" name="histFecha" required>
          </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Guardar historia</button>
        </div>
      </form>
    </div>
  </div>
</div>



