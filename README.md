# Container Coding Sample Application

A sample application to go with Container Coding conference talk. It's not even remotely product-ready.

## Installation

Fetch the scripts by cloning the git repo: `git clone https://github.com/PSchwisow/container-coding.git`

To install dependencies, run `composer install` (with your correct composer path).

## Usage

The simplest way to run the application is using PHP's built-in webserver:

```
php -S localhost:8080 -t public public/routing.php
```

## Tests

To run the unit test suite:

```
./vendor/bin/phpunit
```

## License

Released under the ISC License. See `LICENSE`.
