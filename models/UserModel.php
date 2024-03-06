<?php

include 'BaseModel.php';

class UserModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct(); // Llama al constructor de la clase padre (BaseModel)
    }

    public function registrarUsuario($datos)
    {
        $username = $datos['username'];
        $email = $datos['email'];
        $pass = $datos['pass'];

        // Escapar valores para evitar inyección de SQL
        $username = $this->conexion->real_escape_string($username);
        $email = $this->conexion->real_escape_string($email);
        $password = $this->conexion->real_escape_string($pass);

        // Hashear la contraseña antes de almacenarla en la base de datos
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";

        if ($this->executeQuery($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function verificarUsuario($username, $password)
    {
        // Escapar valores para evitar inyección de SQL
        $username = $this->conexion->real_escape_string($username);

        // Buscar el usuario en la base de datos
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $resultado = $this->conexion->query($sql);

        if ($resultado->num_rows == 1) {
            // Usuario encontrado, verificar la contraseña
            $usuario = $resultado->fetch_assoc();
            if (password_verify($password, $usuario['password'])) {
                // Contraseña válida, devuelve los datos del usuario
                return $usuario;
            }
        }
        // Usuario no encontrado o contraseña incorrecta
        return false;
    }
}
