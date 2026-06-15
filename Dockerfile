FROM php:8.1-cli

# Install required PHP extensions
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    git \
    curl \
    libpq-dev \
    && docker-php-ext-install pdo_mysql \
    && apt-get clean

WORKDIR /app

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000"]
