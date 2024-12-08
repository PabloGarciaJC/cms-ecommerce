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
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/perfil" class="panel-admin__submenu-link">Contraseña</a></li>
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/perfil" class="panel-admin__submenu-link">Eliminar Cuenta</a></li>
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/perfil" class="panel-admin__submenu-link">Formas de Pago</a></li>
      </ul>
    </li>

    <li class="panel-admin__menu-item">
      <a class="panel-admin__menu-link d-flex justify-content-between align-items-center" href="#">
        <span>
          <i class="fas fa-shipping-fast"></i>Pedidos
        </span>
        <i class="fas fa-chevron-right"></i>
      </a>
      <ul class="panel-admin__submenu">
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/listaPedidos" class="panel-admin__submenu-link">Gestión</a></li>
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/listaPedidos" class="panel-admin__submenu-link">Historial</a></li>
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/listaPedidos" class="panel-admin__submenu-link">Enviados</a></li>
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/listaPedidos" class="panel-admin__submenu-link">En Proceso</a></li>
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/listaPedidos" class="panel-admin__submenu-link">Cancelados</a></li>
      </ul>
    </li>
<!-- 
    <li class="panel-admin__menu-item">
      <a class="panel-admin__menu-link d-flex justify-content-between align-items-center" href="#">
        <span>
          <i class="fas fa-shopping-basket me-2"></i> Carrito de Compras
        </span>
        <i class="fas fa-chevron-right"></i>
      </a>
      <ul class="panel-admin__submenu">
       
      </ul>
    </li> -->

    <li class="panel-admin__menu-item">
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
    </li>

    <!-- <li class="panel-admin__menu-item">
      <a class="panel-admin__menu-link d-flex justify-content-between align-items-center" href="#">
        <span>
          <i class="fas fa-list me-2"></i> Categorías
        </span>
        <i class="fas fa-chevron-right"></i>
      </a>
      <ul class="panel-admin__submenu">

      </ul>
    </li> -->

    <li class="panel-admin__menu-item">
      <a class="panel-admin__menu-link d-flex justify-content-between align-items-center" href="#">
        <span>
          <i class="fas fa-shopping-bag"></i> Ecommerce
        </span>
        <i class="fas fa-chevron-right"></i>
      </a>
      <ul class="panel-admin__submenu">   
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/ecommerce" class="panel-admin__submenu-link">Gestor de Catálogo</a></li> 
        <!-- <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/categorias" class="panel-admin__submenu-link">Nueva Categoria</a></li> 
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/productos" class="panel-admin__submenu-link">Crear Nuevo</a></li>
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/listaproductos" class="panel-admin__submenu-link">Ver todos</a></li>
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/carrito" class="panel-admin__submenu-link">Ver Carrito</a></li>
        <li class="panel-admin__submenu-item"><a href="<?php echo BASE_URL ?>Admin/carrito" class="panel-admin__submenu-link">Realizar Pedido</a></li> -->
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