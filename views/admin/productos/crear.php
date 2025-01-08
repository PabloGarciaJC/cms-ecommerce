<?php include __DIR__ . '../../layout/header.php'; ?>
<div class="panel-admin__flex-container">
    <?php include __DIR__ . '../../layout/sidebar.php'; ?>

    <?php
    $buttonHidden = '';
    $buttonClass = 'btn-primary';
    $titleText = 'Guardar';

    // Variables editid y deleteid
    if (isset($_GET['editid'])) {
        $buttonClass = 'btn-warning';
        $titleText = 'Editar';
    } elseif (isset($_GET['deleteid'])) {
        $buttonClass = 'btn-danger';
        $titleText = 'Eliminar';
        $buttonHidden = 'readonly';
    }
    ?>

    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard">
            <h2 class="panel-admin__dashboard-title"><?php echo $titleText; ?> Producto</h2>
            <form action="<?php echo BASE_URL; ?>Admin/guardarProductos" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="editid" value="<?php echo $editId; ?>">
                <input type="hidden" name="deleteid" value="<?php echo $deleteid; ?>">
                <input type="hidden" name="parentid" value="<?php echo $categoriaId; ?>">

                <!-- Pestañas para cada idioma -->
                <ul class="nav nav-tabs" id="languageTabs" role="tablist">
                    <?php foreach ($getIdiomas as $index => $idioma) : ?>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link <?php echo $index === 0 ? 'active' : ''; ?>" id="tab-<?php echo $idioma['codigo']; ?>" data-toggle="tab" href="#form-<?php echo $idioma['codigo']; ?>" role="tab" aria-controls="form-<?php echo $idioma['codigo']; ?>" aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                                <?php echo $idioma['nombre']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="tab-content" id="languageTabsContent">
                    <?php foreach ($getIdiomas as $index => $idioma) : ?>
                        <div class="tab-pane fade <?php echo $index === 0 ? 'show active' : ''; ?>" id="form-<?php echo $idioma['codigo']; ?>" role="tabpanel" aria-labelledby="tab-<?php echo $idioma['codigo']; ?>">
                            
                            <input type="hidden" name="id_idioma[<?php echo $idioma['id']; ?>]" value="<?php echo $idioma['id']; ?>">

                            <!-- Nombre del Producto -->
                            <div class="form-group mt-2">
                                <label for="nombre-<?php echo $idioma['codigo']; ?>">Nombre del Producto (<?php echo $idioma['nombre']; ?>):</label>
                                <input type="text" id="nombre-<?php echo $idioma['codigo']; ?>" name="nombre[<?php echo $idioma['codigo']; ?>]" class="form-control" <?php echo $buttonHidden; ?> placeholder="Ejemplo: Laptop, Smartphone" value="<?php echo isset($getProductosById[$idioma['id']]) ? $getProductosById[$idioma['id']]->nombre : ''; ?>">
                            </div>

                            <!-- Descripción -->
                            <div class="form-group">
                                <label for="descripcion-<?php echo $idioma['codigo']; ?>">Descripción (<?php echo $idioma['nombre']; ?>):</label>
                                <textarea id="descripcion-<?php echo $idioma['codigo']; ?>" name="descripcion[<?php echo $idioma['codigo']; ?>]" class="form-control" <?php echo $buttonHidden; ?> placeholder="Descripción del producto..."><?php echo isset($getProductosById[$idioma['id']]) ? $getProductosById[$idioma['id']]->descripcion : ''; ?></textarea>
                            </div>

                            <!-- Precio -->
                            <div class="form-group">
                                <label for="precio-<?php echo $idioma['codigo']; ?>">Precio:</label>
                                <input type="number" id="precio-<?php echo $idioma['codigo']; ?>" name="precio[<?php echo $idioma['codigo']; ?>]" class="form-control" <?php echo $buttonHidden; ?> placeholder="Ejemplo: 999.99" step="0.01" value="<?php echo isset($getProductosById[$idioma['id']]) ? $getProductosById[$idioma['id']]->precio : ''; ?>">
                            </div>

                            <!-- Stock Disponible -->
                            <div class="form-group">
                                <label for="stock-<?php echo $idioma['codigo']; ?>">Stock Disponible:</label>
                                <input type="number" id="stock-<?php echo $idioma['codigo']; ?>" name="stock[<?php echo $idioma['codigo']; ?>]" class="form-control" <?php echo $buttonHidden; ?> placeholder="Ejemplo: 50" value="<?php echo isset($getProductosById[$idioma['id']]) ? $getProductosById[$idioma['id']]->stock : ''; ?>" />
                            </div>

                            <!-- Estado del Producto -->
                            <div class="form-group">
                                <label for="estado-<?php echo $idioma['codigo']; ?>">Estado del Producto:</label>
                                <select id="estado-<?php echo $idioma['codigo']; ?>" name="estado[<?php echo $idioma['codigo']; ?>]" class="form-control" <?php echo $buttonHidden; ?>>
                                    <option value="available" <?php echo (isset($getProductosById[$idioma['id']]) && $getProductosById[$idioma['id']]->estado === 'available') ? 'selected' : ''; ?>>Disponible</option>
                                    <option value="out_of_stock" <?php echo (isset($getProductosById[$idioma['id']]) && $getProductosById[$idioma['id']]->estado === 'out_of_stock') ? 'selected' : ''; ?>>Agotado</option>
                                    <option value="discontinued" <?php echo (isset($getProductosById[$idioma['id']]) && $getProductosById[$idioma['id']]->estado === 'discontinued') ? 'selected' : ''; ?>>Descontinuado</option>
                                </select>
                            </div>

                            <!-- Oferta o Descuento -->
                            <div class="form-group">
                                <label for="oferta-<?php echo $idioma['codigo']; ?>">Oferta o Descuento (si aplica):</label>
                                <input type="number" id="oferta-<?php echo $idioma['codigo']; ?>" name="oferta[<?php echo $idioma['codigo']; ?>]" class="form-control" <?php echo $buttonHidden; ?> placeholder="Ejemplo: 10" step="0.01" value="<?php echo isset($getProductosById[$idioma['id']]) ? $getProductosById[$idioma['id']]->oferta : ''; ?>">
                                <small>Ingrese el descuento en porcentaje (Ejemplo: 10 para un 10% de descuento)</small>
                            </div>

                            <!-- Fecha de Inicio de la Oferta -->
                            <div class="form-group">
                                <label for="offerStart-<?php echo $idioma['codigo']; ?>">Fecha de Inicio de la Oferta:</label>
                                <input type="date" id="offerStart-<?php echo $idioma['codigo']; ?>" name="offerStart[<?php echo $idioma['codigo']; ?>]" class="form-control" <?php echo $buttonHidden; ?>
                                    value="<?php echo isset($getProductosById[$idioma['id']]) ? $getProductosById[$idioma['id']]->offer_start : ''; ?>" />
                            </div>

                            <!-- Fecha de Expiración de la Oferta -->
                            <div class="form-group">
                                <label for="offerExpiration-<?php echo $idioma['codigo']; ?>">Fecha de Expiración de la Oferta:</label>
                                <input type="date" id="offerExpiration-<?php echo $idioma['codigo']; ?>" name="offerExpiration[<?php echo $idioma['codigo']; ?>]" class="form-control" <?php echo $buttonHidden; ?>
                                    value="<?php echo isset($getProductosById[$idioma['id']]) ? $getProductosById[$idioma['id']]->offer_expiration : ''; ?>" />
                            </div>

                            <!-- Imágenes del Producto -->
                            <div class="form-group">
                                <label for="productImages-<?php echo $idioma['codigo']; ?>">Imágenes del Producto (<?php echo $idioma['nombre']; ?>):</label>
                                <input type="file" id="productImages-<?php echo $idioma['codigo']; ?>" name="productImages[<?php echo $idioma['codigo']; ?>][]" class="form-control" accept="image/*" <?php echo $buttonHidden; ?> multiple>
                                <div id="imagePreview-<?php echo $idioma['codigo']; ?>" class="panel-admin__image-preview mt-3">
                                    <?php
                                    $imagenes = isset($_SESSION['form']['imagenes'][$idioma['codigo']]) ? $_SESSION['form']['imagenes'][$idioma['codigo']] : (isset($getProductosById[$idioma['id']]->imagenes) ? $getProductosById[$idioma['id']]->imagenes : '');
                                    if (is_string($imagenes)) {
                                        $imagenesArray = json_decode($imagenes, true);
                                        if (json_last_error() !== JSON_ERROR_NONE) {
                                            $imagenesArray = [];
                                        }
                                    } elseif (is_array($imagenes)) {
                                        $imagenesArray = $imagenes;
                                    } else {
                                        $imagenesArray = [];
                                    }
                                    echo '<div class="panel-admin__image-container">';
                                    if (!empty($imagenesArray)) {
                                        foreach ($imagenesArray as $imagen) {
                                            $imagenSrc = BASE_URL . 'uploads/images/productos/' . $imagen;
                                            echo '<img src="' . $imagenSrc . '" alt="Imagen del Producto" class="panel-admin__image-thumbnail">';
                                        }
                                    } else {
                                        echo '<img src="' . BASE_URL . 'uploads/images/default.jpg" alt="Imagen del Producto" class="panel-admin__image-thumbnail">';
                                    }
                                    echo '</div>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Botones -->
                <a href="<?php echo BASE_URL; ?>Admin/catalogo<?php echo isset($_GET['categoriaId']) ? '?categoriaId=' . $_GET['categoriaId'] : ''; ?>" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
                <button type="submit" class="btn <?php echo $buttonClass; ?>"><?php echo $titleText; ?></button>
            </form>
        </section>
    </main>
</div>

<?php
if (!isset($_SESSION['errores'])) {
    unset($_SESSION['form']);
}
?>