<?php

// Iniciar sesión (si no está activa)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Destruir toda la información de la sesión
$_SESSION = []; // Vacía el array de sesión
session_unset(); // Elimina las variables de sesión
session_destroy(); // Destruye la sesión

// Redirigir al login 
header("Location: /CURSOSPHP/index.php"); 
exit;
?>