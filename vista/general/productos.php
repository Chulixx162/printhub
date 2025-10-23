<?php
    session_start();
    if (!isset($_SESSION['id_cliente'])) {
        header("Location: ../login.php");
        exit();
    }
    include '../../conexion.php';
    include '../../modelo/productos_m.php';
    include '../../modelo/obtenerEstados.php';
    $haycarrito = haycarrito();
    $nombreCliente = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Cliente';
    // Obtener filtros desde GET
    $filtroCategoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
    $filtroPrecio = isset($_GET['precio']) ? $_GET['precio'] : '';


   $filtroCategoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
   $filtroPrecio = isset($_GET['precio']) ? $_GET['precio'] : '';

    if (!empty($filtroCategoria) || !empty($filtroPrecio)) {
        $productos = obtenerProductosFiltrados($conn, $filtroCategoria, $filtroPrecio);
    } else {
        $productos = obtenerProductosConCategorias($conn);
    }

    $categorias = obtenerCategorias($conn);

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Productos | SIW-TURISMO</title>
  <link rel="icon" href="../../IMAGENES/Logotipo_sinsombrapng_Mesa de trabajo 1-02.png">
  <link href="../../libs/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../libs/fontawesome-free-6.7.2-web/css/all.min.css" rel="stylesheet">
  <style>
    :root {
      --azul-oscuro:rgb(16, 73, 158);
      --verde-acento: #218838;
      
    }
    .img-producto {
        width: 100%;
        height: 200px; /* o el alto que desees */
        object-fit: cover; /* Recorta y ajusta sin deformar */
        border-radius: 0.5rem;
    }


    body {
      background-color: #e6f0fa;
    }

    .navbar {
      background-color: var(--azul-oscuro);
    }

    .navbar-brand,
    .nav-link,
    .navbar-toggler {
      color: white !important;
    }

    .card-title {
      color: var(--azul-oscuro);
    }

    .btn-carrito {
        background-color: #e8590c;
        color: white;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .btn-carrito:hover {
      background-color: #c34702;
    }

    .carousel-caption {
      background-color: rgba(0, 0, 0, 0.5);
      padding: 1rem;
      border-radius: 10px;
    }
    .card {
      transition: transform 0.2s;
      display: flex;
        flex-direction: column;
        height: 100%;
    }
    .card:hover {
      transform: scale(1.05);
    }
    .card-body {
    flex: 1 1 auto;
    }

    .card-footer {
        margin-top: auto;
    }
  </style>
</head>
<body>
    
    <script>
        const nombreCliente = "<?php echo htmlspecialchars($nombreCliente); ?>";
        const mensaje = `Soy ${nombreCliente}, ¿Podría brindarme más información acerca de los productos que tiene disponibles?.`;
        const mensajeCodificado = encodeURIComponent(mensaje);
        const numero = "573143144506";

        document.addEventListener("DOMContentLoaded", () => {
            const enlaceWhatsApp = document.getElementById("whatsappLink");
            enlaceWhatsApp.href = `https://wa.me/${numero}?text=${mensajeCodificado}`;
        });
    </script>

  <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #003366;">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-warning" >SIW-TURISMO</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="PaginaPrincipal.php">
                            <i class="fas fa-home"></i> Página Principal
                            <hr>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="carrito.php">
                            <i class="fas fa-cart-shopping"></i> Carrito
                            <?php if ($haycarrito): ?>
                                <span class="badge bg-danger"><?php echo count($_SESSION['carrito']); ?></span>
                            <?php endif; ?>
                            <hr>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="perfil.php" class="nav-link"><i class="fas fa-user"></i> Perfil <hr></a>
                    </li>
                    
                    
                </ul>

                <!-- Botón WhatsApp-->
                <div class="d-flex">
                    <a class="btn btn-danger me-2" onclick="salir(); ">Cerrar Sesión</a>
                    <a id="whatsappLink" class="btn btn-success me-2" target="_blank">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    
                </div>
            </div>
        </div>
    </nav>



  <!-- Productos -->
    <div class="container my-5">

        <div class="text-center mb-4">
            <h1 class="fw-bold">Bienvenido, <?php echo htmlspecialchars($nombreCliente); ?>!</h1>
            <p class="lead">Explora nuestros productos y servicios turísticos.</p>
        </div>
        <h2 class="mb-4 text-center">Nuestras Categorías</h2>
        <div class="d-flex flex-wrap justify-content-center gap-2 my-3">
            <?php foreach ($categorias as $categoria): ?>
                <span
                    tabindex="0"
                    class="badge bg-info text-dark"
                    data-bs-toggle="popover"
                    data-bs-trigger="hover"
                    title="Descripción"
                    style="cursor: pointer;"
                    data-bs-content="<?= htmlspecialchars($categoria['descripcion']) ?>">
                    <?= htmlspecialchars($categoria['nombre']) ?>
                </span>
            <?php endforeach; ?>
        </div>

        <h2 class="mb-4 text-center">Nuestros Productos</h2>
            <form method="GET" class="mb-4">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="categoria" class="form-label">Categoría</label>
                        <select name="categoria" id="categoria" class="form-select">
                            <option value="">Todas Las Categorias</option>
                            <?php
                            
                            foreach ($categorias as $cat) {
                                $selected = ($filtroCategoria == $cat['id']) ? 'selected' : '';
                                echo "<option value='{$cat['id']}' $selected>{$cat['nombre']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="precio" class="form-label">Precio máximo</label>
                        <input type="number" name="precio" id="precio" class="form-control" value="<?php echo htmlspecialchars($filtroPrecio); ?>" placeholder="Ej. 500000">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter"></i> Aplicar Filtros
                        </button>
                    </div>
                </div>
            </form>


        <div class="row row-cols-1 row-cols-md-3 g-4">
        
            <?php foreach ($productos as $producto): ?>
                <div class="col">
                    <div class="card h-100 d-flex flex-column">
                        <img src="../../img/productos/<?php echo htmlspecialchars($producto['imagen']); ?>" class="card-img-top img-producto" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                        <div class="card-body flex-grow-1">
                            <h5 class="card-title"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                            <p class="card-text">
                                <?php echo substr(htmlspecialchars($producto['descripcion']), 0, 100); ?>...
                            </p>
                            <!-- Botón para abrir el modal -->
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalProducto<?php echo $producto['id']; ?>">
                                Ver más
                            </button>
                        </div>

                        <div class="card-footer mt-auto">
                            <p class="card-text"><strong>Precio:</strong> $<?php echo number_format($producto['precio'], 0, ',', '.'); ?></p>
                            <p class="card-text"><strong>Categoría:</strong> <?php echo htmlspecialchars($producto['nombre_categoria']); ?></p>

                            <form class="form-agregar-carrito" action="../../controlador/carrito_c.php?accion=agregar" method="POST">
                                <input type="hidden" name="id_producto" value="<?php echo $producto['id']; ?>">
                                <input type="hidden" name="nombre" value="<?php echo $producto['nombre']; ?>">
                                <input type="hidden" name="precio" value="<?php echo $producto['precio']; ?>">
                                <input type="hidden" name="cantidad" value="1">
                                <button type="button" class="btn btn-carrito w-100 mt-2" onclick="confirmarAgregar(this)">
                                    <i class="fas fa-cart-plus"></i> Añadir al carrito
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalProducto<?php echo $producto['id']; ?>" tabindex="-1" aria-labelledby="modalLabel<?php echo $producto['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel<?php echo $producto['id']; ?>">
                                    <?php echo htmlspecialchars($producto['nombre']); ?>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <img src="../../img/productos/<?php echo htmlspecialchars($producto['imagen']); ?>" class="card-img-top img-producto" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                                <p><?php echo nl2br(htmlspecialchars($producto['descripcion'])); ?></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>


        

        </div>
    </div>

    <!-- Footer Complejo -->
    <footer class="bg-dark text-light pt-4 mt-5pt-5 pb-4 " style="background-color: #002752;">
        <div class="container text-center text-md-start">
            <div class="row text-center text-md-start">

            <!-- Sección: Empresa -->
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold text-warning">JYS PROMOTORES</h5>
                <p>Promovemos experiencias turísticas inolvidables en el Huila y más allá. Conecta, viaja y descubre con nosotros.</p>
            </div>

            <!-- Sección: Enlaces -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold text-warning">Enlaces</h5>
                <p><a href="PaginaPrincipal.php" class="text-white text-decoration-none">Inicio</a></p>
                <p><a href="quienes_somos.php" class="text-white text-decoration-none">Nosotros</a></p>
            </div>

            <!-- Sección: Contacto -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="mb-4 fw-bold text-warning">Contacto</h5>
                <p><i class="fas fa-home me-2"></i> Teruel, Huila, Colombia</p>
                <p><i class="fas fa-envelope me-2"></i> info@jysturismo.com</p>
               <p>
                    <a href="https://wa.me/573143144506" target="_blank" class="text-white text-decoration-none">
                        <i class="fas fa-mobile-alt me-2"></i> Escríbenos por WhatsApp <br>
                        Haciendo clic aquí
                    </a>
                </p>

            </div>

            <!-- Sección: Redes sociales -->
            <div class="col-md-3 col-lg-3 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold text-warning">Síguenos</h5>
                <a href="https://wa.me/573143144506" target="_blank" class=" text-decoration-none btn btn-outline-light btn-floating m-1" role="button"><i class="fab fa-whatsapp"></i></a>
                <!-- <a href="#" class="btn btn-outline-light btn-floating m-1" role="button"><i class="fab fa-instagram"></i></a> -->
                <a href="https://www.facebook.com/share/1aEM7MnAdN/" target="_blank" class="btn btn-outline-light btn-floating m-1" role="button"><i class="fab fa-facebook-f"></i></a>
                <!-- <a href="#" class="btn btn-outline-light btn-floating m-1" role="button"><i class="fab fa-youtube"></i></a> -->
            </div>
            </div>

            <!-- Línea divisoria -->
            <hr class="my-3">

            <!-- Derechos reservados -->
            <div class="row align-items-center">
                <div class="col-12 col-lg-8">
                    <p class="text-white"> &copy; <span id="year"></span> JYS PROMOTORES DE VIAJES Y TURISMO. <br> Todos los derechos reservados.</p>
                </div>
                
            </div>
        </div>
    </footer>
    <script>
        // Actualizar el año en el footer
        document.getElementById("year").textContent = new Date().getFullYear();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
            const popoverList = [...popoverTriggerList].map(el => new bootstrap.Popover(el));
        });
    </script>
    <script src="../../libs/SweetAlert2/sweetalert2.all.min.js"></script>
    <script src="../../vista/alertas/funcionesalert.js"></script>

    <script>
        async function confirmarAgregar(boton) {
            const confirmado = await confirmar(
                '¿Estás seguro de que deseas añadir este producto al carrito?',
                'Sí, añadir',
                'Cancelar',
                'question'
            );

            if (confirmado) {
                localStorage.setItem('scrollPos', window.scrollY); // Guardamos posición
                boton.closest('form').submit();
            }
        }
        window.addEventListener('load', () => {
            const pos = localStorage.getItem('scrollPos');
            if (pos) {
            window.scrollTo(0, parseInt(pos));
            localStorage.removeItem('scrollPos');
            }
        });
        async function salir() {
            event.preventDefault();
            const confirmarSalida = await confirmar('¿Estás seguro de que deseas cerrar sesión?','Si, Salir', 'No, cancelar', 'question');
            if (confirmarSalida) {
                window.location.href =  '../../controlador/clientes_c.php?accion=salir';
            }
        }
    </script>
    <script src="../../libs/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
