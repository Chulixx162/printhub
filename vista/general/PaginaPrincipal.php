<?php
session_start();
if (!isset($_SESSION['id_cliente'])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JYS Promotores de Viajes y Turismo - RNT: 125482</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../libs/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
      <link href="../../libs/fontawesome-free-6.7.2-web/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="../../IMAGENES/Logotipo_sinsombrapng_Mesa de trabajo 1-02.png">
    
    <style>
        :root {
            --primary-color: #2c5aa0;
            --secondary-color: #f39c12;
            --accent-color: #e74c3c;
            --dark-color: #2c3e50;
            --light-color: #ecf0f1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(rgba(44, 90, 160, 0.8), rgba(52, 152, 219, 0.8)), 
            url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><rect fill="%234a90e2" width="1200" height="600"/><path fill="%23ffffff" opacity="0.1" d="M0,300 Q300,100 600,300 T1200,300 L1200,600 L0,600 Z"/></svg>');
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #333;
        }

        /* Header Styles */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color), #3498db);
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }

        .navbar-nav .nav-link {
            color: white !important;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: var(--secondary-color) !important;
            transform: translateY(-2px);
        }

        /* Hero Section */
        .hero {
            
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            color: white;
            text-align: center;
        }

        /* Logo Styles */
        .hero-logo {
            max-width: 100%;
            height: auto;
            max-height: 200px;
            margin-bottom: 2rem;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.3));
            transition: transform 0.3s ease;
        }

        .hero-logo:hover {
            transform: scale(1.05);
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        .btn-custom {
            background: var(--secondary-color);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin: 0 10px;
        }

        .btn-custom:hover {
            background: #e67e22;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            color: white;
        }

        .btn-outline-custom {
            background: transparent;
            color: white;
            border: 2px solid white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin: 0 10px;
        }

        .btn-outline-custom:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* Footer */
        .footer {
            background: var(--dark-color);
            color: white;
            padding: 60px 0 20px;
        }

        .footer h5 {
            color: var(--secondary-color);
            margin-bottom: 20px;
            font-weight: 600;
        }

        .footer a {
            color: #bdc3c7;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: var(--secondary-color);
        }

        .social-links a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: var(--primary-color);
            color: white;
            text-align: center;
            line-height: 40px;
            border-radius: 50%;
            margin: 0 5px;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: var(--secondary-color);
            transform: translateY(-3px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-logo {
                max-height: 150px;
                margin-bottom: 1.5rem;
            }
            
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero p {
                font-size: 1.1rem;
            }
            
            .btn-custom, .btn-outline-custom {
                display: block;
                margin: 10px auto;
                width: 200px;
            }
        }

        @media (max-width: 576px) {
            .hero-logo {
                max-height: 120px;
                margin-bottom: 1rem;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .hero p {
                font-size: 1rem;
            }
            
            .navbar-brand {
                font-size: 1.2rem;
            }
        }

        /* Animation */
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

        .fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes logoFloat {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .logo-float {
            animation: logoFloat 3s ease-in-out infinite;
        }
        #iconInicio{
          color: #f39c12 !important;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand">
                <i class="fas fa-bus"></i> JYS PROMOTORES
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                      <a class="nav-link" id="iconInicio" href="PaginaPrincipal.php">
                        <i class="fas fa-home"></i> Inicio
                      </a>
                    </li>
                    <li>
                        <a href="perfil.php" class="nav-link">
                            <i class="fas fa-user"></i> Perfil
                        </a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="inicio" class="hero mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto fade-in-up">
                    <!-- Logo centrado -->
                    <div class="text-center mb-4">
                        <img src="../../IMAGENES/Logotipo_sinsombrapng_Mesa de trabajo 1-02.png" alt="JYS Promotores de Viajes y Turismo" class="hero-logo logo-float">
                    </div>
                    
                    <h1>Descubre el Mundo con JYS</h1>
                    <p class="lead">Promotores de Viajes y Turismo - RNT: 125482</p>
                    <p>Creamos experiencias únicas e inolvidables. Tu próxima aventura comienza aquí.</p>
                    <div class="mt-4">
                        <a href="productos.php" class="btn-custom">Productos</a>
                        <a class="btn-outline-custom" onclick="salir(); ">Cerrar Sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php' ?>

    
    
    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navbar background change on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'linear-gradient(135deg, rgba(44, 90, 160, 0.95), rgba(52, 152, 219, 0.95))';
                navbar.style.backdropFilter = 'blur(10px)';
            } else {
                navbar.style.background = 'linear-gradient(135deg, var(--primary-color), #3498db)';
                navbar.style.backdropFilter = 'none';
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
</body>
</html>
