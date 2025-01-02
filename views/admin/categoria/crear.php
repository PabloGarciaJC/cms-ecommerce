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
        <section class="panel-admin__dashboard panel-admin__dashboard--categorias">
            <div class="panel-admin__category-form">
                <h2 class="panel-admin__dashboard-title"><?php echo $titleText; ?> Categoría</h2>
                <form action="<?php echo BASE_URL ?>Admin/guardarCategorias" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="editid" value="<?php echo $editId; ?>">
                    <input type="hidden" name="deleteid" value="<?php echo $deleteid; ?>">
                    <input type="hidden" name="parentid" value="<?php echo $categoriaId; ?>">
                    <!-- Pestañas de idiomas -->
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
                                <div class="form-group mt-2">
                                    <label for="name-<?php echo $idioma['codigo']; ?>">Nombre de la Categoría (<?php echo $idioma['nombre']; ?>):</label>
                                    <input type="text" id="name-<?php echo $idioma['codigo']; ?>" name="name[<?php echo $idioma['codigo']; ?>]" class="form-control" <?php echo $buttonHidden; ?> value="<?php echo isset($getCategoriasId[$idioma['id']]) ? $getCategoriasId[$idioma['id']]->nombre : ''; ?>">
                                    <input type="hidden" name="id_idioma[<?php echo $idioma['id']; ?>]" value="<?php echo $idioma['id']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="descripcion-<?php echo $idioma['codigo']; ?>">Descripción (<?php echo $idioma['nombre']; ?>):</label>
                                    <textarea id="descripcion-<?php echo $idioma['codigo']; ?>" name="descripcion[<?php echo $idioma['codigo']; ?>]" class="form-control" <?php echo $buttonHidden; ?>><?php echo isset($getCategoriasId[$idioma['id']]) ? $getCategoriasId[$idioma['id']]->descripcion : ''; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="categoriaImages-<?php echo $idioma['codigo']; ?>">Subir imagen de categoría (<?php echo $idioma['nombre']; ?>):</label>
                                    <input type="file" id="categoriaImages-<?php echo $idioma['codigo']; ?>" name="categoriaImages[<?php echo $idioma['codigo']; ?>][]" class="form-control" accept="image/*" <?php echo $buttonHidden; ?> multiple>

                                    <div id="imagePreview-<?php echo $idioma['codigo']; ?>" class="panel-admin__image-preview mt-3">
                                        <?php
                                        $imagenes = isset($_SESSION['form']['imagenes'][$idioma['codigo']]) ? $_SESSION['form']['imagenes'][$idioma['codigo']] : (isset($getCategoriasId[$idioma['id']]->imagenes) ? $getCategoriasId[$idioma['id']]->imagenes : '');
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
                                                $imagenSrc = BASE_URL . 'uploads/images/categorias/' . $imagen;
                                                echo '<img src="' . $imagenSrc . '" alt="Imagen del Producto" class="panel-admin__image-thumbnail">';
                                            }
                                        } else {
                                            echo '<img src="' . BASE_URL . 'uploads/images/default.jpg" alt="Imagen de la categoria" class="panel-admin__image-thumbnail">';
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
            </div>
        </section>
    </main>
</div>

<?php
if (!isset($_SESSION['errores'])) {
    unset($_SESSION['form']);
}
?>