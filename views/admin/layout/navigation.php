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
          <i class="fas fa-list me-2"></i> Categorías
        </span>
        <i class="fas fa-chevron-right"></i>
      </a>
      <ul class="panel-admin__submenu">
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/categorias" class="panel-admin__submenu-link">Crear Nueva</a></li>
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/listaCategorias" class="panel-admin__submenu-link">Ver todas</a></li>
      </ul>
    </li>
    <li class="panel-admin__menu-item">
      <a class="panel-admin__menu-link d-flex justify-content-between align-items-center" href="#">
        <span>
          <i class="fas fa-cube me-2"></i> Productos
        </span>
        <i class="fas fa-chevron-right"></i>
      </a>
      <ul class="panel-admin__submenu">
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/productos" class="panel-admin__submenu-link">Crear Nuevo</a></li>
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/listaproductos" class="panel-admin__submenu-link">Ver todos</a></li>
      </ul>
    </li>

    <li class="panel-admin__menu-item">
      <a class="panel-admin__menu-link d-flex justify-content-between align-items-center" href="#">
        <span>
          <i class="fas fa-shopping-cart me-2"></i> Pedidos
        </span>
        <i class="fas fa-chevron-right"></i>
      </a>
      <ul class="panel-admin__submenu">
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/listaPedidos" class="panel-admin__submenu-link">Ver todos</a></li>
      </ul>
    </li>

    <li class="panel-admin__menu-item">
      <a class="panel-admin__menu-link d-flex justify-content-between align-items-center" href="#">
        <span>
          <i class="fas fa-users me-2"></i> Usuarios
        </span>
        <i class="fas fa-chevron-right"></i>
      </a>
      <ul class="panel-admin__submenu">
        <li class="panel-admin__submenu-item">
          <a href="#" class="panel-admin__submenu-link">Clientes</a>
        </li>
        <li class="panel-admin__submenu-item">
          <a href="#" class="panel-admin__submenu-link">Administradores</a>
        </li>
        <li class="panel-admin__submenu-item">
          <a href="#" class="panel-admin__submenu-link">Asignar Roles</a>
        </li>
      </ul>
    </li>
    <li class="panel-admin__menu-item">
      <a class="panel-admin__menu-link d-flex justify-content-between align-items-center" href="#">
        <span>
          <i class="fas fa-cogs me-2"></i> Configuraciones
        </span>
        <i class="fas fa-chevron-right"></i>
      </a>
      <ul class="panel-admin__submenu">
        <li class="panel-admin__submenu-item"><a href="#" class="panel-admin__submenu-link">General</a></li>
        <li class="panel-admin__submenu-item"><a href="#" class="panel-admin__submenu-link">Privacidad</a></li>
      </ul>
    </li>
  </ul>
</aside>