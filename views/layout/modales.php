<!-- inicar sesión -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center"><?php echo TEXT_MODAL_LOGIN_TITLE; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="mb-3 contn-info">
                    <div class="parrafo-info">
                        <h1 class="text-center title-info"><i class="fas fa-exclamation-circle"></i> <?php echo TEXT_IMPORTANT_INFO_TITLE; ?></h1>
                        <p><?php echo TEXT_IMPORTANT_INFO_DESC; ?></p>
                    </div>
                    <div class="row text-center">
                        <div class="col">
                            <div class="card user-card bg-light p-2" data-email="admin@pablogarciajc.com" data-password="password">
                                <p class="mb-0 user-card-parrafo"><strong><?php echo TEXT_ADMINISTRATOR; ?></strong><br><?php echo TEXT_ADMIN_EMAIL; ?></p>
                                <p class="text-center mt-2">
                                    <a href="#" class="select-action"><?php echo TEXT_SELECT_HERE; ?></a>
                                </p>
                            </div>
                        </div>
                        <div class="col mt-3">
                            <div class="card user-card bg-light p-2" data-email="sofia.martinez@pablogarciajc.com" data-password="password">
                                <p class="mb-0 user-card-parrafo"><strong><?php echo TEXT_TEST_CLIENT; ?></strong><br><?php echo TEXT_TEST_CLIENT_EMAIL; ?></p>
                                <p class="text-center mt-2">
                                    <a href="#" class="select-action"><?php echo TEXT_SELECT_HERE; ?></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="<?php echo BASE_URL; ?>Usuario/IniciarSesion" class="formulario-iniciar-sesion" method="POST">
                    <div class="form-group">
                        <label class="col-form-label"><?php echo TEXT_MODAL_EMAIL_LABEL; ?></label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label"><?php echo TEXT_MODAL_PASSWORD_LABEL; ?></label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="right-w3l">
                        <input type="submit" class="form-control" value="<?php echo TEXT_MODAL_CONTINUE_BUTTON; ?>">
                    </div>
                    <p class="text-center dont-do mt-3"><?php echo TEXT_MODAL_NO_ACCOUNT; ?>
                        <a href="#" data-toggle="modal" data-target="#exampleModal2"><?php echo TEXT_MODAL_REGISTER_NOW; ?></a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- register -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo TEXT_MODAL_REGISTER_TITLE; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo BASE_URL; ?>Usuario/registro" method="POST" class="formulario-registro">
                    <div class="form-group">
                        <label class="col-form-label "><?php echo TEXT_MODAL_ALIAS_LABEL; ?></label>
                        <input type="text" class="form-control" name="usuario">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label"><?php echo TEXT_MODAL_EMAIL_LABEL_REGISTER; ?></label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label "><?php echo TEXT_MODAL_PASSWORD_LABEL_REGISTER; ?></label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label "><?php echo TEXT_MODAL_CONFIRM_PASSWORD_LABEL; ?></label>
                        <input type="password" class="form-control" name="confirmarPassword">
                    </div>
                    <div class="sub-w3l">
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="mdCheckedRegistro" name="checked">
                            <label class="custom-control-label" for="mdCheckedRegistro"><?php echo TEXT_MODAL_TERMS_LABEL; ?></label>
                        </div>
                    </div>
                    <div class="right-w3l">
                        <input type="submit" class="form-control" value="<?php echo TEXT_MODAL_ACCEPT_BUTTON; ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Carrtio de Compras -->
<div id="productModal" class="modal" style="display: none;">
    <div class="modal-cart-content">
        <span class="close">&times;</span>
        <h3><?php echo CART_MODAL_TITLE; ?></h3>
        <table id="product-table">
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
            <tbody>
                <!-- Las filas se agregarán dinámicamente aquí -->
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="total-label"><?php echo TEXT_SHIPPING_TOTAL; ?>:</td>
                    <td id="cart-total" class="total-amount">0.00</td>
                </tr>
            </tfoot>
        </table>
        <p id="empty-cart-message" style="display: none; text-align: center; font-size: 18px; color: #777;">
            <?php echo EMPTY_CART_MESSAGE; ?>
        </p>
        <form id="cart-form" action="<?php echo BASE_URL ?>LineaPedidos/checkout" method="POST">
            <input type="hidden" name="productos" id="productos">
            <input type="hidden" name="total" id="total">
            <input type="hidden" value="<?php echo EMPTY_CART_MESSAGE ?>" name="no-more-in-stock" class="no-more-in-stock">
            <input type="hidden" value="<?php echo TEXT_MODAL_ACCEPT_BUTTON ?>" name="btn-aceptar" class="btn-aceptar">
            <input type="hidden" value="<?php echo ERROR_MESSAGE ?>" name="mensaje-error" class="mensaje-error">
            <div style="text-align: center;">
                <button type="submit" id="btn-realizar-pedido" class="btn-realizar-pedido">
                    <i class="fas fa-shopping-cart"></i> <?php echo REALIZAR_PEDIDO; ?>
                </button>
            </div>
        </form>
    </div>
</div>