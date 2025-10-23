<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrador | JYS</title>
    <link rel="stylesheet" href="../../libs/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../libs/fontawesome-free-6.7.2-web/css/all.min.css">
    <link rel="icon" href="../../IMAGENES/Logotipo_sinsombrapng_Mesa de trabajo 1-02.png">
    <link rel="stylesheet" href="css/style_index.css">

    <!-- http://localhost/SIW-TURISMO/vista/admin/vista_general.php -->

    <style>
        body {
            background-color: #f8f9fa;
        }

        a{
            text-decoration: none !important;
        }

        .sidebar {
            /* height: 100vh; */
            background-color: #003049;
            /* azul oscuro institucional */
            color: white;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 12px;
            display: block;
            border-left: 4px solid transparent;
            transition: 0.3s;
        }

        /*SE DEBE CAMBIAR EL I DEPENDIENDO LA PÁGINA QUE ESTÉ JOJOJO*/
    

      
        .i-<?php echo pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) ?>{
            font-weight: bold;
            color: #ffd166 !important;
            background-color: #0077b6 !important;
            border-left: 4px solid #f77f00 !important;
            /* naranjo */
        }
        
        
        .sidebar a:hover{
            background-color: #005f73;
            border-left: 4px solid #f77f00;
            /* naranjo */
        }

        .main-content {
            padding: 2rem;
        }

        .navbar {
            background-color: #0077b6;
            
        }
        .card {
            transition: transform 0.3s ease;
            border-radius: 20px;
            background-color: #fff;
            color: black;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .card:hover {
             transform: scale(1.05);
             cursor: pointer;
             color:bold !important;
        }
    </style>
</head>