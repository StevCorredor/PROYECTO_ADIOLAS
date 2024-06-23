<?php session_start();

// Incluir el archivo de configuración
require 'admin/config.php';

// Incluir el archivo de funciones
require 'funciones.php';

// Inicializar la variable para almacenar errores
$errores = '';

// Comprobar si el método de la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Limpiar y obtener los datos del formulario
    $usuario = limpiardatos($_POST['usuario']);
    $password = limpiardatos($_POST['password']);

    // Verificar si las credenciales coinciden con las del administrador
    if ($usuario == $pagina_admin['usuario'] && $password == $pagina_admin['password']) {
    // Iniciar la sesión del administrador
    $_SESSION['admin'] = $pagina_admin['usuario'];
    // Redirigir al administrador a la página principal
		header('Location: '. RUTA);
	  } else {
      // Establecer el mensaje de error si las credenciales son incorrectas
      $errores = '<h3>Datos incorrectos, ¡intente nuevamente!</h3>';
    }
} 

// Incluir la vista de inicio de sesión
require 'views/login.view.php';

?>