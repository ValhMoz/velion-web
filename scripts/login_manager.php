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
                $datos_historial = array(
                    'paciente_id' => $_POST["usuario_id"],
                    'fecha' => $_POST["fecha_nacimiento"]
                );
                // Intenta registrar un usuario con los datos proporcionados
                $loginController->registrarUsuario($datos, $datos_historial);
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
                $token = $_POST['token'];
                $newPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

                // Verifica si el token es válido
                $query = $conn->prepare("SELECT * FROM password_resets WHERE token = ?");
                $query->bind_param("s", $token);
                $query->execute();
                $result = $query->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $email = $row['email'];

                    // Actualiza la contraseña del usuario
                    $updateQuery = $conn->prepare("UPDATE usuarios SET pass = ? WHERE email = ?");
                    $updateQuery->bind_param("ss", $newPassword, $email);
                    if ($updateQuery->execute()) {
                        echo "Tu contraseña ha sido actualizada.";

                        // Elimina el token de la tabla password_resets
                        $deleteQuery = $conn->prepare("DELETE FROM password_resets WHERE email = ?");
                        $deleteQuery->bind_param("s", $email);
                        $deleteQuery->execute();
                    } else {
                        echo "No se pudo actualizar la contraseña.";
                    }
                } else {
                    echo "Enlace de recuperación inválido o expirado.";
                }
            }

            break;
        case 'solicitar_nueva_contraseña':
            // Lógica para manejar la solicitud de recuperación de contraseña
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
                $email = $_POST['email'];

                // Verifica si el correo electrónico existe en la base de datos
                $query = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
                $query->bind_param("s", $email);
                $query->execute();
                $result = $query->get_result();

                if ($result->num_rows > 0) {
                    $token = bin2hex(random_bytes(50)); // Genera un token seguro
                    $url = "http://tu-dominio.com/reset_password.php?token=" . $token;

                    // Inserta el token en la tabla password_resets
                    $insertQuery = $conn->prepare("INSERT INTO password_resets (email, token) VALUES (?, ?)");
                    $insertQuery->bind_param("ss", $email, $token);
                    $insertQuery->execute();

                    // Envía el correo electrónico
                    $to = $email;
                    $subject = "Recuperar Contraseña";
                    $message = "Haz clic en el siguiente enlace para recuperar tu contraseña: " . $url;
                    $headers = "From: no-reply@tu-dominio.com";

                    if (mail($to, $subject, $message, $headers)) {
                        echo "Se ha enviado un enlace de recuperación a tu correo electrónico.";
                    } else {
                        echo "No se pudo enviar el correo electrónico.";
                    }
                } else {
                    echo "El correo electrónico no está registrado.";
                }
            }
            break;
    }
}
