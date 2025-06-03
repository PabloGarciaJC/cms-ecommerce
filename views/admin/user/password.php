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
            <h2 class="panel-admin__dashboard-title">Editar de Contraseña</h2>
            <form action="<?php echo BASE_URL; ?>Admin/cambioPassword" method="POST" enctype="multipart/form-data" class="panel-admin__user-form protection__layer">
                <input type="hidden" name="id" value="<?php echo $usuario->Id; ?>">
                <div class="form-group">
                    <label for="new_password">Nueva Contraseña:</label>
                    <div style="position: relative;">
                        <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Introduce una nueva contraseña">
                        <span class="toggle-password" data-target="#new_password" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    <?php if (isset($_SESSION['errores']['password'])) : ?>
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['password']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirmar Nueva Contraseña:</label>
                    <div style="position: relative;">
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirma tu nueva contraseña">
                        <span class="toggle-password" data-target="#confirm_password" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    <?php if (isset($_SESSION['errores']['confirmPassword'])) : ?>
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['confirmPassword']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-warning btn-sm">Editar</button>
            </form>
        </section>
    </main>
</div>
<?php unset($_SESSION['errores']); ?>