<!DOCTYPE html>
<html lang="es">

<!-- http://localhost/SIW-TURISMO/vista/general/index.php -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JYS Promotores de Viajes</title>
    <link rel="stylesheet" href="../../libs/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="icon" href="../../IMAGENES/Logotipo_sinsombrapng_Mesa de trabajo 1-02.png">
    <link rel="stylesheet" href="../../libs/bootstrap-icons-1.11.3/a/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../libs/fontawesome-free-6.7.2-web/css/all.min.css">
    <style>
        .hero {
            background-image: url('../../IMAGENES/playa2.jpg');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            color: white;
        }

        .hero-overlay {
            background-color: #189cca;
            padding: 2rem;
            border-radius: 1rem;
        }

        /* .inicia{
            border-radius: 2rem;
            border: white;
        } */
        footer {
            background-color: #212529;
            color: white;
            padding: 1rem;
        }

        .fixed-back-btn {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 999;
        }

        .navbar {
            background-color: #00a9d4;
            color: white;
        }

        /* #00a9d4 */
        /* .nav-item{
            color: white;
        } */
        .nav-link {
            color: white !important;
        }

        .nav-link :hover {
            color: bold;
        }

        .ya {
            background-color: #189cca;
            padding: 2rem;
            border-radius: 1rem;
        }

        /* .nav-menu {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            font-size: 1.2rem;
        }
        .nav-menu :hover {
            text-decoration: underline;
            text-decoration-line: underline;
            cursor: pointer;
        } */

        .nav-menu {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            margin-right: 10px;
            border-right: 5px;
            font-size: 1.2rem;
            position: relative;
            display: inline-block;
        }

        /* Efecto hover */
        .nav-menu::after {
            content: "";
            position: absolute;
            width: 0%;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #fff;
            transition: width 0.3s ease-in-out;
        }


        .nav-menu.active::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 3px;
            background-color: #fff;
            border-radius: 2px;
            transition: width 0.3s ease-in-out;
        }

        .nav-menu:hover::after {
            width: 100%;
        }

        .nav-menu:hover {
            cursor: pointer;
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 20px;
            overflow: hidden;
        }

        .card:hover {
            transform: scale(1.05);
            /* Aumenta el tamaño en un 5% */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            /* Sombra más notoria */
        }

        /* Botones flotantes derecho */
        .social-buttons {
            position: fixed;
            bottom: 90px;
            right: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            z-index: 15;
        }

        .social-buttons img {
            width: 50px;
            height: 50px;
            /* border-radius: 15px; */
            /* box-shadow: 2px 2px 8px rgba(0,0,0,0.3); */
            cursor: pointer;
        }

        .scroll-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #0077a6;
            /* Color azul de tu página */
            color: white;
            padding: 10px 12px;
            border-radius: 50%;
            font-size: 1.2rem;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .scroll-to-top:hover {
            transform: scale(1.2);
            background-color: #005f80;
            /* Un tono más oscuro al pasar el mouse */
        }
    </style>
</head>

<body id="top">
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <img src="../../IMAGENES/Logotipo_sinsombrapng_Mesa de trabajo 1-02.png"
                    width="120" alt="Logo">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-menu active" href="#">Inicio</a></li>
                    <!-- <li class="nav-item"><a class="nav-menu" href="http://localhost/SIW-TURISMO/vista/general/login.php">Servicios</a> -->
                    </li>
                    <li class="nav-item"><a class="nav-menu"
                            href="contactanos.php">Contacto</a></li>
                    <li class="nav-item"><a class="btn btn-outline-light "
                            href="../login.php">INGRESAR</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4">
                    <div class="hero-overlay">
                        <h1 class="fw-bold">Explora, vive y disfruta</h1>
                        <p class="lead">En <strong>JYS Promotores de Viajes y Turismo</strong> nos encargamos de planear
                            tu viaje soñado. Más que una agencia, somos tu guía de aventuras.</p>
                        <a href="quienes_somos.php"
                            class="btn btn-outline-light">Conócenos</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="ya text-light p-4 ">
                        <h4 class="mb-3">¿Ya tienes cuenta?</h4>
                        <p>Haz clic aquí para iniciar sesión:</p>
                        <a href="../login.php" class="inicia btn btn-outline-light">Iniciar
                            sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- tarjetas -->
    <section id="servicios" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">¿Por qué viajar con nosotros?</h2>
            <div class="row g-4">

                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-shoe-prints text-primary" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="card-title fw-bold">Experiencias de alta calidad</h5>
                            <p class="card-text">En JYS Promotores, diseñamos viajes únicos con destinos inolvidables,
                                atención personalizada y planes hechos a tu medida. Vivencias que superan expectativas.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-user-check text-primary" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="card-title fw-bold">Pensamos en ti</h5>
                            <p class="card-text">Tu comodidad y felicidad son nuestra prioridad. Cada destino, actividad
                                y hotel ha sido seleccionado pensando en lo que tú y tu familia realmente necesitan.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-bus text-primary" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="card-title fw-bold">Viajes a todo Colombia</h5>
                            <p class="card-text">Desde el Amazonas hasta La Guajira, te llevamos a conocer los rincones
                                más asombrosos del país. ¡Descubre Colombia con nosotros de forma segura y confiable!
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-map-marker-alt text-primary" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="card-title fw-bold">Atención local en Teruel</h5>
                            <p class="card-text">¿Estás cerca de Teruel? Te atendemos personalmente para planear juntos
                                tu
                                próxima aventura. ¡Conócenos y recibe asesoría directa y personalizada!</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Botones sociales -->
    <div class="row">
        <div class="col-12">
            <div class="social-buttons text-center">
                <a href="https://wa.me/573143144506" target="_blank">
                    <img src="../../IMAGENES/whatsapp.png" alt="WhatsApp">
                </a>
                <a href="https://www.facebook.com/share/1aEM7MnAdN/" target="_blank">
                    <img src="../../IMAGENES/facebook.png" alt="Facebook">
                </a>
            </div>
        </div>
    </div>
    <a href="#top" class="scroll-to-top">
        <i class="fas fa-chevron-up"></i>
    </a>


    <!-- FOOTER -->
    <footer class="text-center">
        <p class="mb-0">&copy; <span id="year"></span> <br>JYS Promotores de Viajes y Turismo. Todos los derechos reservados.</p>
        <p>Síguenos en redes sociales | Contacto: 3143144506</p>
    </footer>
    <!--FECHA-->
    <script>
    document.getElementById("year").textContent = new Date().getFullYear();
    </script>

    <!-- BOTÓN VOLVER ATRÁS -->
    <!-- <a href="javascript:history.back()" class="btn btn-secondary fixed-back-btn">&larr; Atrás</a> -->

    <script src="../../libs/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>