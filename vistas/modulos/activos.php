<?php

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => API_BASE_URL . 'activos-tecnologicos',
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

  /* CATEGORIA */
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => API_BASE_URL . 'categorias-activo',
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

  $responsecategoriaactivos = curl_exec($curl);

  curl_close($curl);
  $dataCategoriaActivos = json_decode($responsecategoriaactivos, true);

    /* USUARIOS */
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

?>
<div class="container-fluid">
  
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-hdd-network"></i> Gestión de Activos Tecnológicos</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarActivo">
      <i class="bi bi-plus-circle"></i> Nuevo Activo
    </button>
  </div>
  
  <div class="table-container">
    <table id="tablaActivos" class="table table-striped table-hover align-middle">
      <thead class="table-light">
        <tr>
          <th>#</th>
          <th>Código</th>
          <th>Equipo</th>
          <th>Categoría</th>
          <th>Marca / Modelo</th>
          <th>N° Serie</th>
          <th>Fecha Compra</th>
          <th>Ubicación</th>
          <th>Estado</th>
          <th>Asignado a</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (isset($data["data"]) && is_array($data["data"])): ?>
          <?php foreach ($data["data"] as $key => $item): ?>
            <tr>
              <td><?= $key + 1 ?></td>
              <td><?= htmlspecialchars($item["acteCodigoActivo"]) ?></td>
              <td><?= htmlspecialchars($item["acteNombreEquipo"]) ?></td>
              <td><?= htmlspecialchars($item["categoria"]["caacNombreCategoria"]) ?></td>
              <td><?= htmlspecialchars($item["acteMarca"]) ?> / <?= htmlspecialchars($item["acteModelo"]) ?></td>
              <td><?= htmlspecialchars($item["acteNumeroSerie"]) ?></td>
              <td><?= htmlspecialchars(date("d/m/Y", strtotime($item["acteFechaCompra"]))) ?></td>
              <td><?= htmlspecialchars($item["acteUbicacion"]) ?></td>
              <td>
                <?php if ($item["acteEstado"] == "ACTIVO"): ?>
                  <span class="badge bg-success">Activo</span>
                <?php elseif ($item["acteEstado"] == "INACTIVO"): ?>
                  <span class="badge bg-secondary">Inactivo</span>
                <?php else: ?>
                  <span class="badge bg-danger"><?= htmlspecialchars($item["acteEstado"]) ?></span>
                <?php endif; ?>
              </td>
              <td><?= htmlspecialchars($item["usuario"]["usuaNombrecompleto"]) ?></td>
              <td>
                <button class="btn btn-sm btn-info btnVerActivo me-1" acteId="<?= $item["acteId"] ?>" title="Ver activo">
                  <i class="bi bi-eye"></i>
                </button>
                <button class="btn btn-sm btn-warning btnEditarActivo me-1" acteId="<?= $item["acteId"] ?>" title="Editar activo">
                  <i class="bi bi-pencil"></i>
                </button>
                <button class="btn btn-sm btn-danger btnEliminarActivo" acteId="<?= $item["acteId"] ?>" title="Eliminar activo">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="11" class="text-center">No hay activos registrados</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

</div>


<!--=====================================
MODAL AGREGAR ACTIVO
======================================-->
<div id="modalAgregarActivo" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <form role="form" id="formRegistrarActivo" method="post">

        <!--=====================================
        CABECERA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#003264; color:white">
          <h4 class="modal-title">Registrar Activo</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">

            <div class="row">
              <!-- Código del Activo -->
              <div class="form-group col-md-4">
                <label for="acteCodigoActivo">Código del Activo</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                  <input type="text" class="form-control input-lg" name="acteCodigoActivo" id="acteCodigoActivo" placeholder="Ej: 11111111" required>
                </div>
              </div>

              <!-- Nombre del Equipo -->
              <div class="form-group col-md-8">
                <label for="acteNombreEquipo">Nombre del Equipo</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-desktop"></i></span>
                  <input type="text" class="form-control input-lg" name="acteNombreEquipo" id="acteNombreEquipo" placeholder="Ej: Laptop Pavilion" required>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Categoría -->
                <div class="form-group col-md-6">
                <label for="caacId">Categoría</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-layer-group"></i></span>
                    <select class="form-control input-lg" name="caacId" id="caacId" required>
                    <option value="">Seleccionar...</option>
                    <?php if (isset($dataCategoriaActivos["data"]) && is_array($dataCategoriaActivos["data"])): ?>
                        <?php foreach ($dataCategoriaActivos["data"] as $categoria): ?>
                        <option value="<?= htmlspecialchars($categoria["caacId"]) ?>">
                            <?= htmlspecialchars($categoria["caacNombreCategoria"]) ?>
                        </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">No hay categorías disponibles</option>
                    <?php endif; ?>
                    </select>
                </div>
                </div>


              <!-- Estado -->
              <div class="form-group col-md-6">
                <label for="acteEstado">Estado</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-toggle-on"></i></span>
                  <select class="form-control input-lg" name="acteEstado" id="acteEstado" required>
                    <option value="">Seleccionar...</option>
                    <option value="ACTIVO">Activo</option>
                    <option value="INACTIVO">Inactivo</option>
                    <option value="DE BAJA">De baja</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Marca -->
              <div class="form-group col-md-4">
                <label for="acteMarca">Marca</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                  <input type="text" class="form-control input-lg" name="acteMarca" id="acteMarca" placeholder="Ej: HP" required>
                </div>
              </div>

              <!-- Modelo -->
              <div class="form-group col-md-4">
                <label for="acteModelo">Modelo</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-cube"></i></span>
                  <input type="text" class="form-control input-lg" name="acteModelo" id="acteModelo" placeholder="Ej: Pavilion 2000" required>
                </div>
              </div>

              <!-- Número de serie -->
              <div class="form-group col-md-4">
                <label for="acteNumeroSerie">Número de Serie</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-hashtag"></i></span>
                  <input type="text" class="form-control input-lg" name="acteNumeroSerie" id="acteNumeroSerie" placeholder="Ej: SN12345" required>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Fecha de Compra -->
              <div class="form-group col-md-4">
                <label for="acteFechaCompra">Fecha de Compra</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input type="date" class="form-control input-lg" name="acteFechaCompra" id="acteFechaCompra" required>
                </div>
              </div>

              <!-- Vida útil -->
              <div class="form-group col-md-4">
                <label for="acteVidaUtilAnios">Vida Útil (años)</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-clock"></i></span>
                  <input type="number" class="form-control input-lg" name="acteVidaUtilAnios" id="acteVidaUtilAnios" placeholder="Ej: 5" required>
                </div>
              </div>

              <!-- Fecha de Baja -->
              <div class="form-group col-md-4">
                <label for="acteFechaBaja">Fecha de Baja</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar-times"></i></span>
                  <input type="date" class="form-control input-lg" name="acteFechaBaja" id="acteFechaBaja">
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Ubicación -->
              <div class="form-group col-md-6">
                <label for="acteUbicacion">Ubicación</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map-marker-alt"></i></span>
                  <input type="text" class="form-control input-lg" name="acteUbicacion" id="acteUbicacion" placeholder="Ej: Laboratorio 3" required>
                </div>
              </div>

                <!-- Usuario asignado -->
                <div class="form-group col-md-6">
                <label for="usuaId">Asignado a (Usuario)</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <select class="form-control input-lg" name="usuaId" id="usuaId" required>
                    <option value="">Seleccionar usuario...</option>
                    <?php if (isset($dataUsuarios["data"]) && is_array($dataUsuarios["data"])): ?>
                        <?php foreach ($dataUsuarios["data"] as $usuario): ?>
                        <option value="<?= htmlspecialchars($usuario["usuaId"]) ?>">
                            <?= htmlspecialchars($usuario["usuaNombrecompleto"]) ?> (<?= htmlspecialchars($usuario["usuaUsername"]) ?>)
                        </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">No hay usuarios disponibles</option>
                    <?php endif; ?>
                    </select>
                </div>
                </div>

            </div>

            <div class="row">
              <!-- Observaciones -->
              <div class="form-group col-md-12">
                <label for="acteObservaciones">Observaciones</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                  <textarea class="form-control input-lg" name="acteObservaciones" id="acteObservaciones" rows="3" placeholder="Ej: Ninguna"></textarea>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Activo</button>
        </div>

      </form>
    </div>
  </div>
</div>




<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->
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
