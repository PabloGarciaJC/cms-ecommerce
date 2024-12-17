<?php if ($productos && $productos->num_rows > 0): ?>
    <?php while ($prod = $productos->fetch_object()): ?>
        <div class="col-md-4 product-men mt-5">
            <div class="men-pro-item simpleCart_shelfItem">
                <div class="men-thumb-item text-center">
                    <?php
                    $imagenes = trim($prod->imagenes, '"');
                    $imagenes_array = json_decode($imagenes);
                    ?>
                    <img src="<?php echo BASE_URL ?>uploads/images/productos/<?php echo $imagenes_array[0]; ?>">
                    <div class="men-cart-pro">
                        <div class="inner-men-cart-pro">
                            <a href="<?php echo BASE_URL ?>Producto/ficha?id=<?php echo $prod->id; ?>" class="link-product-add-cart"><?php echo TEXT_QUICK_VIEW; ?></a>
                        </div>
                    </div>
                </div>
                <div class="item-info-product text-center border-top mt-4">
                    <h4 class="pt-1">
                        <a href="<?php echo BASE_URL ?>Producto/ficha?id=<?php echo $prod->id; ?>"><?php echo $prod->nombre; ?></a>
                    </h4>
                    <?php if (!empty($prod->precio)): ?>
                        <div class="info-product-price my-2">
                            <?php if (!empty($prod->oferta) && $prod->oferta > 0): ?>
                                <span class="product-new-top"><?php echo TEXT_OFERTA . ' ' . intval($prod->oferta) . '$'; ?></span>
                            <?php endif; ?>
                            <?php
                            if (!empty($prod->oferta) && $prod->oferta > 0) {
                                $precio_con_descuento = $prod->precio - $prod->oferta;
                                echo '<span class="item_price">' . intval($prod->precio - $prod->oferta) . '$</span>';
                                echo '<del>' . intval($prod->precio) . '$</del>';
                            } else {
                                echo '<span class="item_price">' . intval($prod->precio) . '$</span>';
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                    <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                        <form action="#" method="post">
                            <fieldset>
                                <input type="hidden" id="text_oferta" value="<?php echo OFERTA; ?>" />
                                <input type="hidden" id="text_subtotal" value="<?php echo SUBTOTAL; ?>" />
                                <input type="hidden" id="text_realizar_pedido" value="<?php echo REALIZAR_PEDIDO; ?>" />
                                <input type="hidden" name="cmd" value="_cart" />
                                <input type="hidden" name="add" value="1" />
                                <input type="hidden" name="business" value="" />
                                <input type="hidden" name="item_name" value="<?php echo $prod->nombre; ?>" />
                                <input type="hidden" name="amount" value="<?php echo $prod->precio; ?>" />
                                <input type="hidden" name="discount_amount" value="<?php echo $prod->oferta; ?>" />
                                <input type="hidden" name="currency_code" value="USD" />
                                <input type="hidden" name="return" value="" />
                                <input type="hidden" name="cancel_return" value=" " />
                                <input type="submit" name="submit" value="<?php echo ADD_TO_CART; ?>" class="button btn" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>