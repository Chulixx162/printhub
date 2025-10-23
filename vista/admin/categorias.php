<?php include('header.php'); ?>
<style>
  .table-responsive {
    overflow-x: auto;
    max-width: 100%;
  }

  .main-content {
    padding: 1rem;
  }

  th, td {
    word-break: break-word;
    min-width: 120px; /* Evita que las columnas se aplasten demasiado en pantallas pequeñas */
  }

  @media (max-width: 576px) {
    .main-content h2 {
      font-size: 1.4rem;
    }

    .table-responsive {
      font-size: 0.9rem;
    }

    .btn {
      font-size: 0.85rem;
    }
  }

  .descripcion-scroll {
    max-height: 80px;       /* Alto máximo antes de hacer scroll vertical */
    max-width: 250px;       /* Ancho máximo antes de hacer scroll horizontal */
    overflow: auto;
    white-space: pre-wrap;  /* Mantiene saltos de línea */
  }

</style>

<body>
  <?php 
    include '../../conexion.php';
    include '../../modelo/categorias_m.php'; 
    $categorias = obtenerCategorias($conn);
  ?>

  <div class="d-flex flex-column flex-lg-row">
    <?php include('sidebar.php'); ?>

    <!-- Contenido principal -->
    <div class="flex-grow-1">
      <nav class="navbar ">
        <div class="container-fluid">
          <span class="navbar-brand text-white">Gestión de CATEGORÍAS</span>
          <div class="dataTables_filter">
            <input type="search" id="buscar" class="form-control form-control-sm" placeholder="Buscar...">
          </div>
        </div>
      </nav>

      <div class="main-content">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
          <h2 class="mb-3 mb-md-0 mt-4">CATEGORÍAS</h2>
          <?php if ($_SESSION['rol'] == 'ADMIN'): ?>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCategoria">
              <i class="fas fa-plus me-2"></i>Nueva Categoría
            </button>
          <?php endif; ?>
        </div>

        <!-- Tabla -->
        <div class="table-responsive">
          <table class="table table-striped table-hover align-middle">
            <thead class="table-dark text-center">
              <tr>
                <th><i class="fas fa-id-badge"></i> ID</th>
                <th><i class="fas fa-tag"></i> Nombre</th>
                <th><i class="fas fa-align-left"></i> Descripción</th>
                <?php if ($_SESSION['rol'] == 'ADMIN'): ?>
                  <th><i class="fas fa-cogs"></i> Acciones</th>
                <?php endif; ?>
              </tr>
            </thead>

            <tbody class="text-center">
              <?php foreach ($categorias as $categoria): ?>
                <tr>
                  <td><?= $categoria['id'] ?></td>
                  <td><?= $categoria['nombre'] ?></td>
                  <td>
                    <textarea class="form-control descripcion-scroll" style="max-height: 100px; max-width: 100%; text-align: left; overflow-wrap: break-word;" readonly><?= $categoria['descripcion'] ?></textarea>
                    
                  </td>
                  <?php if ($_SESSION['rol'] == 'ADMIN'): ?>
                    <td>
                      <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal"
                        data-bs-target="#modalEditar<?= $categoria['id'] ?>">
                        <i class="fas fa-edit"></i>
                      </button>
                      <button class="btn btn-sm btn-outline-danger" 
                        onclick="eliminar(event, <?= $categoria['id'] ?>)"><i class="fas fa-trash-alt"></i>
                      </button>
                    </td>
                  <?php endif; ?>
                </tr>

                <!-- Modal editar categoría -->
                <div class="modal fade" id="modalEditar<?= $categoria['id'] ?>" tabindex="-1"
                  aria-labelledby="modalEditarLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Editar Categoría</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                      </div>
                      <div class="modal-body">
                        <form action="../../controlador/categorias_c.php?accion=actualizar" method="POST">
                          <input type="hidden" name="id" value="<?= $categoria['id'] ?>" />
                          <div class="mb-3">
                            <label for="nombrecategoria<?= $categoria['id'] ?>" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre"
                              id="nombrecategoria<?= $categoria['id'] ?>" value="<?= $categoria['nombre'] ?>" />
                          </div>
                          <div class="mb-3">
                            <label for="descripcion<?= $categoria['id'] ?>" class="form-label">Descripción</label>
                            <textarea class="form-control" name="descripcion"
                              id="descripcion<?= $categoria['id'] ?>"><?= $categoria['descripcion'] ?></textarea>
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

  <!-- Modal de nueva categoría -->
  <div class="modal fade" id="modalCategoria" tabindex="-1" aria-labelledby="modalCategoriaLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="modalCategoriaLabel">Nueva Categoría</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>

        <div class="modal-body">
          <form action='../../controlador/categorias_c.php?accion=registrar' method="POST">
            
            <div class="mb-3">
              <label for="nombreCategoria" class="form-label">Nombre</label>
              <input type="text" class="form-control" name="nombre" id="nombreCategoria" required />
            </div>

            <div class="mb-3">
              <label for="descripcionCategoria" class="form-label">Descripción</label>
              <textarea class="form-control" name="descripcion" id="descripcionCategoria" rows="3" required></textarea>
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
                '¿Estás seguro de que deseas eliminar esta CATEGORÍA?',
                'SÍ', 'No', 'warning'
            );

            if (confirmarSalida) {
                window.location.href = `../../controlador/categorias_c.php?accion=eliminar&id=${id}`;
            }
        }

        // Filtro de búsqueda
          document.getElementById("buscar").addEventListener("keyup", function () {
          const filtro = this.value.toLowerCase();
          const filas = document.querySelectorAll(".table-responsive tbody tr");

          filas.forEach(fila => {
              const textoFila = fila.textContent.toLowerCase();
              fila.style.display = textoFila.includes(filtro) ? "" : "none";
          });
          });
    </script>

  <script src="../../libs/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
