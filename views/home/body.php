<div class="ads-grid py-sm-5 py-4">
	<div class="container py-xl-4 py-lg-2">
		<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
			<?php echo TEXT_NUESTROS_PRODUCTOS ?>
		</h3>
		<div class="row">
			<div class="wrapper">
				<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
					<h3 class="heading-tittle text-center font-italic"><?php echo TEXT_MOVILES; ?></h3>				
					<div class="row">
						<?php echo $producto->moviles(); ?>
					</div>
				</div>
				<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
					<h3 class="heading-tittle text-center font-italic"><?php echo TEXT_PORTATILES; ?></h3>
					<div class="row">
						<?php echo $producto->tvAudios(); ?>
					</div>
				</div>
				<div class="product-sec1 product-sec2 px-sm-5 px-3 animation__fade-in-upscale">
					<div class="row">
						<h3 class="col-md-4 effect-bg">Summer Carnival</h3>
						<p class="w3l-nut-middle">Get Extra 10% Off</p>
						<div class="col-md-8 bg-right-nut">
							<img src="<?php echo BASE_URL ?>assets/images/image1.png" alt="">
						</div>
					</div>
				</div>
				<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
					<h3 class="heading-tittle text-center font-italic"><?php echo TEXT_ACCESORIOS; ?></h3>
					<div class="row">
						<?php echo $producto->electrodomesticos(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>