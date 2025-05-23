FROM php:8.1-cli

# Installer mysqli
RUN docker-php-ext-install mysqli

# Copier les fichiers PHP dans le conteneur
COPY . /var/www/html

# Définir le dossier de travail
WORKDIR /var/www/html

# Exposer le port utilisé
EXPOSE 80

# Lancer le serveur PHP
CMD ["php", "-S", "0.0.0.0:80"]
