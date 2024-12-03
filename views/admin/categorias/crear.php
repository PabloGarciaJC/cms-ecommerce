<?php include __DIR__ . '../../layout/header.php'; ?>

<div class="panel-admin__flex-container">

    <?php include __DIR__ . '../../layout/navigation.php'; ?>

    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard panel-admin__dashboard--categorias">
            <div class="panel-admin__category-form">
                <h2 class="panel-admin__dashboard-title">Nueva Categoría</h2>
                <form action="ruta_para_guardar_categoria.php" method="POST">
                    <div class="form-group">
                        <label for="categoryName">Nombre de la Categoría:</label>
                        <input type="text" id="categoryName" name="categoryName" class="form-control" placeholder="Ejemplo: Electrónica" required>
                    </div>
                    <div class="form-group">
                        <label for="categoryDescription">Descripción:</label>
                        <textarea id="categoryDescription" name="categoryDescription" class="form-control" placeholder="Descripción de la categoría..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Categoría</button>
                </form>
            </div>
            <div class="panel-admin__subcategory-form">
                <h2 class="panel-admin__dashboard-title">Crear Subcategoría</h2>
                <form action="ruta_para_guardar_subcategoria.php" method="POST">
                    <div class="form-group">
                        <label for="parentCategory">Categoría Principal:</label>
                        <select id="parentCategory" name="parentCategory" class="form-control" required>
                            <option value="">Seleccionar Categoría</option>
                            <option value="1">Electrónica</option>
                            <option value="2">Ropa</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subcategoryName">Nombre de la Subcategoría:</label>
                        <input type="text" id="subcategoryName" name="subcategoryName" class="form-control" placeholder="Ejemplo: Smartphones" required>
                    </div>
                    <div class="form-group">
                        <label for="subcategoryDescription">Descripción:</label>
                        <textarea id="subcategoryDescription" name="subcategoryDescription" class="form-control" placeholder="Descripción de la subcategoría..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Subcategoría</button>
                </form>
            </div>
        </section>
    </main>
</div>