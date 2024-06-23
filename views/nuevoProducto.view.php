<?php require 'header.php' ?>

<div class="contenedor">
    <div class="recipiente">
        <article>
            <h2 class="titulo">Nuevo producto</h2>
            <script>
                function actualizarCategoriaProducto() {
                    const select = document.getElementById('id_categoria_producto');
                    const selectedOption = select.options[select.selectedIndex];
                    const categoriaProducto = selectedOption.getAttribute('data-categoria');
                    document.getElementById('categoria_producto').value = categoriaProducto;
                }
            </script>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="formulario" method="post">
                <label for="id_producto">ID del Producto:</label>
                <input type="number" name="id_producto" placeholder="Código:" required>

                <label for="id_categoria_producto">Categoría:</label>
                <select id="id_categoria_producto" name="id_categoria_producto" onchange="actualizarCategoriaProducto()" required>
                    <option value="" disabled selected>Seleccione una categoría</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?php echo $categoria['id_categoria_producto']; ?>" data-categoria="<?php echo $categoria['categoria_producto']; ?>">
                            <?php echo $categoria['id_categoria_producto'] . ' - ' . $categoria['categoria_producto']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <input type="text" id="categoria_producto" name="categoria_producto" placeholder="Producto" readonly required>

                <label for="producto">Referencia:</label>
                <input type="text" id="producto" name="producto" placeholder="Referencia:" required>

                <label for="existencia">Existencia:</label>
                <input type="number" id="existencia" name="existencia" placeholder="Existencias:" required>

                <input type="submit" value="Crear Producto" onclick="return confirm('¿Está seguro de que desea insertar este producto?');">
            </form>
        </article>
    </div>  
</div>

<?php require 'footer.php'; ?>