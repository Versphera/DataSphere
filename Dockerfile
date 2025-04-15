# Gunakan image PHP + Apache
FROM php:8.2-apache

# Install ekstensi yang dibutuhkan (jika perlu)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Salin semua file project ke /var/www/html
COPY . /var/www/html/

# Aktifkan modul rewrite untuk CodeIgniter
RUN a2enmod rewrite

# Ubah konfigurasi Apache agar index.php bisa jalan
RUN sed -i 's!/var/www/html!/var/www/html/public!' /etc/apache2/sites-available/000-default.conf

# Set working directory
WORKDIR /var/www/html/public
