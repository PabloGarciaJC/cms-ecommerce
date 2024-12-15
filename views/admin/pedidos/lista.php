<?php include __DIR__ . '../../layout/header.php'; ?>
<div class="panel-admin__flex-container">
    <?php include __DIR__ . '../../layout/sidebar.php'; ?>
    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard">
            <h2 class="panel-admin__dashboard-title">Gestión de Categorías</h2>
            <div class="panel-admin__category-list">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Categoría</th>
                            <th>Descripción</th>
                            <th>Subcategorías</th>
                            <th>Acciones</th>
                            <th>Ver Productos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Electrónica</td>
                            <td>Todo lo relacionado con tecnología y dispositivos electrónicos.</td>
                            <td>
                                <ul>
                                    <li>Smartphones</li>
                                    <li>Laptops</li>
                                </ul>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm">Editar</button>
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </td>
                            <td>
                                <a href="productos.php?categoria=1" class="btn btn-info btn-sm">Ver Productos</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Ropa</td>
                            <td>Categoría de ropa para hombres, mujeres y niños.</td>
                            <td>
                                <ul>
                                    <li>Hombre</li>
                                    <li>Mujer</li>
                                </ul>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm">Editar</button>
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </td>
                            <td>
                                <a href="productos.php?categoria=2" class="btn btn-info btn-sm">Ver Productos</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>