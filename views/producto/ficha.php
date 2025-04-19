
<?php use helpers\Utils; ?>
<div class="services-breadcrumb">
	<div class="agile_inner_breadcrumb">
		<div class="container">
			<ul class="w3_short">
				<li>
					<a href="<?= BASE_URL ?>"><?php echo TEXT_INICIO; ?></a>
					<i>|</i>
				</li>
				<li><?php echo TEXT_FICHA; ?></li>
			</ul>
		</div>
	</div>
</div>

<div class="banner-bootom-w3-agileits mt-3">
	<div class="container">
		<div class="row <?php echo (isset($productoFicha->stock) && $productoFicha->stock > 0) ? '' : 'product-ficha-sin-stock'; ?>">
			<div class="col-lg-5 col-md-8 single-right-left ">
				<div class="grid images_3_of_2">
					<?php if (!empty($productoFicha->oferta) && $productoFicha->oferta > 0): ?>
						<?php
						// Asegurándonos de que $prod->oferta sea un número válido
						$descuento = floatval($productoFicha->oferta); // Convertimos a float para asegurar que es numérico
						$precio_con_descuento = $productoFicha->precio - ($productoFicha->precio * ($descuento / 100)); // Calculamos el precio con descuento
						?>
						<span class="product-new-top badge badge-danger">-<?php echo intval($descuento); ?>%</span>
					<?php endif; ?>
					<?php
					$imagenesArray = json_decode($productoFicha->imagenes);
					if ($imagenesArray && is_array($imagenesArray)) :
					?>
						<div class="flexslider">
							<ul class="slides">
								<?php foreach ($imagenesArray as $imagen) :
									$imagenUrl = BASE_URL . "uploads/images/productos/" . $imagen;
								?>
									<li data-thumb="<?php echo $imagenUrl; ?>">
										<div class="thumb-image">
											<img src="<?php echo $imagenUrl; ?>" data-imagezoom="true" class="img-fluid" alt="Producto">
										</div>
									</li>
								<?php endforeach; ?>
							</ul>
							<div class="clearfix"></div>
						</div>
					<?php else : ?>
						<img src="<?php echo BASE_URL ?>uploads/images/default.jpg" alt="Imagen del Producto" class="productos-thumbnail">
					<?php endif; ?>
				</div>
			</div>
			<div class="col-lg-7 single-right-left simpleCart_shelfItem">
				<h3 class="mb-3"><?php echo $productoFicha->nombre; ?></h3>
				<?php if (!empty($productoFicha->oferta) && $productoFicha->oferta > 0): ?>
					<div class="pricing-details">
						<span class="item_price text-success font-weight-bold"><?php echo PRICE; ?>: <?php echo round($precio_con_descuento, 2); ?>$</span>
						<span class="text-muted small"><?php echo BEFORE; ?>: <del><?php echo intval($productoFicha->precio); ?>$</del></span>
					</div>
				<?php else: ?>
					<span class="item_price text-success font-weight-bold"><?php echo PRICE; ?>: <?php echo intval($productoFicha->precio); ?>$</span>
				<?php endif; ?>

				<?php if (!empty($productoFicha->nombre_categoria)): ?>
					<div class="product-category mt-2 mb-2">
						<strong><?php echo TEXT_CATEGORY; ?>: </strong>
						<a href="<?php echo BASE_URL ?>Catalogo/index?parent_id=<?php echo $productoFicha->parent_id; ?>" class="producto-tag-categoria"><?php echo $productoFicha->nombre_categoria; ?></a>
					</div>
				<?php endif; ?>

				<?php if (!empty($productoFicha->descripcion)): ?>
					<div class="single-infoagile">
						<ul>
							<li class="mb-3">
								<?php echo $productoFicha->descripcion; ?>
							</li>
						</ul>
					</div>
				<?php endif; ?>

				<div class="product-single-w3l">
					<ul class="pt-3">
						<?php if (!empty($productoFicha->especificacion_1)): ?>
							<li class="mb-1">
								<?php echo $productoFicha->especificacion_1; ?>
							</li>
						<?php endif; ?>
						<?php if (!empty($productoFicha->especificacion_2)): ?>
							<li class="mb-1">
								<?php echo $productoFicha->especificacion_2; ?>
							</li>
						<?php endif; ?>
						<?php if (!empty($productoFicha->especificacion_3)): ?>
							<li class="mb-1">
								<?php echo $productoFicha->especificacion_3; ?>
							</li>
						<?php endif; ?>
						<?php if (!empty($productoFicha->especificacion_4)): ?>
							<li class="mb-1">
								<?php echo $productoFicha->especificacion_4; ?>
							</li>
						<?php endif; ?>
						<?php if (!empty($productoFicha->especificacion_5)): ?>
							<li class="mb-1">
								<?php echo $productoFicha->especificacion_5; ?>
							</li>
						<?php endif; ?>
					</ul>
					<p class="my-3">
						<i class="far fa-hand-point-right mr-2"></i>
						<?php echo TEXT_GARANTIA; ?>
					</p>
				</div>
				<div class="product-rating mb-4 text-center">
					<h4 class="rating-title"><?php echo TEXT_AVERAGE_RATING; ?></h4>
					<div class="stars">
						<?php echo Utils::obtenerEstrellas($productoFicha->grupo_id); ?>
					</div>
				</div>
				<div class="occasion-cart">
					<button class="item-btn-favorito <?php echo isset($productoFicha->favorito_id) && $usuario->Id == $productoFicha->usuario_id ? 'favorito-activado' : false; ?>" data-grupo-id="<?php echo $productoFicha->grupo_id; ?>">
						<i class="fas fa-heart"></i> <?php echo TEXT_PRODUCT_SAVE_FAVORITE; ?>
					</button>
					<form action="<?php BASE_URL ?>Producto/checkout" method="post" class="formulario-items-productos">
						<fieldset>
							<input type="hidden" name="usuario_id" value="<?php echo isset($_SESSION['usuarioRegistrado']->Id) ? $_SESSION['usuarioRegistrado']->Id : false ?>" />
							<input type="hidden" name="nombre" value="<?php echo $productoFicha->nombre; ?>" />
							<input type="hidden" name="precio" value="<?php echo $productoFicha->precio; ?>" />
							<input type="hidden" name="oferta" value="<?php echo $productoFicha->oferta; ?>" />
							<input type="hidden" name="grupo_id" value="<?php echo $productoFicha->grupo_id; ?>" />
							<input type="hidden" name="stock" value="<?php echo $productoFicha->stock; ?>" />
							<?php if (isset($productoFicha->stock) && $productoFicha->stock > 0): ?>
								<input type="submit" name="submit" value="<?php echo ADD_TO_CART; ?>" class="button btn producto-btn" />
							<?php else: ?>
								<input value="SIN STOCK" class="button-sin-stock btn" />
							<?php endif; ?>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Reseñas -->
<div class="container ficha-producto__container mb-4">
	<div class="ficha-producto__reviews-text">
		<h4><?php echo TEXT_REVIEWS_TITLE; ?></h4>
		<div class="ficha-producto__tabs mt-4">
			<div class="ficha-producto__tab ficha-producto__tab--active" id="highest-rated-tab">
				<?php echo TEXT_HIGHEST_RATED_TAB; ?>
			</div>
			<div class="ficha-producto__tab" id="oldest-tab">
				<?php echo TEXT_OLDEST_TAB; ?>
			</div>
			<div class="ficha-producto__tab" id="leave-review-tab">
				<?php echo TEXT_LEAVE_REVIEW_TAB; ?>
			</div>
		</div>
	</div>

	<div class="ficha-producto__tab-content ficha-producto__tab-content--active" id="highest-rated-content">
		<div class="ficha-producto__reviews-list">
			<?php if ($comentariosValorados->num_rows > 0) : ?>
				<?php while ($comentario = $comentariosValorados->fetch_object()) : ?>
					<div class="ficha-producto__review-item">
						<div class="ficha-producto__review-header">
							<strong class="ficha-producto__review-user"><?= htmlspecialchars($comentario->Usuario); ?></strong>
							<div class="ficha-producto__review-stars">
								<?= str_repeat('★', $comentario->calificacion) . str_repeat('☆', 5 - $comentario->calificacion); ?>
							</div>
						</div>
						<p class="ficha-producto__review-comment"><?= htmlspecialchars($comentario->comentario); ?></p>
						<div class="ficha-producto__review-footer">
							<span class="ficha-producto__review-date"><?= date("d M Y", strtotime($comentario->fecha)); ?></span>
						</div>
					</div>
				<?php endwhile; ?>
			<?php else : ?>
				<div class="ficha-producto__review-item">
					<p class="ficha-producto__review-comment"><?php echo TEXT_NO_RATED_REVIEWS; ?></p>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<div class="ficha-producto__tab-content" id="oldest-content">
		<div class="ficha-producto__reviews-list">
			<?php if ($obtenerComentariosMenorCalificacion->num_rows > 0) : ?>
				<?php while ($comentario = $obtenerComentariosMenorCalificacion->fetch_object()) : ?>
					<div class="ficha-producto__review-item">
						<div class="ficha-producto__review-header">
							<strong class="ficha-producto__review-user"><?= htmlspecialchars($comentario->Usuario); ?></strong>
							<div class="ficha-producto__review-stars">
								<?= str_repeat('★', $comentario->calificacion) . str_repeat('☆', 5 - $comentario->calificacion); ?>
							</div>
						</div>
						<p class="ficha-producto__review-comment"><?= htmlspecialchars($comentario->comentario); ?></p>
						<div class="ficha-producto__review-footer">
							<span class="ficha-producto__review-date"><?= date("d M Y", strtotime($comentario->fecha)); ?></span>
						</div>
					</div>
				<?php endwhile; ?>
			<?php else : ?>
				<div class="ficha-producto__review-item">
					<p class="ficha-producto__review-comment"><?php echo TEXT_NO_RATED_REVIEWS; ?></p>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<div class="ficha-producto__tab-content" id="leave-review-content">
		<?php if (isset($_SESSION['exito'])) : ?>
			<div class="alert <?php echo $_SESSION['messageClass']; ?> alert-dismissible fade show mt-2 text-center" role="alert">
				<i class="<?php echo isset($_SESSION['icon']) ? $_SESSION['icon'] : 'fas fa-check-circle'; ?>"></i>
				<?php echo $_SESSION['exito']; ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php endif; ?>

		<div class="ficha-producto__product-review">
			<form action="<?php echo BASE_URL ?>Comentario/guardar" method="POST" id="reviewForm">
				<input type="hidden" name="producto_id" value="<?php echo $productoFicha->id; ?>" />
				<input type="hidden" name="parentid" value="<?php echo isset($_GET['parent_id']) ? $_GET['parent_id'] : false ?>" />
				<input type="hidden" name="producto_grupo_id" value="<?php echo $productoFicha->grupo_id; ?>" />
				<div class="ficha-producto__form-group">
					<textarea id="comentario" name="comentario" class="ficha-producto__form-control" rows="4" placeholder="<?php echo TEXT_LEAVE_COMMENT_PLACEHOLDER; ?>" required><?php echo isset($_SESSION['form']['comentario']) ? htmlspecialchars($_SESSION['form']['comentario'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
				</div>
				<div class="ficha-producto__form-group">
					<label for="calificacion"><?php echo TEXT_RATING_LABEL; ?></label>
					<div class="ficha-producto__stars">
						<?php for ($i = 5; $i >= 1; $i--) : ?>
							<input type="radio" name="calificacion" value="<?php echo $i; ?>" id="star<?php echo $i; ?>"
								<?php echo isset($_SESSION['form']['calificacion']) && $_SESSION['form']['calificacion'] == $i ? 'checked' : ''; ?>>
							<label for="star<?php echo $i; ?>">☆</label>
						<?php endfor; ?>
					</div>
				</div>
				<button type="button" id="submitReview" class="ficha-producto__btn"><?php echo TEXT_SUBMIT_REVIEW_BUTTON; ?></button>
			</form>
		</div>
	</div>
</div>

<?php unset($_SESSION['form'], $_SESSION['errores']); ?>