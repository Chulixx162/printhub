<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <link rel="stylesheet" href="../../libs/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../libs/bootstrap-icons-1.11.3/a/bootstrap-icons.css">
    <link rel="stylesheet" href="../../libs/fontawesome-free-6.7.2-web/css/all.min.css">
</head>
<body>
    <footer class="bg-dark text-light pt-4 mt-5">
        <div class="container">
          <div class="row">
    
            <!-- Información de contacto -->
            <div class="col-md-4 mb-4">
              <h5 class="fw-bold">JYS PROMOTORES DE VIAJES Y TURISMO</h5>
              <p><i class="bi bi-geo-alt-fill"></i> Teruel, Huila - Colombia</p>
              <p><i class="bi bi-envelope-fill"></i> contacto@jysviajes.com</p>
              <p><i class="bi bi-phone-fill"></i> +57 314 314 4506</p>
            </div>
    
            <!-- Enlaces rápidos -->
            <div class="col-md-4 mb-4">
              <h5 class="fw-bold">Enlaces rápidos</h5>
              <ul class="list-unstyled">
                <li><a href="PaginaPrincipal.php" class="text-light text-decoration-none">Inicio</a></li>
                <li><a href="productos.php" class="text-light text-decoration-none">Productos Turísticos</a></li>
                <li><a href="quienes_somos.php" class="text-light text-decoration-none">Quiénes somos</a></li>
                <!-- <li><a href="http://localhost/SIW-TURISMO/vista/general/contactanos.php" class="text-light text-decoration-none">Contáctanos</a></li> -->
              </ul>
            </div>
    
            <!-- Redes sociales -->
            <div class="col-md-4 mb-4">
              <h5 class="fw-bold">Síguenos</h5>
              <a href="https://wa.me/573143144506" target="_blank" class="text-light me-3">
                <i class="bi bi-whatsapp" style="font-size: 1.5rem;"></i>
              </a>
              <a href="https://www.facebook.com/share/1aEM7MnAdN/" target="_blank" class="text-light me-3">
                <i class="bi bi-facebook" style="font-size: 1.5rem;"></i>
              </a>
              <!-- <a href="#" target="_blank" class="text-light me-3">
                <i class="bi bi-instagram" style="font-size: 1.5rem;"></i>
              </a>
              <a href="#" target="_blank" class="text-light">
                <i class="bi bi-youtube" style="font-size: 1.5rem;"></i>
              </a> -->
            </div>
    
          </div>
    
          <hr class="border-secondary">
    
          <!-- Derechos -->
          <div class="text-center pb-3">
            <p class="mb-0">&copy; <span id="year"></span> JYS PROMOTORES DE VIAJES Y TURISMO. <br> Todos los derechos reservados.</p>
            <small>Desarrollado por equipo JJV</small>
            <script>
            document.getElementById("year").textContent = new Date().getFullYear();
            </script>
          </div>
        </div>
      </footer>

    <script src="../../libs/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../libs/SweetAlert2/sweetalert2.all.min.js"></script>
    <script src="../alertas/funcionesalert.js"></script>
</body>
</html>