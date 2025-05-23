FROM php:8.1-cli

# ✅ Installer l’extension mysqli
RUN docker-php-ext-install mysqli

# Copier les fichiers dans le conteneur
COPY . /var/www/html

# Définir le répertoire de travail
WORKDIR /var/www/html

# Exposer le port utilisé par le serveur PHP intégré
EXPOSE 80

# Lancer le serveur PHP intégré
CMD ["php", "-S", "0.0.0.0:80"]
