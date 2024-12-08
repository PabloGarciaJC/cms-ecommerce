<?php include __DIR__ . '../../layout/header.php'; ?>
<div class="panel-admin__flex-container">
    <?php include __DIR__ . '../../layout/sidebar.php'; ?>
    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard panel-admin__dashboard--categorias">
            <div class="panel-admin__category-form">
                <h2 class="panel-admin__dashboard-title">Nueva Categoría</h2>
                <form action="<?php echo BASE_URL ?>Admin/guardarCategorias" method="POST">
                    <input type="hidden" name="editid" value="<?php echo isset($_GET['editid']) ? $_GET['editid'] : ''; ?>">
                    <input type="hidden" name="deteleid" value="<?php echo isset($_GET['deteleid']) ? $_GET['deteleid'] : ''; ?>">
                    <input type="hidden" name="parentid" value="<?php echo isset($_GET['parentid']) ? $_GET['parentid'] : ''; ?>">
                    <div class="form-group">
                        <label for="name">Nombre de la Categoría:</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Ejemplo: Electrónica" value="<?php echo isset($getCategoriasId->nombre) ? $getCategoriasId->nombre : false; ?>">
                        <?php if (isset($_SESSION['errores']['name'])) : ?>
                            <div class="text-danger mt-2">
                                <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['name']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="parentid">Subcategorias</label>
                        <select class="form-control" id="parentid" name="parentid">
                            <option value="" disabled selected>Seleccione...</option>
                            <?php while ($fila = mysqli_fetch_assoc($getCategorias)) : ?>
                                <option value="<?php echo $fila['id']; ?>">
                                    <?php echo $fila['nombre']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                        <?php if (isset($_SESSION['errores']['pais'])) : ?>
                            <div class="text-danger mt-2">
                                <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['pais']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea id="descripcion" name="descripcion" class="form-control" placeholder="Descripción de la categoría..."><?php echo isset($getCategoriasId->descripcion) ? $getCategoriasId->descripcion : false; ?></textarea>
                        <?php if (isset($_SESSION['errores']['descripcion'])) : ?>
                            <div class="text-danger mt-2">
                                <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['descripcion']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="<?php echo BASE_URL; ?>Admin/ecommerce" type="submit" class="btn btn-primary">Volver</a>
                </form>
            </div>
        </section>
    </main>
</div>