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
                                <!-- Botón para guardar el cambio de estado -->
                                <button class="btn btn-success guardar-estado" data-id="<?php echo $comentario->id; ?>">
                                    Guardar
                                </button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </main>
</div>



<!-- Estilos CSS para mejorar el diseño del select y botón -->
<style>
    /* Estilos para el select */
    .estado-select {
        width: 150px;
        padding: 8px;
        font-size: 14px;
        border-radius: 5px;
        border: 1px solid #ccc;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
    }

    .estado-select:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .estado-select option {
        padding: 5px;
    }

    .estado-select:hover {
        background-color: #e9ecef;
    }

    /* Estilos para el botón de guardar */
    .guardar-estado {
        background-color: #28a745;
        color: white;
        padding: 8px 15px;
        font-size: 14px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .guardar-estado:hover {
        background-color: #218838;
    }

    .guardar-estado:active {
        background-color: #1e7e34;
    }
</style>