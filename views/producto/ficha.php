<div class="banner-bootom-w3-agileits py-5">
	<div class="container py-xl-4 py-lg-2">
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
						echo '<span class="item_price">' . intval($productoFicha->precio) . '$</span>';
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
						</ul> -->
					<!-- <p class="my-sm-4 my-3">
							<i class="fas fa-retweet mr-3"></i>Net banking & Credit/ Debit/ ATM card
						</p> -->
				</div>
				<div class="occasion-cart">
					<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
						<form action="#" method="post">
							<fieldset>
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