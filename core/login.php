<?php
// Iniciar la sesión
session_start();

// Incluir el archivo de conexión
require_once 'conn.php';

// Función para obtener el correo electrónico y el nombre de usuario del usuario
function obtenerDatosUsuario($username, $conexion) {
    // Consulta preparada para obtener el correo electrónico y el nombre de usuario
    $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE username = ?");
    $consulta->bind_param("s", $username);

    // Ejecutar la consulta
    $consulta->execute();

    // Obtener el resultado
    $resultado = $consulta->get_result();

    // Verificar si hay filas coincidentes
    if ($resultado->num_rows > 0) {
        // Obtener el correo electrónico y el nombre de usuario
        $fila = $resultado->fetch_assoc();
        return $fila;
    }

    // Si no se encuentra la información
    return null;
}

// Verificar si se recibió un formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario de login
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Consulta preparada para evitar inyección de SQL
    $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE username = ? AND password = ?");
    $consulta->bind_param("ss", $username, $password);

    // Ejecutar la consulta
    $consulta->execute();

    // Obtener el resultado
    $resultado = $consulta->get_result();

    // Verificar si hay filas coincidentes (usuario autenticado)
    if ($resultado->num_rows > 0) {
        // Obtener toda la fila (todos los datos del usuario)
        $fila = $resultado->fetch_assoc();

        // Almacenar toda la información en variables de sesión
        $_SESSION["username"] = $fila["username"];
        $_SESSION["datosUsuario"] = obtenerDatosUsuario($fila["username"], $conexion);
        // Puedes almacenar más información aquí según tus necesidades

        // Credenciales válidas, iniciar sesión y redirigir
        header("Location: ../pages/dashboard.php");
        exit();
    } else {
        // Credenciales inválidas, mostrar mensaje de error
        echo "Usuario o contraseña incorrectos";
    }

    // Cerrar la consulta
    $consulta->close();
    
    // Cerrar la conexión
    $conexion->close();
}
?>