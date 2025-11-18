<?php

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => API_BASE_URL . 'areas',
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

  $responsecategoriaactivos = curl_exec($curl);

?>
<div class="container-fluid">
  
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-diagram-3"></i> Gestión de Áreas</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarArea">
      <i class="bi bi-plus-circle"></i> Nueva Área
    </button>
  </div>
  
  <div class="table-container">
    <table id="tablaAreas" class="table table-striped table-hover align-middle">
      <thead class="table-light">
        <tr>
          <th>#</th>
          <th>Área</th>
          <th>Padre</th>
          <th>Nivel</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (isset($data["data"]) && is_array($data["data"])): ?>
          <?php
            // Función recursiva para recorrer subáreas
            function renderAreas($areas, $nivel = 0, &$contador = 1, $padre = '—') {
              foreach ($areas as $area):
          ?>
            <tr>
              <td><?= $contador++ ?></td>
              <td><?= str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $nivel) ?><?= htmlspecialchars($area["areaNombre"]) ?></td>
              <td><?= htmlspecialchars($padre) ?></td>
              <td>
                <span class="badge bg-<?= $nivel == 0 ? 'primary' : ($nivel == 1 ? 'info' : 'secondary') ?>">
                  Nivel <?= $nivel ?>
                </span>
              </td>
              <td>
                <button type="button" class="btn btn-info btn-sm btnVerArea" areaId="<?= $area['areaId'] ?>" title="Ver área">
                  <i class="bi bi-eye"></i>
                </button>
                <button class="btn btn-sm btn-warning btnEditarArea me-1" areaId="<?= $area["areaId"] ?>" title="Editar área">
                  <i class="bi bi-pencil"></i>
                </button>
                <button class="btn btn-sm btn-danger btnEliminarArea" areaId="<?= $area["areaId"] ?>" title="Eliminar área">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>
          <?php
                // Si existen subáreas, se vuelve a recorrer
                if (!empty($area["subAreas"]) && is_array($area["subAreas"])) {
                  renderAreas($area["subAreas"], $nivel + 1, $contador, $area["areaNombre"]);
                }
              endforeach;
            }

            $contador = 1;
            renderAreas($data["data"], 0, $contador);
          ?>
        <?php else: ?>
          <tr>
            <td colspan="6" class="text-center">No hay áreas registradas</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <!--=====================================
MODAL AGREGAR ÁREA
======================================-->
<div id="modalAgregarArea" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" id="formRegistrarArea" method="post">

        <!-- CABECERA -->
        <div class="modal-header" style="background:#003264; color:white">
          <h4 class="modal-title">Registrar Área de Organigrama</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- CUERPO -->
        <div class="modal-body">
          <div class="box-body">

            <!-- Nombre del área -->
            <div class="form-group mb-3">
              <label for="areaNombre">Nombre del Área</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-building"></i></span>
                <input type="text" class="form-control" name="areaNombre" id="areaNombre" placeholder="Ej: Área de Tecnología e Información" required>
              </div>
            </div>

            <!-- Descripción -->
            <div class="form-group mb-3">
              <label for="areaDescripcion">Descripción</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                <textarea class="form-control" name="areaDescripcion" id="areaDescripcion" rows="2" placeholder="Ej: Responsable de los sistemas, redes y soporte."></textarea>
              </div>
            </div>

            <!-- Área Padre -->
            <div class="form-group mb-3">
              <label for="areaPadreId">Área Padre (opcional)</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-diagram-2"></i></span>
                <select class="form-control" name="areaPadreId" id="areaPadreId">
                  <option value="">Sin área padre (Nivel 0)</option>
                  <?php
                    // Helper recursivo para opciones del select
                    if (isset($data["data"]) && is_array($data["data"])) {

                      function renderAreaOptions($areas, $nivel = 0) {
                        foreach ($areas as $area) {
                          $indent = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $nivel);
                          echo '<option value="' . htmlspecialchars($area["areaId"]) . '">'
                                . $indent . htmlspecialchars($area["areaNombre"]) .
                               '</option>';
                          if (!empty($area["subAreas"]) && is_array($area["subAreas"])) {
                            renderAreaOptions($area["subAreas"], $nivel + 1);
                          }
                        }
                      }

                      renderAreaOptions($data["data"]);
                    } else {
                      echo '<option value="">No hay áreas registradas aún</option>';
                    }
                  ?>
                </select>
              </div>
              <small class="form-text text-muted">
                Si eliges un área padre, esta nueva área quedará debajo de ella en el organigrama.
              </small>
            </div>

          </div>
        </div>

        <!-- PIE -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar Área</button>
        </div>

      </form>
    </div>
  </div>
</div>


</div>