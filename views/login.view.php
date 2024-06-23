<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1c7eb8c542.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo RUTA; ?>/css/estilos.css">
    <title>PROYECTO ADIOLAS</title>
</head>

    <header>
        <div class="contenedor">
            <div class="logo izquierda">
                <p><a href="<?php echo RUTA; ?>">ADIOLAS INV</a></p>
            </div>
        </div>
    </header>

    <div class="contenedor">
		<div class="recipiente">
			<article>
				<h2 class="titulo">Inicia Sesion</h2>
				<form class="formulario" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
					<input type="text" name="usuario" placeholder="Usuario">
					<input type="password" name="password" placeholder="Contraseña">
					<input type="submit" value="Iniciar Sesion">

                    <?php if(!empty($errores)): ?>
                        <div class="error">
                            <ul>
                                <?php echo $errores; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
				</form>
			</article>
		</div>
	</div>

<?php require 'footer.php'; ?>