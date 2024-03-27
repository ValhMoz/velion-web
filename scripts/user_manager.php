<?php
include '../controllers/UserController.php';

// Crea una instancia del controlador de inicio de sesión
$userController = new UserController();

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
                $userController->iniciarSesion($email, $pass);

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
                $userController->registrarUsuario($datos);
            } else {
                echo "No se ha podido completar el registro";
            }
            break;
        case 'añadir_usuario':

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
                'rol' => $_POST["rol"]
            );

            // Intenta registrar un usuario con los datos proporcionados
            $userController->añadirNuevoUsuario($datos);
            break;

        case 'editar_usuario':

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
                'rol' => $_POST["rol"]
            );

            // Intenta registrar un usuario con los datos proporcionados
            $userController->editarUsuario($datos);
            break;

        case 'eliminar_usuario':

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
                'rol' => $_POST["rol"]
            );

            // Intenta registrar un usuario con los datos proporcionados
            $userController->eliminarUsuario($datos);
            break;
        case 'cerrar_sesion':
            $userController->cerrarSesion();
            break;
        case 'actualizar_datos':
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Obtener los valores del formulario

                $datos = array(
                    // 'usuario_id' => $_POST["usuario_id"],
                    // 'nombre' => $_POST["nombre"],
                    // 'apellidos' => $_POST["apellidos"],
                    // 'genero' => $_POST["genero"],
                    // 'telefono' => $_POST["telefono"],
                    // 'fecha_nacimiento' => $_POST["fecha_nacimiento"],
                    // 'direccion' => $_POST["direccion"],
                    // 'provincia' => $_POST["provincia"],
                    // 'municipio' => $_POST["municipio"],
                    // 'cp' => $_POST["cp"],
                    'email' => $_POST["email"],
                    'pass' => password_hash($_POST["pass"], PASSWORD_DEFAULT),
                    // 'rol' => "paciente"
                );

                // Intenta registrar un usuario con los datos proporcionados
                $userController->actualizarDatos($datos);
            } else {
                echo "No se ha podido completar el registro";
            }
            break;
    }
}
?>