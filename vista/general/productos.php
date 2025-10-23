<?php
    session_start();
    if (!isset($_SESSION['id_cliente'])) {
        header("Location: ../login");
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
  <title>Productos | PRINT HUB</title>
  <link rel="icon" href="../../IMAGENES/LogoPrint_b.png">
  <link href="../../libs/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../libs/fontawesome-free-6.7.2-web/css/all.min.css" rel="stylesheet">
  <style>
    :root {
      --azul-oscuro:rgb(16, 73, 158);
      --verde-acento: #218838;
    }

    /* Mejoras tipográficas y espaciado general */
    body {
      background-color: #e6f0fa;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
      line-height: 1.6;
    }

    /* Navbar mejorado con sombra sutil */
    .navbar {
      background-color: var(--azul-oscuro);
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
      padding: 1rem 0;
    }

    .navbar-brand,
    .nav-link,
    .navbar-toggler {
      color: white !important;
    }

    /* Mejora en los enlaces del navbar con transición suave */
    .nav-link {
      position: relative;
      transition: all 0.3s ease;
      padding: 0.5rem 1rem !important;
      border-radius: 8px;
    }

    .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.1);
      transform: translateY(-2px);
    }

    .nav-link hr {
      margin: 0.25rem 0 0 0;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .nav-link:hover hr {
      opacity: 1;
    }

    /* Badge del carrito mejorado */
    .nav-link .badge {
      position: absolute;
      top: 0;
      right: 0;
      transform: translate(25%, -25%);
      font-size: 0.7rem;
      padding: 0.25rem 0.5rem;
      border-radius: 10px;
    }

    /* Sección de bienvenida mejorada */
    .welcome-section {
      background: linear-gradient(135deg, rgba(16, 73, 158, 0.05) 0%, rgba(255, 255, 255, 0.8) 100%);
      padding: 3rem 1rem;
      border-radius: 16px;
      margin-bottom: 3rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .welcome-section h1 {
      font-size: 2.5rem;
      font-weight: 700;
      color: var(--azul-oscuro);
      margin-bottom: 0.5rem;
    }

    .welcome-section .lead {
      font-size: 1.2rem;
      color: #555;
      font-weight: 400;
    }

    /* Badges de categorías mejorados */
    .category-badge {
      padding: 0.75rem 1.5rem;
      font-size: 0.95rem;
      font-weight: 500;
      border-radius: 50px;
      transition: all 0.3s ease;
      cursor: pointer;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .category-badge:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
    }

    /* Sección de filtros mejorada */
    .filter-section {
      background: white;
      padding: 2rem;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      margin-bottom: 3rem;
    }

    .filter-section label {
      font-weight: 600;
      color: var(--azul-oscuro);
      margin-bottom: 0.5rem;
    }

    .filter-section .form-select,
    .filter-section .form-control {
      border: 2px solid #e0e0e0;
      border-radius: 10px;
      padding: 0.75rem 1rem;
      transition: all 0.3s ease;
    }

    .filter-section .form-select:focus,
    .filter-section .form-control:focus {
      border-color: var(--azul-oscuro);
      box-shadow: 0 0 0 0.2rem rgba(16, 73, 158, 0.15);
    }

    /* Títulos de sección mejorados */
    .section-title {
      font-size: 2rem;
      font-weight: 700;
      color: var(--azul-oscuro);
      margin-bottom: 2rem;
      position: relative;
      display: inline-block;
    }

    .section-title::after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 4px;
      background-color: #e8590c;
      border-radius: 2px;
    }

    /* Cards de productos completamente rediseñadas */
    .card {
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      display: flex;
      flex-direction: column;
      height: 100%;
      border: none;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
      background: white;
    }

    .card:hover {
      transform: translateY(-12px);
      box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
    }

    /* Imágenes de productos mejoradas */
    .img-producto {
      width: 100%;
      height: 240px;
      object-fit: cover;
      transition: transform 0.4s ease;
    }

    .card:hover .img-producto {
      transform: scale(1.08);
    }

    .card-img-top {
      overflow: hidden;
    }

    /* Cuerpo de la card mejorado */
    .card-body {
      flex: 1 1 auto;
      padding: 1.5rem;
    }

    .card-title {
      color: var(--azul-oscuro);
      font-size: 1.25rem;
      font-weight: 700;
      margin-bottom: 1rem;
      line-height: 1.3;
    }

    .card-text {
      color: #666;
      font-size: 0.95rem;
      line-height: 1.6;
      margin-bottom: 1rem;
    }

    /* Botón "Ver más" mejorado */
    .btn-ver-mas {
      padding: 0.5rem 1.25rem;
      border-radius: 8px;
      font-weight: 600;
      font-size: 0.9rem;
      transition: all 0.3s ease;
    }

    /* Footer de la card mejorado */
    .card-footer {
      margin-top: auto;
      background: #f8f9fa;
      border-top: 2px solid #e9ecef;
      padding: 1.5rem;
    }

    .card-footer p {
      margin-bottom: 0.75rem;
      font-size: 0.95rem;
    }

    .card-footer strong {
      color: var(--azul-oscuro);
      font-weight: 700;
    }

    .precio-destacado {
      font-size: 1.5rem;
      color: #e8590c;
      font-weight: 800;
    }

    /* Botón de carrito mejorado */
    .btn-carrito {
      background-color: #e8590c;
      color: white;
      font-weight: 700;
      transition: all 0.3s ease;
      border: none;
      border-radius: 10px;
      padding: 0.875rem 1.5rem;
      font-size: 1rem;
      box-shadow: 0 4px 12px rgba(232, 89, 12, 0.3);
    }

    .btn-carrito:hover {
      background-color: #c34702;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(232, 89, 12, 0.4);
    }

    .btn-carrito i {
      margin-right: 0.5rem;
    }

    /* Modal mejorado */
    .modal-content {
      border-radius: 16px;
      border: none;
      overflow: hidden;
    }

    .modal-header {
      background-color: var(--azul-oscuro);
      color: white;
      padding: 1.5rem;
    }

    .modal-title {
      font-weight: 700;
      font-size: 1.5rem;
    }

    .modal-body {
      padding: 2rem;
    }

    .modal-body img {
      border-radius: 12px;
      margin-bottom: 1.5rem;
    }

    /* Footer mejorado */
    footer {
      background-color: #002752;
      margin-top: 5rem;
    }

    footer h5 {
      font-weight: 700;
      letter-spacing: 0.5px;
    }

    footer p {
      line-height: 1.8;
      color: rgba(255, 255, 255, 0.85);
    }

    footer a {
      transition: all 0.3s ease;
    }

    footer a:hover {
      color: #ffc107 !important;
      transform: translateX(5px);
    }

    .btn-floating {
      width: 42px;
      height: 42px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }

    .btn-floating:hover {
      transform: translateY(-4px);
      box-shadow: 0 6px 16px rgba(255, 255, 255, 0.3);
    }

    /* Botones de acción mejorados */
    .btn-danger, .btn-success {
      border-radius: 10px;
      padding: 0.625rem 1.5rem;
      font-weight: 600;
      transition: all 0.3s ease;
      border: none;
    }

    .btn-danger:hover, .btn-success:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    /* Mejoras responsive */
    @media (max-width: 768px) {
      .welcome-section h1 {
        font-size: 1.75rem;
      }

      .section-title {
        font-size: 1.5rem;
      }

      .filter-section {
        padding: 1.5rem;
      }
    }

    /* Animación de carga suave */
    .card {
      animation: fadeInUp 0.6s ease-out;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>
    
    <script>
        const nombreCliente = "<?php echo htmlspecialchars($nombreCliente); ?>";
        const mensaje = `Soy ${nombreCliente}, ¿Podría brindarme más información acerca de los productos que tiene disponibles?.`;
        const mensajeCodificado = encodeURIComponent(mensaje);
        const numero = "573102366157";

        document.addEventListener("DOMContentLoaded", () => {
            const enlaceWhatsApp = document.getElementById("whatsappLink");
            enlaceWhatsApp.href = `https://wa.me/${numero}?text=${mensajeCodificado}`;
        });
    </script>

  <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #003366;">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-warning" style="font-size: 1.5rem;">Print Hub</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="PaginaPrincipal">
                            <i class="fas fa-home"></i> Página Principal
                            <hr>
                        </a>
                    </li>
                    <li class="nav-item position-relative">
                        <a class="nav-link" href="carrito">
                            <i class="fas fa-cart-shopping"></i> Carrito
                            <?php if ($haycarrito): ?>
                                <span class="badge bg-danger"><?php echo count($_SESSION['carrito']); ?></span>
                            <?php endif; ?>
                            <hr>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="perfil" class="nav-link"><i class="fas fa-user"></i> Perfil <hr></a>
                    </li>
                </ul>

                <!-- Botón WhatsApp-->
                <div class="d-flex gap-2">
                    <a class="btn btn-danger" onclick="salir();">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </a>
                    <a id="whatsappLink" class="btn btn-success" target="_blank">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </nav>

  <!-- Productos -->
    <div class="container my-5">
        <!-- Sección de bienvenida mejorada -->
        <div class="welcome-section text-center">
            <h1>Bienvenido, <?php echo htmlspecialchars($nombreCliente); ?>!</h1>
            <p class="lead">Explora nuestros productos y servicios de impresión.</p>
        </div>

        <!-- Categorías con mejor presentación -->
        <div class="text-center mb-5">
            <h2 class="section-title">Nuestras Categorías</h2>
        </div>
        <div class="d-flex flex-wrap justify-content-center gap-3 mb-5">
            <?php foreach ($categorias as $categoria): ?>
                <span
                    tabindex="0"
                    class="badge bg-info text-dark category-badge"
                    data-bs-toggle="popover"
                    data-bs-trigger="hover"
                    title="Descripción"
                    style="cursor: pointer;"
                    data-bs-content="<?= htmlspecialchars($categoria['descripcion']) ?>">
                    <?= htmlspecialchars($categoria['nombre']) ?>
                </span>
            <?php endforeach; ?>
        </div>

        <!-- Sección de filtros mejorada -->
        <div class="text-center mb-4">
            <h2 class="section-title">Nuestros Productos</h2>
        </div>
        
        <div class="filter-section">
            <form method="GET">
                <div class="row g-4 align-items-end">
                    <div class="col-md-4">
                        <label for="categoria" class="form-label">
                            <i class="fas fa-tag me-2"></i>Categoría
                        </label>
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
                        <label for="precio" class="form-label">
                            <i class="fas fa-dollar-sign me-2"></i>Precio máximo
                        </label>
                        <input type="number" name="precio" id="precio" class="form-control" value="<?php echo htmlspecialchars($filtroPrecio); ?>" placeholder="Ej. 500000">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100" style="padding: 0.75rem;">
                            <i class="fas fa-filter me-2"></i> Aplicar Filtros
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Grid de productos mejorado -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($productos as $producto): ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-img-top">
                            <img src="../../img/productos/<?php echo htmlspecialchars($producto['imagen']); ?>" class="img-producto" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                            <p class="card-text">
                                <?php echo substr(htmlspecialchars($producto['descripcion']), 0, 100); ?>...
                            </p>
                            <button class="btn btn-sm btn-primary btn-ver-mas" data-bs-toggle="modal" data-bs-target="#modalProducto<?php echo $producto['id']; ?>">
                                <i class="fas fa-info-circle me-1"></i> Ver más
                            </button>
                        </div>

                        <div class="card-footer">
                            <p class="mb-2">
                                <strong>Precio:</strong> 
                                <span class="precio-destacado">$<?php echo number_format($producto['precio'], 0, ',', '.'); ?></span>
                            </p>
                            <p class="mb-3">
                                <strong>Categoría:</strong> 
                                <span class="badge bg-secondary"><?php echo htmlspecialchars($producto['nombre_categoria']); ?></span>
                            </p>

                            <form class="form-agregar-carrito" action="../../controlador/carrito_c.php?accion=agregar" method="POST">
                                <input type="hidden" name="id_producto" value="<?php echo $producto['id']; ?>">
                                <input type="hidden" name="nombre" value="<?php echo $producto['nombre']; ?>">
                                <input type="hidden" name="precio" value="<?php echo $producto['precio']; ?>">
                                <input type="hidden" name="cantidad" value="1">
                                <button type="button" class="btn btn-carrito w-100" onclick="confirmarAgregar(this)">
                                    <i class="fas fa-cart-plus"></i> Añadir al carrito
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalProducto<?php echo $producto['id']; ?>" tabindex="-1" aria-labelledby="modalLabel<?php echo $producto['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel<?php echo $producto['id']; ?>">
                                    <?php echo htmlspecialchars($producto['nombre']); ?>
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <img src="../../img/productos/<?php echo htmlspecialchars($producto['imagen']); ?>" class="img-fluid rounded" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                                <p class="mt-3"><?php echo nl2br(htmlspecialchars($producto['descripcion'])); ?></p>
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

    <!-- Footer -->
    <footer class="bg-dark text-light pt-5 pb-4">
        <div class="container text-center text-md-start">
            <div class="row text-center text-md-start">
            <!-- Sección: Empresa -->
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold text-warning">Print Hub</h5>
                <p>Ofrecemos todo tipo de accesorios para impresoras, además venta de estas mismas.</p>
            </div>

            <!-- Sección: Enlaces -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold text-warning">Enlaces</h5>
                <p><a href="PaginaPrincipal" class="text-white text-decoration-none">Inicio</a></p>
                <p><a href="quienes_somos" class="text-white text-decoration-none">Nosotros</a></p>
            </div>

            <!-- Sección: Contacto -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="mb-4 fw-bold text-warning">Contacto</h5>
                <p><i class="fas fa-home me-2"></i> Neiva, Huila, Colombia</p>
                <p><i class="fas fa-envelope me-2"></i> info@printhub.com</p>
               <p>
                    <a href="https://wa.me/573102366157" target="_blank" class="text-white text-decoration-none">
                        <i class="fas fa-mobile-alt me-2"></i> Escríbenos por WhatsApp <br>
                        Haciendo clic aquí
                    </a>
                </p>
            </div>

            <!-- Sección: Redes sociales -->
            <div class="col-md-3 col-lg-3 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold text-warning">Síguenos</h5>
                <a href="https://wa.me/573102366157" target="_blank" class="text-decoration-none btn btn-outline-light btn-floating m-1" role="button"><i class="fab fa-whatsapp"></i></a>
                <a href="#" class="btn btn-outline-light btn-floating m-1" role="button"><i class="fab fa-instagram"></i></a>
                <a href="#" target="_blank" class="btn btn-outline-light btn-floating m-1" role="button"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="btn btn-outline-light btn-floating m-1" role="button"><i class="fab fa-youtube"></i></a>
            </div>
            </div>

            <!-- Línea divisoria -->
            <hr class="my-4">

            <!-- Derechos reservados -->
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <p class="text-white mb-0"> &copy; <span id="year"></span> PRINT HUB. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
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
                localStorage.setItem('scrollPos', window.scrollY);
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
