<?php
// Inicia la sesión
session_start();

cerrarSesion();

// Función para cerrar sesión
function cerrarSesion() {
    // Destruye todas las variables de sesión
    session_destroy();

    // Redirige a la página de inicio o a donde desees después de cerrar sesión
    header("Location: index.php");
    exit();
}
?>