<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once '../models/LoginModel.php';
require '../vendor/autoload.php';

class LoginController
{
    private $loginModel;

    public function __construct()
    {
        $this->loginModel = new LoginModel();
    }

    public function iniciarSesion($email, $pass)
    {
        $usuario = $this->loginModel->read('usuarios', "email= '$email'");
        if (!empty($usuario)) {
            // Verificar la contraseña utilizando password_verify
            if (password_verify($pass, $usuario[0]['pass'])) {

                session_start();

                $_SESSION['email'] = $email;
                $_SESSION['usuario_id'] = $usuario[0]["usuario_id"];
                $_SESSION['nombre'] = $usuario[0]['nombre'];
                $_SESSION['apellidos'] = $usuario[0]['apellidos'];
                $_SESSION['telefono'] = $usuario[0]['telefono'];
                $_SESSION['direccion'] = $usuario[0]['direccion'];
                $_SESSION['rol'] = $usuario[0]['rol'];
                $_SESSION['fecha_nacimiento'] = $usuario[0]['fecha_nacimiento'];
                $_SESSION['provincia'] = $usuario[0]["provincia"];
                $_SESSION['municipio'] = $usuario[0]['municipio'];
                $_SESSION['cp'] = $usuario[0]['cp'];
                $_SESSION['sesiones_disponibles'] = $usuario[0]['sesiones_disponibles'];

                if ($usuario[0]['rol'] == 'Administrador' || $usuario[0]['rol'] == 'Fisioterapeuta') {
                    header('Location: ../pages/start.php');
                    exit();
                } else {
                    header('Location: ../pages/start-patients.php');
                    exit();
                }
            } else {
                header("Location: ../index.php?alert=warning&message=Contraseña incorrecta.");
                exit();
            }
        } else {
            header("Location: ../index.php?alert=warning&message=Usuario no encontrado.");
            exit();
        }
    }


    public function registrarUsuario($datos, $datos_historial)
    {
        if ($this->loginModel->insert('usuarios', $datos) == true && ($this->loginModel->insert('historial_medico', $datos_historial)) == true) {
            header("Location: ../index.php?alert=success&message=Se ha completado el registro.");
            exit();
        } else {
            header("Location: ../index.php?alert=warning&message=No se ha podido completar el registro.");
            exit();
        }
    }

    public function cerrarSesion()
    {
        // Cerrar sesión
        session_start();

        // Destruir todas las variables de sesión
        // $_SESSION = array();

        // Borrar la cookie de sesión
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Destruir la sesión
        session_destroy();

        // Redirigir a la página de inicio
        header("Location: ../index.php?alert=success&message=Sesion finalizada");
        exit();
    }

    public function sendPasswordResetEmail($recipientEmail, $resetLink) {
        $mail = new PHPMailer(true);
    
        try {
            // Configuración del servidor SMTP de Gmail
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'tu-correo@gmail.com'; // Tu correo de Gmail
            $mail->Password = 'tu-contraseña-o-contraseña-de-aplicación'; // Tu contraseña de Gmail o contraseña de aplicación
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
    
            // Remitente y destinatario
            $mail->setFrom('tu-correo@gmail.com', 'Tu Nombre');
            $mail->addAddress($recipientEmail);
    
            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de contraseña';
            $mail->Body    = 'Haz clic en el siguiente enlace para recuperar tu contraseña: <a href="' . $resetLink . '">Recuperar Contraseña</a>';
    
            $mail->send();
            echo 'El mensaje ha sido enviado';
        } catch (Exception $e) {
            echo "No se pudo enviar el mensaje. Error de Mailer: {$mail->ErrorInfo}";
        }
    }

    public function generatePasswordResetToken($email) {
        $token = bin2hex(random_bytes(32)); // Genera un token seguro
        $expires = date("U") + 1800; // Token expira en 30 minutos
    
        // Guarda el token en la base de datos
        $conn = new mysqli("localhost", "root", "root", "clinic-managment");
    
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
    
        // Elimina cualquier token existente para este usuario
        $sql = "DELETE FROM password_resets WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
    
        // Inserta el nuevo token
        $sql = "INSERT INTO password_resets (email, token, expires) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $email, $hashedToken, $expires);
        $stmt->execute();
    
        // Envía el correo de recuperación
        $resetLink = 'https://tu-dominio.com/reset_password.php?token=' . $token;
        sendPasswordResetEmail($email, $resetLink);
    
        $stmt->close();
        $conn->close();
    }

    
}
