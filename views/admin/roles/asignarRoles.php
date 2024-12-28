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
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="custom-table-cell">
                        <?php while ($usuario = $obtenerUsuarios->fetch_object()): ?>
                            <tr>
                                <td><?php echo $usuario->Usuario ?></td>
                                <td>
                                    <select class="custom-select-roles estado-select">
                                        <?php
                                        $obtenerRoles->data_seek(0); // Reinicia el cursor del resultado de obtenerRoles
                                        while ($rol = $obtenerRoles->fetch_object()):
                                            $selected = ($usuario->Rol == $rol->id) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo $rol->id ?>" <?php echo $selected ?>><?php echo $rol->nombre ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm btn-rol-change" data-url="<?php echo BASE_URL ?>Admin/cambiarRol" data-user-id="<?php echo $usuario->Id ?>">Editar</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>