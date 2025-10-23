<?php include ('header.php'); ?>
<style>
    .table-responsive {
    overflow-x: auto;
    max-width: 100%;
  }

  .main-content {
    padding: 1rem;
  }

  th, td {
        overflow-wrap: break-word;
        min-width: 100px;
        text-align: center;
        vertical-align: middle;
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
        include '../../modelo/productos_m.php'; 
        // $productos = obtenerProductos($conn);
        $productos = obtenerProductosConCategorias($conn);
        $categorias = obtenerCategorias($conn);
    ?>
    <div class="d-flex flex-column flex-lg-row">

        <?php include ('sidebar.php'); ?>

        <!-- Contenido principal -->
        <div class="flex-grow-1">
            <nav class="navbar navbar-dark ">
                <div class="container-fluid">
                    <span class="navbar-brand">Gestión de Productos</span>
                    <div class="dataTables_filter">
                        <input type="search" id="buscar" class="form-control form-control-sm" placeholder="Buscar...">
                    </div>
                </div>
            </nav>

            <div class="main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-3 mb-md-0 mt-4 ">Productos</h2>
                    <?php if ($_SESSION['rol'] == 'ADMIN' || $_SESSION['rol'] == 'AGENTE'): ?>
                        <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modalproducto">
                            <i class="fas fa-plus me-2"></i>Nuevo producto
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
                                <th><i class="fas fa-folder"></i> Categoría</th>
                                <th><i class="fas fa-dollar-sign"></i> Precio</th>
                                <th><i class="fas fa-align-left"></i> Descripción</th>
                                <?php if ($_SESSION['rol'] == 'ADMIN' || $_SESSION['rol'] == 'AGENTE'): ?>
                                    <th><i class="fas fa-cogs"></i> Acciones</th>
                                <?php endif; ?>

                            </tr>
                        </thead>
                        <?php foreach ($productos as $producto): ?>
                           
                        <tbody class="text-center">

                            <tr>
                                <td><?= $producto['id'] ?></td>
                                <td><?= $producto['nombre'] ?></td>
                                <td><?php echo htmlspecialchars($producto['nombre_categoria']); ?></td>
                                <td>$<?= number_format($producto['precio'], 0, ',', '.') ?></td>
                                <td>
                                    <textarea class="form-control descripcion-scroll" readonly style="max-height: 100px; max-width: 100%; text-align: left; overflow-wrap: break-word;"><?= $producto['descripcion'] ?></textarea>

                                </td>
                                <?php if ($_SESSION['rol'] == 'ADMIN' || $_SESSION['rol'] == 'AGENTE'): ?>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary me-2" data-bs-toggle="modal"
                                            data-bs-target="#modalEditar<?= $producto['id'] ?>"><i class="fas fa-edit"></i>
                                        </button>
                                    
                                            
                                            
                                            
                                        <button class="btn btn-sm btn-outline-danger" onclick="eliminar(event, <?= $producto['id'] ?>)" >
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        
                                    </td>
                                <?php endif; ?>    
                            </tr>
                        
                            <!-- Modal de edición -->
                            

                            <div class="modal fade" id="modalEditar<?= $producto['id'] ?>" tabindex="-1"
                                aria-labelledby="modalEditarLabel<?= $producto['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Editar
                                                Producto</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="../../controlador/productos_c.php?accion=actualizar" enctype="multipart/form-data" method="POST">
                                                <input type="hidden" name="id" value="<?= $producto['id'] ?>" />
                                                <div class="mb-3">
                                                    <label for="nombreproducto<?= $producto['id'] ?>"
                                                        class="form-label">Nombre</label>
                                                    <input type="text" class="form-control"
                                                       name="nombre" id="nombreproducto<?= $producto['id'] ?>"
                                                        value="<?= $producto['nombre'] ?>" />
                                                </div>
                                                <!-- <div class="mb-3">
                                                    <label for="imagenproducto<?= $producto['id'] ?>"
                                                        class="form-label">Imagen</label>
                                                    <input type="file" id="imagenproducto<?=htmlspecialchars($producto['imagen']); ?>"
                                                        name="imagen" accept="image/*" class="form-control" />
                                                </div> -->
                                                <div class="mb-3">
                                                    <label for="imagenproducto<?= $producto['id'] ?>" class="form-label">Imagen</label>
                                                    <input type="file"
                                                        id="imagenproducto<?= $producto['id'] ?>"
                                                        name="imagen"
                                                        accept="image/*"
                                                        class="form-control"
                                                        onchange="mostrarNombreArchivo(this)" />
                                                    
                                                    <!-- Mostrar el nombre del archivo actual -->
                                                    <?php if (!empty($producto['imagen'])): ?>
                                                        <div class="form-text text-success mt-1">
                                                            Archivo actual: <?= htmlspecialchars($producto['imagen']) ?>
                                                        </div>
                                                    <?php endif; ?>

                                                    <!-- Aquí se mostrará el nuevo archivo seleccionado -->
                                                    <div id="nombreArchivo<?= $producto['id'] ?>" class="form-text mt-1 text-primary"></div>
                                                </div>


                                                <div class="mb-3">
                                                    <label for="categoriaProducto<?= $producto['id'] ?>" class="form-label">Categoría del Producto</label>
                                                    <select class="form-select" name="id_categoria" id="categoriaProducto<?= $producto['id'] ?>">
                                                        <?php foreach ($categorias as $categoria): ?>
                                                            <option value="<?= $categoria['id'] ?>" <?= ($producto['id_categoria'] == $categoria['id']) ? 'selected' : '' ?>>
                                                                <?= htmlspecialchars($categoria['nombre']) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="precioproducto<?= $producto['id'] ?>"
                                                        class="form-label">Precio</label>
                                                    <input type="number" class="form-control"
                                                        name="precio" id="precioproducto<?= $producto['id'] ?>"
                                                        value="<?= $producto['precio'] ?>" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="descripcionproducto<?= $producto['id'] ?>"
                                                       name="descripcion" class="form-label">Descripcion</label>
                                                    <input type="text" class="form-control"
                                                       name="descripcion" id="descripcionproducto<?= $producto['id'] ?>"
                                                        value="<?= $producto['descripcion'] ?>" />
                                                </div>
                                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
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

    <!-- Modal de Crear producto -->
    <div class="modal fade" id="modalproducto" tabindex="-1" aria-labelledby="modalproductoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalproductoLabel">Nuevo Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form action="../../controlador/productos_c.php?accion=registrar" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="descripcionproducto" class="form-label">Imagen</label>
                            <input type="file" id="imagen" name="imagen" accept="image/*" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label for="nombreproducto" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombreproducto" required />
                        </div>
                        <div class="mb-3">
                            <label for="descripcionproducto" class="form-label">Descripción</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcionproducto" required />
                        </div>
                        <div class="mb-3">
                            <label for="precioproducto" class="form-label">Precio</label>
                            <input type="number" class="form-control" name="precio" id="precioproducto" required/>
                        </div>
                        <div class="mb-3">
                            <label for="categoriaProducto" class="form-label">Categoría del Producto</label>
                            <select class="form-select" name="id_categoria" id="categoriaProducto" required>
                                <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?= $categoria['id'] ?>">
                                        <?= htmlspecialchars($categoria['nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>

                    
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    
    <?php include ('footer.php'); ?>
    <script>
        async function eliminar(event, id) {
            event.preventDefault();
            const confirmarSalida = await confirmar(
                '¿Estás seguro de que deseas eliminar este PRODUCTO?',
                'SÍ', 'No', 'warning'
            );

            if (confirmarSalida) {
                window.location.href = `../../controlador/productos_c.php?accion=eliminar&id=${id}`;
            }
        }
    </script>
    <script>
    function mostrarNombreArchivo(input) {
        const nombreArchivo = input.files[0]?.name || 'Ningún archivo seleccionado';
        const id = input.id.replace('imagenproducto', 'nombreArchivo');
        document.getElementById(id).textContent = 'Seleccionado: ' + nombreArchivo;
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