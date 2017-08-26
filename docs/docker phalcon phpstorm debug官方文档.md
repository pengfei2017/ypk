https://docs.phalconphp.com/hr/3.2/environments-docker

https://phalconphp.com/en/download/docker

https://phalcon-compose.readme.io/


https://gist.github.com/chadrien/c90927ec2d160ffea9c4
This is how i solved this using Mac Sierra, Docker Native Version 1.12.1, PhpStorm 2016.3 EAP, https://github.com/shincoder/homestead-docker:

n provision.sh

# Enable Remote xdebug
echo "xdebug.idekey = PHPSTORM" >> /etc/php/7.0/fpm/conf.d/20-xdebug.ini
echo "xdebug.default_enable = 0" >> /etc/php/7.0/fpm/conf.d/20-xdebug.ini
echo "xdebug.remote_enable = 1" >> /etc/php/7.0/fpm/conf.d/20-xdebug.ini
echo "xdebug.remote_autostart = 0" >> /etc/php/7.0/fpm/conf.d/20-xdebug.ini
echo "xdebug.remote_connect_back = 0" >> /etc/php/7.0/fpm/conf.d/20-xdebug.ini
echo "xdebug.profiler_enable = 0" >> /etc/php/7.0/fpm/conf.d/20-xdebug.ini
echo "xdebug.remote_host = 10.254.254.254" >> /etc/php/7.0/fpm/conf.d/20-xdebug.ini
in docker-compose.yml

expose:
        - "9000"
    ports:
        - "8080:80" # web
        - "2222:22" # ssh
        - "35729:35729" # live reload
        - "9876:9876" # karma server
    environment:
        PHP_XDEBUG_ENABLED: 1 # Set 1 to enable.
        XDEBUG_CONFIG: remote_host=10.254.254.254
The IP i used everywhere is for my local mac, the one with phpStorm installed on. The IP is not 10.254.254.254 but since the IP could change i made an alias that points to 127.0.0.1.

For some reason i didn't work with 127.0.0.1 in all settings, i guess Docker container sees it at it self?

Anyway, to create the alias i did:

sudo ifconfig en0 alias 10.254.254.254 255.255.255.0
in phpStorm i used all default settings but added this: