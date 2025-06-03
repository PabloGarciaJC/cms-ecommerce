<script src="<?= BASE_URL ?>assets/js/custom/config.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/jquery-2.2.3.min.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/jquery.flexslider.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/jquery.magnific-popup.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/bootstrap.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/creditly.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/creditly2.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/easing.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/easyResponsiveTabs.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/imagezoom.js"></script>
<link href="<?php echo BASE_URL ?>assets/css/flexslider.css" rel="stylesheet" type="text/css" media="all" />
<script src="<?php echo BASE_URL ?>assets/js/move-top.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/scroll.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/SmoothScroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="<?= BASE_URL ?>assets/js/template.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= BASE_URL ?>assets/js/custom/app.js"></script>
<script src="<?= BASE_URL ?>assets/js/custom/usuario.js"></script>
<script src="<?= BASE_URL ?>assets/js/custom/roles.js"></script>
<script src="<?= BASE_URL ?>assets/js/custom/comentario.js"></script>
<script src="<?= BASE_URL ?>assets/js/custom/favorito.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/custom/linea-pedido.js"></script>
<div id="spinner" class="spinner"></div>
<div id="protection-layer"
    data-title="<?= htmlspecialchars(defined('PROTECTION_LAYER_TITLE') && PROTECTION_LAYER_TITLE ? PROTECTION_LAYER_TITLE : 'Acceso Restringido', ENT_QUOTES, 'UTF-8') ?>"
    data-message="<?= htmlspecialchars(defined('PROTECTION_LAYER_MESSAGE') && PROTECTION_LAYER_MESSAGE ? PROTECTION_LAYER_MESSAGE : 'El acceso al panel administrativo está restringido. Si necesitas autorización para ingresar o gestionar los módulos del sistema, no dudes en contactarme a través de mis redes sociales.', ENT_QUOTES, 'UTF-8') ?>"
    data-close="<?= htmlspecialchars(defined('PROTECTION_LAYER_BTN') && PROTECTION_LAYER_BTN ? PROTECTION_LAYER_BTN : 'Cerrar', ENT_QUOTES, 'UTF-8') ?>">
    <?= defined('PROTECTION_LAYER') ? PROTECTION_LAYER : '' ?>
</div>
