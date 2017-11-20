FROM php:7-fpm

RUN apt-get update && \
    apt-get install -y wget apt-transport-https lsb-release ca-certificates && \
    wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg && \
    echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list && \
    apt-get update && \
    apt-get install -y php-mbstring php-xml php-gd
# install npm
RUN curl -sL https://deb.nodesource.com/setup_8.x | bash && \
    apt-get install -y nodejs
## install yarn
RUN npm install -g yarn
WORKDIR /var/www/html

#RUN chmod 777 -R /var/www/html/public/ /var/www/html/bootstrap/ /var/www/html/storage/

