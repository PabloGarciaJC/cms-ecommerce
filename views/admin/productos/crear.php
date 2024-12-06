<?php include __DIR__ . '../../layout/header.php'; ?>

<div class="panel-admin__flex-container">

    <?php include __DIR__ . '../../layout/sidebar.php'; ?>

    <main class="panel-admin__main-content">

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

                <!-- Imagenes del Producto (multiple) -->
                <div class="form-group">
                    <label for="productImages">Imágenes del Producto:</label>
                    <input type="file" id="productImages" name="productImages[]" class="form-control" accept="image/*" multiple required>
                    <div id="imagePreview" class="panel-admin__image-preview mt-3"></div>
                </div>

                <!-- Botón de Envío -->
                <button type="submit" class="btn btn-primary">Crear Producto</button>
            </form>

        </section>


    </main>
</div>