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

        <form method="post" action="<?php echo BASE_URL ?>Producto/checkoutGuardar" class="form-checkout">
            <div class="checkout-right">
                <div class="table-responsive">
                    <table class="timetable_sub">
                        <thead>
                            <tr>
                                <th><?php echo PRODUCT; ?></th>
                                <th><?php echo PRICE; ?></th>
                                <th><?php echo STOCK; ?></th>
                                <th><?php echo CANTIDAD; ?></th>
                                <th><?php echo OFERTA; ?></th>
                                <th><?php echo SUBTOTAL; ?></th>
                                <th><?php echo ACCION; ?></th>
                            </tr>
                        </thead>
                        <tbody id="checkout-table-body">
                            <!-- Los productos se agregarán aquí por JavaScript -->
                        </tbody>
                        <tr>
                            <td colspan="5" style="text-align: right;"><?php echo TEXT_SHIPPING_TOTAL; ?>:</td>
                            <td id="total-price">0.00</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="checkout-left">
                <div class="address_form_agile mt-sm-3 mt-0">
                    <h2 class="panel-admin__dashboard-title"><?php echo TEXT_SHIPPING_ADDRESS_SHIPPING; ?></h2>
                    <input type="hidden" name="id" class="form-control" value="<?php echo isset($usuario->Id) ? htmlspecialchars($usuario->Id) : ''; ?>">
                    <!-- Formulario de dirección de envío (se mantiene igual) -->
                </div>
            </div>

            <div class="container contn-info">
                <div class="parrafo-info">
                    <h1 class="text-center title-info"> <i class="fas fa-exclamation-circle"></i><?php echo TEXT_IMPORTANT_INFO_TITLE; ?></h1>
                    <p class="text-center"><?php echo TEXT_PAYPAL_TEST_CREDENTIALS; ?></p>
                </div>
            </div>
            <div class="checkout-right-basket">
                <input type="hidden" value="<?php echo EMPTY_CART_MESSAGE ?>" name="no-more-in-stock" class="no-more-in-stock">
                <input type="hidden" value="<?php echo TEXT_MODAL_ACCEPT_BUTTON ?>" name="btn-aceptar" class="btn-aceptar">
                <input type="hidden" value="<?php echo ERROR_MESSAGE ?>" name="mensaje-error" class="mensaje-error">
                <button type="submit"><?php echo MAKE_PAYMENT; ?></button>
            </div>
        </form>
    </div>
</div>