<?php
$host = 'localhost';
$dbname = 'bd_siw_turismo';
$username = 'root';
$password = '';
$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die('Error de conexión: ' . mysqli_connect_error());
}
?>