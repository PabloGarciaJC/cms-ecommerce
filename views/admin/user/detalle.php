<?php include __DIR__ . '../../layout/header.php'; ?>

<div class="panel-admin__flex-container">
    <?php include __DIR__ . '../../layout/sidebar.php'; ?>
    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard">
            <h2 class="panel-admin__dashboard-title">Perfil de <?php echo $usuarioDetails->Usuario; ?></h2>
            <div class="panel-admin__category-list">
                <table class="table table-bordered">
                    <tr>
                        <th>Avatar</th>
                        <td>
                            <img src="<?php echo !empty($usuarioDetails->imagen) ? BASE_URL . 'uploads/images/avatar/' . $usuarioDetails->imagen : BASE_URL . 'uploads/images/default.jpg'; ?>" class="user-avatar-header" alt="Avatar de Usuario">
                        </td>
                    </tr>
                    <tr>
                        <th>Usuario</th>
                        <td><?php echo $usuarioDetails->Usuario; ?></td>
                    </tr>
                    <tr>
                        <th>Nombres</th>
                        <td><?php echo $usuarioDetails->Nombres; ?></td>
                    </tr>
                    <tr>
                        <th>Apellidos</th>
                        <td><?php echo $usuarioDetails->Apellidos; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $usuarioDetails->Email; ?></td>
                    </tr>
                    <tr>
                        <th>Telefono</th>
                        <td><?php echo $usuarioDetails->NroTelefono; ?></td>
                    </tr>
                    <tr>
                        <th>Direccion</th>
                        <td><?php echo $usuarioDetails->Direccion; ?></td>
                    </tr>
                    <tr>
                        <th>Pais</th>
                        <td><?php echo $usuarioDetails->Pais; ?></td>
                    </tr>
                    <tr>
                        <th>Ciudad</th>
                        <td><?php echo $usuarioDetails->Ciudad; ?></td>
                    </tr>
                    <tr>
                        <th>Codigo Postal</th>
                        <td><?php echo $usuarioDetails->CodigoPostal; ?></td>
                    </tr>
                    <tr>
                        <th>Rol</th>
                        <td><?php echo $usuarioDetails->Rol; ?></td>
                    </tr>
                    <tr>
                        <th>Imagen</th>
                        <td>
                            <?php if ($usuarioDetails->imagen): ?>
                                <img src="<?php echo $usuarioDetails->imagen; ?>" alt="Imagen de Usuario" width="100">
                            <?php else: ?>
                                <span>No disponible</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
            <a href="<?php echo BASE_URL; ?>Admin/listaUsuario" class="btn btn-primary btn-sm">Volver a la lista de usuarios</a>
        </section>
    </main>
</div>