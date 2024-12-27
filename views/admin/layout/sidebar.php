<aside class="panel-admin__menu" id="menuPanel">
  <ul class="panel-admin__menu-list">
    <li class="panel-admin__menu-item">
      <a class="panel-admin__menu-link-init d-flex justify-content-between align-items-center" href="<?php echo BASE_URL ?>Admin/dashboard">
        <span>
          <i class="fas fa-tachometer-alt me-2"></i> Dashboard
        </span>
      </a>
    </li>
    <li class="panel-admin__menu-item">
      <a class="panel-admin__menu-link d-flex justify-content-between align-items-center" href="#">
        <span>
          <i class="fas fa-user"></i> Cuenta
        </span>
        <i class="fas fa-chevron-right"></i>
      </a>
      <ul class="panel-admin__submenu">
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/perfil" class="panel-admin__submenu-link">Perfil</a></li>
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/password" class="panel-admin__submenu-link">Contraseña</a></li>
      </ul>
    </li>
    
    <!-- Mostrar solo si el usuario tiene rol de Admin -->
    <?php if ($_SESSION['usuarioRegistrado']->rol_nombre == 'Admin'): ?>
    <li class="panel-admin__menu-item">
      <a class="panel-admin__menu-link d-flex justify-content-between align-items-center" href="#">
        <span>
          <i class="fas fa-users"></i> Usuarios
        </span>
        <i class="fas fa-chevron-right"></i>
      </a>
      <ul class="panel-admin__submenu">
        <li class="panel-admin__submenu-item">
          <a href="<?php echo BASE_URL ?>Admin/listaUsuario" class="panel-admin__submenu-link">Lista</a>
        </li>
      </ul>
    </li>
    <li class="panel-admin__menu-item">
      <a class="panel-admin__menu-link d-flex justify-content-between align-items-center" href="#">
        <span>
          <i class="fas fa-users"></i> Roles
        </span>
        <i class="fas fa-chevron-right"></i>
      </a>
      <ul class="panel-admin__submenu">
        <li class="panel-admin__submenu-item">
          <a href="<?php echo BASE_URL ?>Admin/roles" class="panel-admin__submenu-link">Gestionar</a>
        </li>
        <li class="panel-admin__submenu-item">
          <a href="<?php echo BASE_URL ?>Admin/asignarRoles" class="panel-admin__submenu-link">Asignar</a>
        </li>
      </ul>
    </li>
    <li class="panel-admin__menu-item">
      <a class="panel-admin__menu-link d-flex justify-content-between align-items-center" href="#">
        <span>
          <i class="fas fa-th"></i> Catalogo
        </span>
        <i class="fas fa-chevron-right"></i>
      </a>
      <ul class="panel-admin__submenu">
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/catalogo" class="panel-admin__submenu-link">Gestor de Catálogo</a></li>
      </ul>
    </li>
    <?php endif; ?>

    <li class="panel-admin__menu-item">
      <a class="panel-admin__menu-link d-flex justify-content-between align-items-center" href="#">
        <span>
          <i class="fas fa-shipping-fast"></i> Pedidos
        </span>
        <i class="fas fa-chevron-right"></i>
      </a>
      <ul class="panel-admin__submenu">
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/listaPedidos" class="panel-admin__submenu-link">Lista</a></li>
      </ul>
    </li>
    <?php if ($_SESSION['usuarioRegistrado']->rol_nombre == 'Cliente'): ?>
    <li class="panel-admin__menu-item">
      <a class="panel-admin__menu-link d-flex justify-content-between align-items-center" href="#">
        <span>
          <i class="fas fa-shopping-cart"></i> Carrito de Compras
        </span>
        <i class="fas fa-chevron-right"></i>
      </a>
      <ul class="panel-admin__submenu">
        <li class="panel-admin__submenu-item">
          <a href="<?php echo BASE_URL ?>Producto/checkout" class="panel-admin__submenu-link">Ver Carrito</a>
        </li>
      </ul>
    </li>
    <?php endif; ?>
    <li class="panel-admin__menu-item">
      <a class="panel-admin__menu-link d-flex justify-content-between align-items-center" href="#">
        <span>
          <i class="fas fa-book me-2"></i> Conoce la Plataforma
        </span>
        <i class="fas fa-chevron-right"></i>
      </a>
      <ul class="panel-admin__submenu">
        <li class="panel-admin__submenu-item">
          <a href="<?php echo BASE_URL ?>Admin/documentacion" class="panel-admin__submenu-link">Documentación</a>
        </li>
      </ul>
    </li>
    <li class="panel-admin__menu-item">
      <a class="panel-admin__menu-link d-flex justify-content-between align-items-center" href="#">
        <span>
          <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </span>
        <i class="fas fa-chevron-right"></i>
      </a>
      <ul class="panel-admin__submenu">
        <li class="panel-admin__submenu-item">
          <a href="<?php echo BASE_URL ?>Admin/cerrarSesion" class="panel-admin__submenu-link">Cerrar Sesión</a>
        </li>
      </ul>
    </li>
  </ul>
</aside>
