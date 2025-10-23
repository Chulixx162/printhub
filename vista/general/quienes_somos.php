<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Quiénes Somos | JYS Promotores</title>
  <link rel="icon" href="../../IMAGENES/Logotipo_sinsombrapng_Mesa de trabajo 1-02.png" />
  <!-- Bootstrap & FontAwesome -->
  <link rel="stylesheet" href="../../libs/bootstrap-5.3.3-dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../libs/fontawesome-free-6.7.2-web/css/all.min.css" />

  <!-- Estilos personalizados -->
  <style>
    * {
      box-sizing: border-box;
    }

    body,
    html {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      height: 100%;
      background: #f0f4f8;
      color: #2b2b2b;
    }

    .hero {
      background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
        url('../../IMAGENES/playa2.jpg') center/cover no-repeat;
      height: 60vh;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .hero h1 {
      color: #ffffff;
      font-size: 3.5rem;
      z-index: 1;
      position: relative;
      text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
    }

    .about-section {
      padding: 70px 30px;
      max-width: 1000px;
      margin: auto;
      text-align: center;
      background: #ffffff;
      border-radius: 16px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
    }

    .about-section h2 {
      font-size: 2.2rem;
      font-weight: 600;
      color: #0077b6;
      margin-bottom: 25px;
    }

    .about-section p {
      font-size: 17px;
      line-height: 1.7;
      margin-bottom: 22px;
      color: #4b4b4b;
    }

    .about-section .quote {
      font-style: italic;
      color: #666;
      margin-top: 40px;
      font-size: 16px;
    }

    .company-image {
      max-width: 100%;
      width: 350px;
      border-radius: 20px;
      box-shadow: 0 10px 24px rgba(0, 0, 0, 0.15);
      margin-top: 40px;
      transition: transform 0.3s ease;
    }

    .company-image:hover {
      transform: scale(1.03);
    }

    .back-btn {
      position: fixed;
      top: 20px;
      left: 20px;
      z-index: 1000;
      background: #0077b6;
      color: #fff;
      border: none;
      padding: 12px 18px;
      border-radius: 50px;
      font-size: 15px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .back-btn:hover {
      background: #00b4d8;
    }

    footer {
      background: #023047;
      color: #ddd;
      padding: 50px 20px 25px;
      font-size: 15px;
    }

    footer h5 {
      color: #fff;
      font-size: 18px;
      margin-bottom: 15px;
    }

    footer p,
    footer a {
      color: #ccc;
      text-decoration: none;
    }

    footer a:hover {
      color: #90e0ef;
    }

    .social-icons a {
      font-size: 20px;
      margin-right: 15px;
      color: #ffffff;
      transition: color 0.3s ease;
    }

    .social-icons a:hover {
      color: #00d4ff;
    }

    .footer-bottom {
      text-align: center;
      margin-top: 30px;
      font-size: 13px;
      color: #bbb;
    }

    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2.5rem;
        text-align: center;
        padding: 0 15px;
      }

      .about-section {
        padding: 40px 20px;
      }

      .company-image {
        width: 90%;
      }
    }
  </style>

</head>

<body>

  <button class="back-btn" onclick="window.history.back()">
    <i class="fas fa-arrow-left"></i> Atrás
  </button>
  <section class="hero">
    <h1>Conócenos</h1>
  </section>

  <section class="about-section">
    <h2>¿Quiénes somos?</h2>
    <div style="width: 60px; height: 4px; background-color: #0a9396; margin: 10px auto 30px; border-radius: 4px;"></div>

    <p>
      <strong>JYS Promotores</strong> es una agencia de turismo comprometida con ofrecer experiencias de viaje
      auténticas, seguras y transformadoras. Con más de <strong>19 años</strong> en el sector, nos hemos ganado la
      confianza de cientos de viajeros que han recorrido Colombia y el mundo con nosotros.
    </p>
    <p>
      Somos un equipo apasionado por el turismo, la cultura y la conexión humana. Diseñamos cada plan de viaje con
      detalle, desde la logística hasta las emociones que deseas vivir. Cada viaje es una historia que ayudamos a escribir.
    </p>
    <p>
      Ya sea una escapada romántica, una aventura familiar o una ruta exótica, <strong>estamos aquí para crearlo contigo</strong>.
    </p>
    <p class="quote">
      “No vendemos pasajes, creamos recuerdos.”
    </p>

    <!-- Imagen de la empresa mejor presentada -->
    <div class="company-image-container">
      <img src="../../IMAGENES/Logotipo_sinsombrapng_Mesa de trabajo 1-02.png"
        alt="Imagen de la empresa"
        class="company-image img-fluid">
    </div>

  </section>


  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-4">
          <h5>JYS Promotores</h5>
          <p><i class="fas fa-map-marker-alt me-2"></i>Teruel, Huila - Colombia</p>
          <p><i class="fas fa-envelope me-2"></i>contacto@jysviajes.com</p>
          <p><i class="fas fa-phone me-2"></i>+57 314 314 4506</p>
        </div>


        <div class="col-md-4 mb-4">
          <h5>Síguenos</h5>
          <div class="social-icons">
            <a href="https://wa.me/573143144506" target="_blank"><i class="fab fa-whatsapp"></i></a>
            <a href="https://www.facebook.com/share/1aEM7MnAdN/" target="_blank"><i class="fab fa-facebook-f"></i></a>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        &copy; <span id="year"></span> JYS Promotores de Viajes y Turismo. <br>Todos los derechos reservados.
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="../../libs/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById("year").textContent = new Date().getFullYear();
  </script>
</body>

</html>