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

  $responseusuarios = curl_exec($curl);

  curl_close($curl);
  $dataUsuarios = json_decode($responseusuarios, true);

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
          <th>Talla</th>
          <th>Peso</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (isset($data["data"]) && is_array($data["data"])): ?>
          <?php foreach ($data["data"] as $key => $item): ?>
            <tr>
              <td><?= ($key + 1) ?></td>
              <td><?= htmlspecialchars($item["paciente"]["paciNombrecompleto"]) ?></td>
              <td><?= htmlspecialchars($item["usuario"]["usuaNombrecompleto"]) ?></td>
              <td><?= htmlspecialchars(date("d/m/Y H:i", strtotime($item["histFecha"]))) ?></td>
              <td><?= htmlspecialchars($item["histTalle"]) ?> m</td>
              <td><?= htmlspecialchars($item["histPeso"]) ?> kg</td>
              <td>
                <button class="btn btn-sm btn-info btnVerHistoria me-1" histId="<?= $item["histId"] ?>" title="Ver historia">
                  <i class="bi bi-eye"></i>
                </button>
                <button class="btn btn-sm btn-warning btnEditarHistoria me-1" histId="<?= $item["histId"] ?>" title="Editar historia">
                  <i class="bi bi-pencil"></i>
                </button>
                <button class="btn btn-sm btn-danger btnEliminarHistoria" histId="<?= $item["histId"] ?>" title="Eliminar historia">
                  <i class="bi bi-trash"></i>
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
              <?php foreach ($dataUsuarios["data"] as $doctor): ?>
                <option value="<?= $doctor["usuaId"] ?>"><?= $doctor["usuaNombrecompleto"] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Paciente -->
          <div class="form-group mb-3">
            <label for="pacienteId">Paciente</label>
            <select class="form-control" name="pacienteId" id="pacienteId" required>
              <option value="">Seleccione un paciente...</option>
              <?php foreach ($dataPacientes["data"] as $paciente): ?>
                <option value="<?= $paciente["paciId"] ?>"><?= $paciente["paciNombrecompleto"] ?></option>
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

          <!-- Talla -->
          <div class="form-group mb-3">
            <label for="histTalle">Talla</label>
            <input type="number" class="form-control" id="histTalle" name="histTalle" step="0.01" required>
          </div>

          <!-- Peso -->
          <div class="form-group mb-3">
            <label for="histPeso">Peso (kg)</label>
            <input type="number" class="form-control" id="histPeso" name="histPeso" step="0.01" required>
          </div>

          <!-- Temperatura -->
          <div class="form-group mb-3">
            <label for="histTemperaturaC">Temperatura (°C)</label>
            <input type="number" class="form-control" id="histTemperaturaC" name="histTemperaturaC" step="0.01" required>
          </div>

          <!-- Frecuencia Cardiaca -->
          <div class="form-group mb-3">
            <label for="histFrecCardiaca">Frecuencia Cardíaca (lpm)</label>
            <input type="number" class="form-control" id="histFrecCardiaca" name="histFrecCardiaca" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Guardar historia</button>
        </div>
      </form>
    </div>
  </div>
</div>



