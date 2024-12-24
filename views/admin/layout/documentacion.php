<?php include __DIR__ . '../../layout/header.php'; ?>
<div class="panel-admin__flex-container">
    <?php include __DIR__ . '../../layout/sidebar.php'; ?>
    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard">
            <h2 class="panel-admin__dashboard-title">Tecnologías Empleadas para el Desarrollo</h2>
            <div class="row">
                <div class="col-12 col-md-4 mb-4">
                    <div class="card info-card feature-card h-100 shadow-sm bg-light border-light">
                        <div class="card-header">
                            <h3><i class="bi bi-code-slash"></i> PHP</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p>PHP es un lenguaje de scripting ampliamente utilizado para el desarrollo de aplicaciones web dinámicas y sistemas backend.</p>
                            <p><a href="https://www.php.net/docs.php" target="_blank" class="btn btn-link p-0">Documentación de PHP</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card info-card feature-card h-100 shadow-sm bg-light border-light">
                        <div class="card-header">
                            <h3><i class="bi bi-file-earmark-text"></i> Logging</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p>El registro de eventos (logging) se utiliza para monitorear el estado de una aplicación, registrar errores y analizar el comportamiento de la misma.</p>
                            <p><a href="https://www.php-fig.org/psr/psr-3/" target="_blank" class="btn btn-link p-0">Documentación de PSR-3 (Logging)</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card info-card feature-card h-100 shadow-sm bg-light border-light">
                        <div class="card-header">
                            <h3><i class="bi bi-bug"></i> Testing</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p>Testing es una práctica fundamental en el desarrollo de software para garantizar que las funcionalidades de la aplicación operen correctamente y cumplan con los requisitos establecidos.</p>
                            <p><a href="https://phpunit.de/manual/current/en/" target="_blank" class="btn btn-link p-0">Documentación de PHPUnit</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card info-card feature-card h-100 shadow-sm bg-light border-light">
                        <div class="card-header">
                            <h3><i class="bi bi-file-earmark-code"></i> Composer</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p>Gestor de dependencias en PHP, utilizado para instalar y actualizar las bibliotecas y herramientas necesarias para el desarrollo de la aplicación.</p>
                            <p><a href="https://getcomposer.org/doc/" target="_blank" class="btn btn-link p-0">Documentación de Composer</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card info-card feature-card h-100 shadow-sm bg-light border-light">
                        <div class="card-header">
                            <h3><i class="bi bi-box"></i> Docker (con WSL)</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p>Plataforma que permite desarrollar, empaquetar y ejecutar aplicaciones en contenedores, garantizando consistencia y escalabilidad en cualquier entorno. En el caso de Windows, se utiliza WSL2 para permitir la ejecución de contenedores Docker en un entorno Linux virtualizado.</p>
                            <p><a href="https://www.docker.com/get-started" target="_blank" class="btn btn-link p-0">Documentación de Docker</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card info-card feature-card h-100 shadow-sm bg-light border-light">
                        <div class="card-header">
                            <h3><i class="bi bi-stack"></i> Docker Compose</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p>Herramienta para definir y ejecutar aplicaciones multi-contenedor en Docker, facilitando la gestión de servicios y entornos complejos.</p>
                            <p><a href="https://docs.docker.com/compose/" target="_blank" class="btn btn-link p-0">Documentación de Docker Compose</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card info-card feature-card h-100 shadow-sm bg-light border-light">
                        <div class="card-header">
                            <h3><i class="bi bi-grid"></i> Bootstrap</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p>Framework CSS para diseñar interfaces modernas, atractivas y responsivas con una amplia variedad de componentes listos para usar.</p>
                            <p><a href="https://getbootstrap.com/docs" target="_blank" class="btn btn-link p-0">Documentación de Bootstrap</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card info-card feature-card h-100 shadow-sm bg-light border-light">
                        <div class="card-header">
                            <h3><i class="bi bi-github"></i> GitHub</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p>Plataforma de control de versiones basada en Git, utilizada para almacenar y gestionar el código fuente, facilitando el trabajo colaborativo y el seguimiento de cambios.</p>
                            <p><a href="https://docs.github.com/en" target="_blank" class="btn btn-link p-0">Documentación de GitHub</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card info-card feature-card h-100 shadow-sm bg-light border-light">
                        <div class="card-header">
                            <h3><i class="bi bi-journal-text"></i> Notion</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p>Herramienta todo-en-uno para la organización de proyectos, tareas y documentación, facilitando la colaboración entre equipos y el seguimiento del progreso del desarrollo.</p>
                            <p><a href="https://www.notion.so" target="_blank" class="btn btn-link p-0">Página oficial de Notion</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card info-card feature-card h-100 shadow-sm bg-light border-light">
                        <div class="card-header">
                            <h3><i class="bi bi-check-circle"></i> Testing - PHPUnit</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p>Proceso de prueba de la aplicación para asegurar que todas las funcionalidades estén operando correctamente. Esto incluye pruebas unitarias, de integración y pruebas de usuario (UI).</p>
                            <p><a href="https://phpunit.de/manual/current/en/" target="_blank" class="btn btn-link p-0">Documentación de PHPUnit</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card info-card feature-card h-100 shadow-sm bg-light border-light">
                        <div class="card-header">
                            <h3><i class="bi bi-cogs"></i> Make</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p>Make es una herramienta de automatización que utilicé para simplificar la ejecución de tareas repetitivas. En este proyecto, la utilicé para automatizar procesos como el levantamiento de Docker, la ejecución de pruebas y la gestión de contenedores, optimizando el flujo de trabajo.</p>
                            <p><a href="https://www.gnu.org/software/make/manual/" target="_blank" class="btn btn-link p-0">Documentación de Make</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card info-card feature-card h-100 shadow-sm bg-light border-light">
                        <div class="card-header">
                            <h3><i class="bi bi-terminal"></i> Ubuntu con WSL</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p>Utilicé Ubuntu a través de WSL (Windows Subsystem for Linux) para proporcionar un entorno de desarrollo Linux en mi máquina Windows. Esto me permitió trabajar con herramientas y tecnologías nativas de Linux, como Docker, sin necesidad de una máquina virtual o un sistema operativo dual.</p>
                            <p><a href="https://learn.microsoft.com/en-us/windows/wsl/" target="_blank" class="btn btn-link p-0">Documentación de WSL</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="panel-admin__dashboard-title">Usuarios Ficticios para Pruebas</h2>
            <div class="row">
                <div class="col-12 col-md-4 mb-4">
                    <div class="card info-card feature-card h-100 shadow-sm bg-light border-light">
                        <div class="card-header">
                            <h3><i class="bi bi-person-circle"></i> Administrador</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p><strong>Correo:</strong> admin@cms.com</p>
                            <p><strong>Contraseña:</strong> password</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card info-card feature-card h-100 shadow-sm bg-light border-light">
                        <div class="card-header">
                            <h3><i class="bi bi-person-circle"></i> Cliente de Prueba</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p><strong>Correo:</strong> cliente@user.com</p>
                            <p><strong>Contraseña:</strong> password</p>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="panel-admin__dashboard-title">Contáctame / Sígueme en mis redes sociales</h2>
            <div class="row">
                <div class="col-12 col-md-4 mb-4">
                    <div class="card info-card feature-card h-100 shadow-sm bg-light border-light">
                        <div class="card-header">
                            <h3><i class="bi bi-github"></i> GitHub</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p>Visita mi perfil en GitHub para ver mis proyectos y contribuciones al código abierto.</p>
                            <p><a href="https://github.com/PabloGarciaJC" target="_blank" class="btn btn-link p-0">Ir a GitHub</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card info-card feature-card h-100 shadow-sm bg-light border-light">
                        <div class="card-header">
                            <h3><i class="bi bi-facebook"></i> Facebook</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p>Conéctate conmigo en Facebook y mantente al tanto de mis actualizaciones personales y profesionales.</p>
                            <p><a href="https://www.facebook.com/PabloGarciaJC" target="_blank" class="btn btn-link p-0">Ir a Facebook</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card info-card feature-card h-100 shadow-sm bg-light border-light">
                        <div class="card-header">
                            <h3><i class="bi bi-youtube"></i> YouTube</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p>Visita mi canal de YouTube para ver videos sobre desarrollo web, tutoriales y más.</p>
                            <p><a href="https://www.youtube.com/channel/UC5I4oY7BeNwT4gBu1ZKsEhw" target="_blank" class="btn btn-link p-0">Ir a YouTube</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card info-card feature-card h-100 shadow-sm bg-light border-light">
                        <div class="card-header">
                            <h3><i class="bi bi-globe"></i> Página Web</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p>Visita mi página web personal donde encontrarás más sobre mis proyectos y servicios.</p>
                            <p><a href="https://pablogarciajc.com/" target="_blank" class="btn btn-link p-0">Ir a mi página web</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card info-card feature-card h-100 shadow-sm bg-light border-light">
                        <div class="card-header">
                            <h3><i class="bi bi-linkedin"></i> LinkedIn</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p>Conéctate conmigo en LinkedIn para seguir mi carrera profesional y establecer conexiones.</p>
                            <p><a href="https://www.linkedin.com/in/pablogarciajc/" target="_blank" class="btn btn-link p-0">Ir a LinkedIn</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card info-card feature-card h-100 shadow-sm bg-light border-light">
                        <div class="card-header">
                            <h3><i class="bi bi-instagram"></i> Instagram</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p>Sigue mi cuenta de Instagram para ver fotos, proyectos y más contenido relacionado con mi trabajo.</p>
                            <p><a href="https://www.instagram.com/pablogarciajc/" target="_blank" class="btn btn-link p-0">Ir a Instagram</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card info-card feature-card h-100 shadow-sm bg-light border-light">
                        <div class="card-header">
                            <h3><i class="bi bi-twitter"></i> Twitter</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p>Sigue mi cuenta de Twitter para estar al tanto de mis proyectos, pensamientos y actualizaciones.</p>
                            <p><a href="https://x.com/PabloGarciaJC?t=lct1gxvE8DkqAr8dgxrHIw&s=09" target="_blank" class="btn btn-link p-0">Ir a Twitter</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>