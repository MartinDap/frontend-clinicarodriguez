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
  echo "<script>console.log('Datos de la API:', " . json_encode($data) . ");</script>";
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
          <h5 class="modal-title" id="modalRegistrarHistoriaLabel">Registrar Historia Cl├¡nica</h5>
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

          <!-- Fecha -->
          <div class="form-group mb-3">
            <label for="histFecha">Fecha</label>
            <input type="date" class="form-control" id="histFecha" name="histFecha" required>
          </div>

          <!-- Motivo -->
          <div class="form-group mb-3">
            <label for="histMotivo">Motivo de consulta</label>
            <textarea class="form-control" id="histMotivo" name="histMotivo" rows="2" required></textarea>
          </div>

          <!-- Diagn├│stico -->
          <div class="form-group mb-3">
            <label for="histDiagnostico">Diagn├│stico</label>
            <textarea class="form-control" id="histDiagnostico" name="histDiagnostico" rows="2" required></textarea>
          </div>

          <!-- Tratamiento -->
          <div class="form-group mb-3">
            <label for="histTratamiento">Tratamiento</label>
            <textarea class="form-control" id="histTratamiento" name="histTratamiento" rows="2" required></textarea>
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
              <!-- Tel├®fono -->
              <div class="form-group col-md-4">
                <label for="editarPaciTelefono">Tel├®fono / Celular</label>
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
                <label for="editarPaciEmail">Correo electr├│nico</label>
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
              <!-- Direcci├│n -->
              <div class="form-group col-md-8">
                <label for="editarPaciDireccion">Direcci├│n</label>
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

