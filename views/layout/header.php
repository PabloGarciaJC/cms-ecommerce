<!-- top-header -->
<div class="agile-main-top">
	<div class="container-fluid">
		<div class="row main-top-w3l py-2">
			<div class="col-lg-4 header-most-top">
				<p class="text-white text-lg-left text-center">Las Mejores Ofertas y Descuentos en Verano
					<i class="fas fa-shopping-cart ml-1"></i>
				</p>
			</div>
			<div class="col-lg-8 header-right mt-lg-0 mt-2">
				<ul>
					<li class="text-center border-right text-white">
						<a class="play-icon popup-with-zoom-anim text-white" href="#small-dialog1">
							<i class="fas fa-map-marker mr-2"></i>Seleciona Ubicación</a>
					</li>
					<li class="text-center border-right text-white">
						<a href="#" data-toggle="modal" data-target="#exampleModal" class="text-white">
							<i class="fas fa-truck mr-2"></i>Track Order</a>
					</li>
					<li class="text-center border-right text-white">
						<i class="fas fa-phone mr-2"></i> 001 234 5678
					</li>

					<li class="text-center border-right text-white">
						<?php if (isset($_SESSION['usuarioRegistrado'])) : ?>
							<a href="<?= BASE_URL ?>usuario/informacionGeneral">Hola, <?= $usuario->Usuario ?></a>
						<?php else : ?>
							<a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" class="text-white">
								<i class="fas fa-sign-in-alt mr-2"></i> Hola, Identificate </a>
							</a>
						<?php endif; ?>
					</li>
					<li class="text-center text-white">
						<a href="#" data-toggle="modal" data-target="#exampleModal2" class="text-white">
							<i class="fas fa-sign-out-alt mr-2"></i>Registrate </a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<!-- Menu -->
<!-- <div class="navbar-inner">
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
</div> -->

<!-- navigation -->
<div class="navbar-inner">
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="agileits-navi_search">
				<form action="#" method="post">
					<select id="agileinfo-nav_search" name="agileinfo_search" class="border" required="">
						<option value="">All Categories</option>
						<option value="Televisions">Televisions</option>
						<option value="Headphones">Headphones</option>
						<option value="Computers">Computers</option>
						<option value="Appliances">Appliances</option>
						<option value="Mobiles">Mobiles</option>
						<option value="Fruits &amp; Vegetables">Tv &amp; Video</option>
						<option value="iPad & Tablets">iPad & Tablets</option>
						<option value="Cameras & Camcorders">Cameras & Camcorders</option>
						<option value="Home Audio & Theater">Home Audio & Theater</option>
					</select>
				</form>
			</div>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
				aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto text-center mr-xl-5">
					<li class="nav-item active mr-lg-2 mb-lg-0 mb-2">
						<a class="nav-link" href="index.html">Home
							<span class="sr-only">(current)</span>
						</a>
					</li>
					<li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Electronics
						</a>
						<div class="dropdown-menu">
							<div class="agile_inner_drop_nav_info p-4">
								<h5 class="mb-3">Mobiles, Computers</h5>
								<div class="row">
									<div class="col-sm-6 multi-gd-img">
										<ul class="multi-column-dropdown">
											<li>
												<a href="product.html">All Mobile Phones</a>
											</li>
											<li>
												<a href="product.html">All Mobile Accessories</a>
											</li>
											<li>
												<a href="product.html">Cases & Covers</a>
											</li>
											<li>
												<a href="product.html">Screen Protectors</a>
											</li>
											<li>
												<a href="product.html">Power Banks</a>
											</li>
											<li>
												<a href="product.html">All Certified Refurbished</a>
											</li>
											<li>
												<a href="product.html">Tablets</a>
											</li>
											<li>
												<a href="product.html">Wearable Devices</a>
											</li>
											<li>
												<a href="product.html">Smart Home</a>
											</li>
										</ul>
									</div>
									<div class="col-sm-6 multi-gd-img">
										<ul class="multi-column-dropdown">
											<li>
												<a href="product.html">Laptops</a>
											</li>
											<li>
												<a href="product.html">Drives & Storage</a>
											</li>
											<li>
												<a href="product.html">Printers & Ink</a>
											</li>
											<li>
												<a href="product.html">Networking Devices</a>
											</li>
											<li>
												<a href="product.html">Computer Accessories</a>
											</li>
											<li>
												<a href="product.html">Game Zone</a>
											</li>
											<li>
												<a href="product.html">Software</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Appliances
						</a>
						<div class="dropdown-menu">
							<div class="agile_inner_drop_nav_info p-4">
								<h5 class="mb-3">TV, Appliances, Electronics</h5>
								<div class="row">
									<div class="col-sm-6 multi-gd-img">
										<ul class="multi-column-dropdown">
											<li>
												<a href="product2.html">Televisions</a>
											</li>
											<li>
												<a href="product2.html">Home Entertainment Systems</a>
											</li>
											<li>
												<a href="product2.html">Headphones</a>
											</li>
											<li>
												<a href="product2.html">Speakers</a>
											</li>
											<li>
												<a href="product2.html">MP3, Media Players & Accessories</a>
											</li>
											<li>
												<a href="product2.html">Audio & Video Accessories</a>
											</li>
											<li>
												<a href="product2.html">Cameras</a>
											</li>
											<li>
												<a href="product2.html">DSLR Cameras</a>
											</li>
											<li>
												<a href="product2.html">Camera Accessories</a>
											</li>
										</ul>
									</div>
									<div class="col-sm-6 multi-gd-img">
										<ul class="multi-column-dropdown">
											<li>
												<a href="product2.html">Musical Instruments</a>
											</li>
											<li>
												<a href="product2.html">Gaming Consoles</a>
											</li>
											<li>
												<a href="product2.html">All Electronics</a>
											</li>
											<li>
												<a href="product2.html">Air Conditioners</a>
											</li>
											<li>
												<a href="product2.html">Refrigerators</a>
											</li>
											<li>
												<a href="product2.html">Washing Machines</a>
											</li>
											<li>
												<a href="product2.html">Kitchen & Home Appliances</a>
											</li>
											<li>
												<a href="product2.html">Heating & Cooling Appliances</a>
											</li>
											<li>
												<a href="product2.html">All Appliances</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="nav-item mr-lg-2 mb-lg-0 mb-2">
						<a class="nav-link" href="about.html">About Us</a>
					</li>
					<li class="nav-item mr-lg-2 mb-lg-0 mb-2">
						<a class="nav-link" href="product.html">New Arrivals</a>
					</li>
					<li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Pages
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="product.html">Product 1</a>
							<a class="dropdown-item" href="product2.html">Product 2</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="single.html">Single Product 1</a>
							<a class="dropdown-item" href="single2.html">Single Product 2</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="checkout.html">Checkout Page</a>
							<a class="dropdown-item" href="payment.html">Payment Page</a>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="contact.html">Contact Us</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</div>
<!-- //navigation -->

<!-- Buscador -->
<div class="header-bot">
	<div class="container">
		<div class="row header-bot_inner_wthreeinfo_header_mid">
			<!-- logo -->
			<div class="col-md-3 logo_agile">
				<h1 class="text-center">
					<a href="<?= BASE_URL ?>" class="font-weight-bold font-italic">
						<img src="<?= BASE_URL ?>assets/images/logo2.png" class="img-fluid">Electro Store
					</a>
				</h1>
			</div>
			<!-- //logo -->
			<!-- header-bot -->
			<div class="col-md-9 header mt-4 mb-md-0 mb-4">
				<div class="row">
					<!-- search -->
					<div class="col-10 agileits_search">
						<form class="form-inline" action="#" method="post">
							<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" required>
							<button class="btn my-2 my-sm-0" type="submit">Search</button>
						</form>
					</div>
					<!-- //search -->
					<!-- cart details -->
					<div class="col-2 top_nav_right text-center mt-sm-0 mt-2">
						<div class="wthreecartaits wthreecartaits2 cart cart box_1">
							<form action="#" method="post" class="last">
								<input type="hidden" name="cmd" value="_cart">
								<input type="hidden" name="display" value="1">
								<button class="btn w3view-cart" type="submit" name="submit" value="">
									<i class="fas fa-cart-arrow-down"></i>
								</button>
							</form>
						</div>
					</div>
					<!-- //cart details -->
				</div>
			</div>
		</div>
	</div>
</div>