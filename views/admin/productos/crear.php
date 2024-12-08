<?php include __DIR__ . '../../layout/header.php'; ?>
<div class="panel-admin__flex-container">
    <?php include __DIR__ . '../../layout/sidebar.php'; ?>
    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard">
            <?php if (isset($_SESSION['exito'])) : ?>
                <div class="alert alert-success alert-dismissible fade show mt-2 success-alert" role="alert">
                    <i class="fas fa-check-circle"></i> <?php echo $_SESSION['exito']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['exito']); ?>
            <?php endif; ?>
            <h2 class="panel-admin__dashboard-title">Crear Nuevo Producto</h2>
            <form action="<?php echo BASE_URL; ?>Admin/guardarProductos" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nombre">Nombre del Producto:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ejemplo: Laptop, Smartphone">
                    <?php if (isset($_SESSION['errores']['nombre'])) : ?>
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['nombre']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" placeholder="Descripción del producto..."></textarea>
                    <?php if (isset($_SESSION['errores']['descripcion'])) : ?>
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['descripcion']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio" class="form-control" placeholder="Ejemplo: 999.99" step="0.01">
                    <?php if (isset($_SESSION['errores']['precio'])) : ?>
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['precio']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="stock">Stock Disponible:</label>
                    <input type="number" id="stock" name="stock" class="form-control" placeholder="Ejemplo: 50">
                    <?php if (isset($_SESSION['errores']['stock'])) : ?>
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['stock']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="categoria">Categoría:</label>
                    <select id="categoria" name="categoria" class="form-control">
                        <option value="">Selecciona una categoría</option>
                        <option value="37">Electrónica</option>
                        <option value="38">Ropa</option>
                        <option value="39">Hogar</option>
                        <option value="40">Deportes</option>
                    </select>
                    <?php if (isset($_SESSION['errores']['categoria'])) : ?>
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['categoria']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="estado">Estado del Producto:</label>
                    <select id="estado" name="estado" class="form-control">
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
                    <input type="number" id="oferta" name="oferta" class="form-control" placeholder="Ejemplo: 10" step="0.01">
                    <small>Ingrese el descuento en porcentaje (Ejemplo: 10 para un 10% de descuento)</small>
                </div>
                <div class="form-group">
                    <label for="offerExpiration">Fecha de Expiración de la Oferta:</label>
                    <input type="date" id="offerExpiration" name="offerExpiration" class="form-control">
                </div>
                <div class="form-group">
                    <label for="productImages">Imágenes del Producto:</label>
                    <input type="file" id="productImages" name="productImages[]" class="form-control" accept="image/*" multiple>
                    <div id="imagePreview" class="panel-admin__image-preview mt-3"></div>
                </div>
                <button type="submit" class="btn btn-primary">Crear Producto</button>
                <a href="<?php echo BASE_URL; ?>Admin/ecommerce" type="submit" class="btn btn-primary">Volver</a>
            </form>
        </section>
    </main>
</div>
<?php unset($_SESSION['errores']); ?>
