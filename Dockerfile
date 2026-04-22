# syntax=docker/dockerfile:1.6

# -----------------------------------------------------------------------------
# Stage 1: Composer dependencies (PHP)
# The composer.lock pins packages that require PHP >= 8.4 and ext-gd.
# We --ignore-platform-reqs here because this stage only downloads tarballs
# and builds the autoloader; actual PHP code runs in the runtime stage, which
# has PHP 8.4 and all required extensions.
# -----------------------------------------------------------------------------
FROM composer:2.7 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --no-progress \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader \
    --ignore-platform-reqs

# -----------------------------------------------------------------------------
# Stage 2: Frontend assets (Node / Vite)
# -----------------------------------------------------------------------------
FROM node:20-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json vite.config.js ./
RUN npm ci --no-audit --no-fund

COPY resources ./resources
COPY public ./public
RUN npm run build

# -----------------------------------------------------------------------------
# Stage 3: Runtime (PHP-FPM + nginx + supervisor)
# -----------------------------------------------------------------------------
FROM php:8.4-fpm-alpine AS runtime

ENV APP_ENV=production \
    APP_DEBUG=false \
    COMPOSER_ALLOW_SUPERUSER=1 \
    PHP_OPCACHE_ENABLE=1 \
    PHP_OPCACHE_VALIDATE_TIMESTAMPS=0

RUN apk add --no-cache \
        nginx \
        supervisor \
        bash \
        mysql-client \
        tzdata \
        icu-libs \
        libzip \
        libpng \
        libjpeg-turbo \
        freetype \
        oniguruma \
        libxml2 \
    && apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        icu-dev \
        libzip-dev \
        libpng-dev \
        libjpeg-turbo-dev \
        freetype-dev \
        oniguruma-dev \
        libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        bcmath \
        pdo_mysql \
        mysqli \
        mbstring \
        xml \
        zip \
        gd \
        intl \
        exif \
        opcache \
    && apk del .build-deps \
    && rm -rf /var/cache/apk/*

ENV TZ=Europe/Madrid
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

WORKDIR /var/www/html

# Application code
COPY --chown=www-data:www-data . /var/www/html

# Vendored dependencies (from composer stage)
COPY --from=vendor --chown=www-data:www-data /app/vendor /var/www/html/vendor

# Compiled frontend assets (from node stage)
COPY --from=frontend --chown=www-data:www-data /app/public/build /var/www/html/public/build

# Runtime configuration
COPY docker/nginx.conf              /etc/nginx/nginx.conf
COPY docker/php.ini                 /usr/local/etc/php/conf.d/zz-app.ini
COPY docker/php-fpm.conf            /usr/local/etc/php-fpm.d/zz-app.conf
COPY docker/supervisord.conf        /etc/supervisor/conf.d/supervisord.conf
COPY docker/entrypoint.sh           /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh \
    && mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache public \
    && chmod -R 775 storage bootstrap/cache \
    && rm -rf tests tmp docker .github ANALISIS_*.md ESTILO_*.md IMPLEMENTACION_*.md

# Snapshot of bundled static images (logos, theme assets) — used by the
# entrypoint to seed the persistent volume mounted at public/assets/images.
RUN cp -r /var/www/html/public/assets/images /opt/bundled-assets-images \
    && cp -r /var/www/html/public/contratos  /opt/bundled-contratos     \
    && chown -R www-data:www-data /opt/bundled-assets-images /opt/bundled-contratos

EXPOSE 8080

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
