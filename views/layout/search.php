<div class="header-bot">
	<div class="container">
		<div class="row header-bot_inner_wthreeinfo_header_mid">
			<!-- logo -->
			<div class="col-md-3 logo_agile">
				<h1 class="text-center">
					<a href="<?= BASE_URL ?>" class="font-weight-bold font-italic">
						<img src="<?= BASE_URL ?>assets/images/logo2.png" class="img-fluid"><?php echo TEXT_ELECTRO_STORE; ?>
					</a>
				</h1>
			</div>
			<div class="col-md-9 header mt-4 mb-md-0 mb-4">
				<div class="row">
					<div class="col-10 agileits_search">
						<form class="form-inline" action="<?= BASE_URL ?>Catalogo/index" method="GET">
							<input class="form-control mr-sm-2" type="search" name="textoBusqueda" placeholder="<?= TEXT_SEARCH_BUTTON; ?>" aria-label="Search" value="<?= $_GET['textoBusqueda'] ?? ''; ?>">
							<button class="btn my-2 my-sm-0" type="submit"><?= TEXT_SEARCH_BUTTON; ?></button>
						</form>

					</div>
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
				</div>
			</div>
		</div>
	</div>
</div>