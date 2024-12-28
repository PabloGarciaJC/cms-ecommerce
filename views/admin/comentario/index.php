<?php include __DIR__ . '../../layout/header.php'; ?>
<div class="panel-admin__flex-container">
    <?php include __DIR__ . '../../layout/sidebar.php'; ?>
    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard">
            <h2 class="panel-admin__dashboard-title">Gestión de Comentarios</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Comentario</th>
                        <th>Calificación</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Verificar si el objeto de comentarios tiene datos
                    while ($comentario = $comentarios->fetch_object()) :
                    ?>
                        <tr id="comentario-<?php echo $comentario->id; ?>">
                            <td><?php echo $comentario->id; ?></td>
                            <td><?php echo htmlspecialchars($comentario->Usuario); ?></td>
                            <td><?php echo htmlspecialchars($comentario->comentario); ?></td>
                            <td>
                                <?php
                                // Mostrar calificación como estrellas (★) y vacías (☆)
                                echo str_repeat('★', $comentario->calificacion) . str_repeat('☆', 5 - $comentario->calificacion);
                                ?>
                            </td>
                            <td><?php echo date("d M Y", strtotime($comentario->fecha)); ?></td>
                            <td>
                                <!-- Seleccionar estado con un select -->
                                <select class="estado-select" data-id="<?php echo $comentario->id; ?>">
                                    <option value="1" <?php echo $comentario->estado == 1 ? 'selected' : ''; ?>>Aprobado</option>
                                    <option value="0" <?php echo $comentario->estado == 0 ? 'selected' : ''; ?>>Pendiente</option>
                                </select>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm guardar-estado" data-id="<?php echo $comentario->id; ?>">
                                    Editar
                                </button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </main>
</div>