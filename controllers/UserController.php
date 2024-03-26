<?php
require_once '../models/UserModel.php';

class UserController
{
    private $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new UserModel();
    }

    public function obtenerUsuarios()
    {
        return $this->usuarioModel->read('usuarios');
    }

    public function iniciarSesion($email, $pass)
    {
        $usuario = $this->usuarioModel->read('usuarios', "email= '$email'");
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
                    header('Location: ../pages/dashboard.php');
                    exit();
                } else {
                    header('Location: ../pages/dashboard-patients.php');
                    exit();
                }
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "Usuario no encontrado.";
        }
    }


    public function registrarUsuario($datos)
    {
        if ($this->usuarioModel->insert('usuarios', $datos) == true) {
            header('Location: ../index.php');
            exit();
        } else {
            echo "No se ha podido completar el registro";
        }
    }

    public function añadirNuevoUsuario($datos)
    {
        if ($this->usuarioModel->insert('usuarios', $datos) == true) {
            // Dentro de la función añadirNuevoUsuario en UserController.php
            header('Location: ../pages/dashboard.php?page=users');
            exit();
        } else {
            // Dentro de la función añadirNuevoUsuario en UserController.php
            header('Location: ../pages/dashboard.php?page=users');
            exit();
        }
    }

    public function actualizarDatos($datos)
    {
        echo ($_SESSION['usuario_id']);
        if ($this->usuarioModel->update('usuarios', $datos, $_SESSION['usuario_id']) == true) {
            exit();
        } else {
            echo "No se ha podido completar el registro";
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
        header("Location: ../index.php");
        exit();
    }
}
