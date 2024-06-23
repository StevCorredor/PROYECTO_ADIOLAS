<section class="paginacion">
	<ul>
		<?php $numero_paginas = numero_paginas($blog_config['elementos_por_pagina'], $conexion); ?>
		
		<?php if (pagina_actual() === 1): ?>
			 <!-- Valida si la página actual es la primera -->
			<li class="disabled">&laquo;</li>
		<?php else: ?>
			<!-- Enlaces a la página anterior si no es la primer página -->
			<li><a href="inventario.php?p=<?php echo pagina_actual() - 1?>">&laquo;</a></li>
		<?php endif; ?>
		
		 <!-- Un For para mostrar todas las páginas -->
		<?php for ($i = 1; $i <= $numero_paginas; $i++): ?>
			<?php if (pagina_actual() === $i): ?>
				<!-- Página actual resaltada como activa -->
				<li class="active">
					<?php echo $i; ?>
				</li>
			<?php else: ?>
				<!-- Establece un enlace a las demás páginas siguientes si no es la página actual -->
				<li>
					<a href="inventario.php?p=<?php echo $i?>"><?php echo $i; ?></a>
				</li>
			<?php endif; ?>
		<?php endfor; ?>

		<?php if (pagina_actual() == $numero_paginas): ?>
			<!-- Valida si la página actual es la última -->
			<li class="disabled">&raquo;</li>
		<?php else: ?>
			<!-- Establece un enlace a las demás páginas siguientes si no es la última página -->
			<li><a href="inventario.php?p=<?php echo pagina_actual() + 1; ?>">&raquo;</a></li>
		<?php endif; ?>
	</ul>
</section>