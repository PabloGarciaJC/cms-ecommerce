<?php include __DIR__ . '../../layout/header.php'; ?>
<div class="panel-admin__flex-container">
    <?php include __DIR__ . '../../layout/sidebar.php'; ?>
    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard">
            <h2 class="panel-admin__dashboard-title">Asignar Roles</h2>
            <div class="panel-admin__category-list">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="custom-table-cell">
                        <?php while ($usuario = $obtenerUsuarios->fetch_object()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($usuario->usuario_nombres . ' ' . $usuario->usuario_apellidos) ?></td>
                                <td>
                                    <select class="custom-select-roles estado-select">
                                        <?php
                                        $obtenerRoles->data_seek(0);
                                        while ($rol = $obtenerRoles->fetch_object()):
                                            $selected = ($usuario->rol_id == $rol->id) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo $rol->id ?>" <?php echo $selected ?>>
                                                <?php echo htmlspecialchars($rol->nombre) ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </td>
                                <td>
                                    <select class="custom-select-status estado-select">
                                        <option value="active" <?php echo ($usuario->usuario_status == 'active') ? 'selected' : '' ?>>Activo</option>
                                        <option value="inactive" <?php echo ($usuario->usuario_status == 'inactive') ? 'selected' : '' ?>>Inactivo</option>
                                    </select>
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm btn-rol-change"
                                        data-url="<?php echo BASE_URL ?>Admin/cambiarRol"
                                        data-user-id="<?php echo $usuario->usuario_id ?>">
                                        Editar
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>
