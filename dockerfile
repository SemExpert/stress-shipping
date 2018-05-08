FROM webdevops/php-nginx:7.0

COPY .dev-certificates/testing.vm.crt /opt/docker/etc/nginx/ssl/server.crt
COPY .dev-certificates/testing.vm.key /opt/docker/etc/nginx/ssl/server.key