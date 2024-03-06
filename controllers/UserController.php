<?php

require_once '../models/UserModel.php';
require_once '../index.php';

class UserController
{
    private $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new UserModel();
    }

    // public function mostrarFormularioLogin() {
    //     // Aquí podrías cargar la vista del formulario de inicio de sesión
    //     include 'login.php';
    // }

    public function iniciarSesion($email, $pass)
    {
        // Verificar si el usuario existe en la base de datos
        $usuario = $this->usuarioModel->read('usuarios', "email= '$email'");
        if (!empty($usuario)) {
            // Verificar la contraseña
            if ($pass === $usuario[0]['pass']) {
                // Iniciar sesión
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['nombre'] = $usuario[0]['nombre'];

                // Redirigir a la página de inicio o a otra página de tu elección
                header('Location: ../pages/dashboard.php');
                exit();

            } else {
                // Contraseña incorrecta
                echo "Contraseña incorrecta.";
            }
        } else {
            // Usuario no encontrado
            echo "Usuario no encontrado.";
        }
    }

    public function registrarUsuario($datos)
    {
        $this->usuarioModel->insert('usuarios', $datos);
        header('Location: ../index.php');
        exit();
    }

    public function cerrarSesion()
    {
        // Cerrar sesión
        session_start();
        // Destruir todas las variables de sesión
        $_SESSION = array();

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
        header("Location: ../pages/index.php");
        exit();
    }
}
