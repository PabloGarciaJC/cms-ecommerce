<div class="agile-main-top">
	<div class="container-fluid">
		<div class="row main-top-w3l py-2">
			<div class="col-lg-4 header-most-top">
				<p class="text-white text-lg-left text-center">
					<?php echo TEXT_BEST_OFFERS; ?>
					<i class="fas fa-shopping-cart ml-1"></i>
				</p>
			</div>
			<div class="col-lg-8 header-right mt-lg-0 mt-2">
				<ul class="text-right header-top-contn">
					<li class="text-center border-right text-white">
						<i class="fas fa-phone mr-2"></i> <?php echo TEXT_PHONE_NUMBER; ?>
					</li>
					<li class="text-center  <?php echo isset($_SESSION['usuarioRegistrado']) ? '' : 'border-right' ?> text-white">
						<?php if (isset($_SESSION['usuarioRegistrado'])) : ?>
							<a href="<?= BASE_URL ?>Admin/dashboard" class="text-white">
							<img src="<?php echo !empty($_SESSION['usuarioRegistrado']->imagen) ? BASE_URL . 'uploads/images/avatar/' . $_SESSION['usuarioRegistrado']->imagen : BASE_URL . 'uploads/images/default.jpg'; ?>" class="user-avatar-header" alt="Avatar de Usuario">
								<?php echo $usuario->Usuario; ?>
							</a>
						<?php else : ?>
							<a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" class="text-white">
								<i class="fas fa-sign-in-alt mr-2"></i> <?php echo TEXT_HELLO_IDENTIFY; ?>
							</a>
						<?php endif; ?>
					</li>
					<?php if (!isset($_SESSION['usuarioRegistrado'])) : ?>
						<li class="text-center text-white">
							<a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal2" class="text-white">
								<i class="fas fa-sign-out-alt mr-2"></i><?php echo TEXT_REGISTER; ?></a>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="navbar-inner">
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-containder">

			<div class="custom-select-container">
				<div class="select-selected">
					<div>
						<img src="<?php echo BASE_URL ?>assets/images/banderas/<?php echo TEXT_LANGUAGE_IDIOMA; ?>.svg" alt="selected-language">
						<?php echo TEXT_LANGUAGE; ?>
					</div>
					<div class="select-arrow">&#9662;</div>
				</div>
				<div class="select-items">
					<?php
					if (isset($getIdiomas) && !empty($getIdiomas)) {
						foreach ($getIdiomas as $idioma) {
							echo '<div data-value="' . $idioma['codigo'] . '">';
							echo '<img src="' . BASE_URL . 'assets/images/banderas/' . $idioma['codigo'] . '.svg" alt="bandera-' . $idioma['codigo'] . '">';
							echo $idioma['nombre'];
							echo '</div>';
						}
					} else {
						echo '<div>No se encontraron idiomas disponibles</div>';
					}
					?>
				</div>
			</div>

			<form id="language-form" action="<?php echo BASE_URL . ltrim($_SERVER['REQUEST_URI'], '/') ?>" method="POST">
				<input type="hidden" name="lenguaje" id="selected-language">
			</form>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
				aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto text-center mr-xl-5">
					<li class="nav-item <?php echo (basename($_SERVER['REQUEST_URI']) == '' || basename($_SERVER['REQUEST_URI']) == 'index.php') ? 'active' : ''; ?> mr-lg-2 mb-lg-0 mb-2">
						<a class="nav-link" href="<?php echo BASE_URL; ?>"><?php echo TEXT_INICIO; ?>
							<span class="sr-only">(current)</span>
						</a>
					</li>
					<!-- Categorías y Productos -->
					<?php if (!empty($categoriasConSubcategoriasYProductos)) : ?>
						<?php foreach ($categoriasConSubcategoriasYProductos as $item) : ?>
							<li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
								<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<?= $item['categoria']->nombre ?>
								</a>
								<!-- Dropdown de Subcategorías y Productos -->
								<div class="dropdown-menu multi-level-dropdown">
									<div class="agile_inner_drop_nav_info p-4">
										<div class="row">
											<!-- Subcategorías -->
											<?php if (isset($item['subcategorias']) && $item['subcategorias']->num_rows > 0) : ?>
												<div class="col-sm-6 multi-gd-img">
													<h6>Subcategorías</h6>
													<ul class="multi-column-dropdown">
														<?php while ($subcategoria = $item['subcategorias']->fetch_object()) : ?>
															<li><a href="<?php echo BASE_URL; ?>Catalogo/index?parent_id=<?= $subcategoria->grupo_id ?>"><?= $subcategoria->nombre ?></a></li>
														<?php endwhile; ?>
													</ul>
												</div>
											<?php else: ?>
												<div class="col-sm-6 multi-gd-img">
													<p class="container"><?php echo ERROR_NO_SUBCATEGORY_FOUND; ?></p>
												</div>
											<?php endif; ?>
											<!-- Productos -->
											<?php if (isset($item['productos']) && $item['productos']->num_rows > 0) : ?>
												<div class="col-sm-6 multi-gd-img">
													<h6>Productos</h6>
													<ul class="multi-column-dropdown">
														<?php while ($producto = $item['productos']->fetch_object()) : ?>
															<li><a href="<?php echo BASE_URL ?>Producto/ficha?id=<?php echo urlencode($producto->id); ?>&parent_id=<?php echo urlencode($producto->parent_id); ?>"><?= $producto->nombre ?></a></li>
														<?php endwhile; ?>
													</ul>
												</div>
											<?php else: ?>
												<div class="col-sm-6 multi-gd-img">
													<p class="container"><?php echo ERROR_NO_PRODUCTS_FOUND; ?></p>
												</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</li>
						<?php endforeach; ?>
					<?php endif; ?>
					<!-- Otros enlaces -->
					<li class="nav-item <?php echo (basename($_SERVER['REQUEST_URI']) == 'nosotros') ? 'active' : ''; ?> mr-lg-2 mb-lg-0 mb-2">
						<a class="nav-link" href="<?php echo BASE_URL; ?>Home/nosotros"><?php echo TEXT_NOSOTROS; ?></a>
					</li>
					<li class="nav-item <?php echo (basename($_SERVER['REQUEST_URI']) == 'contactanos') ? 'active' : ''; ?>">
						<a class="nav-link" href="<?php echo BASE_URL; ?>Home/contactanos"><?php echo TEXT_CONTACTANOS; ?></a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</div>