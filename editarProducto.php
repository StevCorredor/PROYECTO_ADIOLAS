<?php session_start();

// Incluir el archivo de configuración
require 'admin/config.php';

// Incluir el archivo de funciones
require 'funciones.php';

// Establecer la conexión a la base de datos
$conexion = conexion($bd_config);

// Verificar si la conexión se ha establecido correctamente
if(!$conexion){
	// Redirigir a la página de error si la conexión falla
	header('Location: error.php');
}

// Comprobar si el método de la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Limpiar y obtener los datos del formulario
    $id_producto = limpiarDatos($_POST['id_producto']);
    $id_categoria_producto = limpiarDatos($_POST['id_categoria_producto']);
    $producto = limpiarDatos($_POST['producto']);
    $existencia = limpiarDatos($_POST['existencia']);
	
	// Preparar la consulta SQL para actualizar el producto
    $statement = $conexion->prepare('
		UPDATE producto 
		SET 
			id_categoria_producto = :id_categoria_producto, 
			producto = :producto, 
			existencia = :existencia 
		WHERE 
			id_producto = :id_producto
	');
	
	// Ejecutar la consulta con los parámetros del formulario
	$statement->execute(array(
		':id_producto' => $id_producto,
		':id_categoria_producto' => $id_categoria_producto,
		':producto' => $producto,
		':existencia' => $existencia
	));

	// Redirigir al usuario a la página de inventario
	header("Location: " . RUTA . 'inventario.php');
    exit();

} else {
	// Obtener el ID del elemento desde la URL y limpiarlo
    $id_elemento = id_elemento($_GET['id']);

	// Verificar si el ID del elemento está vacío
	if (empty($id_elemento)) {
		// Redirigir a la página de inventario si el ID está vacío
		header('Location: ' . RUTA . 'inventario.php');
		exit();
	}

	// Obtenemos el elemento por su id
	$elemento = obtener_elementos_por_id($conexion, $id_elemento);

	// Verificar si el elemento existe
	if (!$elemento) {
		// Redirigir a la página de inventario si el elemento no existe
		header('Location: ' . RUTA . 'inventario.php');
		exit();
	}

	// Obtener el primer resultado del elemento
	$elemento = $elemento[0];
}

// Incluir la vista para editar el producto
require 'views/editarProducto.view.php';

?>