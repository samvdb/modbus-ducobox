# study-symfony-4

### Steps

- [x] ``` docker run --rm -v $(pwd):/app composer:1.5.1 create-project symfony/skeleton sf4  ```
- [x] Inside downloaded folder: ``` docker run --rm -v $(pwd):/app composer:1.5.1 require server ```
- [x] ``` docker run --rm -v $(pwd):/var/www/html -p 8000:8000 trafex/alpine-nginx-php7 /var/www/html/bin/console server:run 0.0.0.0:8000 ```
