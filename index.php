<?php

// Incluir el archivo de configuración
require 'admin/config.php';

// Incluir el archivo de funciones
require 'funciones.php';

// Establecer la conexión a la base de datos
$conexion = conexion($bd_config);
// Verificar si la conexión se ha establecido correctamente
if (!$conexion) {
	// Redirigir a la página de error si la conexión falla
	header('Location: error.php');
}

// Incluir la vista principal
require 'views/index.view.php';

?>