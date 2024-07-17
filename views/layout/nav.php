	<div class="navbar-inner">
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto text-center mr-xl-5">
						<li class="nav-item active mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link" href="<?= BASE_URL ?>">Home
								<span class="sr-only">(current)</span>
							</a>
						</li>
						<?php while ($categoriaNav = $categoriaBarraNavegacion->fetch_object()) : ?>

							<li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
								<a class="nav-link dropdown" href="<?= BASE_URL ?>Producto/mostrar&producto=<?= $categoriaNav->id ?>"><?= $categoriaNav->categorias ?></a>
							</li>
						<?php endwhile; ?>
						<li class="nav-item mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link" href="<?= BASE_URL ?>Home/sobreNosotros">Sobre Nosotros</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= BASE_URL ?>Home/contactanos">Contáctanos</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</div>