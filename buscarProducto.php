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

// Comprobar que el método de la solicitud sea GET y que haya contenido en el parámetro 'busqueda'
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['busqueda'])) {
    // Limpiar los datos del parámetro 'busqueda'
    $busqueda = limpiarDatos($_GET['busqueda']);

     // Preparar la consulta SQL con JOIN para incluir categoría_producto
    $statement = $conexion->prepare(
        "SELECT 
                p.id_producto,
                p.id_categoria_producto,
                cp.categoria_producto,
                p.producto,
                p.existencia
              FROM 
                producto p
              INNER JOIN 
                categoria_producto cp ON p.id_categoria_producto = cp.id_categoria_producto
              WHERE 
                p.id_producto LIKE :busqueda
                OR p.id_categoria_producto LIKE :busqueda
                OR p.producto LIKE :busqueda
                OR p.existencia LIKE :busqueda
                OR cp.categoria_producto LIKE :busqueda"
    );

    // Ejecutar la consulta con el parámetro de búsqueda
    $statement->execute(array(':busqueda' => "%$busqueda%"));

    // Obtener los resultados
    $resultados = $statement->fetchAll();

    // Determinar el título a mostrar con base a si hay resultados o no
    if (empty($resultados)) {
        $titulo = 'Resultados de la búsqueda: ' . '"' . $busqueda . '"';
        $mensaje = 'No existen registros, ¡intente nuevamente!';
    } else {
        $titulo = 'Resultados de la búsqueda: ' . '"' . $busqueda . '"';
    }
}else {
  // Redirigir a la página de inventario si no se ha realizado una búsqueda válida
	header('Location:' . RUTA . 'inventario.php');
}
// Mostrar los resultados de la búsqueda
require 'views/buscarProducto.view.php';

?>