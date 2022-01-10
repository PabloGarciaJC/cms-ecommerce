<!-- banner-2 -->
<div class="page-head_agile_info_w3l">
</div>
<!-- //banner-2 -->

<!-- page -->
<div class="services-breadcrumb">
	<div class="agile_inner_breadcrumb">
		<div class="container">
			<ul class="w3_short">
				<li>
					<a href="<?= base_url ?>">Home</a>
					<i>|</i>
				</li>
				<li><?= $obtenerProductoPorCategoriaId->nombreCategoria ?></li>
			</ul>
		</div>
	</div>
</div>
<!-- //page -->

<!-- top Products -->
<div class="ads-grid py-sm-5 py-4">
	<div class="container py-xl-4 py-lg-2">
		<!-- tittle heading -->
		<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
			<span>M</span>obiles
			<span>&</span>
			<span>C</span>omputers
		</h3>
		<!-- //tittle heading -->
		<div class="row">
			<!-- product left -->
			<div class="agileinfo-ads-display col-lg-9">
				<div class="wrapper">

					<!-- Id Categoria Para Obtener el Producto -->
					<input type="hidden" id="productoIdCategoria" value="<?= $obtenerProductoPorCategoriaId->categoria_id ?>">

					<!-- Respuesta Ajax y PHP -->
					<div id="respuestaPhpMostrarProductos"></div>

				</div>
			</div>
			<!-- //product left -->
			<!-- product right -->
			<div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
				<div class="side-bar p-sm-4 p-3">
					<div class="search-hotel border-bottom py-2">

						<form action="" id="buscadorMostrarProducto" method="POST">
							<input type="search" placeholder="Buscador..." id="buscadorProducto" name="">
							<input type="submit" id="btn" value=" ">
						</form>

						<div class="left-side py-2">
							<h3 class="agileits-sear-head mb-3">Marca</h3>
							<div id="respuestaPhpMostrarMarca"></div>
							<ul>
								<?php while ($obtenerMarcaSinRepetirSidebar = Utils::extraerRegistros($mostrarMarcaSinRepetirSidebar)) : ?>
									<li>
										<input type="checkbox" value="<?= $obtenerMarcaSinRepetirSidebar->marca ?>" class="checkedMarca">
										<span class="span"><?= $obtenerMarcaSinRepetirSidebar->marca ?></span>
									</li>
								<?php endwhile; ?>
							</ul>
						</div>
					</div>

					<!-- Memoria Ram -->
					<div class="left-side border-bottom py-2">
						<h3 class="agileits-sear-head mb-3">Ram</h3>
						<ul>
							<li>
								<input type="checkbox" value="2 GB" class="checkedMemoriaRam">
								<span class="span">2 GB</span>
							</li>
							<li>
								<input type="checkbox" value="4 GB" class="checkedMemoriaRam">
								<span class="span">4 GB</span>
							</li>
							<li>
								<input type="checkbox" value="8 GB" class="checkedMemoriaRam">
								<span class="span">8 GB</span>
							</li>
							<li>
								<input type="checkbox" value="16 GB" class="checkedMemoriaRam">
								<span class="span">16 GB</span>
							</li>
							<li>
								<input type="checkbox" value="32 GB" class="checkedMemoriaRam">
								<span class="span">32 GB</span>
							</li>
						</ul>

					</div>
					<!-- //Memoria Ram  -->

					<!-- Precio -->
					<div class="left-side border-bottom py-2">
						<h3 class="agileits-sear-head mb-3">Precio</h3>
						<ul>
							<li>
								<input type="checkbox" value="0 - 20" class="checkedPrecio">
								<span class="span">0 - 20 USD</span>
							</li>
							<li>
								<input type="checkbox" value="20 - 50" class="checkedPrecio">
								<span class="span">20 - 50 USD </span>
							</li>
							<li>
								<input type="checkbox" value="50 - 100" class="checkedPrecio">
								<span class="span">50 - 100 USD </span>
							</li>
							<li>
								<input type="checkbox" value="100 - 1000000" class="checkedPrecio">
								<span class="span">Más de 100 USD </span>
							</li>
						</ul>
					</div>
					<!-- //Precio -->

					<!-- discounts -->
					<div class="left-side border-bottom py-2">
						<h3 class="agileits-sear-head mb-3">Ofertas</h3>
						<ul>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">5% or More</span>
							</li>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">10% or More</span>
							</li>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">20% or More</span>
							</li>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">30% or More</span>
							</li>
							<li>
								<input type="checkbox" class="checked">
								<span class="span">50% or More</span>
							</li>
						</ul>

					</div>
					<!-- offers -->
					<!-- //arrivals -->
				</div>
				<!-- //product right -->
			</div>
		</div>
	</div>
</div>
<!-- //top products -->