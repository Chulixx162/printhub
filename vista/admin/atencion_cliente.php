<?php 
    include('header.php');
?>
<style>
 .table-responsive {
  width: 100%;
  overflow-x: auto; /* Scroll solo si es necesario */
  overflow-y: hidden;
  max-width: 100%;
}

th, td {
  text-align: left;
  vertical-align: middle;
  word-wrap: break-word;
}

/* ====== MÓVILES ====== */
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

  table {
    min-width: 800px; /* Fuerza scroll horizontal en móviles */
  }

  th, td {
    white-space: nowrap;
  }
}

/* ====== TABLETS ====== */
@media (min-width: 577px) and (max-width: 991px) {
  .table-responsive {
    font-size: 0.95rem;
  }

  table {
    min-width: 900px; /* Puede necesitar scroll */
  }

  th, td {
    white-space: nowrap;
  }
}

/* ====== ESCRITORIO (PC) ====== */
@media (min-width: 992px) {
  table {
    width: 100%;
    min-width: unset;   /* Se adapta al ancho disponible */
    table-layout: auto; /* Ajusta automáticamente las columnas */
  }

  th, td {
    white-space: normal;    /* Permite saltos de línea */
    word-wrap: break-word;  /* Rompe palabras largas */
  }
}

</style>
<body>
    <?php 
        include '../../conexion.php';
        include '../../modelo/atenciones_m.php';
        $atenciones = obtenerAtenciones($conn);
    ?>

    <div class="d-flex flex-column flex-lg-row">

        <?php include ('sidebar.php'); ?>

        <!-- Contenido principal -->
        <div class="flex-grow-1">
            <nav class="navbar navbar-dark">
                <div class="container-fluid">
                    
                    <span class="navbar-brand">Gestión de Atención Al Cliente</span>
                    <div class="dataTables_filter">
                        <input type="search" id="buscar" class="form-control form-control-sm" placeholder="Buscar...">
                    </div>
                </div>
            </nav>

            <div class="main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0 mt-4">Atención</h2>
                   
                </div>

                <!-- Tabla -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center"><i class="fas fa-id-badge"></i> ID</th>
                                <th class="text-center"><i class="fas fa-user"></i> Nombre Completo</th>
                                <th class="text-center"><i class="fas fa-envelope"></i> Correro</th>
                                <th class="text-center"><i class="fas fa-mobile-alt"></i> Telefono</th>
                                <th class="text-center"><i class="fas fa-comment-alt"></i> Mensaje</th>
                                <th class="text-center"><i class="fas fa-calendar-alt"></i> Fecha</th>
                                <th class="text-center"><i class="fas fa-hourglass-half"></i> Estado</th>
                                <th class="text-center"><i class="fas fa-cogs"></i> Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php foreach ($atenciones as $atencion): ?>
                                <tr>
                                    <td><?= $atencion['id'] ?></td>
                                    <td><?= $atencion['nombre'] ?></td>
                                    <td><?= $atencion['correo'] ?></td>
                                    <td>
                                    <a href="https://wa.me/57<?= preg_replace('/\D/', '', $atencion['telefono']) ?>" target="_blank">
                                        <?= $atencion['telefono'] ?>
                                    </a>
                                    </td>

                                   <td>
                                        <textarea lass="overflow-auto" style="
                                            max-height: 100px;
                                            max-width: 100%;
                                            text-align: left;
                                            overflow-wrap: break-word;
                                            background-color: #f0f8ff; /* azul claro suave */
                                            padding: 8px 12px;
                                            border-radius: 10px;
                                            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
                                            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                                            font-size: 14px;
                                            color: #333;
                                            "
                                            readonly><?= htmlspecialchars($atencion['mensaje']) ?>
                                        </textarea>
                                        
                                    </td>

                                    <td><?= $atencion['fecha'] ?></td>

                                    <td style="<?= $atencion['estado']=='RE' ? 'background-color:#28a745;color:#fff;padding:5px;border-radius:4px;text-align:center;' : ($atencion['estado']=='PE' ? 'background-color:#dc3545;color:#fff;padding:5px;border-radius:4px;text-align:center;' : '') ?>">
                                        <?= htmlspecialchars($atencion['estado']) ?>
                                    </td>


                                    
                                    <td>
                                    <button class="btn btn-sm btn-outline-primary m-2" data-bs-toggle="modal"
                                        data-bs-target="#modalEditar<?= $atencion['id'] ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger m-2" 
                                        onclick="eliminar(event, <?= $atencion['id'] ?>)"><i class="fas fa-trash-alt"></i>
                                    </button>
                                    </td>
                                </tr>
                                
                                <!--Modal editar Atencion -->
                                <div class="modal fade" id="modalEditar<?= $atencion['id'] ?>" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Editar Atención</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../../controlador/atenciones_c.php?accion=actualizar" method="POST">
                                                    <input type="hidden" name="id" value="<?= $atencion['id'] ?>" />
                                                    
                                                    <div class="mb-3">
                                                    <label class="form-label">Estado</label>
                                                    <select class="form-select" name="estado">
                                                        <option value="PE" <?= $atencion['estado'] == 'PE' ? 'selected' : '' ?>>PENDIENTE</option>
                                                        <option value="RE" <?= $atencion['estado'] == 'RE' ? 'selected' : '' ?>>RESUELTA</option>
                                                        
                                                    </select>
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


    <?php include ('footer.php'); ?>
    <script>
        async function eliminar(event, id) {
            event.preventDefault();
            const confirmarSalida = await confirmar(
                '¿Estás seguro de que deseas eliminar esta ATENCIÓN?',
                'SÍ', 'No', 'warning'
            );

            if (confirmarSalida) {
                window.location.href = `../../controlador/atenciones_c.php?accion=eliminar&id=${id}`;
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