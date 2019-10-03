# Resty , the PhP Framework For Restful APIs ( BETA , DEV, ON TEST )

Why ***Resty*** ? Cause it's make restful API. One simplest way to create, handle and manage your restful API. Lighter, less code for more performance. Resty is for you, Resty is made for you.



# Table of Contents

 - [Requirements](#requirements)
 - [Installation](#installation)
 - [Manual](#manual)
   - [Structure](#resty-tree)
   - [Configuration](#configuration)
   - [Add new controllers](#add-new-controllers)
   - [Add new routes](#add-new-routes)
   - [Snippets](#snippets)
   - [Just Try](#just-try)
 - [Third-Party](#third-party)
 - [License](#Licence)



## Requirements

* Php >= 7.2
* Curl



## Installation

**Easily from Packagist**
```sh
$ composer require ludndev/resty
```

**Another way**
You can install it by cloning from github. Use composer to install dependancies.
```sh
$ git clone https://github.com/ludndev/resty-php-framework.git
$ cd path/to/resty/
$ composer install
```


## Manual



### Resty Tree

```md
+-- controllers
|   +-- controller.php
|   +-- products
|       +-- create.php
+-- providers
|   +-- DBController.php
|   +-- Header.php
|   +-- MOError.php
|   +-- Paginate.php
|   +-- Response.php
|   +-- Rest.php
|   +-- Router.php
|   +-- Shared.php
+-- routes
|   +-- default.php
|   +-- products.html
+-- tests
|   +-- client.php
|   +-- seeds.php
|   +-- test-database.sql
|   +-- test.php
|   +-- members.yml
+-- .env
+-- .env.example
+-- api.php
+-- composer.json
+-- README.md
```



### Configuration

Simply edit your `.env` file on **Resty** root app. If there is no .env file, create it from `.env.example`.

```md
# Resty Common settings
APP_NAME = "Resty API"
APP_VERSION = "1.0"
APP_URL = "http://localhost:8000"
APP_EMAIL = "webmaster@email.tld"


# Database settings
DB_DRIVER = "mysql"
DB_HOST = "database_host"
DB_NAME = "database_name"
DB_USER = "database_username"
DB_PASS = "database_password"
```



### Add new controllers

1. You can add controllers manually to routes folder on `/resty/controllers/`.

2. Or by using the Command Line Tools
```sh
$ php rshell command
```



### Add new routes

1. You can add routes manually to routes folder on `/resty/routes/`.

2. Or by using the Command Line Tools
```sh
$ php rshell command
```



### Snippets
**Cause** we love *code*, there is some snippets for you.
(VSCode Snippet)[http://link.to]
(Sublime Text)[http://link.to]



### Just Try

You can populate **Resty** with default data. Here is how to do.
```sh
$ php rshell command
```



## Third Party

Reads docs. Tools used to :
* [phroute/phroute](https://link____)
* [vlucas/phpdotenv](https://link____)
* [guzzlehttp/guzzle](https://link____)
* [fzaninotto/faker](https://link____)



## Licence

**Resty** is released under the MIT Licence. See the bundled [LICENSE](LICENCE) file for details.



