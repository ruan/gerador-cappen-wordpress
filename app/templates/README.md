# <%= name %>


## Requirements:

* PHP 7.1 or higher
* MySQL 5.7 or higher
* NodeJS (https://nodejs.org/)
* GruntJS (http://gruntjs.com/)
* Yeoman (http://yeoman.io/)
* Bower (http://bower.io/)
* Composer (https://getcomposer.org/)

## Installation

```bash
npm install
bower install
composer install
```

## Usage

- Open a command promp and go to root project;
- Copy `.env.example` to `.env` and update with your local configuration;
- When the installation is done, type `grunt app` to compile; This will run `watch` in dev mode; For production, type `grunt build`.
