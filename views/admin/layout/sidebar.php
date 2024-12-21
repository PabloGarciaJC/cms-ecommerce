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
    <li class="panel-admin__menu-item">
      <a class="panel-admin__menu-link d-flex justify-content-between align-items-center" href="#">
        <span>
          <i class="fas fa-users"></i> Usuarios
        </span>
        <i class="fas fa-chevron-right"></i>        
      </a>
      <ul class="panel-admin__submenu">
        <li class="panel-admin__submenu-item">
          <a href="<?php echo BASE_URL ?>Admin/listaUsuario" class="panel-admin__submenu-link">Listar</a>
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
    <!-- <li class="panel-admin__menu-item">
      <a class="panel-admin__menu-link d-flex justify-content-between align-items-center" href="#">
        <span>
          <i class="fas fa-shopping-basket me-2"></i> Carrito de Compras
        </span>
        <i class="fas fa-chevron-right"></i>
      </a>
      <ul class="panel-admin__submenu">
        <li class="panel-admin__submenu-item">
          <a href="<?php echo BASE_URL ?>Admin/administradores" class="panel-admin__submenu-link">Administradores</a>
        </li>
        <li class="panel-admin__submenu-item">
          <a href="<?php echo BASE_URL ?>Admin/clientes" class="panel-admin__submenu-link">Clientes</a>
        </li>
        <li class="panel-admin__submenu-item">
          <a href="<?php echo BASE_URL ?>Admin/roles" class="panel-admin__submenu-link">Asignar Roles</a>
        </li>
      </ul>
    </li> -->
    <li class="panel-admin__menu-item">
      <a class="panel-admin__menu-link d-flex justify-content-between align-items-center" href="#">
        <span>
          <i class="fas fa-shipping-fast"></i>Pedidos
        </span>
        <i class="fas fa-chevron-right"></i>
      </a>
      <ul class="panel-admin__submenu">
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/listaPedidos" class="panel-admin__submenu-link">Lista</a></li>
        <!-- <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/listaPedidos" class="panel-admin__submenu-link">Historial</a></li>
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/listaPedidos" class="panel-admin__submenu-link">Enviados</a></li>
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/listaPedidos" class="panel-admin__submenu-link">En Proceso</a></li>
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/listaPedidos" class="panel-admin__submenu-link">Cancelados</a></li> -->
      </ul>
    </li>
    <!-- <li class="panel-admin__menu-item">
      <a class="panel-admin__menu-link d-flex justify-content-between align-items-center" href="#">
        <span>
          <i class="fas fa-heart me-2"></i> Favoritos
        </span>
        <i class="fas fa-chevron-right"></i>
      </a>
      <ul class="panel-admin__submenu">
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/favoritos" class="panel-admin__submenu-link">Ver Favoritos</a></li>
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/favoritos" class="panel-admin__submenu-link">Gestionar Favoritos</a></li>
      </ul>
    </li> -->
    <!-- <li class="panel-admin__menu-item">
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
    </li> -->
  </ul>
</aside>