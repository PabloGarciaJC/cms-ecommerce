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
		<div class="row">
			<div class="col-lg-5 col-md-8 single-right-left ">
				<div class="grid images_3_of_2">
					<?php if (!empty($productoFicha->oferta) && $productoFicha->oferta > 0): ?>
						<span class="product-new-top"><?php echo TEXT_OFERTA . ' ' . intval($productoFicha->oferta) . '$'; ?></span>
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
				<p class="mb-3">
					<?php
					if (!empty($productoFicha->oferta) && $productoFicha->oferta > 0) {
						$precio_con_descuento = $productoFicha->precio - $productoFicha->oferta;
						echo '<span class="item_price">' . intval($productoFicha->precio - $productoFicha->oferta) . '$</span>';
						echo '<del>' . intval($productoFicha->precio) . '$</del>';
					} else {
						echo '<span class="item_price">' . PRICE . ' : ' . intval($productoFicha->precio) . '$</span>';
					}
					?>
				</p>
				<div class="single-infoagile">
					<ul>
						<li class="mb-3">
							<?php echo $productoFicha->descripcion; ?>
						</li>
					</ul>
				</div>
				<div class="product-single-w3l">
					<p class="my-3">
						<i class="far fa-hand-point-right mr-2"></i>
						<?php echo TEXT_GARANTIA; ?>
					</p>
					<!-- <ul>
						<li class="mb-1">
							3 GB RAM | 16 GB ROM | Expandable Upto 256 GB
						</li>
						<li class="mb-1">
							5.5 inch Full HD Display
						</li>
						<li class="mb-1">
							13MP Rear Camera | 8MP Front Camera
						</li>
						<li class="mb-1">
							3300 mAh Battery
						</li>
						<li class="mb-1">
							Exynos 7870 Octa Core 1.6GHz Processor
						</li>
					</ul>
					<p class="my-sm-4 my-3">
						<i class="fas fa-retweet mr-3"></i>Net banking & Credit/ Debit/ ATM card
					</p> -->
				</div>
				<?php
				// Asegúrate de que $promedioCalificacion tenga un valor válido
				$promedioCalificacion = isset($promedioCalificacion) && is_numeric($promedioCalificacion) ? $promedioCalificacion : 0;
				// Redondea el promedio
				$promedioRedondeado = round($promedioCalificacion);
				?>
				<div class="product-rating mb-4 text-center">
					<h4 class="rating-title">Calificación Promedio</h4>
					<div class="stars">
						<?php
						// Generar las estrellas llenas y vacías
						echo str_repeat('<i class="fas fa-star"></i>', $promedioRedondeado);
						echo str_repeat('<i class="far fa-star"></i>', 5 - $promedioRedondeado);
						?>
						<span class="rating-value">(<?= number_format($promedioCalificacion, 1); ?> de 5)</span>
					</div>
				</div>

				<div class="occasion-cart">
					<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
						<form action="#" method="post">
							<fieldset>
								<?php
								$imagenes = trim($productoFicha->imagenes, '"');
								$imagenes_array = json_decode($imagenes);
								?>
								<input type="hidden" name="producto_id" value="<?php echo $productoFicha->id; ?>" />
								<input type="hidden" name="href" value="<?php echo BASE_URL ?>Producto/ficha?id=<?php echo $productoFicha->id; ?>" />
								<input type="hidden" name="image" value="<?php echo BASE_URL ?>uploads/images/productos/<?php echo $imagenes_array[0]; ?>" />
								<input type="hidden" id="text_oferta" value="<?php echo OFERTA; ?>" />
								<input type="hidden" id="text_subtotal" value="<?php echo SUBTOTAL; ?>" />
								<input type="hidden" id="text_realizar_pedido" value="<?php echo REALIZAR_PEDIDO; ?>" />
								<input type="hidden" name="cmd" value="_cart" />
								<input type="hidden" name="add" value="1" />
								<input type="hidden" name="business" value=" " />
								<input type="hidden" name="business" value="" />
								<input type="hidden" name="item_name" value="<?php echo $productoFicha->nombre; ?>" />
								<input type="hidden" name="amount" value="<?php echo $productoFicha->precio; ?>" />
								<input type="hidden" name="discount_amount" value="<?php echo $productoFicha->oferta ?>" />
								<input type="hidden" name="currency_code" value="USD" />
								<input type="hidden" name="cancel_return" value=" " />
								<input type="hidden" name="return" value="" />
								<input type="submit" name="submit" value="<?php echo ADD_TO_CART; ?>" class="button btn" />
							</fieldset>
						</form>
					</div>
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
			<div class="ficha-producto__tab ficha-producto__tab--active" id="leave-review-tab">
				<?php echo TEXT_LEAVE_REVIEW_TAB; ?>
			</div>
			<div class="ficha-producto__tab" id="highest-rated-tab">
				<?php echo TEXT_HIGHEST_RATED_TAB; ?>
			</div>
			<div class="ficha-producto__tab" id="oldest-tab">
				<?php echo TEXT_OLDEST_TAB; ?>
			</div>
		</div>

		<!-- Formulario de reseña -->
		<div class="ficha-producto__tab-content ficha-producto__tab-content--active" id="leave-review-content">
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
					<input type="hidden" name="usuario_id" value="<?php echo isset($usuario->Id) ? $usuario->Id : false ?>" />
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

	<div class="ficha-producto__tab-content" id="highest-rated-content">
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
				<p class="ficha-producto__no-reviews"><?php echo TEXT_NO_RATED_REVIEWS; ?></p>
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
				<p class="ficha-producto__no-reviews"><?php echo TEXT_NO_OLD_REVIEWS; ?></p>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php unset($_SESSION['form'], $_SESSION['errores']); ?>