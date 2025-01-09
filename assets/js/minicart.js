$(document).ready(function () {
    // Cargar los productos guardados en localStorage al inicio
    loadProductsFromLocalStorage();

    // Capturar los valores de los campos hidden para usar en los mensajes
    const noMoreInStockMessage = $('input[name="no-more-in-stock"]').val();
    const btnAceptarText = $('input[name="btn-aceptar"]').val();
    const errorMessageText = $('input[name="mensaje-error"]').val();

    // Mostrar el modal al hacer clic en el botón de submit del formulario (añadir productos al carrito)
    $('.formulario-items-productos').on('submit', function (e) {
        e.preventDefault(); // Evitar el envío del formulario

        // Obtener los valores de los campos hidden del formulario
        const itemName = $(this).find('input[name="item_name"]').val();
        const price = parseFloat($(this).find('input[name="amount"]').val());
        const productId = $(this).find('input[name="producto_id"]').val();
        const stock = parseInt($(this).find('input[name="stock"]').val()); // Obtener el stock del producto
        const offer = parseFloat($(this).find('input[name="discount_amount"]').val()) || 0; // Garantiza que la oferta sea 0 si no está definida

        // Verificar si el producto tiene stock disponible
        if (stock <= 0) {
            // Mostrar mensaje de "sin stock" en el modal
            $('#productModal .modal-cart-content').html(`
            <h3>Producto fuera de stock</h3>
            <p>Lo sentimos, el producto "${itemName}" ya no está disponible.</p>
            <button class="close-modal">Cerrar</button>
        `);
            $('#productModal').fadeIn();
            return; // Salir de la función si no hay stock
        }

        // Revisar si el producto ya está en la tabla
        let existingRow = $(`#product-table tbody tr[data-product-id="${productId}"]`);
        if (existingRow.length > 0) {
            // Incrementar cantidad si ya existe
            let qtyInput = existingRow.find('.product-qty');
            let currentQty = parseInt(qtyInput.val());
            if (currentQty < stock) { // Evitar incrementar más allá del stock
                qtyInput.val(currentQty + 1);
                updateSubtotal(existingRow, price, offer); // Actualizar subtotal
            }
        } else {
            // Crear una nueva fila para el producto con la columna de oferta
            let offerText = offer > 0 ? `-${offer}$` : '0€'; // Si hay una oferta, mostrarla
            let newRow = `
            <tr data-product-id="${productId}">
                <td>${itemName}</td>
                <td class="product-price">${price.toFixed(2)}</td>
                <td class="product-stock">${stock}</td>
                <td class="product-cntn-qty">
                    <button class="btn-decrease">-</button>
                    <input type="number" class="product-qty" value="1" min="1" readonly>
                    <button class="btn-increase">+</button>
                </td>
                <td class="product-offer">${offerText}</td>
                <td class="product-subtotal">${(price - offer).toFixed(2)}</td>
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
    $('#product-table').on('click', '.btn-increase', function () {
        let row = $(this).closest('tr');
        let qtyInput = row.find('.product-qty');
        let price = parseFloat(row.find('.product-price').text());
        let offer = parseFloat(row.find('.product-offer').text().replace('%', '').replace('$', '')) || 0; // Obtener la oferta
        let currentQty = parseInt(qtyInput.val());
        let stock = parseInt(row.find('.product-stock').text()); // Obtener el stock del producto

        // Verificar si la cantidad actual es menor al stock
        if (currentQty < stock) {
            qtyInput.val(currentQty + 1);
            updateSubtotal(row, price, offer); // Actualizar subtotal
            saveProductsToLocalStorage(); // Guardar los cambios
            calculateTotal(); // Recalcular el total
        } else {
            // Mostrar mensaje de error con Swal
            Swal.fire({
                title: `${errorMessageText}`,
                icon: 'error',
                html: `${noMoreInStockMessage}`,
                confirmButtonText: `${btnAceptarText}`
            });
        }
    });

    // Decrementar cantidad
    $('#product-table').on('click', '.btn-decrease', function () {
        let row = $(this).closest('tr');
        let qtyInput = row.find('.product-qty');
        let price = parseFloat(row.find('.product-price').text());
        let offer = parseFloat(row.find('.product-offer').text().replace('%', '').replace('$', '')) || 0; // Obtener la oferta
        let currentQty = parseInt(qtyInput.val());
        if (currentQty > 1) {
            qtyInput.val(currentQty - 1);
            updateSubtotal(row, price, offer); // Actualizar subtotal
            saveProductsToLocalStorage(); // Guardar los cambios
            calculateTotal(); // Recalcular el total
        }
    });

    // Eliminar producto
    $('#product-table').on('click', '.btn-remove', function () {
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
    $('.close').on('click', function () {
        $('#productModal').fadeOut();
    });

    $(window).on('click', function (e) {
        if ($(e.target).is('#productModal')) {
            $('#productModal').fadeOut();
        }
    });

    // Actualizar subtotal de una fila
    function updateSubtotal(row, price, offer) {
        let qty = parseInt(row.find('.product-qty').val());
        let subtotal = qty * price * (1 - offer / 100); // Aplicar descuento si existe
        row.find('.product-subtotal').text(subtotal.toFixed(2));
    }

    // Calcular el total de la tabla y mostrar mensaje si está vacío
    function calculateTotal() {
        let total = 0;
        $('#product-table tbody tr').each(function () {
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
        $('#product-table tbody tr').each(function () {
            let productId = $(this).data('product-id');
            let itemName = $(this).find('td').eq(0).text();
            let price = parseFloat($(this).find('.product-price').text());
            let quantity = parseInt($(this).find('.product-qty').val());
            let stock = parseInt($(this).find('.product-stock').text()); // Guardar stock
            let offer = parseFloat($(this).find('.product-offer').text().replace('%', '').replace('$', '')) || 0; // Guardar oferta aquí
            products.push({
                productId,
                itemName,
                price,
                quantity,
                stock,
                offer // Guardar oferta aquí
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
        $('#product-table tbody').empty(); // Limpiar la tabla antes de cargar productos
        if (products && products.length > 0) {
            products.forEach(product => {
                let offerText = product.offer ? `${product.offer}$` : '0€'; // Mostrar oferta si existe
                let newRow = `
                <tr data-product-id="${product.productId}">
                    <td>${product.itemName}</td>
                    <td class="product-price">${product.price.toFixed(2)}</td>
                    <td class="product-stock">${product.stock}</td>
                    <td class="product-cntn-qty">
                        <button class="btn-decrease">-</button>
                        <input type="number" class="product-qty" value="${product.quantity}" min="1" readonly>
                        <button class="btn-increase">+</button>
                    </td>
                    <td class="product-offer">${offerText}</td>
                    <td class="product-subtotal">${(product.quantity * product.price * (1 - product.offer / 100)).toFixed(2)}</td>
                    <td><button class="btn-remove">X</button></td>
                </tr>
            `;
                $('#product-table tbody').append(newRow);
            });
            calculateTotal(); // Recalcular el total después de cargar los productos
        } else {
            $('#empty-cart-message').show(); // Mostrar mensaje si el carrito está vacío
        }
    }

    // Mostrar el carrito al hacer clic en el ícono del carrito
    $('.w3view-cart').on('click', function (e) {
        e.preventDefault(); // Evitar el comportamiento de submit del formulario
        loadProductsFromLocalStorage(); // Asegúrate de cargar los productos más recientes
        $('#productModal').fadeIn(); // Mostrar el modal
    });

    // Cerrar el modal cuando se presiona el botón "Cerrar"
    $(document).on('click', '.close-modal', function () {
        $('#productModal').fadeOut();
    });
});