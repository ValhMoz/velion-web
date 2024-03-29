<?php
include '../controllers/LoginController.php';

// Crea una instancia del controlador de inicio de sesión
$loginController = new LoginController();

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"]) {

    switch ($_POST['action']) {
        case 'iniciar_sesion':
            // Verifica si se enviaron datos de nombre de usuario y contraseña
            if (isset($_POST["email"]) && isset($_POST["pass"])) {
                // Obtiene los datos del formulario
                $email = $_POST["email"];
                $pass = $_POST["pass"];

                // Intenta iniciar sesión con los datos proporcionados
                $loginController->iniciarSesion($email, $pass);

                // Si el checkbox está marcado, establece un tiempo de expiración más largo para la sesión
                if (isset($_POST['mantener_sesion']) && $_POST['mantener_sesion'] == 'on') {
                    // Establece un tiempo de expiración más largo (por ejemplo, 30 días)
                    ini_set('session.cookie_lifetime', 30 * 24 * 3600);
                }
            } else {
                // Datos de inicio de sesión incompletos
                echo "Por favor, introduzca nombre de usuario y contraseña.";
            }
            break;
        case 'registrar_usuario':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Obtener los valores del formulario

                $datos = array(
                    'usuario_id' => $_POST["usuario_id"],
                    'nombre' => $_POST["nombre"],
                    'apellidos' => $_POST["apellidos"],
                    'genero' => $_POST["genero"],
                    'telefono' => $_POST["telefono"],
                    'fecha_nacimiento' => $_POST["fecha_nacimiento"],
                    'direccion' => $_POST["direccion"],
                    'provincia' => $_POST["provincia"],
                    'municipio' => $_POST["municipio"],
                    'cp' => $_POST["cp"],
                    'email' => $_POST["email"],
                    'pass' => password_hash($_POST["pass"], PASSWORD_DEFAULT),
                    'rol' => "paciente"
                );


                // Intenta registrar un usuario con los datos proporcionados
                $loginController->registrarUsuario($datos);
            } else {
                echo "No se ha podido completar el registro";
            }
            break;
        case 'cerrar_sesion':
            $userController->cerrarSesion();
            break;
        case 'resetear_contraseña':
            // Lógica para restablecer la contraseña
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reset_password"])) {
                // Verificar si el token proporcionado coincide con el token almacenado en la base de datos y no ha expirado
                $token = $_POST["token"];
                // Aquí debes incluir la lógica para verificar si el token proporcionado coincide con el token almacenado en tu base de datos

                if ($token_valid) {
                    // Actualizar la contraseña del usuario en la base de datos
                    $new_password = $_POST["password"];
                    // Aquí debes incluir la lógica para actualizar la contraseña del usuario en tu base de datos

                    echo "¡Tu contraseña ha sido restablecida con éxito!";
                } else {
                    echo "El enlace de restablecimiento de contraseña es inválido o ha expirado. Por favor, solicita otro.";
                }
            }

            break;
        case 'solicitar_nueva_contraseña':
            // Lógica para manejar la solicitud de recuperación de contraseña
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
                // Conectar a la base de datos y realizar la validación del correo electrónico proporcionado
                // Verificar si el correo electrónico existe en la base de datos
                $email = $_POST["email"];
                // Aquí debes incluir la lógica para verificar si el correo electrónico existe en tu base de datos

                if ($email_exists) {
                    // Generar un token único
                    $token = bin2hex(random_bytes(32)); // Genera un token aleatorio de 64 caracteres (32 bytes)
                    // Guardar el token en la base de datos junto con el correo electrónico
                    // Aquí debes incluir la lógica para almacenar el token en tu base de datos junto con el correo electrónico

                    // Enviar correo electrónico con el enlace de restablecimiento de contraseña que contiene el token
                    $reset_link = "http://tuweb.com/reset_password.php?token=$token";
                    $subject = "Recuperación de contraseña";
                    $message = "Hola,\n\nHas solicitado restablecer tu contraseña. Para cambiar tu contraseña, haz clic en el siguiente enlace: $reset_link";
                    $headers = "From: tuemail@tudominio.com";

                    if (mail($email, $subject, $message, $headers)) {
                        echo "Se ha enviado un enlace de restablecimiento de contraseña a tu correo electrónico.";
                    } else {
                        echo "Hubo un problema al enviar el correo electrónico. Por favor, inténtalo de nuevo más tarde.";
                    }
                } else {
                    echo "El correo electrónico proporcionado no está registrado en nuestra base de datos.";
                }
            }
            break;
    }
}
?>