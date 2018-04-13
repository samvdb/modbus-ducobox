# docker-symfony-4

### About

Basic structure of SF4 + Docker.

``` docker-compose up -d ```

- See ```http://localhost```
- See ```http://localhost/lie```

Tips:
- Execute docker commands inside php docker container ``` docker-compose exec php-fpm bash ```
- Use 'console' to help and create things ``` bin/console make:controller lie ```
- Checking Requirements: ```php vendor/bin/requirements-checker ```

References: https://symfony.com/doc/master/setup.html
