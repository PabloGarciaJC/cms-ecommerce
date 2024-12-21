<div class="services-breadcrumb">
	<div class="agile_inner_breadcrumb">
		<div class="container">
			<ul class="w3_short">
				<li>
					<a href="<?= BASE_URL ?>"><?php echo TEXT_INICIO; ?></a>
					<i>|</i>
				</li>
				<li><?php echo TEXT_CHECKOUT; ?></li>
			</ul>
		</div>
	</div>
</div>

<div class="privacy py-sm-1 py-0">
	<div class="container py-lg-2">
		<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
			<?php echo CHECKOUT; ?>
		</h3>
		<form method="post" action="<?php echo BASE_URL ?>Producto/checkoutGuardar">
			<div class="checkout-right">
				<div class="table-responsive">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th><?php echo SL_NO; ?></th>
								<th><?php echo PRODUCT; ?></th>
								<th><?php echo QUALITY; ?></th>
								<th><?php echo PRODUCT_NAME; ?></th>
								<th><?php echo PRICE; ?></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$items = $_SESSION['productoLista'] ?? [];
							if (empty($items)) {
								echo '<tr><td colspan="5">No hay productos</td></tr>';
							} else {
								$total = 0;
								foreach ($items as $index => $item) {
									$total += $item['price'] * $item['quantity']; ?>
									<tr class="rem<?php echo $index + 1; ?>">
										<td class="invert"><?php echo $index + 1; ?></td>
										<td class="invert-image">
											<a href="<?php echo $item['href']; ?>">
												<img src="<?php echo $item['image']; ?>" alt=" " class="img-responsive">
											</a>
										</td>
										<td class="invert">
											<div class="quantity">
												<div class="quantity-select">
													<!-- <div class="entry value-minus">&nbsp;</div> -->
													<div class="entry value">
														<span><?php echo $item['quantity']; ?></span>
													</div>
													<!-- <div class="entry value-plus active">&nbsp;</div> -->
												</div>
											</div>
										</td>
										<td class="invert"><?php echo $item['name']; ?></td>
										<td class="invert">$<?php echo number_format($item['price'], 2); ?></td>
										<input type="hidden" name="productos[<?php echo $index; ?>][producto_id]" value="<?php echo $item['producto_id']; ?>" />
										<input type="hidden" name="productos[<?php echo $index; ?>][quantity]" value="<?php echo $item['quantity']; ?>" />
									</tr>
							<?php
								}
							}
							?>
							<!-- Campos ocultos para datos del usuario -->
							<input type="hidden" name="usuario_id" value="<?php echo $usuario->Id; ?>" />
							<input type="hidden" name="pais" value="<?php echo $usuario->Pais; ?>" />
							<input type="hidden" name="ciudad" value="<?php echo $usuario->Ciudad; ?>" />
							<input type="hidden" name="direccion" value="<?php echo $usuario->Direccion; ?>" />
							<input type="hidden" name="codigoPostal" value="<?php echo $usuario->CodigoPostal; ?>" />
							<input type="hidden" id="text_oferta" value="<?php echo OFERTA; ?>" />
							<input type="hidden" id="text_subtotal" value="<?php echo SUBTOTAL; ?>" />
							<input type="hidden" id="text_realizar_pedido" value="<?php echo REALIZAR_PEDIDO; ?>" />
						</tbody>
						<tfoot>
							<tr>
								<td colspan="4" style="text-align: right;"><strong>Total:</strong></td>
								<td>$<?php echo isset($total) ? number_format($total, 2) : '0.00'; ?></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>



			<div class="checkout-right-basket">
				<button type="submit"><?php echo MAKE_PAYMENT; ?></button>
			</div>

		</form>
	</div>
</div>