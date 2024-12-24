# Menggunakan image PHP resmi dengan Apache
FROM php:8.1-apache

# Salin semua file dari folder proyek ke folder root di dalam container
COPY . /var/www/html/

# Pastikan folder root dapat diakses
RUN chown -R www-data:www-data /var/www/html

# Aktifkan module rewrite Apache untuk PHP
RUN a2enmod rewrite

# Atur working directory di dalam container
WORKDIR /var/www/html

# Expose port 80 agar server bisa diakses
EXPOSE 80

