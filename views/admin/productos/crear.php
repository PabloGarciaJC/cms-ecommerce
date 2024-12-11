<?php include __DIR__ . '../../layout/header.php'; ?>
<div class="panel-admin__flex-container">
    <?php include __DIR__ . '../../layout/sidebar.php'; ?>
    <?php
    $buttonHidden = '';
    if (isset($_GET['editid'])) {
        $buttonClass = 'btn-warning';
        $titleText = 'Editar';
    } elseif (isset($_GET['deleteid'])) {
        $buttonClass = 'btn-danger';
        $titleText = 'Eliminar';
        $buttonHidden = 'readonly';
    } else {
        $buttonClass = 'btn-primary';
        $titleText = 'Guardar';
    }
    ?>
    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard">
            <h2 class="panel-admin__dashboard-title"><?php echo $titleText; ?> Producto</h2>
            <form action="<?php echo BASE_URL; ?>Admin/guardarProductos" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="editid" value="<?php echo $editId; ?>">
                <input type="hidden" name="deleteid" value="<?php echo $deleteid; ?>">
                <input type="hidden" name="parentid" value="<?php echo $parentid; ?>">
                <div class="form-group">
                    <label for="nombre">Nombre del Producto:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" <?php echo $buttonHidden; ?> placeholder="Ejemplo: Laptop, Smartphone" value="<?php echo isset($_SESSION['form']['nombre']) ? $_SESSION['form']['nombre'] : (isset($getProductosById->nombre) ? $getProductosById->nombre : ''); ?>">
                    <?php if (isset($_SESSION['errores']['nombre'])) : ?>
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['nombre']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" <?php echo $buttonHidden; ?> placeholder="Descripción del producto..."><?php echo isset($_SESSION['form']['descripcion']) ? $_SESSION['form']['descripcion'] : (isset($getProductosById->descripcion) ? $getProductosById->descripcion : ''); ?></textarea>
                    <?php if (isset($_SESSION['errores']['descripcion'])) : ?>
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['descripcion']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio" class="form-control" <?php echo $buttonHidden; ?> placeholder="Ejemplo: 999.99" step="0.01" value="<?php echo isset($_SESSION['form']['precio']) ? $_SESSION['form']['precio'] : (isset($getProductosById->precio) ? $getProductosById->precio : ''); ?>">
                    <?php if (isset($_SESSION['errores']['precio'])) : ?>
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['precio']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="stock">Stock Disponible:</label>
                    <input type="number" id="stock" name="stock" class="form-control" <?php echo $buttonHidden; ?> placeholder="Ejemplo: 50" value="<?php echo isset($_SESSION['form']['stock']) ? $_SESSION['form']['stock'] : (isset($getProductosById->stock) ? $getProductosById->stock : ''); ?>" />
                    <?php if (isset($_SESSION['errores']['stock'])) : ?>
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['stock']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="categoria">Categoría:</label>
                    <select id="categoria" name="categoria" class="form-control" <?php echo $buttonHidden; ?>>
                        <option value="<?php echo $parentid; ?>">Seleccione...</option>
                        <?php while ($categorias = $getCategorias['categorias']->fetch_object()) : ?>
                            <option value="<?php echo $categorias->id; ?>">
                                <?php echo $categorias->nombre; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="estado">Estado del Producto:</label>
                    <select id="estado" name="estado" class="form-control" <?php echo $buttonHidden; ?>>
                        <option value="available">Disponible</option>
                        <option value="out_of_stock">Agotado</option>
                        <option value="discontinued">Descontinuado</option>
                    </select>
                    <?php if (isset($_SESSION['errores']['estado'])) : ?>
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['estado']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="oferta">Oferta o Descuento (si aplica):</label>
                    <input type="number" id="oferta" name="oferta" class="form-control" <?php echo $buttonHidden; ?> placeholder="Ejemplo: 10" step="0.01" value="<?php echo isset($_SESSION['form']['oferta']) ? $_SESSION['form']['oferta'] : (isset($getProductosById->oferta) ? $getProductosById->oferta : ''); ?>">
                    <small>Ingrese el descuento en porcentaje (Ejemplo: 10 para un 10% de descuento)</small>
                </div>
                <div class="form-group">
                    <label for="offerExpiration">Fecha de Expiración de la Oferta:</label>
                    <input type="date" id="offerExpiration" name="offerExpiration" <?php echo $buttonHidden; ?> class="form-control" value="<?php echo isset($_SESSION['form']['offer_expiration']) ? $_SESSION['form']['offer_expiration'] : (isset($getProductosById->offer_expiration) ? date('Y-m-d', strtotime($getProductosById->offer_expiration)) : ''); ?>" />
                </div>

                <div class="form-group">
                    <label for="productImages">Imágenes del Producto:</label>
                    <input type="file" id="productImages" name="productImages[]" class="form-control" accept="image/*" <?php echo $buttonHidden; ?> multiple>

                    <!-- Mostrar imágenes existentes -->
                    <div id="imagePreview" class="panel-admin__image-preview mt-3">
                        <?php
                        // Obtener las imágenes existentes
                        $imagenes = isset($_SESSION['form']['imagenes']) ? $_SESSION['form']['imagenes'] : (isset($getProductosById->imagenes) ? $getProductosById->imagenes : '');

                        if (!empty($imagenes)) {
                            // Asumimos que las imágenes están separadas por comas en la base de datos
                            $imagenesArray = explode(',', $imagenes);

                            // Limpiar y validar imágenes
                            $imagenesArray = array_filter(array_map(function ($imagen) {
                                return trim($imagen, ' "'); // Elimina comillas y espacios
                            }, $imagenesArray), function ($imagen) {
                                return !empty($imagen) && $imagen !== 'null'; // Filtra vacíos y "null"
                            });

                            foreach ($imagenesArray as $imagen) {
                                $imagenSanitizada = preg_replace('/[^a-z0-9_\-.]/i', '', $imagen);
                                echo '<div class="panel-admin__image-container">';
                                echo '<img src="' . BASE_URL . 'uploads/images/productos/' . htmlspecialchars($imagenSanitizada, ENT_QUOTES, 'UTF-8') . '" alt="Imagen del Producto" class="panel-admin__image-thumbnail">';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <a href="<?php echo BASE_URL; ?>Admin/ecommerce<?php echo isset($_GET['categoriaId']) ? '?categoriaId=' . $_GET['categoriaId'] : false; ?>" class="btn btn-primary">
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