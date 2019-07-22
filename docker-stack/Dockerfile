FROM php:7.3-fpm
LABEL maintainer "Ahmet AKŞİT <ahmetaksit@gmail.com>"

# install the PHP extensions we need
RUN set -ex; \
	\
	savedAptMark="$(apt-mark showmanual)"; \
	\
	apt-get update; \
	apt-get install -y --no-install-recommends \
		libjpeg-dev \
		libpng-dev \
		libzip-dev \
	; \
	\
	docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr; \
	docker-php-ext-install gd mysqli opcache zip; \
	\

# reset apt-mark's "manual" list so that "purge --auto-remove" will remove all build dependencies
	apt-mark auto '.*' > /dev/null; \
	apt-mark manual $savedAptMark; \
	ldd "$(php -r 'echo ini_get("extension_dir");')"/*.so \
		| awk '/=>/ { print $3 }' \
		| sort -u \
		| xargs -r dpkg-query -S \
		| cut -d: -f1 \
		| sort -u \
		| xargs -rt apt-mark manual; \
	\
	apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false; \
	rm -rf /var/lib/apt/lists/*

# set recommended PHP.ini settings
# see https://secure.php.net/manual/en/opcache.installation.php
RUN { \
		echo 'opcache.memory_consumption=128'; \
		echo 'opcache.interned_strings_buffer=8'; \
		echo 'opcache.max_accelerated_files=4000'; \
		echo 'opcache.revalidate_freq=2'; \
		echo 'opcache.fast_shutdown=1'; \
		echo 'opcache.enable_cli=1'; \
	} > /usr/local/etc/php/conf.d/opcache-recommended.ini

# Configure_Error_Logging
RUN { \
		echo 'error_reporting = 4339'; \
		echo 'display_errors = Off'; \
		echo 'display_startup_errors = Off'; \
		echo 'log_errors = On'; \
		echo 'error_log = /dev/stderr'; \
		echo 'log_errors_max_len = 1024'; \
		echo 'ignore_repeated_errors = On'; \
		echo 'ignore_repeated_source = Off'; \
		echo 'html_errors = Off'; \
	} > /usr/local/etc/php/conf.d/error-logging.ini

VOLUME /var/www/html

ENV PROJECT_DIR=/var/www/html \
    APP_URL=localhost

ENV CODEIGNITER_VERSION 3.1.10
ENV CODEIGNITER_SHA1 b920007b9488d11fdd82c01b1331706869dc338f

RUN set -ex; \
	curl -o codeigniter.tar.gz -fSL "https://github.com/bcit-ci/CodeIgniter/archive/${CODEIGNITER_VERSION}.tar.gz"; \
	echo "$CODEIGNITER_SHA1 *codeigniter.tar.gz" | sha1sum -c -; \
# upstream tarballs include ./codeigniter/ so this gives us /usr/src/codeigniter
	tar -xzf codeigniter.tar.gz -C /usr/src/; \
	rm codeigniter.tar.gz; \
	chown -R www-data:www-data /usr/src/codeigniter

#RUN docker-php-ext-install mysqli gettext
#RUN a2enmod rewrite

#COPY ./src $PROJECT_DIR
#COPY ./docker-stack/docker-entrypoint.sh /entrypoint.sh

#RUN sed -i 's/\r//' /entrypoint.sh

#VOLUME $PROJECT_DIR/storage

#ENTRYPOINT ["/bin/bash", "/entrypoint.sh"]
#CMD ["run"]

CMD ["php-fpm"]