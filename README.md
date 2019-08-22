<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/Labs64/laravel-boilerplate"><img src="https://travis-ci.org/Labs64/laravel-boilerplate.svg" alt="Build Status"></a>
<a href="https://github.com/Labs64/laravel-boilerplate/blob/master/composer.json"><img src="https://img.shields.io/badge/php-%3E%3D%207.2-8892BF.svg" alt="PHP Badge"></a>
</p>

# Laravel 5 Boilerplate Ticket System Project

A simplified demand generation and management system written in Laravel 5.8
## Run

To start the PHP built-in server
```
$ php artisan serve --port=8080
or
$ php -S localhost:8080 -t public/
```

Now you can browse the site at [http://localhost:8080](http://localhost:8080)  🙌

## Docker

Here is a Docker based local development environment prepared, which provides a very flexible and extensible way of building your custom Laravel 5 applications.

### What's Inside
This project is based on [docker-compose](https://docs.docker.com/compose/). By default, the following containers are started: _laravel-env (centos:7 based), mysql, nginx_. Additional containers (_phpmyadmin, mailhog_) are externalized into `docker-compose.utils.yml`. The `/var/www/laravel-boilerplate` directory is the web root which is mapped to the nginx container.
You can directly edit configuration files from within the repo as they are mapped to the correct locations in containers.

<p align="center"><img src="https://raw.githubusercontent.com/Labs64/laravel-boilerplate/master/dockerfiles/img/laravel-boilerplate-docker.png" alt="Laravel Boilerplate Docker"></p>

### System Requirements
To be able to run Laravel Boilerplate you have to meet the following requirements:
* [docker](https://www.docker.com)
* [docker-compose](https://docs.docker.com/compose/)

### Run

1. Copy `.env.example` to `.env` and modify according to your environment (make sure database host set to `DB_HOST=mysql`)
```
$ cp project.env .env
```

2. Start environment
```
$ docker-compose up -d  # to start base containers
or
$ docker-compose -f docker-compose.yml -f docker-compose.utils.yml up -d  # to start base and utils containers
```

3. Build project
```
$ docker-compose run --rm ticket-system_laravel-env_1 ./dockerfiles/bin/prj-build.sh
```

Now you can browse the site at [http://localhost:80](http://localhost:80)  🙌

---

4. Stop environment
```
$ docker-compose down
 or
$ docker-compose -f docker-compose.yml -f docker-compose.utils.yml down
```