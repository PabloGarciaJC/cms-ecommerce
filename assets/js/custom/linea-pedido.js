class CarritoCompras {

    onReady() {
        this.customCarritoCompras();
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

            if (formData) {
                // Convertir formData a un objeto clave-valor
                let params = new URLSearchParams(formData);
                let isEmpty = false;

                // Recorrer cada clave-valor del formulario
                params.forEach((value, key) => {
                    if (!value.trim()) { // Verificar si el valor está vacío
                        isEmpty = true;
                    }
                });

                if (isEmpty) {
                    Swal.fire({
                        icon: "info",
                        html: '<p style="color: red; text-align: justify;"><i class="fa fa-times-circle"></i> El Usuario debe de estar Registrado</p>',
                        confirmButtonText: 'Aceptar',
                    });

                }
            }

            $.ajax({
                type: "POST",
                url: baseUrl + 'LineaPedidos/obtenerProductos',
                data: formData,
                success: function (response) {

                    try {
                        let data = JSON.parse(response);

                        // Limpiar las filas anteriores de la tabla antes de agregar las nuevas
                        $('#product-table tbody').empty();

                        data.forEach(product => {
                            let price = parseFloat(product.linea_pedido_precio);

                            if (isNaN(price)) {
                                price = 0;
                            }

                            let subtotal = price;
                            let newRow = `
                                <tr data-product-id="${product.linea_pedido_producto_id}">
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

            // Verifica si Existe usuario Logeado
            if (usuarioId) {
                $('#productModal').fadeIn();
            }

        });

        // Desde el Formulario de los Items del Listado del Productos
        $('.formulario-items-productos').on('submit', function (e) {
            e.preventDefault();

            let formData = $(this).serialize();

            // Primera solicitud: Asegura que los productos se agreguen al carrito
            $.ajax({
                type: "POST",
                url: baseUrl + 'LineaPedidos/agregar',
                data: formData,
                success: function (response) {

                    const data = JSON.parse(response);

                    // Mostrar mensaje de éxito o error
                    if (data.success) {
                        Swal.fire({
                            title: data.titulo,
                            icon: "success",
                            showConfirmButton: false,
                            confirmButtonText: data.boton,
                            timer: 850
                        });
                    } else {
                        let errorMessage = "";
                        data.message.forEach(function (error) {
                            errorMessage += `<p style="color: red;text-align: justify;"><i class="fa fa-times-circle"></i> ${error}</p>`;
                        });
                        Swal.fire({
                            title: data.titulo,
                            icon: "info",
                            html: errorMessage,
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

                                // Limpiar las filas anteriores de la tabla antes de agregar las nuevas
                                $('#product-table tbody').empty();

                                data.forEach(product => {
                                    let price = parseFloat(product.linea_pedido_precio);

                                    if (isNaN(price)) {
                                        price = 0;
                                    }

                                    let subtotal = price;
                                    let newRow = `
                                        <tr data-product-id="${product.linea_pedido_producto_id}">
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
            let price = parseFloat(row.find('.product-price').text().replace('€', '').trim()); // Asegúrate de quitar el símbolo €
            let offer = parseFloat(row.find('.product-offer').text().replace('%', '').trim()) || 0; // Obtener la oferta
            let currentQty = parseInt(qtyInput.val());
            let stock = parseInt(row.find('.product-stock').text()); // Obtener el stock del producto
            let grupoIdInput = row.find('.product-grupo-id').val();

            // Verificar si la cantidad actual es menor al stock
            if (currentQty < stock) {
                currentQty++;  // Incrementar la cantidad
                qtyInput.val(currentQty); // Actualizar el input de cantidad
                updateSubtotal(row, price, offer, currentQty, grupoIdInput); // Actualizar subtotal
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
                let subtotal = parseFloat(subtotalText.replace('€', '').trim()); // Quitar el símbolo de euro y convertir a número
                if (!isNaN(subtotal)) {
                    total += subtotal;
                }
            });

            $('#cart-total').text(total.toFixed(2) + '€'); // Actualizar el total en el lugar correcto
        }

        // Eliminar producto
        $('#product-table').on('click', '.btn-remove', function () {
            let row = $(this).closest('tr');
            let productId = row.data('product-id');
            let grupoIdInput = row.find('.product-grupo-id').val();

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

    // Método customCarritoCompras
    customCarritoCompras() {
        this.modal();
    }

    // Iniciar aplicación
    init() {
        this.onReady();
    }
}

// Crear una nueva instancia del carrito y ejecutarlo
let appCarritoCompras = new CarritoCompras();
appCarritoCompras.init();
