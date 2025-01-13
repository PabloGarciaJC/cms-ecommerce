<div class="privacy py-sm-1 py-0">
    <div class="container py-lg-2">
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
            <?php echo CHECKOUT; ?>
        </h3>

        <form method="post" action="<?php echo BASE_URL ?>LineaPedidos/checkoutGuardar" class="form-checkout">
            <div class="checkout-right">
                <div class="table-responsive">
                    <table class="timetable_sub table">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo PRODUCT; ?></th>
                                <th class="text-center"><?php echo PRICE; ?></th>
                                <th class="text-center"><?php echo CANTIDAD; ?></th>
                                <th class="text-center"><?php echo OFERTA; ?></th>
                                <th class="text-center"><?php echo SUBTOTAL; ?></th>
                            </tr>
                        </thead>
                        <tbody id="checkout-table-body">
                            <?php if (!empty($lineasDePedido)) : ?>
                                <?php foreach ($lineasDePedido as $producto) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($producto['linea_pedido_nombre']); ?></td>
                                        <td><?php echo number_format($producto['linea_pedido_precio'], 2); ?>€</td>
                                        <td><?php echo empty($producto['linea_pedido_cantidad']) ? '1' : $producto['linea_pedido_cantidad']; ?></td>
                                        <td>
                                            <?php if ($producto['linea_pedido_oferta'] > 0) : ?>
                                                <span class="oferta"><?php echo number_format($producto['linea_pedido_oferta'], 2); ?>%</span>
                                            <?php else : ?>
                                                <span class="sin-oferta">0.00%</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo empty($producto['linea_pedido_cantidad']) ? number_format($producto['linea_pedido_subtotal'], 2) . '€'  : number_format($producto['linea_pedido_subtotal'], 2) . '€'; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5"><?php echo 'TEXT_NO_PRODUCTS_IN_CART'; ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tr>
                            <td colspan="4" style="text-align: right; font-weight: bold;"><?php echo TEXT_SHIPPING_TOTAL; ?>:</td>
                            <td id="total-price" style="font-weight: bold;">
                                <?php
                                // Calcular el total de la compra
                                $totalPrecio = 0;
                                foreach ($lineasDePedido as $producto) {
                                    $totalPrecio += $producto['linea_pedido_subtotal'];
                                }
                                echo number_format($totalPrecio, 2) . '€';
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="checkout-left">
                <div class="address_form_agile mt-sm-3 mt-0">
                    <h2 class="panel-admin__dashboard-title"><?php echo TEXT_SHIPPING_ADDRESS_SHIPPING; ?></h2>
                    <input type="hidden" name="id" class="form-control" value="<?php echo isset($usuario->Id) ? htmlspecialchars($usuario->Id) : ''; ?>">

                    <div class="form-group">
                        <label><?php echo TEXT_SHIPPING_ADDRESS; ?>:</label>
                        <input type="text" name="direccion" class="form-control" placeholder="<?php echo TEXT_SHIPPING_ADDRESS_USER; ?>" value="<?php echo isset($_SESSION['form']['direccion']) ? htmlspecialchars($_SESSION['form']['direccion']) : (isset($usuario->Direccion) ? htmlspecialchars($usuario->Direccion) : ''); ?>" disabled>
                        <?php if (isset($_SESSION['errores']['direccion'])) : ?>
                            <div class="text-danger mt-2">
                                <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['direccion']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="pais"><?php echo TEXT_SHIPPING_COUNTRY; ?>:</label>
                        <select class="form-control" id="pais" name="pais" disabled>
                            <option value="" disabled selected><?php echo TEXT_SHIPPING_SELECT; ?>...</option>
                            <?php while ($fila = mysqli_fetch_assoc($paisesTodos)) : ?>
                                <option value="<?php echo $fila['Id']; ?>"
                                    <?php echo isset($_SESSION['form']['pais']) ? ($_SESSION['form']['pais'] == $fila['Id'] ? 'selected' : '') : (isset($usuario->Pais) && $usuario->Pais == $fila['Id'] ? 'selected' : ''); ?>>
                                    <?php echo $fila['Pais']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                        <?php if (isset($_SESSION['errores']['pais'])) : ?>
                            <div class="text-danger mt-2">
                                <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['pais']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="ciudad"><?php echo TEXT_SHIPPING_CITY; ?>:</label>
                        <select class="form-control" id="ciudad" name="ciudad" <?php echo empty($usuario->Pais) ? 'disabled' : ''; ?> disabled>
                            <?php if (!empty($usuario->Ciudad)) : ?>
                                <option selected><?php echo htmlspecialchars($usuario->Ciudad); ?></option>
                            <?php else : ?>
                                <option value="" disabled selected><?php echo TEXT_SHIPPING_SELECT; ?>...</option>
                            <?php endif; ?>
                        </select>
                        <?php if (isset($_SESSION['errores']['ciudad'])) : ?>
                            <div class="text-danger mt-2">
                                <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['ciudad']; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="codigoPostal"><?php echo TEXT_SHIPPING_ZIP_CODE; ?>:</label>
                        <input type="text" id="codigoPostal" name="codigoPostal" class="form-control" value="<?php echo isset($_SESSION['form']['codigoPostal']) ? htmlspecialchars($_SESSION['form']['codigoPostal']) : (isset($usuario->CodigoPostal) ? htmlspecialchars($usuario->CodigoPostal) : ''); ?>" disabled>
                        <?php if (isset($_SESSION['errores']['codigoPostal'])) : ?>
                            <div class="text-danger mt-2">
                                <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['codigoPostal']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Mensaje de nota importante -->
            <div class="container contn-info">
                <div class="parrafo-info">
                    <h1 class="text-center title-info">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo TEXT_IMPORTANT_INFO_TITLE; ?>
                    </h1>
                    <p class="text-center"><?php echo TEXT_PAYPAL_TEST_CREDENTIALS; ?></p>
                </div>
            </div>

            <div class="checkout-right-basket">
                <?php if (isset($_SESSION['errores']) && count($_SESSION['errores']) > 0) : ?>
                    <?php if (isset($_SESSION['usuarioRegistrado'])) : ?>
                        <a href="<?php echo BASE_URL ?>Admin/perfil" type="button" target="_blank"><i class="fas fa-user-cog"></i> <?php echo TEXT_SHIPPING_UPDATE_FORM; ?></a>
                    <?php else : ?>
                        <div class="custom-alert-danger" role="alert">
                            <i class="fas fa-exclamation-circle"></i>
                            <div class="custom-alert-checkout">
                                <?php if (isset($_SESSION['errores']['usuarioRegistrado'])) : ?>
                                    <?php echo $_SESSION['errores']['usuarioRegistrado']; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <button type="submit"><?php echo MAKE_PAYMENT; ?></button>
            </div>
        </form>
    </div>
</div>

<?php
unset($_SESSION['errores']);
unset($_SESSION['form']);
unset($_SESSION['exito']);
?>