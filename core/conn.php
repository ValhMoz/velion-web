<?php
// Configuración de la conexión a la base de datos
$host = "localhost";
$usuario_bd = "root";
$contrasena_bd = "";
$nombre_bd = "project-crm";

// Crear conexión
$conexion = new mysqli($host, $usuario_bd, $contrasena_bd, $nombre_bd);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>