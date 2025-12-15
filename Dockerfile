FROM php:8.2-cli

# Dossier de travail
WORKDIR /var/www/html

# Dépendances système
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

# Copier TOUT le projet
COPY . .

# Permissions nécessaires à Laravel + SQLite
RUN chmod -R ug+rwx storage bootstrap/cache



# Exposer le port Render
EXPOSE 10000

# Lancer le serveur PHP
CMD ["php", "-S", "0.0.0.0:10000", "-t", "public"]
