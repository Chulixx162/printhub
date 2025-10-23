<?php include('header.php'); ?>
<style>
.table-container {
  width: 100%;
  overflow-x: auto; /* Scroll solo si es necesario */
  overflow-y: hidden;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  vertical-align: middle;
  text-align: center;
}

/* ====== MÓVILES ====== */
@media (max-width: 576px) {
  .table {
    font-size: 0.75rem;
  }

  .btn {
    font-size: 0.7rem;
    padding: 0.25rem 0.4rem;
  }

  table {
    min-width: 800px; /* fuerza scroll horizontal */
  }

  th, td {
    white-space: nowrap; /* evita cortes en móviles */
  }
}

/* ====== TABLETS ====== */
@media (min-width: 577px) and (max-width: 991px) {
  .table {
    font-size: 0.85rem;
  }

  .btn {
    font-size: 0.75rem;
    padding: 0.3rem 0.6rem;
  }

  table {
    min-width: 900px; /* aún puede necesitar scroll */
  }

  th, td {
    white-space: nowrap;
  }
}

/* ====== ESCRITORIO (PC) ====== */
@media (min-width: 992px) {
  .table {
    font-size: 0.9rem;
  }

  .btn {
    font-size: 0.8rem;
    padding: 0.35rem 0.75rem;
  }

  table {
    min-width: unset; /* se adapta */
    table-layout: auto; /* ancho automático */
  }

  th, td {
    white-space: normal; /* permite saltos de línea */
    word-wrap: break-word; /* rompe palabras largas */
  }
}

</style>
<body>
<?php 
    include '../../conexion.php';
    include '../../modelo/viajeros_m.php';
    $viajeros = obtenerViajeros($conn);
?>

<div class="d-flex flex-column flex-lg-row">
  <?php include('sidebar.php'); ?>

  <div class="flex-grow-1">
    <nav class="navbar navbar-dark">
      <div class="container-fluid">
        <span class="navbar-brand text-white">Gestión de viajeros</span>
        <div class="dataTables_filter">
          <input type="search" id="buscar" class="form-control form-control-sm" placeholder="Buscar...">
        </div>
      </div>
    </nav>

    <div class="main-content">
      <div class="d-flex justify-content-between align-items-center mb-4">
          <h2 class="mb-0 mt-4">VIAJEROS</h2>
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalviajeros">
            <i class="fas fa-plus me-2"></i>Nuevo Viajero
          </button>
        </div>

      <div class="table-container">
        <table class="table table-striped table-hover align-middle">
          <thead class="table-dark text-center">
            <tr>
              <th><i class="fas fa-id-badge"></i> ID</th>
                <th><i class="fas fa-user"></i> Nombre Completo</th>
                <th><i class="fas fa-id-card"></i> Tipo Doc.</th>
                <th><i class="fas fa-hashtag"></i> Número</th>
                <th><i class="fas fa-calendar-plus"></i> Registro</th>
                <th><i class="fas fa-birthday-cake"></i> Nacimiento</th>
                <th><i class="fas fa-phone-alt"></i> Contacto 1</th>
                <th><i class="fas fa-mobile-alt"></i> Contacto 2</th>
                <th><i class="fas fa-map-marker-alt"></i> Dirección</th>
                <th><i class="fas fa-cogs"></i> Acciones</th>

            </tr>
          </thead>
          <tbody class="text-center">
            <?php foreach ($viajeros as $viajero): ?>
              <tr>
                <td><?= $viajero['id'] ?></td>
                <td><?= $viajero['nombre'] ?></td>
                <td><?= $viajero['tipo_de_documento'] ?></td>
                <td><?= $viajero['numero_de_documento'] ?></td>
                <td><?= $viajero['fecha_registro'] ?></td>
                <td><?= $viajero['fecha_nacimiento'] ?></td>
                <td>
                  <a href="https://wa.me/57<?= preg_replace('/\D/', '', $viajero['contacto_1']) ?>" target="_blank">
                    <?= $viajero['contacto_1'] ?>
                  </a>
                </td>
                <td>
                  <a href="https://wa.me/57<?= preg_replace('/\D/', '', $viajero['contacto_2']) ?>" target="_blank">
                    <?= $viajero['contacto_2'] ?>
                  </a>
                </td>
                <td><?= $viajero['direccion'] ?></td>
                <td>
                  <button class="btn btn-sm btn-outline-primary m-2" data-bs-toggle="modal"
                    data-bs-target="#modalEditar<?= $viajero['id'] ?>">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button class="btn btn-sm btn-outline-danger" 
                    onclick="eliminar(event, <?= $viajero['id'] ?>)"><i class="fas fa-trash-alt"></i>
                  </button>
                </td>
              </tr>

              <!-- Modal Editar viajero -->
              <div class="modal fade" id="modalEditar<?= $viajero['id'] ?>" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                      <h5 class="modal-title">Editar viajero</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                      <form action="../../controlador/viajeros_c.php?accion=actualizar" method="POST">
                        <input type="hidden" name="id" value="<?= $viajero['id'] ?>" />
                        <div class="mb-3">
                          <label class="form-label">Nombre</label>
                          <input type="text" class="form-control" name="nombre" value="<?= $viajero['nombre'] ?>" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Tipo de Documento</label>
                          <select class="form-select" name="tipo_documento">
                            <?php
                            $tipos = ["CC" => "Cédula de Ciudadanía", "TI" => "Tarjeta de Identidad", "RC" => "Registro Civil", "PASAPORTE" => "Pasaporte", "CE" => "Cédula de Extranjería"];
                            foreach ($tipos as $clave => $texto):
                              $selected = $viajero['tipo_documento'] == $clave ? 'selected' : '';
                              echo "<option value=\"$clave\" $selected>$texto</option>";
                            endforeach;
                            ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Número de Documento</label>
                          <input type="number" class="form-control" name="numero_documento" value="<?= $viajero['numero_de_documento'] ?>" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Fecha de Nacimiento</label>
                          <input type="date" class="form-control" name="fecha_nacimiento" value="<?= $viajero['fecha_nacimiento'] ?>" />
                        </div>
                       
                        <div class="mb-3">
                          <label class="form-label">Contacto 1</label>
                          <input type="number" class="form-control" name="contacto1" value="<?= $viajero['contacto_1'] ?>" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Contacto 2</label>
                          <input type="number" class="form-control" name="contacto2" value="<?= $viajero['contacto_2'] ?>" />
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Dirección</label>
                          <input type="text" class="form-control" name="direccion" value="<?= $viajero['direccion'] ?>" />
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

 <!-- Modal de nuevo viajeros -->

  <div class="modal fade" id="modalviajeros" tabindex="-1" aria-labelledby="modalviajerosLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="modalviajerosLabel">Nuevo Viajero</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <form action='../../controlador/viajeros_c.php?accion=registrar' method="POST">
            <!-- <div class="mb-3">
              <label for="contacto1viajeros" class="form-label">Imagen</label>
              <input type="file" id="imagen" name="imagen" accept="image/*" class="form-control" />
            </div> -->
            <div class="mb-3">
              <label for="nombreviajeros" class="form-label">Nombre</label>
              <input type="text" class="form-control" name="nombre" id="nombreviajeros" required />
            </div>
            <div class="mb-3">
              <label for="tipodocumentoviajeros" class="form-label">Tipo de Documento</label>
              <select class="form-select" name="tipo_documento" id="tipodocumentoviajeros" required>
                <option value="CC">Cédula de Ciudadanía</option>
                <option value="TI">Tarjeta de Identidad</option>
                <option value="RC">Registro Civil</option>
                <option value="PASAPORTE">Pasaporte</option>
                <option value="CE">Cédula de Extranjería</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="numerodocumentoviajeros" class="form-label">Número de Documento</label>
              <input type="number" class="form-control" name="numero_documento" id="numerodocumentoviajeros" required />
            </div>
            <div class="mb-3">
              <label for="fechanacimientoviajeros" class="form-label">Fecha de Nacimiento</label>
              <input type="date" class="form-control" name="fecha_nacimiento" id="fechanacimientoviajeros" />
            </div>
            <div class="mb-3">
              <label for="direccionviajeros" class="form-label">Dirección</label>
              <input type="text" class="form-control" name="direccion" id="direccionviajeros" />
            </div>
            <div class="mb-3">
              <label for="contacto1viajeros" class="form-label">Contacto_1</label>
              <input type="number" name="contacto1" class="form-control" id="contacto1viajeros" required />
            </div>
            <div class="mb-3">
              <label for="contacto2viajeros" class="form-label">Contacto_2</label>
              <input type="number" name="contacto2"  class="form-control" id="contacto2viajeros" />
            </div>
           
            
             <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button class="btn btn-primary" type="submit">Guardar</button>
          </div>
          </form>
        </div>
       
      </div>
    </div>
  </div>

  <?php include('footer.php'); ?>
  <script>
    async function eliminar(event, id) {
        event.preventDefault();
        const confirmarSalida = await confirmar(
            '¿Estás seguro de que deseas eliminar a este VIAJERO?',
            'SÍ', 'No', 'warning'
        );

        if (confirmarSalida) {
            window.location.href = `../../controlador/viajeros_c.php?accion=eliminar&id=${id}`;
        }
    }

    // Filtro de búsqueda
    document.getElementById("buscar").addEventListener("keyup", function () {
    const filtro = this.value.toLowerCase();
    const filas = document.querySelectorAll(".table-container tbody tr");

    filas.forEach(fila => {
        const textoFila = fila.textContent.toLowerCase();
        fila.style.display = textoFila.includes(filtro) ? "" : "none";
    });
    });
  </script>
  <script src="../../libs/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
