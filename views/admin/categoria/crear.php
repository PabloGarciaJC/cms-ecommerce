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

                <?php if (isset($_SESSION['exito'])) : ?>
                    <div class="alert <?php echo $_SESSION['messageClass']; ?> alert-dismissible fade show mt-2 text-center" role="alert">
                        <i class="<?php echo isset($_SESSION['icon']) ? $_SESSION['icon'] : 'fas fa-check-circle'; ?>"></i>
                        <?php echo $_SESSION['exito']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php unset($_SESSION['exito'], $_SESSION['messageClass'], $_SESSION['icon']); ?>
                <?php endif; ?>

                <h2 class="panel-admin__dashboard-title"><?php echo $titleText; ?> Categoría</h2>
                <form action="<?php echo BASE_URL ?>Admin/guardarCategorias" method="POST">
                    <input type="hidden" name="editid" value="<?php echo $editId ?>">
                    <input type="hidden" name="deleteid" value="<?php echo $deleteid  ?>">
                    <input type="hidden" name="parentid" value="<?php echo $categoriaId; ?>">
                    <div class="form-group">
                        <label for="name">Nombre de la Categoría:</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Ejemplo: Electrónica" <?php echo $buttonHidden; ?> value="<?php echo isset($_SESSION['form']['name']) ? $_SESSION['form']['name'] : (isset($getCategoriasId->nombre) ? $getCategoriasId->nombre : ''); ?>">
                        <?php if (isset($_SESSION['errores']['name'])) : ?>
                            <div class="text-danger mt-2">
                                <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['name']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea id="descripcion" name="descripcion" class="form-control" <?php echo $buttonHidden; ?> placeholder="Descripción de la categoría..."><?php echo isset($_SESSION['form']['descripcion']) ? $_SESSION['form']['descripcion'] : (isset($getCategoriasId->descripcion) ? $getCategoriasId->descripcion : ''); ?></textarea>
                        <?php if (isset($_SESSION['errores']['descripcion'])) : ?>
                            <div class="text-danger mt-2">
                                <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['descripcion']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <a href=" <?php echo BASE_URL; ?>Admin/catalogo<?php echo isset($_GET['categoriaId']) ? '?categoriaId=' . $_GET['categoriaId'] : false; ?>" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <button type="submit" class="btn <?php echo $buttonClass; ?>"><?php echo $titleText; ?></button>
                </form>
            </div>
        </section>
    </main>
</div>
<?php unset($_SESSION['exito'], $_SESSION['messageClass']); ?>
<?php unset($_SESSION['errores']);
if (!isset($_SESSION['errores'])) {
    unset($_SESSION['form']);
}
?>