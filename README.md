# study-symfony-4

### About

Study of SF4 + Docker.

### Steps

- [x] ``` docker run --rm -v $(pwd):/app composer:1.5.1 create-project symfony/skeleton sf4  ```
- [x] Inside downloaded folder: ``` docker run --rm -v $(pwd):/app composer:1.5.1 require server ```
- [x] ``` docker run --rm --name sf4_server -v $(pwd):/var/www/html -p 8000:8000 trafex/alpine-nginx-php7 /var/www/html/bin/console server:run 0.0.0.0:8000 ```
( if want to destroy it : ``` docker rm -f sf4_server ``` )
- [x] ``` docker run --rm -v $(pwd):/app composer:1.5.1 require req-checker ```
- [x] ``` docker run --rm -v $(pwd):/var/www/html -p 8000:8000 trafex/alpine-nginx-php7 php /var/www/html/vendor/bin/requirements-checker ```


@todo:

- [ ] Replace PHP7 docker run image to something like this : ``` docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:7.0-cli php your-script.php ``` or ``` docker run -d -p 80:80 --name my-apache-php-app -v "$PWD":/var/www/html php:7.0-apache ```


References: https://symfony.com/doc/master/setup.html
