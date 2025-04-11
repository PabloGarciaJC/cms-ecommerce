## ---------------------------------------------------------
## Utilizar una imagen base de PHP con Apache
## ---------------------------------------------------------

FROM php:8.2-apache

## ---------------------------------------------------------
## Argumentos
## ---------------------------------------------------------

ARG NEW_UID
ARG NEW_GID
ARG MY_USER
ARG MY_GROUP

## ---------------------------------------------------------
## Habilitar e instalar extensiones y librerías necesarias
## ---------------------------------------------------------

RUN set -eux && \
    groupadd -g ${NEW_GID} -r ${MY_GROUP} && \
    useradd -u ${NEW_UID} -m -s /bin/bash -g ${MY_GROUP} ${MY_USER} && \
    apt-get update && apt-get install -y \
    tzdata \
    nano \
    git \
    zlib1g-dev \
    && ln -fs /usr/share/zoneinfo/Europe/Madrid /etc/localtime && \
    dpkg-reconfigure -f noninteractive tzdata && \
    docker-php-ext-install -j$(nproc) mysqli pdo_mysql && \
    docker-php-ext-enable mysqli pdo_mysql && \
    a2enmod rewrite && \
    apt-get clean && rm -rf /var/lib/apt/lists/* && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer


## ---------------------------------------------------------
## Copiar el contenido de la aplicación
## ---------------------------------------------------------

COPY . /var/www/html

## ---------------------------------------------------------
## Configurar bash
# Configuración personalizada del entorno de la terminal para usuario y root.
# Incluye alias, variables de entorno y configuración de sudo sin contraseña.
## ---------------------------------------------------------

RUN echo ". /etc/terminal" | tee -a /home/${MY_USER}/.bashrc /root/.bashrc && \
    chown ${MY_USER}:${MY_GROUP} /home/${MY_USER}/.bashrc
COPY ./php_server/bash/terminal /etc/terminal
COPY ./php_server/bash/sudo-user /etc/sudoers.d/sudo-user

## ---------------------------------------------------------
## Copiar y habilitar la configuración de Apache
## ---------------------------------------------------------

COPY ./php_server/host/virtual-host.conf /etc/apache2/sites-available/virtual-host.conf
RUN a2ensite virtual-host.conf 
RUN a2dissite 000-default.conf
    
## ---------------------------------------------------------
## Agregar ServerName a la configuración global de Apache
# Añade 'ServerName localhost' a la configuración global de Apache para evitar un warning al iniciar Apache.
## ---------------------------------------------------------

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

## ---------------------------------------------------------
## Exponer el puerto 80
## ---------------------------------------------------------

EXPOSE 80

## ---------------------------------------------------------
## Comando por defecto
# 'docker-php-entrypoint' inicializa el entorno PHP y 'apache2-foreground' ejecuta Apache en primer plano.
## ---------------------------------------------------------

ENTRYPOINT ["docker-php-entrypoint"]
CMD ["apache2-foreground"]
