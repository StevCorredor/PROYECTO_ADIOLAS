<?php session_start();

// Incluir el archivo de configuración
require 'admin/config.php';

// Incluir el archivo de funciones
require 'funciones.php';

// Conectamos a la base de datos
$conexion = conexion($bd_config);
// Verificar si la conexión se ha establecido correctamente
if(!$conexion){
	// Redirigir a la página de error si la conexión falla
	header('Location: error.php');
}

// Limpiar y obtener el ID del producto desde la URL
$id = limpiarDatos($_GET['id']);

// Comprobamos que exista un ID
if (!$id) {
	// Redirigir a la página de inventario si el ID no existe
	header('Location:' . RUTA . 'inventario.php');
}

// Preparar la consulta SQL para eliminar el producto
$statement = $conexion->prepare('DELETE FROM producto WHERE id_producto = :id_producto');

// Ejecutar la consulta con el ID del producto
$statement->execute(array('id_producto' => $id));

// Redirigir al usuario a la página de inventario después de eliminar el producto
header('Location: ' . RUTA . 'inventario.php');

?>