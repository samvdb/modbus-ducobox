# ducobox-modbus-php

Experimental project to read and write values to a Ducobox connected over modbus tcp.

I am using a ``USR-TCP232-410S`` to create a TCP modbus server of my ducobox.

Once the docker containers are running you make the following http calls.

```http://localhost:81/all/5``` <-- show all data, includes node 1 (main unit) and node  2,3,4,5. Currently only supports valves.
```http://localhost:81/n``` <--- n is the node number of your device (eg. 1 for the main unit)
```http://localhost:81/set/1/ventilation_position/50```  <--- this sets the main unit's ventilation to 50%


Modify the .env file in the project with your unit's info:

```dotenv
UNIT_ID=1
HOST=x.x.x.x
PORT=502
```

Unit id will most likely be 1.
In ducobox set the external configuration to "ReggOffset=1"


Make sure to run composer install after running docker-compose up -d

```bash
$ docker-compose exec php-fpm bash
$ composer install
```

After this you should be up and running.

### About

Basic structure of SF4 + Docker.

``` docker-compose up -d ```

- See ```http://localhost```

Tips:
- Execute docker commands inside php docker container ``` docker-compose exec php-fpm bash ```
- Use 'console' to help and create things ``` bin/console make:controller lie ```
- Checking Requirements: ```php vendor/bin/requirements-checker ```

References: 
- https://symfony.com/doc/master/setup.html
- http://blog.joeymasip.com/docker-for-symfony-4/
