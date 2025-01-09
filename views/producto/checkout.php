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

<style>

</style>

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

            <div class="container contn-info">
                <div class="parrafo-info">
                    <h1 class="text-center title-info"> <i class="fas fa-exclamation-circle"></i><?php echo TEXT_IMPORTANT_INFO_TITLE; ?></h1>
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
                <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($usuarioId); ?>" />
                <input type="hidden" value="<?php echo EMPTY_CART_MESSAGE ?>" name="no-more-in-stock" class="no-more-in-stock">
                <input type="hidden" value="<?php echo TEXT_MODAL_ACCEPT_BUTTON ?>" name="btn-aceptar" class="btn-aceptar">
                <input type="hidden" value="<?php echo ERROR_MESSAGE ?>" name="mensaje-error" class="mensaje-error">
                <button type="submit"><?php echo MAKE_PAYMENT; ?></button>

            </div>


        </form>
    </div>
</div>