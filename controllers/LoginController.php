<?php
require_once '../models/LoginModel.php';

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

                if ($usuario[0]['rol'] == 'administrador' || $usuario[0]['rol'] == 'fisioterapeuta') {
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
}
