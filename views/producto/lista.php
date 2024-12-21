<?php if ($productos && $productos->num_rows > 0): ?>
    <?php while ($prod = $productos->fetch_object()): ?>
        <?php include __DIR__ . '/plantilla.php'; ?>
    <?php endwhile; ?>
<?php endif; ?>