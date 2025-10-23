<?php
include '../../conexion.php';
include '../../modelo/obtenerEstados.php';
$CampanaPedidos = hayPedidos($conn);
$CampanaAtencion = hayAtenciones($conn);
$CampanaPedidosFisicos=hayPedidosFisicos($conn);
$campanaAbonos = hayAbonosPendientes($conn);
?>



    <div class="sidebar p-3 text-center d-flex flex-column flex-shrink-0 text-white overflow-auto">
        <!-- Sidebar -->
        <nav style="min-width: 250px;">
            <!-- Logo -->
            <img src="../../IMAGENES/Logotipo_sinsombrapng_Mesa de trabajo 1-02.png" alt="Logo SIW-TURISMO"
                class="img-fluid mb-3 mx-auto d-block" style="max-height: 80px;" />

            <!-- Título -->
            <h4 class="mb-4">SIW-TURISMO</h4>

            <!-- Menú navegación -->
            <ul class="nav nav-pills flex-column text-start">
                <li class="nav-item">
                    <a href="vista_general.php" class="nav-link i-vista_general text-white">
                        <i class="fas fa-chart-line me-2"></i>ADMINISTRAR
                    </a>
                </li>

                <li class="nav-item">
                    <a href="productos.php" class="nav-link i-productos text-white">
                        <i class="fas fa-suitcase-rolling me-2"></i>PRODUCTOS
                    </a>
                </li>

                <!-- <li class="nav-item">
                    <a href="planes.php" class="nav-link i-planes text-white">
                        <i class="fas fa-user me-2"></i>Planes Individuales
                    </a>
                </li>
                <li class="nav-item">
                    <a href="tours.php" class="nav-link i-tours text-white">
                        <i class="fas fa-map-marked-alt me-2"></i>Tours
                    </a>
                </li> -->
                <?php if ($_SESSION['rol'] == 'ADMIN'): ?>
                    <li class="nav-item">
                        <a href="usuarios.php" class="nav-link i-usuarios text-white">
                            <i class="fas fa-users-cog me-2"></i>Usuarios
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="clientes.php" class="nav-link i-clientes text-white">
                        <i class="fas fa-id-card me-2"></i>Clientes
                    </a>
                </li>
                <li class="nav-item">
                    <a href="circulo_viajero.php" class="nav-link i-circulo_viajero text-white">
                        <i class="fas fa-globe me-2"></i>Círculo Viajero
                    </a>
                </li>
                <?php if ($_SESSION['rol'] == 'ADMIN' || $_SESSION['rol'] == 'ATENCION_CLIENTE'): ?>
                    <li class="nav-item">
                        <a href="atencion_cliente.php" class="nav-link i-atencion_cliente text-white">
                            <i class="fas fa-comments me-2"></i>Atención al Cliente
                            <?php if ($CampanaAtencion): ?>
                                <i class="fas fa-bell text-warning ms-2"></i> <!-- Campana -->
                            <?php endif; ?>
                        </a>
                    </li>
                <?php endif; ?>
                
                <li class="nav-item">
                    <a href="venta_tienda.php" class="nav-link i-venta_tienda text-white">
                        <i class="fas fa-cash-register me-2"></i>Ventas en Tienda
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pedidos.php" class="nav-link i-pedidos text-white">
                        <i class="fas fa-file-invoice-dollar me-2"></i>
                        Pedidos Online

                        <?php if ($CampanaPedidos): ?>
                            <i class="fas fa-bell text-warning ms-2"></i> <!-- Campana -->
                        <?php endif; ?>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="pedidos_tienda.php" class="nav-link i-pedidos_tienda text-white">
                        <i class="fas fa-store me-2"></i>
                        Pedidos en Tienda

                        <?php if ($CampanaPedidosFisicos): ?>
                            <i class="fas fa-bell text-warning ms-2"></i> <!-- Campana -->
                        <?php endif; ?>
                    </a>
                </li>
                <?php if ($_SESSION['rol'] != 'ATENCION_CLIENTE'): ?>
                    <li class="nav-item">
                        <a href="abonos.php" class="nav-link i-abonos text-white">
                            <i class="fas fa-hand-holding-usd me-2"></i>Abonos
                            <?php if ($campanaAbonos): ?>
                            <i class="fas fa-bell text-warning ms-2"></i> <!-- Campana -->
                        <?php endif; ?>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="categorias.php" class="nav-link i-categorias text-white">
                        <i class="fas fa-car me-2"></i>Categorías
                        
                    </a>
                </li>

                <hr />

                <li class="nav-item">
                    <a href="../../controlador/usuarios_c.php?accion=salir" class="nav-link i10 text-white" onclick="salir();">
                        <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                    </a>
                </li>
            </ul>
        </nav>
    </div>



    <script>
        async function salir() {
            event.preventDefault();
            const confirmarSalida = await confirmar('¿Estás seguro de que deseas cerrar sesión?', 'Si, Salir', 'No, cancelar', 'question');
            if (confirmarSalida) {
                window.location.href = '../../controlador/clientes_c.php?accion=salir';
            }
        }
    </script>
    <script src="../../libs/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../libs/SweetAlert2/sweetalert2.all.min.js"></script>
    <script src="../alertas/funcionesalert.js"></script>
