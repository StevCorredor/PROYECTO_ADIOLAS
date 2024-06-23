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

// Inicializar variables para los datos del producto
$id_producto = '';
$id_categoria_producto = '';
$producto = '';
$existencia = '';

// Obtener las categorías de productos de la base de datos
$categorias = obtener_categorias_producto($conexion);

// Comprobar si el método de la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Limpiar y obtener los datos del formulario
    $id_producto = limpiarDatos($_POST['id_producto']);
    $id_categoria_producto = limpiarDatos($_POST['id_categoria_producto']);
    $producto = limpiarDatos($_POST['producto']);
    $existencia = limpiarDatos($_POST['existencia']);

    // Preparar y ejecutar la consulta SQL para insertar un nuevo producto
    $statement = $conexion->prepare(
        'INSERT INTO producto (id_producto, id_categoria_producto, producto, existencia) 
        VALUES (:id_producto, :id_categoria_producto, :producto, :existencia)'
    );

    // Manejar errores en la ejecución de la consulta
    if ($statement->execute(array(
        ':id_producto' => $id_producto,
        ':id_categoria_producto' => $id_categoria_producto,
        ':producto' => $producto,
        ':existencia' => $existencia
    ))) {
        // Redirigir al usuario a la página de inventario si la inserción es exitosa
        header('Location: ' . RUTA . 'inventario.php');
    } else {
        // Manejar errores si la consulta falla
        echo 'Error al insertar el producto';
    }
}

// Incluir la vista para crear un nuevo producto
require 'views/nuevoProducto.view.php';

?>