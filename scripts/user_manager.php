<?php
include '../controllers/UserController.php';

// Crea una instancia del controlador de inicio de sesión
$userController = new UserController();

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"]) {

    switch ($_POST['action']) {
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
            $datos_historial = array(
                'paciente_id' => $_POST["usuario_id"],
                'fecha' => $_POST["fecha_nacimiento"]
            );

            // Intenta registrar un usuario con los datos proporcionados
            $userController->añadirNuevoUsuario($datos, $datos_historial);
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

            case 'obtener_usuario_id':
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