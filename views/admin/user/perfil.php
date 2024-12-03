<?php include __DIR__ . '../../layout/header.php'; ?>

<div class="panel-admin__flex-container">

    <?php include __DIR__ . '../../layout/navigation.php'; ?>

    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard">
            <h2 class="panel-admin__dashboard-title">Perfil de Usuario</h2>
            <form action="ruta_para_guardar_usuario.php" method="POST" enctype="multipart/form-data" class="panel-admin__user-form">
                <!-- ID -->
                <div class="form-group">
                    <label for="userId">ID:</label>
                    <input type="text" id="userId" name="userId" class="form-control" placeholder="ID único del usuario" readonly>
                </div>

                <!-- Usuario -->
                <div class="form-group">
                    <label for="username">Usuario:</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Nombre de usuario" required>
                </div>

                <!-- Contraseña -->
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña del usuario" required>
                </div>

                <!-- Número de Documento -->
                <div class="form-group">
                    <label for="documentNumber">Número de Documento:</label>
                    <input type="text" id="documentNumber" name="documentNumber" class="form-control" placeholder="Documento de identidad" required>
                </div>

                <!-- Nombres -->
                <div class="form-group">
                    <label for="firstName">Nombres:</label>
                    <input type="text" id="firstName" name="firstName" class="form-control" placeholder="Nombres del usuario" required>
                </div>

                <!-- Apellidos -->
                <div class="form-group">
                    <label for="lastName">Apellidos:</label>
                    <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Apellidos del usuario" required>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Correo electrónico" required>
                </div>

                <!-- Número de Teléfono -->
                <div class="form-group">
                    <label for="phone">Número de Teléfono:</label>
                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="Teléfono del usuario" required>
                </div>

                <!-- Dirección -->
                <div class="form-group">
                    <label for="address">Dirección:</label>
                    <input type="text" id="address" name="address" class="form-control" placeholder="Dirección del usuario" required>
                </div>

                <!-- País -->
                <div class="form-group">
                    <label for="country">País:</label>
                    <input type="text" id="country" name="country" class="form-control" placeholder="País del usuario" required>
                </div>

                <!-- Ciudad -->
                <div class="form-group">
                    <label for="city">Ciudad:</label>
                    <input type="text" id="city" name="city" class="form-control" placeholder="Ciudad del usuario" required>
                </div>

                <!-- Código Postal -->
                <div class="form-group">
                    <label for="postalCode">Código Postal:</label>
                    <input type="text" id="postalCode" name="postalCode" class="form-control" placeholder="Código Postal" required>
                </div>

                <!-- Rol -->
                <div class="form-group">
                    <label for="role">Rol:</label>
                    <select id="role" name="role" class="form-control" required>
                        <option value="client">Cliente</option>
                        <option value="admin">Administrador</option>
                        <option value="moderator">Moderador</option>
                        <option value="vendor">Vendedor</option>
                    </select>
                </div>

                <!-- Avatar -->
                <div class="form-group">
                    <label for="avatar">Avatar (URL o Subir Imagen):</label>
                    <input type="file" id="avatar" name="avatar" class="form-control" accept="image/*">
                    <div class="panel-admin__avatar-preview mt-3">
                        <img id="avatarPreview" class="panel-admin__avatar-thumbnail" alt="Avatar Preview">
                    </div>
                </div>

                <!-- Botón de Guardar -->
                <button type="submit" class="btn btn-primary">Guardar Perfil</button>
            </form>
        </section>

        <!-- JavaScript para previsualizar el avatar -->
        <script>
            document.getElementById('avatar').addEventListener('change', function(event) {
                const file = event.target.files[0];
                const preview = document.getElementById('avatarPreview');

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.src = '';
                    preview.style.display = 'none';
                }
            });
        </script>

    </main>
</div>