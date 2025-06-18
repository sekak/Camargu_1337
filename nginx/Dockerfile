FROM debian:bookworm

RUN apt-get update && apt-get install -y \
    nano \
    php8.2 \
    php8.2-fpm \
    php8.2-mysql \
    php8.2-cli \
    php8.2-opcache \
    php8.2-readline \
    php-common \
    nginx \
    curl \
    mariadb-client \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy custom Nginx configuration
COPY nginx/nginx.conf /etc/nginx/nginx.conf

# Create web root and copy app files
RUN mkdir -p /var/www/html
COPY ./backend/ /var/www/html/

COPY ../nginx/script.sh /usr/local/bin/script.sh
RUN chmod +x /usr/local/bin/script.sh


# Expose port 80
EXPOSE 80

# Start both PHP-FPM and Nginx
CMD ["/usr/local/bin/script.sh"]

