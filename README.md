# Documentación del Proyecto: Aplicación Web Ecommerce

La **Aplicación Web Ecommerce** es un sistema seguro y escalable diseñado para ofrecer una experiencia óptima a compradores y vendedores. Su enfoque es garantizar la eficiencia y adaptabilidad, utilizando buenas prácticas de desarrollo y actualizaciones constantes.

### Demo del Proyecto  
[https://ecommerce.pablogarciajc.com/](https://ecommerce.pablogarciajc.com/)

| ![Imagen 1](https://pablogarciajc.com/wp-content/uploads/2024/03/pablogarciajc-aplicacion-web-ecommerce-img1.webp) | ![Imagen 2](https://pablogarciajc.com/wp-content/uploads/2024/03/pablogarciajc-aplicacion-web-ecommerce-img2.webp) |
|-----------|-----------|

---

## Funcionalidades Principales

La plataforma cuenta con **cuatro módulos principales** que optimizan la experiencia de usuario y administración:

- **Dashboard**: Visualiza métricas clave.
- **Registro y Login**: Gestión de cuentas de usuario.
- **Cuenta**: Administración de perfil y contraseñas.
- **Usuarios**: Gestión de usuarios y roles.
- **Roles**: Asigna permisos específicos a los usuarios.
- **Catálogo**: Administración de productos y servicios.
- **Pedidos**: Consulta y gestión de pedidos.
- **Carrito de Compras**: Gestión de productos en el carrito.
- **Favoritos**: Guarda productos o recursos favoritos para acceso rápido.
- **Comentarios**: Deja tus comentarios sobre la plataforma.
- **Conoce la Plataforma**: Acceso a documentación técnica.
- **Cerrar Sesión**: Logout seguro.

### Roles de Usuario Iniciales

El sistema está diseñado inicialmente con **dos roles**:

1. **Administrador**: Tiene acceso completo a todas las funcionalidades y módulos de la plataforma. El administrador puede gestionar usuarios, roles, productos, pedidos, entre otros.
2. **Cliente Normal**: Accede principalmente a funcionalidades relacionadas con la compra de productos, visualización de su cuenta, carrito de compras, y favoritos.

## Tecnologías Usadas

| **Tecnología**           | **Descripción**                                                                                                                                                                                                                                  |
|--------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **PHP**                  | Lenguaje de programación para backend y bases de datos.                                                                                                           |
| **Logging**              | Herramienta para registrar eventos y errores del sistema.                                                                                                      |
| **Testing**              | Pruebas unitarias y de integración para asegurar la funcionalidad.                                                                 |
| **Composer**             | Gestor de dependencias en PHP.                                                                                                                                                                     |
| **Docker (con WSL)**     | Plataforma para contenerización y escalabilidad.                                                                                                                                               |
| **Docker Compose**       | Herramienta para definir y ejecutar aplicaciones multi-contenedor.                                                                 |
| **Make**                 | Automatiza tareas repetitivas del proyecto.                                                                                                                                                                   |

---

## Créditos

| **Recurso**                        | **Descripción**                                                                                               | **Enlace**                                              |
|------------------------------------|---------------------------------------------------------------------------------------------------------------|---------------------------------------------------------|
| **Plantilla de la aplicación**     | Plantilla utilizada para la interfaz de usuario.                                                              | [W3Layouts](http://w3layouts.com)                        |
| **Licencia de la plantilla**       | Licencia de la plantilla bajo Creative Commons Attribution 3.0 Unported.                                      | [Creative Commons License](http://creativecommons.org/licenses/by/3.0/) |
| **Imágenes de productos**          | Imágenes de productos obtenidas de Amazon.                                                                     | [Amazon](https://www.amazon.com)                         |
---

## Usuarios Ficticios para Pruebas

| **Nombre**                     | **Correo**                        | **Contraseña** | **Rol**         |
|---------------------------------|-----------------------------------|----------------|-----------------|
| Administrador                   | admin@cms.com                     | password       | Administrador   |
| Luis Fernando Ramos             | luis.ramos@pablogarciajc.com       | password       | Cliente         |
| Marco Antonio Santis            | santis@pablogarciajc.com          | password       | Cliente         |
| Juan Carlos Pérez               | juan.perez@pablogarciajc.com      | password       | Cliente         |
| Ana María López                 | ana.lopez@pablogarciajc.com       | password       | Cliente         |
| Carlos Alberto Rodríguez        | carlos.rodriguez@pablogarciajc.com| password       | Cliente         |
| Lucía Fernanda Mendoza          | lucia.mendoza@pablogarciajc.com   | password       | Cliente         |
| Pedro Luis Gómez                | pedro.gomez@pablogarciajc.com     | password       | Cliente         |
| Sofía Alejandra Martínez        | sofia.martinez@pablogarciajc.com  | password       | Cliente         |
| Diego Armando Herrera           | diego.herrera@pablogarciajc.com   | password       | Cliente         |
| María Isabel González           | maria.gonzalez@pablogarciajc.com  | password       | Cliente         |
| Javier Ernesto Ortiz            | javier.ortiz@pablogarciajc.com    | password       | Cliente         |
| Laura Patricia Vega             | laura.vega@pablogarciajc.com      | password       | Cliente         |

---

## Instalación

### Requisitos Previos

- Tener **Docker** y **Docker Compose** instalados.
- **Make**: Utilizado para automatizar procesos y gestionar contenedores de manera más eficiente.

### Pasos de Instalación

1. Clona el repositorio desde GitHub.
2. Dentro del repositorio, encontrarás un archivo **Makefile** que contiene los comandos necesarios para iniciar y gestionar tu aplicación.
3. Usa los siguientes comandos de **Make** para interactuar con la aplicación:

   - **`make init-app`**: Inicializa los contenedores y configura la aplicación.
   - **`make up`**: Levanta la aplicación y sus contenedores asociados.
   - **`make down`**: Detiene los contenedores y apaga la aplicación.
   - **`make shell`**: Ingresa al contenedor para interactuar directamente con el sistema en su entorno de ejecución.

4. Además de estos comandos, dentro del archivo **Makefile** puedes encontrar otros comandos que te permitirán interactuar de manera más específica con los contenedores y los diferentes servicios que conforman la aplicación.

5. Accede a los siguientes endpoints:
   - **Aplicación Web**: [http://localhost:8081/](http://localhost:8081/)
   - **PhpMyAdmin**: [http://localhost:8082/](http://localhost:8082/)

---

## Contáctame para más información o preguntas

| Redes Sociales  | Desarrollador de Aplicaciones Web |
| ------------- | ------------- |
| ![Web Icono](https://pablogarciajc.com/wp-content/uploads/2024/04/web.png) | **[www.pablogarciajc.com](https://pablogarciajc.com/)** |
| ![Facebook](https://pablogarciajc.com/wp-content/uploads/2024/04/facebook.png) | **[@pablogarciajc](https://www.facebook.com/PabloGarciaJC)** |
| ![LinkedIn](https://pablogarciajc.com/wp-content/uploads/2024/04/linkedin.png) | **[@pablogarciajc](https://www.linkedin.com/in/pablogarciajc/)** |

> _"El buen trabajo es la solución de hoy, para construir el futuro del mañana."_
