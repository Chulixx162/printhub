<!DOCTYPE html>
<html lang="es">
<head>
	<title>Ingresar - JYS</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" href="../libs/fontawesome-free-6.7.2-web/css/all.min.css">
	<link rel="icon" href="../IMAGENES/Logotipo_sinsombrapng_Mesa de trabajo 1-02.png">
	<link rel="stylesheet" href="../libs/bootstrap-5.3.3-dist/css/bootstrap.min.css">

	<style>
		/* ---------------- BASE ---------------- */
		body {
			font-family: 'Segoe UI', Arial, sans-serif;
			margin: 0;
			padding: 0;
			min-height: 100vh;
			display: flex;
			flex-direction: column;
			background: #f8f9fa;
			position: relative;
		}

		/* Simplified background with solid blue and white pattern */
		body::before {
			content: "";
			position: absolute;
			top: 0; 
			left: 0;
			width: 100%; 
			height: 100%;
			background: linear-gradient(180deg, #1e3a8a 0%, #176ffdff 50%, #176ffdff 100%);
			z-index: 0;
		}

		/* ---------------- NAVBAR ---------------- */
		/* Solid blue navbar without transparency */
		.dashboard-Navbar {
			background: #1e3a8a;
			color: white;
			padding: 16px 20px;
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			box-shadow: 0 2px 8px rgba(0,0,0,0.1);
			z-index: 1000;
			text-align: center;
			display: flex;
			justify-content: center;
			align-items: center;
			border-bottom: 3px solid #3b82f6;
		}

		.dashboard-sideBar-title img {
			border-radius: 8px;
			width: 100px;
			height: 100px;
			margin-right: 15px;
		}

		.dashboard-sideBar-title h1 {
			font-size: clamp(16px, 3.5vw, 24px);
			font-weight: 600;
			letter-spacing: 0.5px;
			color: #ffffff;
			margin: 0;
		}

		/* ---------------- LOGIN FORM ---------------- */
		/* Clean white form with solid blue accents */
		.logInForm {
			position: relative;
			z-index: 2;
			background: #ffffff;
			border: 2px solid #e5e7eb;
			border-radius: 12px;
			padding: 40px 30px;
			width: 100%;
			max-width: 420px;
			margin: 140px auto 40px auto;
			text-align: center;
			color: #1f2937;
			box-shadow: 0 4px 20px rgba(0,0,0,0.08);
		}

		/* Blue icon instead of white */
		.logInForm i {
			color: #1e3a8a;
			margin-bottom: 20px;
		}

		.logInForm h2 {
			font-size: 24px;
			margin-bottom: 30px;
			font-weight: 600;
			color: #1e3a8a;
			text-transform: none;
		}

		.form-control {
			border: 2px solid #e5e7eb;
			border-radius: 8px;
			text-align: left;
			font-size: 16px;
			padding: 12px 16px;
			transition: border-color 0.3s ease;
		}

		.form-control:focus {
			border-color: #3b82f6;
			box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
			outline: none;
		}

		label {
			font-weight: 500;
			display: block;
			margin-bottom: 8px;
			color: #374151;
			text-align: left;
		}

		/* ---------------- BOTONES ---------------- */
		/* Solid blue button without gradients */
		.btncolor {
			background: #1e3a8a;
			color: white;
			border: none;
			padding: 14px 20px;
			border-radius: 8px;
			cursor: pointer;
			width: 100%;
			font-size: 16px;
			font-weight: 500;
			transition: background-color 0.3s ease;
		}

		.btncolor:hover {
			background: #1d4ed8;
		}

		/* Blue links instead of orange */
		a {
			color: #3b82f6;
			font-weight: 500;
			text-decoration: none;
			transition: color 0.3s;
		}
		
		a:hover {
			color: #1e3a8a;
			text-decoration: underline;
		}

		/* ---------------- BOTÓN FLOTANTE ---------------- */
		/* Blue floating button */
		.floating-btn {
			position: fixed;
			bottom: 20px;
			left: 20px;
			z-index: 9999;
			background-color: #073379ff;
			color: white;
			border: none;
			padding: 16px;
			border-radius: 50%;
			box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
			cursor: pointer;
			transition: all 0.3s ease;
			width: 56px;
			height: 56px;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		
		.floating-btn:hover {
			background-color: #1e3a8a;
			transform: translateY(-5px);
		}

		/* Blue admin button */
		.btn-admin {
			background: #ffffff;
			color: #1e3a8a;
			border: 2px solid #1e3a8a;
			padding: 12px 24px;
			border-radius: 8px;
			font-weight: 500;
			transition: all 0.3s ease;
		}

		.btn-admin:hover {
			background: #1e3a8a;
			color: #ffffff;
		}

		/* ---------------- RESPONSIVE ---------------- */
		@media (max-width: 768px) {
			.dashboard-sideBar-title img {
				width: 50px;
				height: 50px;
			}
			
			.logInForm {
				margin-top: 120px;
				padding: 30px 20px;
				max-width: 90%;
			}
			
			.dashboard-Navbar {
				padding: 12px 15px;
			}
		}

		@media (max-width: 480px) {
			.dashboard-Navbar {
				padding: 10px;
			}
			
			.dashboard-sideBar-title h1 {
				font-size: 14px;
			}
			
			.logInForm {
				margin-top: 100px;
				padding: 25px 15px;
			}
			
			.form-control {
				font-size: 14px;
				padding: 10px 12px;
			}
			
			.floating-btn {
				width: 48px;
				height: 48px;
				bottom: 15px;
				left: 15px;
			}
		}
	</style>
</head>
<body>
	<!-- NAVBAR -->
	<section class="ashboard-contentPage">
		<nav class="dashboard-Navbar">
			<div class="dashboard-sideBar-title d-flex align-items-center">
				<img src="../IMAGENES/Logotipo_sinsombrapng_Mesa de trabajo 1-02.png" alt="Logo">
				<h1>JYS PROMOTORES DE VIAJES Y TURISMO</h1>
			</div>
		</nav>
	</section>

	<!-- BOTÓN FLOTANTE -->
	<button onclick="window.location.href='../vista/general/index.php'" class="floating-btn">
		<i class="fas fa-home"></i>
	</button>

	<!-- LOGIN FORM -->
	<form class="logInForm" id="formulario" action="../controlador/clientes_c.php?accion=ingresar" method="POST">
		<i class="fa fa-user-circle fa-5x"></i>
		<h2>Inicia sesión</h2>

		<div class="form-group mb-3">
			<label for="UserEmail">Usuario</label>
			<input class="form-control" id="UserEmail" name="email" type="email" placeholder="example@gmail.com" required>
		</div>

		<div class="form-group mb-3">
			<label for="UserPass">Contraseña</label>
			<input class="form-control" id="UserPass" name="clave" type="password" placeholder="Clave123*" required>
		</div>

		<input type="submit" value="Iniciar sesión" class="btncolor mb-3">
		
		<a href="general/crear_cuenta.php">¿No tienes cuenta? Crea una aquí</a>
	</form>

	<!-- Botón admin -->
	<div class="text-center mb-4" style="z-index:2; position: relative;">
		<a href="admin/login_admin.php">
			<button class="btn btn-admin"><i class="fas fa-user-shield"></i> Administrador</button>
		</a>
	</div>

	<script src="../libs/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
