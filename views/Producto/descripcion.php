	<!-- Single Page -->
	<div class="banner-bootom-w3-agileits py-5">
		<div class="container py-xl-4 py-lg-2">
			<div class="row">
				<div class="col-lg-5 col-md-8 single-right-left ">
					<div class="grid images_3_of_2">
						<div class="flexslider">
							<img src="<?= BASE_URL ?>uploads/images/productos/<?= $idProducto->imagen ?>" width="50%" height="50%" alt="">
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
				<div class="col-lg-7 single-right-left simpleCart_shelfItem">
					<h3 class="mb-3"><?= $idProducto->nombre ?></h3>
					<div class="single-infoagile">
						<ul>
							<li class="mb-3">
								<strong>Precio: </strong> <?= $idProducto->precio ?> $
							</li>
							<li class="mb-3">
								<strong> Oferta : </strong><?= $idProducto->oferta ?> %
							</li>
							<li class="mb-3">
								<strong> Marca : </strong><?= $idProducto->marca ?>
							</li>

							<li class="mb-3">
								<strong> Stock : </strong><?= $idProducto->stock ?>
							</li>

							<li class="mb-3">
								<strong> Descripción : </strong><?= $idProducto->descripcion ?>
							</li>
						</ul>
					</div>
					<div class="product-single-w3l">
						<p class="my-3">
							<i class="far fa-hand-point-right mr-2"></i>
							<strong>1 Año de Garantía del Fabricante</strong>
						</p>
						<ul>
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
					</div>
					<div class="occasion-cart">
						<a class="btn btn-primary" href="<?= BASE_URL ?>CarritoCompras/listar&id=<?= $idProducto->id ?>">Añadir a la cesta</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- //Single Page -->

	<!-- Con este Scrip Soluciono el Problema. de cargar la pagina dos veces -->
	<script>
		if (window.history.replaceState) {
			window.history.replaceState(null, null, window.location.href);
		}
	</script>