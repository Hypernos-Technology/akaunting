FROM php:8.2-fpm

ARG SUPPORTED_LOCALES="en_US.UTF-8"
ARG NODE_VERSION=20

RUN apt-get update \
    && apt-get -y upgrade --no-install-recommends \
    && apt-get install -y --no-install-recommends \
    build-essential \
    imagemagick \
    libfreetype6-dev \
    libicu-dev \
    libjpeg62-turbo-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libonig-dev \
    libpng-dev \
    libpq-dev \
    libssl-dev \
    libxml2-dev \
    libxrender1 \
    libzip-dev \
    locales \
    openssl \
    unzip \
    zip \
    zlib1g-dev \
    gnupg \
    && curl -sLS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer \
    && curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg \
    && echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_$NODE_VERSION.x nodistro main" > /etc/apt/sources.list.d/nodesource.list \
    && apt-get update \
    && apt-get install -y nodejs \
    && npm install -g npm \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN for locale in ${SUPPORTED_LOCALES}; do \
   sed -i 's/^# '"${locale}/${locale}/" /etc/locale.gen; done \
   && locale-gen

RUN docker-php-ext-configure gd \
   --with-freetype \
   --with-jpeg \
   && docker-php-ext-install -j$(nproc) \
   gd \
   bcmath \
   intl \
   mbstring \
   pcntl \
   pdo \
   pdo_mysql \
   zip

# Download Akaunting application
#RUN mkdir -p /var/www/akaunting \
#   && curl -Lo /tmp/akaunting.zip 'https://akaunting.com/download.php?version=latest&utm_source=docker&utm_campaign=developers' \
#   && unzip /tmp/akaunting.zip -d /var/www/html \
#   && rm -f /tmp/akaunting.zip

#COPY files/html /var/www/html

# Set working directory
WORKDIR /var/www/html

EXPOSE 9000

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

CMD ["--start"]
