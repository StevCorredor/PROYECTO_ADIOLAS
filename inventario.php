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

// Obtener los elementos de la base de datos con paginación
$elementos = obtener_elemento($blog_config['elementos_por_pagina'], $conexion);

// Verificar si se han obtenido elementos
if (!$elementos) {
    // Redirigir a la página de error si no se obtienen elementos
    header('Location: error.php');
}

// Incluir la vista del inventario
require 'views/inventario.view.php';

?>