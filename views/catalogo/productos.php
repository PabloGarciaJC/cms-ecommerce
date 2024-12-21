
    <div class="container py-xl-4 py-lg-2">
        <div class="row">
            <div class="wrapper">
                <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
                    <div class="row">
                        <?php if (!empty($getCategorias['productos']) && $getCategorias['productos']->num_rows > 0) : ?>
                            <?php while ($prod = $getCategorias['productos']->fetch_object()) : ?>
                                <?php include __DIR__ . '../../producto/plantilla.php'; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
