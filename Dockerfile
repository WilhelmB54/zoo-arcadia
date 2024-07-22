# Utiliser une image PHP officielle avec Apache et PHP 8.2
FROM php:8.2-apache

# Installer les extensions nécessaires
RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql

# Copier les fichiers du projet dans le répertoire de l'application dans le conteneur
COPY . /var/www/html/

# Copier le fichier de configuration Apache depuis le répertoire local
COPY zooarcadia.conf /etc/apache2/sites-available/zooarcadia.conf

# Assurer que le répertoire a les bonnes permissions pour le serveur Apache
RUN chown -R www-data:www-data /var/www/html

# Activer la configuration du site
RUN a2ensite zooarcadia.conf

# Modifier la configuration d'Apache pour écouter sur le port 8080
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf

# Exposer le port 8080 pour que l'application soit accessible depuis ce port
EXPOSE 8080

# La commande par défaut pour démarrer Apache
CMD ["apache2-foreground"]
