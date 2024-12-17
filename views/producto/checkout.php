	<div class="privacy py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<?php echo CHECKOUT; ?>
			</h3>
			<!-- //tittle heading -->
			<div class="checkout-right">
				<h4 class="mb-sm-4 mb-3"><?php echo CART_CONTAINS; ?>
					<span>3 <?php echo PRODUCTS_COUNT; ?></span>
				</h4>
				<div class="table-responsive">


					<table class="timetable_sub">
						<thead>
							<tr>
								<th><?php echo SL_NO; ?></th>
								<th><?php echo PRODUCT; ?></th>
								<th><?php echo QUALITY; ?></th>
								<th><?php echo PRODUCT_NAME; ?></th>
								<th><?php echo PRICE; ?></th>
								<th><?php echo REMOVE; ?></th>
							</tr>
						</thead>
						<tbody>
							<?php
							if (empty($items)) {
								echo '<tr><td colspan="6">No hay productos</td></tr>'; // Si no hay productos, mostrar un mensaje.
							} else {
								// Si hay productos, recorrer el array para generar las filas
								foreach ($items as $index => $item) { ?>
									<tr class="rem<?php echo $index + 1; ?>">
										<td class="invert"><?php echo $index + 1; ?></td>
										<td class="invert-image">
											<a href="single.html">
												<img src="images/a.jpg" alt=" " class="img-responsive">
											</a>
										</td>
										<td class="invert">
											<div class="quantity">
												<div class="quantity-select">
													<div class="entry value-minus">&nbsp;</div>
													<div class="entry value">
														<span><?php echo $item['quantity']; ?></span>
													</div>
													<div class="entry value-plus active">&nbsp;</div>
												</div>
											</div>
										</td>
										<td class="invert"><?php echo $item['name']; ?></td>
										<td class="invert">$<?php echo number_format($item['price'], 2); ?></td>
										<td class="invert">
											<div class="rem">
												<div class="close<?php echo $index + 1; ?>"> </div>
											</div>
										</td>
									</tr>
							<?php
								}
							}
							?>
						</tbody>
					</table>



				</div>
			</div>
			<div class="checkout-left">
				<div class="address_form_agile mt-sm-5 mt-4">
					<h4 class="mb-sm-4 mb-3">Add a new Details</h4>
					<form action="payment.html" method="post" class="creditly-card-form agileinfo_form">
						<div class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<div class="first-row">
									<div class="controls form-group">
										<input class="billing-address-name form-control" type="text" name="name" placeholder="Full Name" required="">
									</div>
									<div class="w3_agileits_card_number_grids">
										<div class="w3_agileits_card_number_grid_left form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Mobile Number" name="number" required="">
											</div>
										</div>
										<div class="w3_agileits_card_number_grid_right form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Landmark" name="landmark" required="">
											</div>
										</div>
									</div>
									<div class="controls form-group">
										<input type="text" class="form-control" placeholder="Town/City" name="city" required="">
									</div>
									<div class="controls form-group">
										<select class="option-w3ls">
											<option>Select Address type</option>
											<option>Office</option>
											<option>Home</option>
											<option>Commercial</option>

										</select>
									</div>
								</div>
								<button class="submit check_out btn">Delivery to this Address</button>
							</div>
						</div>
					</form>
					<div class="checkout-right-basket">
						<a href="payment.html"><?php echo MAKE_PAYMENT; ?>
							<span class="far fa-hand-point-right"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div