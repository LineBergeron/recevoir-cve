FROM php:8.1-cli

# Installation des dépendances nécessaires pour mysqli
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli

# Copier les fichiers dans le conteneur
COPY . /var/www/html

# Définir le répertoire de travail
WORKDIR /var/www/html

# Exposer le port utilisé par le serveur PHP intégré
EXPOSE 80

# Démarrer le serveur PHP
CMD ["php", "-S", "0.0.0.0:80"]
