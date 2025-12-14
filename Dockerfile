FROM php:8.2-cli

# Dépendances système
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libsqlite3-dev \
    libzip-dev \
    zip \
    curl \
    && docker-php-ext-install pdo pdo_sqlite zip \
    && rm -rf /var/lib/apt/lists/*

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Dossier de travail
WORKDIR /var/www

# Copier le projet
COPY . .

# Installer dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Générer clé + migrer
RUN php artisan key:generate \
 && php artisan migrate --force

# Port Render
EXPOSE 10000

# Lancer Laravel
CMD php artisan serve --host=0.0.0.0 --port=10000
