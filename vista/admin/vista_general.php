<?php 
    include('header.php');

    function contarProductos($conn) {
        $sql = "SELECT COUNT(*) as total FROM productos";
        $resultado = $conn->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            return $fila['total'];
        } else {
            return 0;
        }
    }


    function contarUsuarios($conn) {
        $sql = "SELECT COUNT(*) as total FROM usuarios";
        $resultado = $conn->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            return $fila['total'];
        } else {
            return 0;
        }
    }


?>
<style>
    .main-content {
    padding: 1rem;
  }
</style>
<body>
    
    <?php 
    include '../../conexion.php';
    include '../../modelo/usuarios_m.php'; 
    $totalClientes = contarClientes($conn);
    $totalProductos = contarProductos($conn);
    $totalUsuarios= contarUsuarios($conn);

  ?>
    <div class="d-flex flex-column flex-lg-row">

        <?php 
            include('sidebar.php');
        ?>
       
        <!-- Main Content -->
        <div class="flex-grow-1">
            <nav class="navbar navbar-dark">
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <span class="navbar-brand">
                        Bienvenido, <?php echo $_SESSION['nombre']; ?> (<?php echo $_SESSION['rol']; ?>) :
                    </span>

                    <div class="text-light text-end me-3" style="line-height: 1.2;">
                        <div id="current-time" style="font-weight: bold;"></div>
                        <div id="current-date" style="font-size: 0.9rem;"></div>
                    </div>
                </div>

            </nav>
            <div class="main-content">
                <h2 class="mt-4">Resumen general</h2>
                <p>Aquí podrás gestionar toda la información de JYS PROMOTORES DE VIAJES Y TURISMO.</p>

                <!-- Cards resumen -->
                <div class="row g-4">
                    <div class="col-md-4">
                        <a href="clientes.php">
                        <div class="card shadow border-0">
                            <div class="card-body text-center">
                                <i class="fas fa-users fa-2x text-primary"></i>
                                <h5 class="mt-2">Clientes</h5>
                                <p class="mb-0"> <b> <?php echo $totalClientes; ?> </b> Clientes registrados</p>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="productos.php">
                        <div class="card shadow border-0">
                            <div class="card-body text-center">
                                <i class="fas fa-suitcase fa-2x text-success"></i>
                                <h5 class="mt-2">Productos</h5>
                                <p class="mb-0"><b> <?php echo $totalProductos; ?> </b> Productos disponibles</p>
                            </div>
                        </div>
                        </a>
                    </div>
                    <?php if ($_SESSION['rol'] == 'ADMIN'): ?>
                        <div class="col-md-4">
                            <a href="usuarios.php">
                            <div class="card shadow border-0">
                                <div class="card-body text-center">
                                    <i class="fas fa-users-cog fa-2x text-warning"></i>
                                    <h5 class="mt-2">Usuarios</h5>
                                    <p class="mb-0"><b> <?php echo $totalUsuarios; ?> </b> Usuarios registrados</p>
                                </div>
                            </div>
                            </a>
                        
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
        
    </div>
    <?php include ('footer.php'); ?>
    
    <script>
        function updateDateTime() {
            const now = new Date();

            // Hora en zona horaria de Bogotá
            const timeString = now.toLocaleTimeString('es-CO', {
            timeZone: 'America/Bogota'
            });

            // Fecha en zona horaria de Bogotá
            const dateString = now.toLocaleDateString('es-CO', {
            timeZone: 'America/Bogota',
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
            });

            const formattedDate = dateString.charAt(0).toUpperCase() + dateString.slice(1);

            document.getElementById('current-time').textContent = timeString;
            document.getElementById('current-date').textContent = formattedDate;
        }

        setInterval(updateDateTime, 1000);
        updateDateTime();
    </script>

    <script src="../../libs/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>