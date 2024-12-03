<?php include __DIR__ . '../../layout/header.php'; ?>

<div class="panel-admin__flex-container">

    <?php include __DIR__ . '../../layout/navigation.php'; ?>

    <main class="panel-admin__main-content">


        <style>
            /* Estilo general para el contenedor de las imágenes */
            .panel-admin__image-container {
                position: relative;
                margin-right: 10px;
                margin-bottom: 10px;
                width: 120px;
                /* Ancho fijo para cada imagen */
                text-align: center;
                /* Centrar los botones y la imagen */
            }

            /* Estilo para las imágenes de producto */
            .panel-admin__image-thumbnail {
                width: 100px;
                /* Fijar el tamaño de la imagen */
                margin-bottom: 10px;
            }

            /* Botones debajo de las imágenes */
            .panel-admin__btn {
                width: 100px;
                margin-bottom: 5px;
                /* Espacio debajo del botón */
                font-size: 12px;
            }

            /* Estilo para el botón de eliminar */
            .panel-admin__btn--delete {
                background-color: #dc3545;
                /* Rojo */
                color: white;
            }

            /* Estilo para el botón de editar */
            .panel-admin__btn--edit {
                background-color: #ffc107;
                /* Amarillo */
                color: black;
            }

            /* Contenedor para la vista previa de imágenes */
            .panel-admin__image-preview {
                display: flex;
                flex-wrap: wrap;
                margin-top: 15px;
            }
        </style>





        <section class="panel-admin__dashboard">

            <h2 class="panel-admin__dashboard-title">Crear Nuevo Producto</h2>
            <form action="ruta_para_guardar_producto.php" method="POST" enctype="multipart/form-data">
                <!-- Nombre del Producto -->
                <div class="form-group">
                    <label for="productName">Nombre del Producto:</label>
                    <input type="text" id="productName" name="productName" class="form-control" placeholder="Ejemplo: Laptop, Smartphone" required>
                </div>

                <!-- Descripción del Producto -->
                <div class="form-group">
                    <label for="productDescription">Descripción:</label>
                    <textarea id="productDescription" name="productDescription" class="form-control" placeholder="Descripción del producto..." required></textarea>
                </div>

                <!-- Costo del Producto -->
                <div class="form-group">
                    <label for="productPrice">Precio:</label>
                    <input type="number" id="productPrice" name="productPrice" class="form-control" placeholder="Ejemplo: 999.99" step="0.01" required>
                </div>

                <!-- Stock del Producto -->
                <div class="form-group">
                    <label for="productStock">Stock Disponible:</label>
                    <input type="number" id="productStock" name="productStock" class="form-control" placeholder="Ejemplo: 50" required>
                </div>

                <!-- Categoría del Producto -->
                <div class="form-group">
                    <label for="productCategory">Categoría:</label>
                    <select id="productCategory" name="productCategory" class="form-control" required>
                        <option value="">Selecciona una categoría</option>
                        <option value="electronics">Electrónica</option>
                        <option value="clothing">Ropa</option>
                        <option value="home">Hogar</option>
                        <option value="sports">Deportes</option>
                        <option value="toys">Juguetes</option>
                    </select>
                </div>

                <!-- Imagenes del Producto (multiple) -->
                <div class="form-group">
                    <label for="productImages">Imágenes del Producto:</label>
                    <input type="file" id="productImages" name="productImages[]" class="form-control" accept="image/*" multiple required>
                    <div id="imagePreview" class="panel-admin__image-preview mt-3"></div>
                </div>

                <!-- Estado del Producto -->
                <div class="form-group">
                    <label for="productStatus">Estado del Producto:</label>
                    <select id="productStatus" name="productStatus" class="form-control" required>
                        <option value="available">Disponible</option>
                        <option value="out_of_stock">Agotado</option>
                        <option value="discontinued">Descontinuado</option>
                    </select>
                </div>

                <!-- Ofertas o Descuentos -->
                <div class="form-group">
                    <label for="productDiscount">Oferta o Descuento (si aplica):</label>
                    <input type="number" id="productDiscount" name="productDiscount" class="form-control" placeholder="Ejemplo: 10" step="0.01">
                    <small>Ingrese el descuento en porcentaje (Ejemplo: 10 para un 10% de descuento)</small>
                </div>

                <!-- Fecha de Expiración de la Oferta -->
                <div class="form-group">
                    <label for="offerExpiration">Fecha de Expiración de la Oferta:</label>
                    <input type="date" id="offerExpiration" name="offerExpiration" class="form-control">
                </div>

                <!-- Botón de Envío -->
                <button type="submit" class="btn btn-primary">Crear Producto</button>
            </form>

        </section>

        <!-- JavaScript para previsualizar, editar y eliminar imágenes -->
        <script>
            let imageFiles = []; // Para mantener el control de las imágenes cargadas

            document.getElementById('productImages').addEventListener('change', function(event) {
                const files = event.target.files;
                const previewContainer = document.getElementById('imagePreview');
                previewContainer.innerHTML = ''; // Limpiar cualquier imagen previa

                imageFiles = []; // Reiniciar el arreglo de archivos

                // Mostrar todas las imágenes seleccionadas
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const imgContainer = document.createElement('div');
                        imgContainer.classList.add('panel-admin__image-container');

                        const imgElement = document.createElement('img');
                        imgElement.src = e.target.result;
                        imgElement.classList.add('panel-admin__image-thumbnail');

                        // Añadir archivo al arreglo de archivos para gestión posterior
                        imageFiles.push(file);

                        // Botón de eliminar
                        const deleteBtn = document.createElement('button');
                        deleteBtn.textContent = 'Eliminar';
                        deleteBtn.classList.add('panel-admin__btn', 'panel-admin__btn--delete');
                        deleteBtn.addEventListener('click', function() {
                            // Eliminar la imagen
                            imgContainer.remove();
                            imageFiles = imageFiles.filter(f => f !== file); // Eliminar la imagen del arreglo
                        });

                        // Botón de editar
                        const editBtn = document.createElement('button');
                        editBtn.textContent = 'Editar';
                        editBtn.classList.add('panel-admin__btn', 'panel-admin__btn--edit');
                        editBtn.addEventListener('click', function() {
                            const input = document.createElement('input');
                            input.type = 'file';
                            input.accept = 'image/*';
                            input.click();

                            input.addEventListener('change', function() {
                                const newFile = input.files[0];
                                if (newFile) {
                                    const newReader = new FileReader();
                                    newReader.onload = function(e) {
                                        imgElement.src = e.target.result; // Reemplazar la imagen
                                        imageFiles = imageFiles.map(f => f === file ? newFile : f); // Reemplazar en el arreglo
                                    };
                                    newReader.readAsDataURL(newFile);
                                }
                            });
                        });

                        // Añadir la imagen, botones de editar y eliminar al contenedor
                        imgContainer.appendChild(imgElement);
                        imgContainer.appendChild(editBtn); // Botón de editar
                        imgContainer.appendChild(deleteBtn); // Botón de eliminar
                        previewContainer.appendChild(imgContainer);
                    };

                    reader.readAsDataURL(file);
                }
            });
        </script>



    </main>
</div>