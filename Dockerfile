# Gunakan base image PHP + Apache
FROM php:8.1-apache

# Install ekstensi yang dibutuhkan CodeIgniter
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Aktifkan mod_rewrite Apache (penting untuk routing CodeIgniter)
RUN a2enmod rewrite

# Copy file proyek ke dalam container
COPY . /var/www/html

# Set working directory di container
WORKDIR /var/www/html

# Set permission supaya Apache bisa akses
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Pastikan Apache listen di port 80
EXPOSE 80

# Jalankan Apache di foreground
CMD ["apache2-foreground"]
