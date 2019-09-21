FROM kimbtechnologies/php_nginx:latest

RUN apk add --update --no-cache $PHPIZE_DEPS \
	&& pecl install redis \
	&& docker-php-ext-enable redis