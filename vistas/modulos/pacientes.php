<?php
  $token = obtener_token_usuario();
  if ($token !== null){
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
          'Authorization: ' . $token,
          'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $data = json_decode($response, true);
  }
  

?>
<div class="container-fluid">
  
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-people"></i> Gestión de Pacientes</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarPaciente">
      <i class="bi bi-plus-circle"></i> Nuevo Paciente
    </button>
  </div>
  
  <div class="table-container">
    <table id="tablaPacientes" class="table table-striped table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>DNI</th>
          <th>Nombre Completo</th>
          <th>Fecha Nacimiento</th>
          <th>Teléfono</th>
          <th>Email</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (isset($data["data"]) && is_array($data["data"]) && count($data["data"]) > 0): ?>
          <?php foreach ($data["data"] as $key => $paciente): ?>
            <?php 
              $persona   = $paciente["persona"] ?? [];
              $dni       = $persona["persNroDoc"]        ?? '';
              $nombre    = $persona["persNombrecompleto"]?? '';
              $fecNac    = $persona["persFecNacimiento"] ?? null;
              $telefono  = $persona["persTelefono"]      ?? '';
              $email     = $persona["persEmail"]         ?? '';
              $paciId    = $paciente["paciId"]           ?? '';
            ?>
            <tr>
              <td><?= $key + 1 ?></td>
              <td><?= htmlspecialchars($dni) ?></td>
              <td><?= htmlspecialchars($nombre) ?></td>
              <td><?= $fecNac ? date("d/m/Y", strtotime($fecNac)) : '-' ?></td>
              <td><?= htmlspecialchars($telefono) ?></td>
              <td><?= htmlspecialchars($email) ?></td>
              <td>
                <button class="btn btn-sm btn-info btnVerPaciente" paciId="<?= htmlspecialchars($paciId) ?>">
                  <i class="bi bi-eye"></i>
                </button>
                <button class="btn btn-sm btn-warning btnEditarPaciente" paciId="<?= htmlspecialchars($paciId) ?>">
                  <i class="bi bi-pencil"></i>
                </button>
                <button class="btn btn-sm btn-danger btnEliminarPaciente" eliminarPaciId="<?= htmlspecialchars($paciId) ?>">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="7" class="text-center">No se encontraron pacientes</td>
          </tr>
        <?php endif; ?>
      </tbody>



    </table>
  </div>
  
</div>

<!--=====================================
MODAL AGREGAR PACIENTE
======================================-->
<div id="modalAgregarPaciente" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg"><!-- modal más ancho para que respire -->

    <div class="modal-content">

      <form role="form" id="formRegistrarPaciente" method="post">

        <!--=====================================
        CABECERA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#003264; color:white">
          <h4 class="modal-title">Registrar Paciente</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">

            <div class="row">
              <!-- Nombre completo -->
              <div class="form-group col-md-8">
                <label for="paciNombrecompleto">Nombre completo</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    name="paciNombrecompleto"
                    id="paciNombrecompleto"
                    placeholder="Ej: Luis Gonzales Arévalo"
                    required>
                </div>
              </div>

              <!-- Tipo Documento -->
              <div class="form-group col-md-4">
                <label for="paciTipoDoc">Tipo Documento</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-id-badge"></i></span>
                  <select
                    class="form-control input-lg"
                    name="paciTipoDoc"
                    id="paciTipoDoc"
                    required>
                    <option value="">Seleccionar...</option>
                    <option value="DNI">DNI</option>
                    <option value="CE">CE</option>
                    <option value="PAS">PAS</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Nro Documento -->
              <div class="form-group col-md-4">
                <label for="paciNroDoc">Nro Documento</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-id-card"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    name="paciNroDoc"
                    id="paciNroDoc"
                    placeholder="74229874"
                    required>
                </div>
              </div>

              <!-- Sexo -->
              <div class="form-group col-md-4">
                <label for="paciSexo">Sexo</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span>
                  <select
                    class="form-control input-lg"
                    name="paciSexo"
                    id="paciSexo"
                    required>
                    <option value="">Seleccionar...</option>
                    <option value="MASCULINO">Masculino</option>
                    <option value="FEMENINO">Femenino</option>
                  </select>
                </div>
              </div>

              <!-- Fecha de nacimiento -->
              <div class="form-group col-md-4">
                <label for="paciFecNacimiento">Fecha de nacimiento</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input
                    type="date"
                    class="form-control input-lg"
                    name="paciFecNacimiento"
                    id="paciFecNacimiento"
                    required>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Estado civil -->
              <div class="form-group col-md-4">
                <label for="paciEstadoCivil">Estado civil</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-heart"></i></span>
                  <select
                    class="form-control input-lg"
                    name="paciEstadoCivil"
                    id="paciEstadoCivil"
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

              <!-- Teléfono -->
              <div class="form-group col-md-4">
                <label for="paciTelefono">Teléfono / Celular</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    name="paciTelefono"
                    id="paciTelefono"
                    placeholder="967431258"
                    required>
                </div>
              </div>

              <!-- Correo -->
              <div class="form-group col-md-4">
                <label for="paciEmail">Correo electrónico</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input
                    type="email"
                    class="form-control input-lg"
                    name="paciEmail"
                    id="paciEmail"
                    placeholder="luis.gonzales@gmail.com"
                    required>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Dirección -->
              <div class="form-group col-md-12">
                <label for="paciDireccion">Dirección</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-home"></i></span>
                  <input
                    type="text"
                    class="form-control input-lg"
                    name="paciDireccion"
                    id="paciDireccion"
                    placeholder="Jr Luis 1"
                    required>
                </div>
              </div>
            </div>

          </div><
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar paciente</button>
        </div>

      </form>

    </div>

  </div>
</div>

<!--=====================================
MODAL EDITAR PACIENTE
======================================-->
<div id="modalEditarPaciente" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" id="formEditarPaciente" method="post">

        <!--=====================================
        CABECERA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#003264; color:white">
          <h4 class="modal-title">Editar Paciente</h4>
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
