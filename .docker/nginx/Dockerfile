FROM library/nginx:1.18.0-alpine
COPY default.conf /etc/nginx/conf.d/
EXPOSE 80
WORKDIR /var/www/html
#ENTRYPOINT composer install --no-interaction --optimize-autoloader && php-fpm -F -R -D && nginx -g "daemon off;"
