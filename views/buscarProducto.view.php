<?php require 'header.php'; ?>

    <div class="contenedor">
        <div class="recipiente">
            <article>
                <h2 class="titulo">Administración del inventario</h2>
                <div class="thumb">
                    <img src="img/inventario.jpg" alt="">
                </div>
            </article>
        </div>

        <div class="recipiente">
            <article>
                <!-- Caja de búsqueda y botón para añadir nuevo artículo -->
                <div class="herramientas">
                    <form action="<?php echo RUTA; ?>/buscarProducto.php" method="get">
                        <input type="text" name="busqueda" class="cajaBusqueda" placeholder="Buscar producto...">
                    </form>
                    <button><a href="nuevoProducto.php"> Añadir nuevo producto </a></button>
                </div>
                <?php if (!empty($mensaje)): ?>
                    <h2><?php echo $titulo; ?></h2></br>
                    <h2><?php echo $mensaje; ?></h2>
                <?php else: ?>
                    <h2><?php echo $titulo; ?></h2>
                <table>
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Categoría</th>
                            <th>Producto</th>
                            <th>Referencia</th>
                            <th>Existencias</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($resultados as $elemento): ?>
                            <tr>
                                <td><?php echo $elemento['id_producto']; ?></td>
                                <td><?php echo $elemento['id_categoria_producto']; ?></td>
                                <td><?php echo $elemento['categoria_producto']; ?></td>
                                <td><?php echo $elemento['producto']; ?></td>
                                <td><?php echo $elemento['existencia']; ?></td>
                                <td><a href="editarProducto.php?id=<?php echo $elemento['id_producto']; ?>" class="editar">Editar</a></td>
                                <td><a href="eliminarProducto.php?id=<?php echo $elemento['id_producto']; ?>" class="eliminar" onclick="return confirm('¿Está seguro de que desea eliminar este producto?');">Eliminar</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>   
            </article>
        </div>

        <?php require 'paginacion.php'; ?>

    </div>

<?php require 'footer.php'; ?>