FROM php:8.2-apache

# 必要なモジュールをインストール
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_mysql

# Apacheの設定
RUN a2enmod rewrite