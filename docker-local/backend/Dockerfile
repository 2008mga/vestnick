FROM php:7-fpm

RUN apt-get update && \
    apt-get install -y wget apt-transport-https lsb-release ca-certificates && \
    wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg && \
    echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list && \
    apt-get update && \
    apt-get install -y php-mbstring php-xml php-gd git

WORKDIR /var/www/html

RUN pwd
#RUN chmod 777 -R /var/www/html/public/ /var/www/html/bootstrap/ /var/www/html/storage/

