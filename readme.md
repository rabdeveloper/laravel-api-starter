# Laravel Api Starter

[![Build Status](https://scrutinizer-ci.com/g/kingscode/laravel-api-starter/badges/build.png?b=master)](https://scrutinizer-ci.com/g/kingscode/laravel-api-starter/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/kingscode/laravel-api-starter/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/kingscode/laravel-api-starter/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/kingscode/laravel-api-starter/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kingscode/laravel-api-starter/?branch=master)

Our base `laravel/laravel` installation for `vue` front-end applications.

## Usage
```bash
composer create-project kingscode/laravel-api-starter --stability=dev --prefer-source
```

Then after following the [installation](#installation) steps you'll have an OAuth client with the credentials:
```bash
id: 1
secret: 384WFKbLe729R2fw7ZRvK1DuGVwpAhct774DYkTI
```

There'll also be a default user with the credentials:
```bash
email: info@kingscode.nl
password: secret
```

## Installation
### With Docker
Docker helps a ton by providing us a unison development environment that allows us to quickly install new dependencies and share the configuration of those.

Begin by pulling the docker containers and booting docker.
```bash
$ docker-compose up --build -d
```

Then get into the `app` container.
```bash
$ docker exec -it app bash
```

And run the following commands.
```bash
$ cp .env.example .env
$ composer install
$ pa key:generate
$ pa migrate
$ pa passport:keys
$ pa passport:client --password
$ pa db:seed
```

### Without Docker
You can also run without Docker but you'll have to do the walk of atonement. 

Start by setting up your environment and installing dependencies.

Then run the following to copy the `.env` file and fill it accordingly:
```bash
$ cp .env.example .env
```

And run the following commands to get it all booted up.
```bash
$ composer install
$ php artisan key:generate
$ php artisan migrate
$ php artisan passport:keys
$ php artisan passport:client --password
$ php artisan db:seed
```

<img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse2.explicit.bing.net%2Fth%3Fid%3DOIP.yP-yT-o8-1XeZ205ANoVKwHaD_%26pid%3DApi&f=1">
