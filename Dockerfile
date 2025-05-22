FROM php:8.1-cli

# Copie des fichiers dans le conteneur
COPY . /var/www/html

# Définir le répertoire de travail
WORKDIR /var/www/html

# Exposer le port utilisé par le serveur PHP intégré
EXPOSE 80

# Commande pour démarrer le serveur PHP
CMD ["php", "-S", "0.0.0.0:80"]
