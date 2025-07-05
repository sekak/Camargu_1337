FROM debian:bookworm

# Install PHP, extensions, and tools
RUN apt-get update && apt-get install -y \
    php-gd \
    php \
    php-cli \
    php-mbstring \
    php-xml \
    php-curl \
    php-mysql \
    unzip \
    git \
    curl \
    nginx \
    php-fpm \
    && apt-get clean

# Set working directory
WORKDIR /var/www/html

# Copy app source code
COPY ./backend /var/www/html

# Install PHPMailer with Composer

# Copy nginx config
COPY ../nginx/nginx.conf /etc/nginx/nginx.conf

# Create html dir if missing
RUN mkdir -p /var/www/html/public

# Start script
COPY ../nginx/script.sh /usr/local/bin/script.sh
RUN chmod +x /usr/local/bin/script.sh

CMD ["/usr/local/bin/script.sh"]
