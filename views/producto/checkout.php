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

        <?php if (isset($_SESSION['exito'])) : ?>
            <div class="alert <?php echo $_SESSION['messageClass']; ?> alert-dismissible fade show mt-2 text-center" role="alert">
                <i class="<?php echo isset($_SESSION['icon']) ? $_SESSION['icon'] : 'fas fa-check-circle'; ?>"></i>
                <?php echo $_SESSION['exito']; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php unset($_SESSION['exito'], $_SESSION['messageClass'], $_SESSION['icon']); ?>
        <?php endif; ?>

        <form method="post" action="<?php echo BASE_URL ?>Producto/checkoutGuardar" class="form-checkout">
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
                                        <td class="invert-image invert-img-table">
                                            <a href="<?php echo $item['href']; ?>">
                                                <img src="<?php echo $item['image']; ?>" alt=" " class="img-responsive">
                                            </a>
                                        </td>
                                        <td class="invert">
                                            <div class="quantity">
                                                <div class="quantity-select">
                                                    <div class="entry value">
                                                        <span><?php echo $item['quantity']; ?></span>
                                                    </div>
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
            <div class="checkout-left">
                <div class="address_form_agile mt-sm-3 mt-0">
                    <h2 class="panel-admin__dashboard-title">Dirección del Envio</h2>
                    <input type="hidden" name="id" class="form-control" value="<?php echo isset($usuario->Id) ? htmlspecialchars($usuario->Id) : ''; ?>">
                    <div class="form-group">
                        <label>Dirección:</label>
                        <input type="text" name="direccion" class="form-control" placeholder="Dirección del usuario" value="<?php echo isset($_SESSION['form']['direccion']) ? htmlspecialchars($_SESSION['form']['direccion']) : (isset($usuario->Direccion) ? htmlspecialchars($usuario->Direccion) : ''); ?>" disabled>
                        <?php if (isset($_SESSION['errores']['direccion'])) : ?>
                            <div class="text-danger mt-2">
                                <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['direccion']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="pais">País:</label>
                        <select class="form-control" id="pais" name="pais" disabled>
                            <option value="" disabled selected>Seleccione...</option>
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
                        <label for="ciudad">Ciudad/Región:</label>
                        <select class="form-control" id="ciudad" name="ciudad" <?php echo empty($usuario->Pais) ? 'disabled' : ''; ?> disabled>
                            <?php if (!empty($usuario->Ciudad)) : ?>
                                <option selected><?php echo htmlspecialchars($usuario->Ciudad); ?></option>
                            <?php else : ?>
                                <option value="" disabled selected>Seleccione...</option>
                            <?php endif; ?>
                        </select>
                        <?php if (isset($_SESSION['errores']['ciudad'])) : ?>
                            <div class="text-danger mt-2">
                                <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['ciudad']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="codigoPostal">Código Postal:</label>
                        <input type="text" id="codigoPostal" name="codigoPostal" class="form-control" value="<?php echo isset($_SESSION['form']['codigoPostal']) ? htmlspecialchars($_SESSION['form']['codigoPostal']) : (isset($usuario->CodigoPostal) ? htmlspecialchars($usuario->CodigoPostal) : ''); ?>" disabled>
                        <?php if (isset($_SESSION['errores']['codigoPostal'])) : ?>
                            <div class="text-danger mt-2">
                                <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['codigoPostal']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
            $usuarioId = isset($usuario->Id) ? $usuario->Id : '';
            $pais = isset($usuario->Pais) ? $usuario->Pais : '';
            $ciudad = isset($usuario->Ciudad) ? $usuario->Ciudad : '';
            $direccion = isset($usuario->Direccion) ? $usuario->Direccion : '';
            $codigoPostal = isset($usuario->CodigoPostal) ? $usuario->CodigoPostal : '';
            ?>
            <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($usuarioId); ?>" />
            <input type="hidden" name="pais" value="<?php echo htmlspecialchars($pais); ?>" />
            <input type="hidden" name="ciudad" value="<?php echo htmlspecialchars($ciudad); ?>" />
            <input type="hidden" name="direccion" value="<?php echo htmlspecialchars($direccion); ?>" />
            <input type="hidden" name="codigoPostal" value="<?php echo htmlspecialchars($codigoPostal); ?>" />
            <input type="hidden" id="text_oferta" value="<?php echo htmlspecialchars(OFERTA); ?>" />
            <input type="hidden" id="text_subtotal" value="<?php echo htmlspecialchars(SUBTOTAL); ?>" />
            <input type="hidden" id="text_realizar_pedido" value="<?php echo htmlspecialchars(REALIZAR_PEDIDO); ?>" />
            <div class="checkout-right-basket">
                <button type="submit"><?php echo MAKE_PAYMENT; ?></button>
                <?php if (isset($_SESSION['errores']) && count($_SESSION['errores']) > 0) : ?>
                    <a href="<?php echo BASE_URL ?>Admin/perfil" type="button" target="_blank">Actualizar Formulario</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>