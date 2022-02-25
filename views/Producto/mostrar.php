<!-- banner-2 -->
<div class="page-head_agile_info_w3l">
</div>
<!-- //banner-2 -->

<div class="services-breadcrumb">
	<div class="agile_inner_breadcrumb">
		<div class="container">
			<ul class="w3_short">
				<li>
					<a href="<?= base_url ?>">Home</a>
					<i>|</i>
				</li>
				<li><?= $mostrarProductoPorCategoria->categorias ?></li>
			</ul>
		</div>
	</div>
</div>


<div class="ads-grid py-sm-5 py-4">
	<div class="container py-xl-4 py-lg-2">

		<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
			<span>M</span>obiles
			<span>&</span>
			<span>C</span>omputers
		</h3>

		<?php if ($mostrarMarcaSinRepetirSidebar->num_rows > 0) : ?>

			<div class="row">
				<div class="agileinfo-ads-display col-lg-9">
					<div class="wrapper">
						
						<!-- Id Categoria Para Obtener el Producto -->
						<input type="hidden" id="productoIdCategoria" value="<?= $mostrarProductoPorCategoria->id ?>">

						<!-- Desplazamiento del Buscador -->
						<div id="solicita-informacion"></div>

						<!-- Respuesta Ajax y PHP -->
						<div id="respuestaPhpMostrarProductos"></div>
					</div>
				</div>

				<div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
					<div class="side-bar p-sm-4 p-3">
						<div class="search-hotel border-bottom py-2">
							<!-- Buscador -->
							<input type="text" class="form-control" placeholder=" Buscador..." id="buscadorMostrarProducto">
							<!-- //Buscador -->
							<div class="left-side py-2">
								<h3 class="agileits-sear-head mb-3">Marca</h3>
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
							<h3 class="agileits-sear-head mb-3">Capacidad</h3>
							<ul>
								<?php while ($obtenerMemoriaRamSinRepetirSidebar = Utils::extraerRegistros($mostrarMemoriaRamSinRepetirSidebar)) : ?>
									<li>
										<input type="checkbox" value="<?= $obtenerMemoriaRamSinRepetirSidebar->memoria_ram ?>" class="checkedMemoriaRam">
										<span class="span"><?= $obtenerMemoriaRamSinRepetirSidebar->memoria_ram . " Gb" ?></span>
									</li>
								<?php endwhile; ?>
							</ul>
						</div>
						<!-- //Memoria Ram  -->

						<!-- Precio -->
						<div class="left-side border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Precio</h3>
							<ul>
								<li>
									<input type="checkbox" value="0 - 20" class="checkedPrecio">
									<span class="span">0 - 20 $</span>
								</li>
								<li>
									<input type="checkbox" value="20 - 50" class="checkedPrecio">
									<span class="span">20 - 50 $ </span>
								</li>
								<li>
									<input type="checkbox" value="50 - 100" class="checkedPrecio">
									<span class="span">50 - 100 $ </span>
								</li>
								<li>
									<input type="checkbox" value="100 - 1000000" class="checkedPrecio">
									<span class="span">Más de 100 $ </span>
								</li>
							</ul>
						</div>
						<!-- //Precio -->

						<!-- Ofertas -->
						<div class="left-side border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Ofertas</h3>
							<ul>
								<li>
									<input type="checkbox" value="5" class="checkedOfertas">
									<span class="span">5 % de Descuento</span>
								</li>
								<li>
									<input type="checkbox" value="10" class="checkedOfertas">
									<span class="span">10 % de Descuento</span>
								</li>
								<li>
									<input type="checkbox" value="20" class="checkedOfertas">
									<span class="span">20 % de Descuento</span>
								</li>
								<li>
									<input type="checkbox" value="30" class="checkedOfertas">
									<span class="span">30 % de Descuento</span>
								</li>
								<li>
									<input type="checkbox" value="40" class="checkedOfertas">
									<span class="span">40 % de Descuento</span>
								</li>
								<li>
									<input type="checkbox" value="50" class="checkedOfertas">
									<span class="span">50 % de Descuento</span>
								</li>
							</ul>
						</div>
						<!-- //Ofertas -->
					</div>
				</div>
			</div>
		<?php else : ?>
			<div class="alert alert-primary text-center" role="alert">
				No hay Productos para <strong>Vender</strong>
			</div>
		<?php endif; ?>
	</div>
</div>