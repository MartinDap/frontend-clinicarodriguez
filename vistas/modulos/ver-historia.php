<?php
// Verificar que se reciba el ID
if(!isset($_GET['histId'])) {
    header('Location: ?ruta=historias-clinicas');
    exit;
}

$histId = $_GET['histId'];

// Obtener datos de la historia desde la API
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => API_BASE_URL . 'historias/' . $histId,
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

$historia = json_decode($response, true);

$data = $historia['data'];

 /* DOCUMENTOS */
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => API_BASE_URL . 'documentos/historia/' . $histId,
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

  $responsedocumentos = curl_exec($curl);

  curl_close($curl);
  $dataDocumentos = json_decode($responsedocumentos, true);

?>

<div class="container-fluid">
  
  <!-- Botón para volver -->
  <div class="mb-4">
    <a href="?ruta=historias-clinicas" class="btn btn-secondary">
      <i class="bi bi-arrow-left"></i> Volver a Historias Clínicas
    </a>
  </div>

  <!-- Título -->
  <div class="card mb-4">
    <div class="card-header bg-primary text-white">
      <h3 class="mb-0">
        <i class="bi bi-journal-medical"></i> 
        Historia Clínica #<?= htmlspecialchars($data['histId']) ?>
      </h3>
    </div>
  </div>

  <div class="row">
    
    <!-- Información del Paciente -->
    <div class="col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header bg-info text-white">
          <h5 class="mb-0"><i class="bi bi-person"></i> Información del Paciente</h5>
        </div>
        <div class="card-body">
          <table class="table table-borderless">
            <tr>
              <th width="40%">Nombre:</th>
              <td><?= htmlspecialchars($data['paciente']['paciNombrecompleto']) ?></td>
            </tr>
            <tr>
              <th>DNI:</th>
              <td><?= htmlspecialchars($data['paciente']['paciDni']) ?></td>
            </tr>
            <tr>
              <th>Fecha de nacimiento:</th>
              <td><?= htmlspecialchars($data['paciente']['paciFecNacimiento']) ?></td>
            </tr>
            <tr>
              <th>Sexo:</th>
              <td><?= htmlspecialchars($data['paciente']['paciSexo']) ?></td>
            </tr>
            <tr>
              <th>Teléfono:</th>
              <td><?= htmlspecialchars($data['paciente']['paciTelefono']) ?></td>
            </tr>
            <tr>
              <th>Email:</th>
              <td><?= htmlspecialchars($data['paciente']['paciEmail']) ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>

    <!-- Información del Doctor -->
    <div class="col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-header bg-success text-white">
          <h5 class="mb-0"><i class="bi bi-person-badge"></i> Médico Tratante</h5>
        </div>
        <div class="card-body">
          <table class="table table-borderless">
            <tr>
              <th width="40%">Nombre:</th>
              <td><?= htmlspecialchars($data['usuario']['usuaNombrecompleto']) ?></td>
            </tr>
            <tr>
              <th>Fecha de Consulta:</th>
              <td><?= date('d/m/Y', strtotime($data['histFecha'])) ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>

  </div>

  <!-- Detalles de la Historia Clínica -->
  <div class="row">
    <!-- Documentos del Paciente -->
    <div class="col-12 mb-4">
      <div class="card shadow-sm">
        
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
          <h5 class="mb-0">
            <i class="bi bi-folder2-open"></i> Documentos del Paciente
          </h5>
          <button class="btn btn-light btn-sm" id="btnSubirDocumento" data-bs-toggle="modal" data-bs-target="#modalSubirDocumento">
            <i class="bi bi-upload"></i> Subir Documento
          </button>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped align-middle">
              <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Nombre del Documento</th>
                  <th>Tipo</th>
                  <th>Fecha de Subida</th>
                  <th>Acciones</th>
                </tr>
              </thead>

              <tbody id="tablaDocumentosPaciente">
                <?php if (!empty($dataDocumentos['data']) && is_array($dataDocumentos['data'])): ?>
                  <?php foreach ($dataDocumentos['data'] as $index => $doc): ?>
                    <tr>
                      <td><?= (int)$index + 1 ?></td>
                      <td><?= htmlspecialchars($doc['docuNombre']) ?></td>
                      <td><?= htmlspecialchars($doc['docuTipo']) ?></td>
                      <td><?= date("Y-m-d H:i", strtotime($doc['docuFechaSubida'])) ?></td>
                      <td>
                        <a href="<?= htmlspecialchars($doc['docuUrl']) ?>" target="_blank" class="btn btn-sm btn-primary" title="Ver documento">
                          <i class="bi bi-eye"></i>
                        </a>

                        <button class="btn btn-sm btn-danger btnEliminarDocumento" docuId="<?= $doc['docuId'] ?>" title="Eliminar documento">
                          <i class="bi bi-trash"></i>
                        </button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="5" class="text-center text-muted">No hay documentos registrados</td>
                  </tr>
                <?php endif; ?>
              </tbody>


            </table>

          </div>
        </div>

      </div>
    </div>

    <!-- Observaciones (si existen) -->
    <?php if(isset($data['histObservaciones']) && !empty($data['histObservaciones'])): ?>
    <div class="col-12 mb-4">
      <div class="card">
        <div class="card-header bg-secondary text-white">
          <h5 class="mb-0"><i class="bi bi-chat-left-text"></i> Observaciones</h5>
        </div>
        <div class="card-body">
          <p class="mb-0"><?= nl2br(htmlspecialchars($data['histObservaciones'])) ?></p>
        </div>
      </div>
    </div>
    <?php endif; ?>

  </div>

  <!-- Botones de Acción -->
  <div class="card mb-4">
    <div class="card-body text-center">
      <a href="?ruta=historias-clinicas" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Volver
      </a>
    </div>
  </div>

</div>

<!-- Modal Subir Documento -->
<div class="modal fade" id="modalSubirDocumento" tabindex="-1" aria-labelledby="modalSubirDocumentoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="modalSubirDocumentoLabel">
          <i class="bi bi-upload"></i> Subir Documento del Paciente
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      
      <form id="formSubirDocumento" enctype="multipart/form-data">
        <div class="modal-body">
          
          <!-- Campo oculto para almacenar el histId -->
          <input type="hidden" name="histId" id="histId" value="<?= htmlspecialchars($data['histId'] ?? '') ?>">

          <!-- Nombre del documento -->
          <div class="mb-3">
            <label for="docNombre" class="form-label">Nombre del Documento</label>
            <input type="text" class="form-control" name="docNombre" id="docNombre" required>
          </div>

          <!-- Archivo del documento -->
          <div class="mb-3">
            <label for="docArchivo" class="form-label">Archivo</label>
            <input type="file" class="form-control" name="docArchivo" id="docArchivo" accept=".pdf,.jpg,.jpeg,.png" required>
            <div class="form-text">Formatos permitidos: PDF, JPG, PNG.</div>
          </div>

          <!-- Tipo de documento -->
          <div class="mb-3">
            <label for="docTipo" class="form-label">Tipo de Documento</label>
            <select class="form-control" name="docTipo" id="docTipo" required>
              <option value="">Seleccione un tipo de documento...</option>
              <option value="informe_medico">Informe Médico</option>
              <option value="examen_laboratorio">Exámenes de Laboratorio</option>
              <option value="imagenes_medicas">Imágenes Médicas</option>
              <option value="receta_medica">Receta Médica</option>
              <option value="consentimiento_informado">Consentimiento Informado</option>
              <option value="historial_consultas">Historial de Consultas</option>
              <option value="informe_quirurgico">Informe Quirúrgico</option>
              <option value="resultados_pruebas">Resultados de Pruebas</option>
              <option value="hoja_seguimiento">Hoja de Seguimiento</option>
              <option value="referencia_medica">Referencia Médica</option>
              <option value="plan_tratamiento">Plan de Tratamiento</option>
              <option value="informe_psicologia">Informe de Psicología</option>
              <option value="informe_fisioterapia">Informe de Fisioterapia</option>
              <option value="historia_vacunacion">Historia de Vacunación</option>
            </select>
          </div>


          <!-- Visibilidad para el paciente -->
          <div class="mb-3">
            <label for="visiblePaciente" class="form-label">Visible al Paciente</label>
            <select class="form-control" name="visiblePaciente" id="visiblePaciente" required>
              <option value="true">Sí</option>
              <option value="false">No</option>
            </select>
          </div>

          <!-- Documento confidencial -->
          <div class="mb-3">
            <label for="confidencial" class="form-label">Confidencial</label>
            <select class="form-control" name="confidencial" id="confidencial" required>
              <option value="true">Sí</option>
              <option value="false">No</option>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">
            <i class="bi bi-cloud-arrow-up"></i> Subir
          </button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>

    </div>
  </div>
</div>




<style>
@media print {
  .btn, .sidebar, .sidebar-toggle, header {
    display: none !important;
  }
}
</style>