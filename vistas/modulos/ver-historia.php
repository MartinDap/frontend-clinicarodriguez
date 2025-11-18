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
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

      <h3 class="mb-0">
        <i class="bi bi-journal-medical"></i> 
        Historia Clínica #<?= htmlspecialchars($data['histId']) ?>
      </h3>

      <button class="btn btn-light btn-sm fw-bold shadow" 
              id="btnIniciarTriajeEpisodio">
        <i class="bi bi-plus-circle"></i> INICIAR ATENCIÓN MÉDICA
      </button>
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
              <td><?= htmlspecialchars($data['paciente']['persona']['persNombrecompleto']) ?></td>
            </tr>
            <tr>
              <th>DNI:</th>
              <td><?= htmlspecialchars($data['paciente']['persona']['persNroDoc']) ?></td>
            </tr>
            <tr>
              <th>Fecha de nacimiento:</th>
              <td><?= htmlspecialchars($data['paciente']['persona']['persFecNacimiento']) ?></td>
            </tr>
            <tr>
              <th>Sexo:</th>
              <td><?= htmlspecialchars($data['paciente']['persona']['persSexo']) ?></td>
            </tr>
            <tr>
              <th>Teléfono:</th>
              <td><?= htmlspecialchars($data['paciente']['persona']['persTelefono']) ?></td>
            </tr>
            <tr>
              <th>Email:</th>
              <td><?= htmlspecialchars($data['paciente']['persona']['persEmail']) ?></td>
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
              <td><?= htmlspecialchars($data['usuario']['persona']['persNombrecompleto']) ?></td>
            </tr>
            <tr>
              <th>Fecha de Consulta:</th>
              <td><?= date('d/m/Y', strtotime($data['histRegistrofecha'])) ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>

  </div>

  <!-- Detalles de la Historia Clínica -->
  <div class="row">
    <!-- Triaje y Episodios Clínicos en una fila -->
    <div class="col-md-6 mb-4">
      <div class="card shadow-sm">
        
        <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
          <h5 class="mb-0">
            <i class="bi bi-file-earmark-medical"></i> Triaje
          </h5>
          <button class="btn btn-light btn-sm" id="btnIniciarTriaje" data-bs-toggle="modal" data-bs-target="#modalIniciarTriaje">
            <i class="bi bi-plus-circle"></i> Iniciar Triaje
          </button>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped align-middle">
              <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Fecha de Triaje</th>
                  <th>Acciones</th>
                </tr>
              </thead>

              <tbody id="tablaTriajesPaciente">
                <?php if (!empty($data['triajes']) && is_array($data['triajes'])): ?>
                  <?php foreach ($data['triajes'] as $index => $triaje): ?>
                    <tr>
                      <td><?= (int)$index + 1 ?></td>
                      <td><?= date("Y-m-d", strtotime($triaje['triaFecha'])) ?></td>
                      <td>
                        <button class="btn btn-sm btn-info btnVerTriaje" triaId="<?= $triaje['triaId'] ?>" title="Ver triaje">
                          <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-danger btnEliminarTriaje" triaId="<?= $triaje['triaId'] ?>" title="Eliminar triaje">
                          <i class="bi bi-trash"></i>
                        </button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="3" class="text-center text-muted">No hay triajes registrados</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>

    <!-- Episodios Clínicos -->
    <div class="col-md-6 mb-4">
      <div class="card shadow-sm">
        
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
          <h5 class="mb-0">
            <i class="bi bi-journal-medical"></i> Episodios Clínicos
          </h5>
          <!-- Botón Agregar Nuevo Episodio -->
          <button class="btn btn-light btn-sm" id="btnAgregarEpisodio" data-bs-toggle="modal" data-bs-target="#modalAgregarEpisodio">
            <i class="bi bi-plus-circle"></i> Agregar Nuevo Episodio
          </button>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped align-middle">
              <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Fecha de Episodio</th>
                  <th>Descripción</th>
                  <th>Acciones</th>
                </tr>
              </thead>

              <tbody id="tablaEpisodiosClinicosPaciente">
                <?php if (!empty($data['episodiosClinicos']) && is_array($data['episodiosClinicos'])): ?>
                  <?php foreach ($data['episodiosClinicos'] as $index => $episodio): ?>
                    <tr>
                      <td><?= (int)$index + 1 ?></td>
                      <td><?= date("Y-m-d H:i", strtotime($episodio['epclFecha'])) ?></td>
                      <td><?= htmlspecialchars($episodio['epclMotivoConsulta']) ?></td>
                      <td>
                        <button class="btn btn-sm btn-info btnVerEpisodio" epclId="<?= $episodio['epclId'] ?>" title="Ver episodio">
                          <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-danger btnEliminarEpisodio" epclId="<?= $episodio['epclId'] ?>" title="Eliminar episodio">
                          <i class="bi bi-trash"></i>
                        </button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="4" class="text-center text-muted">No hay episodios clínicos registrados</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>

  </div>

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
                      <button type="button" class="btn btn-sm btn-primary btnVerDocumento" data-doc-url="<?= htmlspecialchars($doc['docuUrl']) ?>"
                        title="Ver documento">
                        <i class="bi bi-eye"></i>
                      </button>
                      <button class="btn btn-sm btn-warning btnEditarDocumento" docuId="<?= $doc["docuId"] ?>">
                          <i class="bi bi-pencil"></i>
                      </button>

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

</div>

<!-- Modal para Iniciar Triaje -->
<div class="modal fade" id="modalIniciarTriaje" tabindex="-1" aria-labelledby="modalIniciarTriajeLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header bg-warning text-white">
        <h5 class="modal-title" id="modalIniciarTriajeLabel">
          <i class="bi bi-file-earmark-medical"></i> Iniciar Triaje
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <form id="formIniciarTriaje">
        <div class="modal-body">

          <!-- Campo oculto para almacenar el histId -->
          <input type="hidden" name="histId" id="histIdTriaje" value="<?= htmlspecialchars($data['histId'] ?? '') ?>">

          <!-- Fila 1: Fecha, Talla, Peso -->
          <div class="row mb-3">
            <div class="col-md-4">
              <label for="triaFecha" class="form-label">Fecha del Triaje</label>
              <input
                type="date"
                class="form-control"
                name="triaFecha"
                id="triaFecha"
                required
                readonly>
            </div>

            <div class="col-md-4">
              <label for="triaTalla" class="form-label">Talla (m)</label>
              <input
                type="number"
                step="0.01"
                class="form-control"
                name="triaTalla"
                id="triaTalla"
                placeholder="Ej: 1.65"
                required>
            </div>

            <div class="col-md-4">
              <label for="triaPeso" class="form-label">Peso (kg)</label>
              <input
                type="number"
                step="0.1"
                class="form-control"
                name="triaPeso"
                id="triaPeso"
                placeholder="Ej: 65.5"
                required>
            </div>
          </div>

          <!-- Fila 2: Temperatura, Presión arterial, Frec. cardíaca -->
          <div class="row mb-3">
            <div class="col-md-4">
              <label for="triaTemp" class="form-label">Temperatura (°C)</label>
              <input
                type="number"
                step="0.1"
                class="form-control"
                name="triaTemp"
                id="triaTemp"
                placeholder="Ej: 37.2"
                required>
            </div>

            <div class="col-md-4">
              <label for="triaPresion" class="form-label">Presión arterial (mmHg)</label>
              <input
                type="text"
                class="form-control"
                name="triaPresion"
                id="triaPresion"
                placeholder="Ej: 120/80"
                required>
            </div>

            <div class="col-md-4">
              <label for="triaFrecCardiaca" class="form-label">Frecuencia cardíaca (lpm)</label>
              <input
                type="number"
                step="1"
                class="form-control"
                name="triaFrecCardiaca"
                id="triaFrecCardiaca"
                placeholder="Ej: 80"
                required>
            </div>
          </div>

          <!-- Fila 3: Saturación y Estado -->
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="triaSaturacion" class="form-label">Saturación de oxígeno (%)</label>
              <input
                type="number"
                step="0.1"
                class="form-control"
                name="triaSaturacion"
                id="triaSaturacion"
                placeholder="Ej: 97"
                required>
            </div>
          </div>

          <!-- Fila 4: Observaciones -->
          <div class="mb-3">
            <label for="triaObservaciones" class="form-label">Observaciones</label>
            <textarea
              class="form-control"
              name="triaObservaciones"
              id="triaObservaciones"
              rows="3"
              placeholder="Notas adicionales del triaje (opcional)"></textarea>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">
            <i class="bi bi-save"></i> Registrar Triaje
          </button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- Modal para Agregar Nuevo Episodio Clínico -->
<div class="modal fade" id="modalAgregarEpisodio" tabindex="-1" aria-labelledby="modalAgregarEpisodioLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="modalAgregarEpisodioLabel">
          <i class="bi bi-journal-medical"></i> Agregar Nuevo Episodio Clínico
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <form id="formAgregarEpisodio">
        <div class="modal-body">

          <!-- Campo oculto para almacenar el histId -->
          <input type="hidden" name="histId" id="histIdEpisodio" value="<?= htmlspecialchars($data['histId'] ?? '') ?>">

          <!-- Fila 1: Fecha y Tipo -->
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="epclFecha" class="form-label">Fecha del Episodio</label>
              <input type="datetime-local" class="form-control" name="epclFecha" id="epclFecha" required readonly>
            </div>
            <div class="col-md-6">
              <label for="epclTipo" class="form-label">Tipo de Episodio</label>
              <input type="text" class="form-control" name="epclTipo" id="epclTipo" placeholder="Ej: Consulta general, control, emergencia" required>
            </div>
          </div>

          <!-- Fila 2: Motivo de la consulta -->
          <div class="mb-3">
            <label for="epclMotivoConsulta" class="form-label">Motivo de la Consulta</label>
            <textarea class="form-control" name="epclMotivoConsulta" id="epclMotivoConsulta" rows="2" placeholder="Ej: Dolor de cabeza intenso desde hace 3 días" required></textarea>
          </div>

          <!-- Fila 3: Diagnóstico y Tratamiento lado a lado -->
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="epclDiagnostico" class="form-label">Diagnóstico</label>
              <textarea class="form-control" name="epclDiagnostico" id="epclDiagnostico" rows="3" required></textarea>
            </div>
            <div class="col-md-6">
              <label for="epclTratamiento" class="form-label">Tratamiento</label>
              <textarea class="form-control" name="epclTratamiento" id="epclTratamiento" rows="3" required></textarea>
            </div>
          </div>

          <!-- Fila 4: Observaciones (opcional, ancho completo) -->
          <div class="mb-3">
            <label for="epclObservaciones" class="form-label">Observaciones</label>
            <textarea class="form-control" name="epclObservaciones" id="epclObservaciones" rows="2" placeholder="Opcional"></textarea>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-info">
            <i class="bi bi-save"></i> Guardar Episodio
          </button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>

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
                
                <!-- 📋 DOCUMENTOS ESENCIALES (Los más comunes) -->
                <option value="informe_medico">Informe Médico</option>
                <option value="examen_laboratorio">Exámenes de Laboratorio</option>
                <option value="imagenes_medicas">Imágenes Médicas</option>
                <option value="receta_medica">Receta Médica</option>
                <option value="resultados_clinicos">Resultados Clínicos</option>
                
                <!-- 🩺 DOCUMENTOS IMPORTANTES -->
                <option value="historial_consultas">Historial de Consultas</option>
                <option value="consentimiento_informado">Consentimiento Informado</option>
                <option value="plan_tratamiento">Plan de Tratamiento</option>
                
                <!-- 🎯 DOCUMENTOS ESPECIALIZADOS -->
                <option value="informe_quirurgico">Informe Quirúrgico</option>
                <option value="resultados_pruebas">Resultados de Pruebas</option>
                <option value="referencia_medica">Referencia Médica</option>
                <option value="hoja_seguimiento">Hoja de Seguimiento</option>
                
                <!-- 📊 DOCUMENTOS DE ESPECIALIDADES -->
                <option value="informe_psicologia">Informe de Psicología</option>
                <option value="informe_fisioterapia">Informe de Fisioterapia</option>
                <option value="historia_vacunacion">Historia de Vacunación</option>
                
                <!-- ✨ OPCIÓN "OTRO" -->
                <option value="otro">Otro (especificar)</option>
            </select>
          </div>

          <!-- Campo para especificar cuando se selecciona "Otro" -->
          <div class="mb-3" id="campoOtroContainer" style="display: none;">
              <label for="docTipoOtro" class="form-label">Especificar tipo de documento</label>
              <input type="text" class="form-control" name="docTipoOtro" id="docTipoOtro" placeholder="Ej: Certificado médico, Informe de enfermería, etc.">
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

<!-- Modal para editar documento -->
 <!--=====================================
MODAL EDITAR DOCUMENTO
======================================-->
<div id="modalEditarDocumento" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" id="formEditarDocumento" method="post">

        <!--=====================================
        CABECERA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#003264; color:white">
          <h4 class="modal-title">Editar Documento</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">

            <input type="hidden" name="docId" id="editarDocId">
            <input type="hidden" name="docArchivo" id="editarDocArchivo">

            <!-- Información del Documento (Solo Lectura) -->
            <div class="card mb-4">
              <div class="card-header bg-light">
                <h5 class="card-title mb-0">
                  <i class="bi bi-file-text"></i> Información del Documento
                </h5>
              </div>
              <div class="card-body">
                <div class="row">
                  
                  <!-- Nombre del Documento (Solo lectura) -->
                  <div class="form-group col-md-6">
                    <label for="editarDocNombre" class="form-label fw-bold">Nombre del Documento</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bi bi-file-earmark"></i></span>
                      <input
                        type="text"
                        class="form-control"
                        id="editarDocNombre"
                        readonly
                        style="background-color: #f8f9fa; cursor: not-allowed;">
                    </div>
                  </div>

                  <!-- Tipo de Documento (Solo lectura) -->
                  <div class="form-group col-md-6">
                    <label for="editarDocTipo" class="form-label fw-bold">Tipo de Documento</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bi bi-tags"></i></span>
                      <input
                        type="text"
                        class="form-control"
                        id="editarDocTipo"
                        readonly
                        style="background-color: #f8f9fa; cursor: not-allowed;">
                    </div>
                  </div>

                </div>

                <div class="row mt-3">
                  
                  <!-- Archivo PDF (Solo lectura con enlace) -->
                  <div class="form-group col-md-12">
                    <label for="editarDocArchivoLink" class="form-label fw-bold">Archivo</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bi bi-file-pdf"></i></span>
                      <a 
                        href="#" 
                        id="editarDocArchivoLink" 
                        class="form-control text-decoration-none"
                        target="_blank"
                        style="background-color: #f8f9fa; cursor: pointer;">
                        Ver documento actual
                      </a>
                    </div>
                    <small class="form-text text-muted">Haga clic para ver el documento actual</small>
                  </div>

                </div>
              </div>
            </div>

            <!-- Configuración de Acceso (Editables) -->
            <div class="card">
              <div class="card-header bg-light">
                <h5 class="card-title mb-0">
                  <i class="bi bi-shield-lock"></i> Configuración de Acceso
                </h5>
              </div>
              <div class="card-body">
                <div class="row">

                  <!-- Visible para el Paciente -->
                  <div class="form-group col-md-6">
                    <label for="editarVisiblePaciente" class="form-label fw-bold">
                      <i class="bi bi-eye"></i> Visible para el Paciente
                    </label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bi bi-person-check"></i></span>
                      <select
                        class="form-control"
                        name="editarVisiblePaciente"
                        id="editarVisiblePaciente"
                        required>
                        <option value="true">Sí - El paciente puede ver este documento</option>
                        <option value="false">No - Solo personal autorizado</option>
                      </select>
                    </div>
                    <small class="form-text text-muted">
                      Controla si el paciente puede visualizar este documento en su portal
                    </small>
                  </div>

                  <!-- Documento Confidencial -->
                  <div class="form-group col-md-6">
                    <label for="editarConfidencial" class="form-label fw-bold">
                      <i class="bi bi-shield"></i> Documento Confidencial
                    </label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="bi bi-lock"></i></span>
                      <select
                        class="form-control"
                        name="editarConfidencial"
                        id="editarConfidencial"
                        required>
                        <option value="true">Sí - Acceso restringido</option>
                        <option value="false">No - Acceso estándar</option>
                      </select>
                    </div>
                    <small class="form-text text-muted">
                      Los documentos confidenciales requieren permisos especiales
                    </small>
                  </div>

                </div>

                <!-- Indicador de Estado Actual -->
                <div class="row mt-3">
                  <div class="col-12">
                    <div id="estadoActual" class="alert alert-info p-2 small">
                      <i class="bi bi-info-circle"></i> 
                      <span id="textoEstado">Estado actual del documento</span>
                    </div>
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
          <button type="submit" class="btn btn-success">
            <i class="bi bi-check-lg"></i> Guardar Cambios
          </button>
        </div>

      </form>

    </div>

  </div>
</div>

<!-- Modal para ver pdf -->
<div class="modal fade" id="modalVerDocumento" tabindex="-1" aria-labelledby="modalVerDocumentoLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalVerDocumentoLabel">
          <i class="bi bi-file-earmark-pdf"></i> Ver Documento
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body p-0">
        <iframe
          id="iframeDocumento"
          src=""
          style="width:100%; height:80vh; border:none;"
        ></iframe>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

<!-- Modal para ver Triaje -->
 <div class="modal fade" id="modalVerTriaje" tabindex="-1" aria-labelledby="modalVerTriajeLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header bg-warning text-white">
        <h5 class="modal-title" id="modalVerTriajeLabel">
          <i class="bi bi-file-earmark-medical"></i> Detalle de Triaje
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body">

        <!-- Campo oculto para almacenar el triaId -->
        <input type="hidden" id="verTriaId">

        <!-- Fila 1: Fecha, Talla, Peso -->
        <div class="row mb-3">
          <div class="col-md-4">
            <label for="verTriaFecha" class="form-label">Fecha del Triaje</label>
            <input
              type="date"
              class="form-control"
              id="verTriaFecha"
              readonly>
          </div>

          <div class="col-md-4">
            <label for="verTriaTalla" class="form-label">Talla (m)</label>
            <input
              type="number"
              step="0.01"
              class="form-control"
              id="verTriaTalla"
              readonly>
          </div>

          <div class="col-md-4">
            <label for="verTriaPeso" class="form-label">Peso (kg)</label>
            <input
              type="number"
              step="0.1"
              class="form-control"
              id="verTriaPeso"
              readonly>
          </div>
        </div>

        <!-- Fila 2: Temperatura, Presión arterial, Frec. cardíaca -->
        <div class="row mb-3">
          <div class="col-md-4">
            <label for="verTriaTemp" class="form-label">Temperatura (°C)</label>
            <input
              type="number"
              step="0.1"
              class="form-control"
              id="verTriaTemp"
              readonly>
          </div>

          <div class="col-md-4">
            <label for="verTriaPresion" class="form-label">Presión arterial (mmHg)</label>
            <input
              type="text"
              class="form-control"
              id="verTriaPresion"
              readonly>
          </div>

          <div class="col-md-4">
            <label for="verTriaFrecCardiaca" class="form-label">Frecuencia cardíaca (lpm)</label>
            <input
              type="number"
              class="form-control"
              id="verTriaFrecCardiaca"
              readonly>
          </div>
        </div>

        <!-- Fila 3: Saturación y Estado -->
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="verTriaSaturacion" class="form-label">Saturación de oxígeno (%)</label>
            <input
              type="number"
              step="0.1"
              class="form-control"
              id="verTriaSaturacion"
              readonly>
          </div>
        </div>

        <!-- Fila 4: Observaciones -->
        <div class="mb-3">
          <label for="verTriaObservaciones" class="form-label">Observaciones</label>
          <textarea
            class="form-control"
            id="verTriaObservaciones"
            rows="3"
            readonly></textarea>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Cerrar
        </button>
      </div>

    </div>
  </div>
</div>

<!-- Modal para ver Episodio Clínico -->
  <div class="modal fade" id="modalVerEpisodio" tabindex="-1" aria-labelledby="modalVerEpisodioLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="modalVerEpisodioLabel">
          <i class="bi bi-journal-medical"></i> Detalle de Episodio Clínico
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>

      <div class="modal-body">

        <!-- Campo oculto para almacenar el epclId -->
        <input type="hidden" id="verEpclId">

        <!-- Fila 1: Fecha, Tipo -->
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="verEpclFecha" class="form-label">Fecha del Episodio</label>
            <input
              type="text"
              class="form-control"
              id="verEpclFecha"
              readonly>
          </div>

          <div class="col-md-6">
            <label for="verEpclTipo" class="form-label">Tipo de Episodio</label>
            <input
              type="text"
              class="form-control"
              id="verEpclTipo"
              readonly>
          </div>
        </div>

        <!-- Motivo de consulta -->
        <div class="mb-3">
          <label for="verEpclMotivoConsulta" class="form-label">Motivo de la Consulta</label>
          <textarea
            class="form-control"
            id="verEpclMotivoConsulta"
            rows="2"
            readonly></textarea>
        </div>

        <!-- Fila 2: Diagnóstico y Tratamiento -->
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="verEpclDiagnostico" class="form-label">Diagnóstico</label>
            <textarea
              class="form-control"
              id="verEpclDiagnostico"
              rows="3"
              readonly></textarea>
          </div>

          <div class="col-md-6">
            <label for="verEpclTratamiento" class="form-label">Tratamiento</label>
            <textarea
              class="form-control"
              id="verEpclTratamiento"
              rows="3"
              readonly></textarea>
          </div>
        </div>

        <!-- Fila 3: Observaciones y Estado -->
        <div class="row mb-3">
          <div class="col-md-8">
            <label for="verEpclObservaciones" class="form-label">Observaciones</label>
            <textarea
              class="form-control"
              id="verEpclObservaciones"
              rows="2"
              readonly></textarea>
          </div>

          <div class="col-md-4">
            <label for="verEpclEstado" class="form-label">Estado</label>
            <input
              type="text"
              class="form-control"
              id="verEpclEstado"
              readonly>
          </div>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Cerrar
        </button>
      </div>

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