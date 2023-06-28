FROM ghcr.io/immediatemediaco/php:8.1-composer-tests

COPY . /home/www-data/app

WORKDIR /home/www-data/app

RUN --mount=type=secret,id=COMPOSER_AUTH,target=/root/.composer/auth.json \
    composer update --no-scripts --no-progress --no-interaction --prefer-dist
