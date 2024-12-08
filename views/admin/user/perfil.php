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
            <h2 class="panel-admin__dashboard-title">Perfil de Usuario</h2>
            <form action="<?php echo BASE_URL; ?>Admin/perfilGuardar" method="POST" enctype="multipart/form-data" class="panel-admin__user-form">
                <input type="hidden" name="id" class="form-control" value="<?php echo $usuario->Id; ?>">
                <div class="form-group">
                    <label for="username">Usuario:</label>
                    <input type="text" id="username" name="usuario" class="form-control" placeholder="Nombre de usuario" value="<?php echo $usuario->Usuario; ?>">
                    <?php if (isset($_SESSION['errores']['usuario'])) : ?>
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['usuario']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- 
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <div style="position: relative;">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña del usuario" value="<?php echo $usuario->Password; ?>">
                        <span id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    <?php if (isset($_SESSION['errores']['password'])) : ?>
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['password']; ?>
                        </div>
                    <?php endif; ?>
                </div> -->
                <div class="form-group">
                    <label>Número de Documento:</label>
                    <input type="text" name="documentacion" class="form-control" placeholder="Documento de identidad" value="<?php echo $usuario->NumeroDocumento; ?>">
                    <?php if (isset($_SESSION['errores']['documentacion'])) : ?>
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['documentacion']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label>Nombres:</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombres del usuario" value="<?php echo $usuario->Nombres; ?>">
                    <?php if (isset($_SESSION['errores']['nombre'])) : ?>
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['nombre']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label>Apellidos:</label>
                    <input type="text" name="apellido" class="form-control" placeholder="Apellidos del usuario" value="<?php echo $usuario->Apellidos; ?>">
                    <?php if (isset($_SESSION['errores']['apellido'])) : ?>
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['apellido']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label>Correo Electrónico:</label>
                    <input type="email" name="email" class="form-control" placeholder="Correo electrónico" value="<?php echo $usuario->Email; ?>" disabled>
                    <?php if (isset($_SESSION['errores']['email'])) : ?>
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['email']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label>Número de Teléfono:</label>
                    <input type="text" name="telefono" class="form-control" placeholder="Teléfono del usuario" value="<?php echo $usuario->NroTelefono; ?>">
                    <?php if (isset($_SESSION['errores']['telefono'])) : ?>
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['telefono']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label>Dirección:</label>
                    <input type="text" name="direccion" class="form-control" placeholder="Dirección del usuario" value="<?php echo $usuario->Direccion; ?>">
                    <?php if (isset($_SESSION['errores']['direccion'])) : ?>
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['direccion']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="pais">País:</label>
                    <select class="form-control" id="pais" name="pais">
                        <option value="" disabled selected>Seleccione...</option>
                        <?php while ($fila = mysqli_fetch_assoc($paisesTodos)) : ?>
                            <option value="<?php echo $fila['Id']; ?>"
                                <?php echo $usuario->Pais == $fila['Id'] ? 'selected' : ''; ?>>
                                <?php echo $fila['Pais']; ?>
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
                    <label for="ciudad">Ciudad/Región:</label>
                    <select class="form-control" id="ciudad" name="ciudad" <?php echo empty($usuario->Pais) ? 'disabled' : ''; ?>>
                        <?php if (!empty($usuario->Ciudad)) : ?>
                            <option selected><?php echo $usuario->Ciudad; ?></option>
                        <?php else : ?>
                            <option value="" disabled selected>Seleccione...</option>
                        <?php endif; ?>
                    </select>
                    <?php if (isset($_SESSION['errores']['ciudad'])) : ?>
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['ciudad']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="codigoPostal">Código Postal:</label>
                    <input type="text" id="codigoPostal" name="codigoPostal" class="form-control" value="<?php echo $usuario->CodigoPostal; ?>">
                    <?php if (isset($_SESSION['errores']['codigoPostal'])) : ?>
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['codigoPostal']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="avatar">Imagen de Usuario (Avatar):</label>
                    <input type="file" id="avatar" name="avatar" class="form-control" accept="image/*">
                    <div class="panel-admin__avatar-preview mt-3">
                        <img id="avatarPreview" class="panel-admin__avatar-thumbnail" src="<?php echo !empty($usuario->imagen) ? BASE_URL . 'uploads/images/avatar/' . $usuario->imagen : BASE_URL . 'uploads/images/avatar/default-avatar.png'; ?>" alt="Avatar de Usuario">
                    </div>
                    <?php if (isset($_SESSION['errores']['avatar'])) : ?>
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $_SESSION['errores']['avatar']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Perfil</button>
            </form>
        </section>
    </main>
</div>
<?php unset($_SESSION['errores']); ?>