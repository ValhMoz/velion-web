function cerrarSesion() {
    // Realiza una solicitud AJAX a la API de cerrar sesión
    $.ajax({
        url: '../scripts/logout_manager.php', // Ruta de la API de cerrar sesión
        type: 'POST', // Método de la solicitud
        success: function(response) {
            // Redirige al usuario a index.php después de cerrar sesión
            window.location.href = '../index.php?alert=success&message=UHas cerrado sesión correctamente'

        },
        error: function(xhr, status, error) {
            // Maneja el error si ocurre
            console.error(error);
        }
    });
}