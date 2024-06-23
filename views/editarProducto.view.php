<?php require 'header.php' ?>

<div class="contenedor">
    <div class="recipiente">
        <article>
            <h2 class="titulo">Editar producto</h2>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="formulario" method="POST">
                <label for="id_producto">ID del Producto:</label>
                <input type="number" id="id_producto" name="id_producto" value="<?php echo $elemento['id_producto']; ?>" disabled>
                <input type="hidden" name="id_producto" value="<?php echo $elemento['id_producto']; ?>">

                <label for="id_categoria_producto">ID de la Categoría del Producto:</label>
                <input type="number" id="id_categoria_producto" name="id_categoria_producto" value="<?php echo $elemento['id_categoria_producto']; ?>" disabled>
                <input type="hidden" name="id_categoria_producto" value="<?php echo $elemento['id_categoria_producto']; ?>">

                <label for="categoria_producto">Nombre del Producto:</label>
                <input type="text" id="categoria_producto" name="categoria_producto" value="<?php echo $elemento['categoria_producto']; ?>" disabled>
                <input type="hidden" name="categoria_producto" value="<?php echo $elemento['categoria_producto']; ?>">

                <label for="producto">Referencia:</label>
                <input type="text" id="producto" name="producto" value="<?php echo $elemento['producto']; ?>">

                <label for="existencia">Existencia:</label>
                <input type="number" id="existencia" name="existencia" value="<?php echo $elemento['existencia']; ?>">

                <input type="submit" value="Modificar Producto" onclick="return confirm('¿Está seguro que desea modificar este producto?');">
            </form>
        </article>
    </div>  
</div>

<?php require 'footer.php'; ?>