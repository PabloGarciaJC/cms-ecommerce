class LineaPedido {

    onReady() {
        this.customLineaPedido();
    }

    modal() {

        // Capturar los valores de los campos hidden para usar en los mensajes
        let noMoreInStockMessage = $('input[name="no-more-in-stock"]').val();
        let btnAceptarText = $('input[name="btn-aceptar"]').val();
        let errorMessageText = $('input[name="mensaje-error"]').val();
        let usuarioId = $('input[name="usuario_id"]').val();

        // Desde el icono del Search General
        $('.formulario-icono-productos').on('submit', function (e) {
            e.preventDefault();

            let formData = $(this).serialize();

            // Primera solicitud: Asegura que el usuario Exista
            $.ajax({
                type: "POST",
                url: baseUrl + 'LineaPedidos/validarUsuario',
                data: formData,
                success: function (response) {
                    try {
                        const data = JSON.parse(response);
                        if (!data.success) {
                            Swal.fire({
                                title: data.message,
                                icon: "info",
                                confirmButtonText: data.boton
                            });
                        }
                    } catch (error) {
                        false;
                    }
                }
            });

            // Segunda solicitud: Obtener productos para mostrar en el modal
            $.ajax({
                type: "POST",
                url: baseUrl + 'LineaPedidos/obtenerProductos',
                data: formData,
                success: function (response) {
                    try {
                        let data = JSON.parse(response);
                        $('#product-table tbody').empty();
                        data.forEach(product => {
                            let price = parseFloat(product.linea_pedido_precio);
                            if (isNaN(price)) {
                                price = 0;
                            }
                            let subtotal = price;
                            let newRow = `
                                <tr>
                                    <td>${product.linea_pedido_nombre}</td>
                                    <td class="product-price">${price.toFixed(2)}€</td>
                                    <td class="product-stock">${product.producto_stock}</td>
                                    <td class="product-cntn-qty">
                                        <button class="btn-decrease">-</button>
                                        <input type="number" class="product-qty" value="${product.linea_pedido_cantidad ? product.linea_pedido_cantidad : 1}" min="1" readonly>
                                        <input type="hidden" class="product-grupo-id" value="${product.linea_pedido_grupo_id}">
                                        <button class="btn-increase">+</button>
                                    </td>
                                    <td class="product-offer">${product.linea_pedido_oferta || 'N/A'}</td>
                                    <td class="product-subtotal">${subtotal.toFixed(2)}€</td>
                                    <td><button class="btn-remove">X</button></td>
                                </tr>`;
                            $('#product-table tbody').append(newRow);
                        });
                        calculateTotal(); // Recalcular el total general
                    } catch (error) {
                        false;
                    }
                }
            });

            $('#productModal').fadeIn();
           
        });

        // Desde el Formulario de los Items del Listado del Productos
        $('.formulario-items-productos').on('submit', function (e) {
            e.preventDefault();
            let formData = $(this).serialize();

            // Primera solicitud: Asegura que los productos se agreguen al carrito
            $.ajax({
                type: "POST",
                url: baseUrl + 'LineaPedidos/incluir',
                data: formData,
                success: function (response) {
                    const data = JSON.parse(response);

                    if (data.success) {
                        Swal.fire({
                            title: data.titulo,
                            icon: "success",
                            showConfirmButton: false,
                            confirmButtonText: data.boton,
                            timer: 850
                        });
                    } else {
                        Swal.fire({
                            title: data.message,
                            icon: "info",
                            confirmButtonText: data.boton
                        });
                    }

                    // Segunda solicitud: Obtener productos para mostrar en el modal
                    $.ajax({
                        type: "POST",
                        url: baseUrl + 'LineaPedidos/obtenerProductos',
                        data: formData,
                        success: function (response) {
                            try {
                                let data = JSON.parse(response);
                                $('#product-table tbody').empty();
                                data.forEach(product => {
                                    let price = parseFloat(product.linea_pedido_precio);
                                    if (isNaN(price)) {
                                        price = 0;
                                    }
                                    let subtotal = price;
                                    let newRow = `
                                        <tr>
                                            <td>${product.linea_pedido_nombre}</td>
                                            <td class="product-price">${price.toFixed(2)}€</td>
                                            <td class="product-stock">${product.producto_stock}</td>
                                            <td class="product-cntn-qty">
                                                <button class="btn-decrease">-</button>
                                                <input type="number" class="product-qty" value="${product.linea_pedido_cantidad ? product.linea_pedido_cantidad : 1}" min="1" readonly>
                                                <input type="hidden" class="product-grupo-id" value="${product.linea_pedido_grupo_id}">
                                                <button class="btn-increase">+</button>
                                            </td>
                                            <td class="product-offer">${product.linea_pedido_oferta || 'N/A'}</td>
                                            <td class="product-subtotal">${subtotal.toFixed(2)}€</td>
                                            <td><button class="btn-remove">X</button></td>
                                        </tr>`;
                                    $('#product-table tbody').append(newRow);
                                });
                                calculateTotal(); // Recalcular el total general
                            } catch (error) {
                                false;
                            }
                        }
                    });
                }
            });
            // Verifica si Existe usuario Logeado
            if (usuarioId) {
                $('#productModal').fadeIn();
            }
        });


        // Incrementar cantidad
        $('#product-table').on('click', '.btn-increase', function () {
            let row = $(this).closest('tr');
            let qtyInput = row.find('.product-qty');
            let price = parseFloat(row.find('.product-price').text().replace('€', '').trim());
            let offer = parseFloat(row.find('.product-offer').text().replace('%', '').trim()) || 0;
            let currentQty = parseInt(qtyInput.val());
            let stock = parseInt(row.find('.product-stock').text());
            let grupoIdInput = row.find('.product-grupo-id').val();

            // Verificar si la cantidad actual es menor al stock
            if (currentQty < stock) {
                currentQty++;  // Incrementar la cantidad
                qtyInput.val(currentQty); // Actualizar el input de cantidad
                updateSubtotal(row, price, offer, currentQty, grupoIdInput); // Actualizar subtotal
            } else {
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
            let price = parseFloat(row.find('.product-price').text().replace('€', '').trim());
            let offer = parseFloat(row.find('.product-offer').text().replace('%', '').trim()) || 0;
            let currentQty = parseInt(qtyInput.val());
            let grupoIdInput = row.find('.product-grupo-id').val();

            if (currentQty > 1) {
                currentQty--; // Decrementar la cantidad
                qtyInput.val(currentQty); // Actualizar el input de cantidad
                updateSubtotal(row, price, offer, currentQty, grupoIdInput); // Actualizar subtotal
            }
        });

        // Actualiza el subtotal de un producto
        function updateSubtotal(row, price, offer, qty, grupoIdInput) {
            let discount = (price * (offer / 100)) || 0;
            let subtotal = (price - discount) * qty;

            // Crear un objeto de datos para enviar al servidor
            let formData = {
                cantidad: qty,
                precio: price,
                oferta: offer,
                grupoId: grupoIdInput,
                subtotal: subtotal.toFixed(2),
            };

            $.ajax({
                type: "POST",
                url: baseUrl + 'LineaPedidos/actualizar',
                data: formData,
                success: function (response) {
                    true;
                }
            });

            row.find('.product-subtotal').text(subtotal.toFixed(2) + '€');

            calculateTotal(); // Recalcular el total general
        }

        // Calcular el total general del carrito
        function calculateTotal() {
            let total = 0;
            $('#product-table tbody tr').each(function () {
                let subtotalText = $(this).find('.product-subtotal').text();
                let subtotal = parseFloat(subtotalText.replace('€', '').trim());
                if (!isNaN(subtotal)) {
                    total += subtotal;
                }
            });

            $('#cart-total').text(total.toFixed(2) + '€');
        }

        // Eliminar producto
        $('#product-table').on('click', '.btn-remove', function () {
            let row = $(this).closest('tr');
            let grupoIdInput = row.find('.product-grupo-id').val();

            // Crear un objeto de datos para enviar al servidor
            let formData = {
                grupoId: grupoIdInput,
            };

            $.ajax({
                type: "POST",
                url: baseUrl + 'LineaPedidos/eliminar',
                data: formData,
                success: function (response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        Swal.fire({
                            title: data.message,
                            icon: "success",
                            showConfirmButton: false,
                            confirmButtonText: data.boton,
                            timer: 1000
                        });
                    }
                }
            });

            // Eliminar el producto de la tabla
            row.remove();

            // Recalcular el total
            calculateTotal(); // Recalcular el total
        });

        // Función para cerrar el modal
        $('.close').on('click', function () {
            $('#productModal').fadeOut();
        });

        // Función para cerrar el modal fuera de él
        $(window).on('click', function (e) {
            if ($(e.target).is('#productModal')) {
                $('#productModal').fadeOut();
            }
        });
    }

    // Método customLineaPedido
    customLineaPedido() {
        this.modal();
    }

    // Iniciar aplicación
    init() {
        this.onReady();
    }
}

// Crear una nueva instancia del carrito y ejecutarlo
let appLineaPedido = new LineaPedido();
appLineaPedido.init();
