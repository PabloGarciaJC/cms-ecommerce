<?php include __DIR__ . '../../layout/header.php'; ?>
<div class="panel-admin__flex-container">
    <?php include __DIR__ . '../../layout/sidebar.php'; ?>
    <main class="panel-admin__main-content">
        <section class="panel-admin__dashboard">
            <h2 class="panel-admin__dashboard-title">Tecnologías Empleadas para el Desarrollo</h2>

            <div class="row">
                <!-- Tarjetas con más padding y fondo restaurado -->
                <div class="col-12 col-md-4 mb-4">
                    <div class="card info-card feature-card h-100 shadow-sm bg-light border-light">
                        <div class="card-header">
                            <h3><i class="bi bi-code-slash"></i> Laravel</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p>Framework PHP robusto y eficiente utilizado para el desarrollo del back-end de la aplicación. Facilita la creación de aplicaciones web seguras, escalables y fáciles de mantener.</p>
                            <p><a href="https://laravel.com/docs" target="_blank" class="btn btn-link p-0">Documentación de Laravel</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card info-card feature-card h-100 shadow-sm bg-light border-light">
                        <div class="card-header">
                            <h3><i class="bi bi-arrow-repeat"></i> Laravel Mix</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p>Herramienta de compilación de assets basada en Webpack, que facilita la gestión de archivos CSS y JavaScript, mejorando la eficiencia en el desarrollo front-end.</p>
                            <p><a href="https://laravel-mix.com/docs" target="_blank" class="btn btn-link p-0">Documentación de Laravel Mix</a></p>
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
                            <h3><i class="bi bi-cloud-download"></i> Postman</h3>
                        </div>
                        <div class="card-body-info p-4">
                            <p>Herramienta utilizada para probar y documentar los endpoints de la API. Con Postman, realizamos solicitudes HTTP y verificamos las respuestas de la API para asegurar su correcto funcionamiento.</p>
                            <p><a href="https://www.postman.com/docs" target="_blank" class="btn btn-link p-0">Documentación de Postman</a></p>
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

        </section>
    </main>
</div>
