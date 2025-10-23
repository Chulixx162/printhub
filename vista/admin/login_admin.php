

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Administrador</title>
  <link rel="stylesheet" href="../../libs/bootstrap-5.3.3-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../libs/fontawesome-free-6.7.2-web/css/all.min.css">
  <link rel="icon" href="../../IMAGENES\Logotipo_sinsombrapng_Mesa de trabajo 1-02.png">
  <style>
    body {
      background: linear-gradient(to right,rgb(7, 55, 79), #0077b6);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-card {
      background-color: white;
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      max-width: 400px;
      width: 100%;
    }
    .linea{
      border: 2px solid #f77f00;
    }
    .linea:hover{
      border-radius: 1rem;
      background-color: #f77f00;
    }
  </style>
</head>
<body>
  <div class="login-card">
    <div class="text-center mb-4">
      <img src="../../IMAGENES\Logotipo_sinsombrapng_Mesa de trabajo 1-02.png" width="80" alt="Logo">
      <h4 class="mt-2">Ingreso Administrador</h4>
    </div>

    <form action="../../controlador/usuarios_c.php?accion=ingresar" method="POST">
      <div class="mb-3">
        <label for="correo" class="form-label"><i class="fas fa-user me-2"></i>Correo electrónico</label>
        <input type="email" name="correo" id="correo" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="clave" class="form-label"><i class="fas fa-lock me-2"></i>Contraseña</label>
        <input type="password" name="clave" id="clave" class="form-control" required>
      </div>
      <hr>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt me-2"></i>Ingresar</button>
      </div>
      
    </form>
      <div class="d-grid mt-2">
        <a class="btn linea" href="../login.php"><button class="btn " ><i class="fas fa-chess-pawn me-2"></i>Ingresar como Cliente</button></a>
        
      </div>
  </div>
</body>
<script src="../../libs/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</html>
