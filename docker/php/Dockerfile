FROM php:7.4-fpm

# composerインストール
COPY --from=composer /usr/bin/composer /usr/bin/composer

# npmインストール
COPY --from=node:10.22 /usr/local/bin /usr/local/bin
COPY --from=node:10.22 /usr/local/lib /usr/local/lib

# apt-get更新＆インストール
RUN apt-get update \
  && apt-get install -y \
  git \
  zip \
  unzip \
  libzip-dev \
  && docker-php-ext-install zip pdo_mysql

WORKDIR /var/www