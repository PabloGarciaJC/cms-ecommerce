<script src="<?= BASE_URL ?>assets/js/custom/config.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/jquery-2.2.3.min.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/jquery.flexslider.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/jquery.magnific-popup.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/bootstrap.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/creditly.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/creditly2.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/easing.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/easyResponsiveTabs.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/imagezoom.js"></script>
<link href="<?php echo BASE_URL ?>assets/css/flexslider.css" rel="stylesheet" type="text/css" media="all" />
<script src="<?php echo BASE_URL ?>assets/js/minicart.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/move-top.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/scroll.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/SmoothScroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="<?= BASE_URL ?>assets/js/template.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= BASE_URL ?>assets/js/custom/app.js"></script>
<script src="<?= BASE_URL ?>assets/js/custom/usuario.js"></script>
<script src="<?= BASE_URL ?>assets/js/custom/roles.js"></script>
<script src="<?= BASE_URL ?>assets/js/custom/comentario.js"></script>
<script src="<?= BASE_URL ?>assets/js/custom/favorito.js"></script>


<script>
    $(document).ready(function() {
        // Cargar los productos guardados en el localStorage al inicio
        loadProductsFromLocalStorage();

        // Mostrar el modal al hacer clic en el botón de submit del formulario
        $('.formulario-items-productos').on('submit', function(e) {
            e.preventDefault(); // Evitar el envío del formulario

            // Obtener los valores de los campos hidden del formulario
            const itemName = $(this).find('input[name="item_name"]').val();
            const price = parseFloat($(this).find('input[name="amount"]').val());
            const productId = $(this).find('input[name="producto_id"]').val();

            // Revisar si el producto ya está en la tabla
            let existingRow = $(`#product-table tbody tr[data-product-id="${productId}"]`);
            if (existingRow.length > 0) {
                // Incrementar cantidad si ya existe
                let qtyInput = existingRow.find('.product-qty');
                let currentQty = parseInt(qtyInput.val());
                qtyInput.val(currentQty + 1);
                updateSubtotal(existingRow, price); // Actualizar subtotal
            } else {
                // Crear una nueva fila para el producto
                let newRow = ` 
            <tr data-product-id="${productId}">
                <td>${itemName}</td>
                <td class="product-price">${price.toFixed(2)}</td>
                <td class="product-cntn-qty">
                    <button class="btn-decrease">-</button>
                    <input type="number" class="product-qty" value="1" min="1" readonly>
                    <button class="btn-increase">+</button>
                </td>
                <td class="product-subtotal">${price.toFixed(2)}</td>
                <td><button class="btn-remove">X</button></td>
            </tr>
        `;
                $('#product-table tbody').append(newRow);
            }

            // Guardar el carrito en localStorage
            saveProductsToLocalStorage();

            // Recalcular el total
            calculateTotal();

            // Mostrar el modal
            $('#productModal').fadeIn();
        });

        // Incrementar cantidad
        $('#product-table').on('click', '.btn-increase', function() {
            let row = $(this).closest('tr');
            let qtyInput = row.find('.product-qty');
            let price = parseFloat(row.find('.product-price').text());
            let currentQty = parseInt(qtyInput.val());
            qtyInput.val(currentQty + 1);
            updateSubtotal(row, price);
            saveProductsToLocalStorage(); // Guardar los cambios
            calculateTotal(); // Recalcular el total
        });

        // Decrementar cantidad
        $('#product-table').on('click', '.btn-decrease', function() {
            let row = $(this).closest('tr');
            let qtyInput = row.find('.product-qty');
            let price = parseFloat(row.find('.product-price').text());
            let currentQty = parseInt(qtyInput.val());
            if (currentQty > 1) {
                qtyInput.val(currentQty - 1);
                updateSubtotal(row, price);
                saveProductsToLocalStorage(); // Guardar los cambios
                calculateTotal(); // Recalcular el total
            }
        });

        // Eliminar producto
        $('#product-table').on('click', '.btn-remove', function() {
            let row = $(this).closest('tr');
            let productId = row.data('product-id');

            // Eliminar el producto de la tabla
            row.remove();

            // Eliminar el producto del localStorage
            removeProductFromLocalStorage(productId);

            // Recalcular el total
            calculateTotal(); // Recalcular el total
        });

        // Función para cerrar el modal
        $('.close').on('click', function() {
            $('#productModal').fadeOut();
        });

        $(window).on('click', function(e) {
            if ($(e.target).is('#productModal')) {
                $('#productModal').fadeOut();
            }
        });

        // Actualizar subtotal de una fila
        function updateSubtotal(row, price) {
            let qty = parseInt(row.find('.product-qty').val());
            let subtotal = qty * price;
            row.find('.product-subtotal').text(subtotal.toFixed(2));
        }

        // Calcular el total de la tabla y mostrar mensaje si está vacío
        function calculateTotal() {
            let total = 0;
            $('#product-table tbody tr').each(function() {
                let subtotal = parseFloat($(this).find('.product-subtotal').text());
                total += subtotal;
            });
            $('#cart-total').text(total.toFixed(2)); // Actualizar el total en la tabla

            // Verificar si hay productos en el carrito
            if ($('#product-table tbody tr').length === 0) {
                $('#empty-cart-message').show(); // Mostrar el mensaje si no hay productos
            } else {
                $('#empty-cart-message').hide(); // Ocultar el mensaje si hay productos
            }
        }

        // Guardar los productos en localStorage
        function saveProductsToLocalStorage() {
            let products = [];
            $('#product-table tbody tr').each(function() {
                let productId = $(this).data('product-id');
                let itemName = $(this).find('td').eq(0).text();
                let price = parseFloat($(this).find('.product-price').text());
                let quantity = parseInt($(this).find('.product-qty').val());
                products.push({
                    productId,
                    itemName,
                    price,
                    quantity
                });
            });
            localStorage.setItem('cart', JSON.stringify(products));
        }

        // Eliminar un producto de localStorage
        function removeProductFromLocalStorage(productId) {
            let products = JSON.parse(localStorage.getItem('cart')) || [];
            // Filtrar el producto a eliminar
            products = products.filter(product => product.productId !== productId);
            // Guardar los productos actualizados en localStorage
            localStorage.setItem('cart', JSON.stringify(products));
        }

        // Cargar los productos desde localStorage
        function loadProductsFromLocalStorage() {
            let products = JSON.parse(localStorage.getItem('cart'));
            if (products && products.length > 0) {
                products.forEach(product => {
                    let newRow = `
                <tr data-product-id="${product.productId}">
                    <td>${product.itemName}</td>
                    <td class="product-price">${product.price.toFixed(2)}</td>
                    <td class="product-cntn-qty">
                        <button class="btn-decrease">-</button>
                        <input type="number" class="product-qty" value="${product.quantity}" min="1" readonly>
                        <button class="btn-increase">+</button>
                    </td>
                    <td class="product-subtotal">${(product.quantity * product.price).toFixed(2)}</td>
                    <td><button class="btn-remove">X</button></td>
                </tr>
                `;
                    $('#product-table tbody').append(newRow);
                });
                calculateTotal(); // Recalcular el total después de cargar los productos
            }
        }
    });
</script>




<!-- Spinner centrado en la pantalla -->
<div id="spinner" class="spinner"></div>