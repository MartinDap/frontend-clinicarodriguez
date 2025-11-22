<?php
  $token = obtener_token_usuario();
  if ($token !== null){
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
          'Authorization: ' . $token,
          'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $data = json_decode($response, true);

    $responsecategoriaactivos = curl_exec($curl);
  }
  

?>
<div class="container-fluid">
  
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-diagram-3"></i> Gestión de Áreas</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarArea">
      <i class="bi bi-plus-circle"></i> Nueva Área
    </button>
  </div>

  <div class="container-fluid">
  <div class="accordion" id="accordionAreas">
    <?php if (isset($data["data"]) && is_array($data["data"])): ?>
      <?php
        // Función recursiva para renderizar acordeones
        function renderAccordion($areas, $nivel = 0, $parentId = 'accordionAreas') {
          foreach ($areas as $index => $area):
            $areaId = $area['areaId'];
            $uniqueId = $parentId . '_' . $areaId;
            $hasChildren = !empty($area["subAreas"]) && is_array($area["subAreas"]);
            
            // Colores según nivel
            $badgeColor = $nivel == 0 ? 'primary' : ($nivel == 1 ? 'info' : 'secondary');
            $headerColor = $nivel == 0 ? 'bg-primary bg-opacity-10' : ($nivel == 1 ? 'bg-info bg-opacity-10' : 'bg-light');
      ?>
        <div class="accordion-item border">
          <h2 class="accordion-header" id="heading<?= $uniqueId ?>">
            <button class="accordion-button collapsed <?= $headerColor ?>" type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#collapse<?= $uniqueId ?>" 
                    aria-expanded="false" 
                    aria-controls="collapse<?= $uniqueId ?>">
              
              <div class="d-flex justify-content-between align-items-center w-100 me-3">
                <div class="d-flex align-items-center gap-3">
                  <?php if ($hasChildren): ?>
                    <i class="bi bi-folder-fill text-warning"></i>
                  <?php else: ?>
                    <i class="bi bi-file-earmark-text text-secondary"></i>
                  <?php endif; ?>
                  
                  <span class="fw-bold"><?= htmlspecialchars($area["areaNombre"]) ?></span>
                  
                  <span class="badge bg-<?= $badgeColor ?>">
                    Nivel <?= $nivel ?>
                  </span>
                  
                  <?php if ($hasChildren): ?>
                    <span class="badge bg-secondary">
                      <?= count($area["subAreas"]) ?> sub-área(s)
                    </span>
                  <?php endif; ?>
                </div>
              </div>
            </button>
          </h2>
          
          <div id="collapse<?= $uniqueId ?>" 
               class="accordion-collapse collapse" 
               aria-labelledby="heading<?= $uniqueId ?>" 
               data-bs-parent="#<?= $parentId ?>">
            <div class="accordion-body">
              <!-- Información del área -->
              <div class="card mb-3 border-0 bg-light">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-md-8">
                      <p class="mb-1">
                        <strong><i class="bi bi-info-circle"></i> ID:</strong> 
                        <?= $area['areaId'] ?>
                      </p>
                      <p class="mb-0">
                        <strong><i class="bi bi-diagram-3"></i> Nivel jerárquico:</strong> 
                        Nivel <?= $nivel ?>
                      </p>
                    </div>
                    <div class="col-md-4 text-end">
                      <div class="btn-group" role="group">
                        <button type="button" 
                                class="btn btn-info btn-sm btnVerArea" 
                                areaId="<?= $area['areaId'] ?>" 
                                title="Ver área">
                          <i class="bi bi-eye"></i> Ver
                        </button>
                        <button class="btn btn-warning btn-sm btnEditarArea" 
                                areaId="<?= $area["areaId"] ?>" 
                                title="Editar área">
                          <i class="bi bi-pencil"></i> Editar
                        </button>
                        <button class="btn btn-danger btn-sm btnEliminarArea" 
                                areaId="<?= $area["areaId"] ?>" 
                                title="Eliminar área">
                          <i class="bi bi-trash"></i> Eliminar
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Subáreas anidadas -->
              <?php if ($hasChildren): ?>
                <div class="ms-4 border-start border-3 border-primary ps-3">
                  <h6 class="text-muted mb-3">
                    <i class="bi bi-arrow-return-right"></i> Sub-áreas de "<?= htmlspecialchars($area["areaNombre"]) ?>"
                  </h6>
                  <div class="accordion" id="<?= $uniqueId ?>">
                    <?php renderAccordion($area["subAreas"], $nivel + 1, $uniqueId); ?>
                  </div>
                </div>
              <?php else: ?>
                <div class="alert alert-info mb-0" role="alert">
                  <i class="bi bi-info-circle"></i> Esta área no tiene sub-áreas.
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php
          endforeach;
        }
        
        renderAccordion($data["data"], 0);
      ?>
    <?php else: ?>
      <div class="alert alert-warning text-center" role="alert">
        <i class="bi bi-exclamation-triangle"></i> No hay áreas registradas
      </div>
    <?php endif; ?>
  </div>
</div>

<style>
  .accordion-button:not(.collapsed) {
    font-weight: 600;
  }
  
  .accordion-button::after {
    flex-shrink: 0;
  }
  
  .accordion-item {
    margin-bottom: 0.5rem;
    border-radius: 0.375rem !important;
    overflow: hidden;
  }
  
  .accordion-body {
    padding: 1.25rem;
  }
  
  /* Animación suave */
  .accordion-collapse {
    transition: all 0.3s ease-in-out;
  }
  
  /* Hover effect en botones */
  .accordion-button:hover {
    background-color: rgba(0, 0, 0, 0.05);
  }
</style>
  
  
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