<?php

// Función para establecer la conexión a la base de datos
function conexion ($bd_config){
    try {
         // Crear una nueva instancia de PDO para conectarse a la base de datos
        $conexion = new PDO('mysql:host=localhost;dbname='.$bd_config['basedatos'], $bd_config['usuario'], $bd_config['pass']);
        return $conexion;
    } catch (PDOException $e) {
         // Si hay un error en la conexión, devolver false
        return false;
    }
}

// Función para limpiar los datos de entrada
function limpiarDatos($datos){
   // Eliminar espacios en blanco al inicio y al final
	$datos = trim($datos);
   // Eliminar barras invertidas
	$datos = stripslashes($datos);
   // Convertir caracteres especiales a entidades HTML
	$datos = htmlspecialchars($datos);
	return $datos;
}

// Función para obtener elementos por ID
function obtener_elementos_por_id($conexion, $id){
   // Realizar una consulta para obtener el elemento por ID
	$resultado = $conexion->query("
	SELECT 
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
            p.id_producto = $id
         LIMIT 1
	");
   // Obtener todos los resultados de la consulta
	$resultado = $resultado->fetchAll();
   // Devolver el resultado si existe, de lo contrario devolver false
	return ($resultado) ? $resultado : false;
}

// Función para convertir un ID a entero y limpiarlo
function id_elemento($id){
	return (int)limpiarDatos($id);
}

// Función para obtener la página actual desde la URL
function pagina_actual(){
   // Verificar si el parámetro 'p' existe en la URL y devolver su valor convertido a entero
	return isset($_GET['p']) ? (int)$_GET['p']: 1; 
}

// Función para obtener los elementos de la página actual
function obtener_elemento($elementos_por_pagina, $conexion){
   // Calcular el inicio de los elementos de la página actual
	$inicio = (pagina_actual() > 1) ? (pagina_actual() * $elementos_por_pagina - $elementos_por_pagina) : 0;
   // Preparar la consulta para obtener los elementos con limitación de paginación
	$sentencia = $conexion->prepare("
	SELECT SQL_CALC_FOUND_ROWS 
                p.id_producto,
                p.id_categoria_producto,
                cp.categoria_producto,
                p.producto,
                p.existencia
              FROM 
                producto p
              INNER JOIN 
                categoria_producto cp ON p.id_categoria_producto = cp.id_categoria_producto
              LIMIT {$inicio}, {$elementos_por_pagina}
	");
   // Ejecutar la consulta
	$sentencia->execute();
   // Devolver todos los resultados de la consulta
	return $sentencia->fetchAll();
}

// Función para calcular el número total de páginas
function numero_paginas($elementos_por_pagina, $conexion){
   // Preparar y ejecutar la consulta para obtener el número total de elementos
	$total_elemento = $conexion->prepare('SELECT FOUND_ROWS() as total');
	$total_elemento->execute();
   // Obtener el número total de elementos
	$total_elemento = $total_elemento->fetch()['total'];
   // Calcular el número total de páginas
	$numero_paginas = ceil($total_elemento / $elementos_por_pagina);
   // Devolver el número total de páginas
	return $numero_paginas;
}

// Obtener las categorías de productos
function obtener_categorias_producto($conexion) {
   // Preparar la consulta para obtener todas las categorías de productos
   $statement = $conexion->prepare('SELECT id_categoria_producto, categoria_producto FROM categoria_producto');
   // Ejecutar la consulta
   $statement->execute();
   // Devolver todos los resultados de la consulta
   return $statement->fetchAll();
}

?>
