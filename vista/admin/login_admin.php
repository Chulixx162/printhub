<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Administrador</title>
  <link rel="stylesheet" href="../../libs/bootstrap-5.3.3-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../libs/fontawesome-free-6.7.2-web/css/all.min.css">
  <link rel="icon" href="../../IMAGENES/Logo Printhub.png">
  <style>
    :root{
      --primary-dark: #153E75;
      --primary-cyan: #00AEEF;
      --gray-medium: #6C757D;
      --gray-light: #E9ECEF;
      --accent-magenta: #EC008C;
      --accent-yellow: #FFD100;
      --black: #231F20;
    }

    body {
      background: linear-gradient(to right, var(--primary-dark), var(--primary-cyan));
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }

    .login-card {
      background-color: #ffffff;
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 6px 18px rgba(0,0,0,0.18);
      max-width: 420px;
      width: 100%;
      border: 1px solid var(--gray-light);
    }

    .login-card img { filter: none; }

    label { color: var(--black); font-weight: 600; }

    .form-control:focus {
      border-color: var(--primary-cyan);
      box-shadow: 0 0 0 0.15rem rgba(0,174,239,0.12);
    }

    .btn-printhub {
      background: var(--primary-dark);
      color: #fff;
      border: none;
      transition: background .15s ease;
    }
    .btn-printhub:hover, .btn-printhub:focus {
      background: var(--primary-cyan);
      color: #fff;
    }

    .linea{
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: .5rem;
      padding: .5rem .75rem;
      border: 2px solid var(--accent-yellow);
      color: var(--black);
      border-radius: 0.75rem;
      background: transparent;
      text-decoration: none;
      transition: background .15s ease, color .15s ease;
    }
    .linea:hover{
      background-color: var(--accent-yellow);
      color: #000;
      text-decoration: none;
    }

    .small-muted { color: var(--gray-medium); font-size: .9rem; }
  </style>
</head>
<body>
  <div class="login-card">
    <div class="text-center mb-4">
      <img src="../../IMAGENES/Logo Printhub.png" width="100" alt="Logo">
      <h4 class="mt-2" style="color:var(--primary-dark)">Ingreso Administrador</h4>
    </div>

    <form action="../../controlador/usuarios_c.php?accion=ingresar" method="POST" novalidate>
      <div class="mb-3">
        <label for="correo" class="form-label"><i class="fas fa-user me-2"></i>Correo electrónico</label>
        <input type="email" name="correo" id="correo" class="form-control" required autofocus>
      </div>
      <div class="mb-3">
        <label for="clave" class="form-label"><i class="fas fa-lock me-2"></i>Contraseña</label>
        <input type="password" name="clave" id="clave" class="form-control" required>
      </div>
      <hr>
      <div class="d-grid">
        <button type="submit" class="btn btn-printhub"><i class="fas fa-sign-in-alt me-2"></i>Ingresar</button>
      </div>
      
    </form>
      <div class="d-grid mt-2">
        <a class="linea" href="../login.php"><i class="fas fa-chess-pawn me-2"></i>Ingresar como Cliente</a>
      </div>
  </div>
</body>
<script src="../../libs/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</html>
