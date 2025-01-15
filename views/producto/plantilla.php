<div class="col-md-4 product-men mt-5 animation__fade-in-upscale <?php echo (isset($prod->stock) && $prod->stock > 0) ? '' : 'product-sin-stock'; ?>">
    <div class="men-pro-item simpleCart_shelfItem">
        <a href="<?php echo BASE_URL ?>Producto/ficha?grupo_id=<?php echo urlencode($prod->grupo_id); ?>" class="men-thumb-item text-center">
            <?php
            if (is_string($prod->imagenes)) {
                $imagenesArray = json_decode($prod->imagenes, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $imagenesArray = [];
                }
            }
            if (!empty($imagenesArray)) {
                echo '<img src="' . BASE_URL . 'uploads/images/productos/' . $imagenesArray[0] . '">';
            } else {
                echo '<img src="' . BASE_URL . 'uploads/images/default.jpg" alt="Imagen del Producto" class="panel-admin__image-thumbnail">';
            }
            ?>
            <div class="men-cart-pro">
                <div class="inner-men-cart-pro">
                    <a href="<?php echo BASE_URL ?>Producto/ficha?grupo_id=<?php echo urlencode($prod->grupo_id); ?>" class="link-product-add-cart"><?php echo TEXT_QUICK_VIEW; ?></a>
                </div>
            </div>
        </a>
        <div class="item-info-product text-center border-top mt-4">
            <h4 class="pt-1">
                <a href="<?php echo BASE_URL ?>Producto/ficha?grupo_id=<?php echo urlencode($prod->grupo_id); ?>"><?php echo $prod->nombre; ?></a>
            </h4>
            <?php if (!empty($prod->precio)): ?>
                <div class="info-product-price my-2">
                    <?php if (!empty($prod->oferta) && $prod->oferta > 0): ?>
                        <?php
                        // Asegurándonos de que $prod->oferta sea un número válido
                        $descuento = floatval($prod->oferta); // Convertimos a float para asegurar que es numérico
                        $precio_con_descuento = $prod->precio - ($prod->precio * ($descuento / 100)); // Calculamos el precio con descuento
                        ?>
                        <span class="product-new-top badge badge-danger">-<?php echo intval($descuento); ?>%</span>
                        <div class="pricing-details">
                            <span class="item_price text-success font-weight-bold"><?php echo PRICE; ?>: <?php echo round($precio_con_descuento, 2); ?>$</span>
                            <span class="text-muted small"><?php echo BEFORE; ?>: <del><?php echo intval($prod->precio); ?>$</del></span>
                        </div>
                    <?php else: ?>
                        <span class="item_price text-success font-weight-bold"><?php echo PRICE; ?>: <?php echo intval($prod->precio); ?>$</span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="product-rating-plantilla">
                <span class="stars">
                    <?php echo Utils::obtenerEstrellas($prod->grupo_id); ?>
                </span>
            </div>
            <button class="item-btn-favorito <?php echo isset($prod->favorito_id) && $usuario->Id == $prod->usuario_id ? 'favorito-activado' : false; ?>" data-grupo-id="<?php echo $prod->grupo_id; ?>">
                <i class="fas fa-heart"></i> <?php echo TEXT_PRODUCT_SAVE_FAVORITE; ?>
            </button>
            <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                <form action="<?php BASE_URL ?>Producto/checkout" method="post" class="formulario-items-productos">
                    <fieldset>
                        <input type="hidden" name="usuario_id" value="<?php echo isset($_SESSION['usuarioRegistrado']->Id) ? $_SESSION['usuarioRegistrado']->Id : false ?>" />
                        <input type="hidden" name="nombre" value="<?php echo $prod->nombre; ?>" />
                        <input type="hidden" name="precio" value="<?php echo $prod->precio; ?>" />
                        <input type="hidden" name="oferta" value="<?php echo $prod->oferta; ?>" />
                        <input type="hidden" name="grupo_id" value="<?php echo $prod->grupo_id; ?>" />
                        <input type="hidden" name="stock" value="<?php echo $prod->stock; ?>" />
                        <?php if (isset($prod->stock) && $prod->stock > 0): ?>
                            <input type="submit" name="submit" value="<?php echo ADD_TO_CART; ?>" class="button btn" />
                        <?php else: ?>
                            <input value="SIN STOCK" class="button-sin-stock btn" />
                        <?php endif; ?>
                    </fieldset>
                </form>
            </div>

        </div>
    </div>
</div>