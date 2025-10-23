<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contáctanos | JYS Promotores</title>
  <link rel="icon" href="../../IMAGENES/Logotipo_sinsombrapng_Mesa de trabajo 1-02.png" />

  <!-- Bootstrap & FontAwesome -->
  <link rel="stylesheet" href="../../libs/bootstrap-5.3.3-dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../libs/fontawesome-free-6.7.2-web/css/all.min.css" />

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0f4f8;
      color: #333;
    }

    .hero {
      background: linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.55)),
        url('../../IMAGENES/playa2.jpg') center/cover no-repeat;
      height: 45vh;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
    }

    .hero h1 {
      font-size: 3.2rem;
    }

    .contact-container {
      max-width: 1100px;
      margin: auto;
      padding: 60px 20px;
    }

    .form-card {
      background: #ffffff;
      border-radius: 16px;
      padding: 30px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
    }

    .form-label {
      font-weight: 600;
      color: #444;
    }

    .form-control,
    .form-select {
      border-radius: 10px;
      background-color: #f9f9f9;
    }

    .btn-submit {
      background-color: #0077b6;
      color: #fff;
      font-weight: 500;
      border: none;
      padding: 10px 25px;
      border-radius: 50px;
    }

    .btn-submit:hover {
      background-color: #0096c7;
    }

    .info-card {
      background-color: #023047;
      color: #fff;
      border-radius: 16px;
      padding: 30px;
    }

    .info-card i {
      color: #90e0ef;
      margin-right: 10px;
    }

    .map-responsive iframe {
      width: 100%;
      height: 250px;
      border: 0;
      border-radius: 10px;
    }

    .logo-container {
      text-align: center;
      margin-top: 40px;
    }

    .logo-container img {
      max-width: 300px;
    }

    .btn-back {
      position: fixed;
      top: 20px;
      left: 20px;
      z-index: 999;
      background-color: #0077b6;
      color: #fff;
      border: none;
      padding: 10px 18px;
      border-radius: 50px;
      font-size: 15px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
      transition: background 0.3s ease;
    }

    .btn-back:hover {
      background-color: #0096c7;
    }

    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2rem;
      }
    }
  </style>
</head>

<body>

  <!-- Botón de regreso -->
  <button onclick="window.location.href='index.php'" class="btn-back">
    <i class="fas fa-arrow-left"></i> Volver
  </button>

  <!-- Hero -->
  <section class="hero">
    <h1>Contáctanos</h1>
  </section>

  <!-- Logo -->
  <div class="logo-container">
    <img src="../../IMAGENES/Logotipo_sinsombrapng_Mesa de trabajo 1-02.png" alt="Logo JYS" />
  </div>

  <!-- Contenido principal -->
  <div class="contact-container">
    <div class="row g-4">
      <!-- Formulario -->
      <div class="col-lg-6">
        <div class="form-card">
          <h4 class="mb-4 text-center">Envíanos un mensaje</h4>
          <form action="../../controlador/atenciones_c.php?accion=registrar" method="POST" autocomplete="on">
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre completo</label>
              <input type="text" name="nombre" class="form-control" id="nombre" required />
            </div>
            <div class="mb-3">
              <label for="correo" class="form-label">Correo electrónico</label>
              <input type="email" name="correo" class="form-control" id="correo" required />
            </div>
            <div class="mb-3">
              <label for="telefono" class="form-label">Teléfono</label>
              <input type="tel" name="telefono" class="form-control" id="telefono" required />
            </div>
            <div class="mb-3">
              <label for="mensaje" class="form-label">Mensaje</label>
              <textarea name="mensaje" class="form-control" id="mensaje" rows="4" required></textarea>
            </div>
            <div class="text-center mt-4">
              <button type="submit" class="btn btn-submit">Enviar mensaje</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Información de contacto -->
      <div class="col-lg-6">
        <div class="info-card">
          <h5 class="mb-4 text-center">Información de contacto</h5>
          <p><i class="fas fa-map-marker-alt"></i> Teruel, Huila - Colombia</p>
          <p><i class="fas fa-envelope"></i> contacto@jysviajes.com</p>
          <p><i class="fas fa-phone"></i> +57 314 314 4506</p>
          <div class="map-responsive mt-4">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15902.507462969106!2d-75.58234426659398!3d2.195792836457243!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e246ce408a8cb27%3A0x6c4c5158d229a7b9!2sTeruel%2C%20Huila!5e0!3m2!1ses!2sco!4v1712953951950!5m2!1ses!2sco" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="../../libs/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../libs/SweetAlert2/sweetalert2.all.min.js"></script>
  <script src="../alertas/funcionesalert.js"></script>
</body>

</html>
