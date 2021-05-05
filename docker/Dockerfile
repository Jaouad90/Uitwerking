FROM php:8.0-fpm-alpine

# Set timezone
RUN ln -snf /usr/share/zoneinfo/Etc/UTC /etc/localtime && echo Etc/UTC > /etc/timezone
RUN printf '[PHP]\ndate.timezone = "%s"\n', Etc/UTC > /usr/local/etc/php/conf.d/tzone.ini
RUN "date"

# Install the necessary tools
RUN apk update && \
    apk add --no-cache bash \
    nginx \
    nano \
    openssl \
    unzip \
    mysql-dev \
    npm \
    git \
    openssh \
    nodejs \
    $PHPIZE_DEPS && \
    docker-php-ext-install mysqli pdo pdo_mysql

# Composer dependencies
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Add php-upstream
RUN echo "upstream php-upstream { server 127.0.0.1:8000; }" > /etc/nginx/conf.d/upstream.conf

# Nginx configuration files
COPY nginx.conf /etc/nginx/nginx.conf
COPY laravel.conf /etc/nginx/conf.d/default.conf

# Test the configuration files
RUN nginx -t

# Copy and mark the entrypoint as an executable
COPY entrypoint.sh /etc/entrypoint.sh
RUN ["chmod", "+x", "/etc/entrypoint.sh"]

WORKDIR /var/www/html

EXPOSE 8000
ENTRYPOINT ["/etc/entrypoint.sh"]