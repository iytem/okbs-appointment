FROM php:7-fpm

ENV PROJECT_DIR=/var/www/html \
    APP_URL=localhost

RUN docker-php-ext-install mysqli gettext
#RUN a2enmod rewrite

COPY ./src $PROJECT_DIR
COPY ./docker-stack/docker-entrypoint.sh /entrypoint.sh

RUN sed -i 's/\r//' /entrypoint.sh

VOLUME $PROJECT_DIR/storage

#ENTRYPOINT ["/bin/bash", "/entrypoint.sh"]
#CMD ["run"]

CMD ["php-fpm"]