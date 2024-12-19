	<!-- banner-2 -->
	<div class="page-head_agile_info_w3l">
	</div>
	<!-- page -->
	<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="<?= BASE_URL ?>"><?php echo TEXT_INICIO; ?></a>
						<i>|</i>
					</li>
					<li><?php echo TEXT_CONTACTANOS; ?></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="contact py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<?php echo TEXT_CONTACTO; ?>
			</h3>

			<div class="row contact-grids agile-1 mb-5">
				<div class="col-sm-4 contact-grid agileinfo-6 mt-sm-0 mt-2">
					<div class="contact-grid1 text-center">
						<div class="con-ic">
							<i class="fas fa-map-marker-alt rounded-circle"></i>
						</div>
						<h4 class="font-weight-bold mt-sm-4 mt-3 mb-3"><?php echo TEXT_ADDRESS_TITLE; ?></h4>
						<p><?php echo TEXT_ADDRESS_DETAILS; ?></p>
					</div>
				</div>
				<div class="col-sm-4 contact-grid agileinfo-6 my-sm-0 my-4">
					<div class="contact-grid1 text-center">
						<div class="con-ic">
							<i class="fas fa-phone rounded-circle"></i>
						</div>
						<h4 class="font-weight-bold mt-sm-4 mt-3 mb-3"><?php echo TEXT_CALL_US_TITLE; ?></h4>
						<p><?php echo TEXT_CALL_US_DETAILS; ?></p>
					</div>
				</div>
				<div class="col-sm-4 contact-grid agileinfo-6">
					<div class="contact-grid1 text-center">
						<div class="con-ic">
							<i class="fas fa-envelope-open rounded-circle"></i>
						</div>
						<h4 class="font-weight-bold mt-sm-4 mt-3 mb-3"><?php echo TEXT_EMAIL_TITLE; ?></h4>
						<p><?php echo TEXT_EMAIL_DETAILS; ?></p>
					</div>
				</div>
			</div>
			<!-- form -->
			<form action="#" method="post">
				<div class="contact-grids1 w3agile-6">
					<div class="row">
						<div class="col-md-6 col-sm-6 contact-form1 form-group">
							<label class="col-form-label"><?php echo TEXT_FORM_NAME_LABEL; ?></label>
							<input type="text" class="form-control" name="Name" placeholder="" required="">
						</div>
						<div class="col-md-6 col-sm-6 contact-form1 form-group">
							<label class="col-form-label"><?php echo TEXT_FORM_EMAIL_LABEL; ?></label>
							<input type="email" class="form-control" name="Email" placeholder="" required="">
						</div>
					</div>
					<div class="contact-me animated wow slideInUp form-group">
						<label class="col-form-label"><?php echo TEXT_FORM_MESSAGE_LABEL; ?></label>
						<textarea name="Message" class="form-control" placeholder="" required=""></textarea>
					</div>
					<div class="contact-form">
						<input type="submit" value="<?php echo TEXT_FORM_SUBMIT_BUTTON; ?>">
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- //contact --