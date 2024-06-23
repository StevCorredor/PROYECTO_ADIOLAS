<?php 
// Iniciar la sesión
session_start();

// Destruir todas las sesiones activas
session_destroy();

// Vaciar el array $_SESSION
$_SESSION = array();

// Redirigir al usuario a la página de inicio de sesión
header('Location: login.php');

// Finalizar la ejecución del script
die();

?>