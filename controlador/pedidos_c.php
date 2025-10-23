<?php
include '../modelo/pedidos_m.php';
include '../conexion.php';
$accion = isset($_GET['accion']) ? $_GET['accion'] : '';
if ($accion == 'cambiar') {
    cambiarestado($conn, $_POST);
}elseif ($accion == 'eliminar') {
    borrar($conn, $_GET['id']);
}
?>