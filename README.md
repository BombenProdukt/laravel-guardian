## About laravel-guardian

This project was created by, and is maintained by [Brian Faust](https://github.com/faustbrian), and is a Laravel-based authentication system operating in a headless manner. Be sure to browse through the [changelog](CHANGELOG.md), [code of conduct](.github/CODE_OF_CONDUCT.md), [contribution guidelines](.github/CONTRIBUTING.md), [license](LICENSE), and [security policy](.github/SECURITY.md).

## TODO

- TOTP MFA
- SMS MFA
- EMAIL MFA
- PASSKEY MFA
- MAGICLINK LOGIN
- PASSWORDLESS LOGIN
- PASSPHRASE LOGIN

## Installation

> **Note**
> This package requires [PHP](https://www.php.net/) 8.2 or later, and it supports [Laravel](https://laravel.com/) 10 or later.

To get the latest version, simply require the project using [Composer](https://getcomposer.org/):

```bash
$ composer require bombenprodukt/laravel-guardian
```

You can publish the migrations by using:

```bash
$ php artisan vendor:publish --tag="laravel-guardian-migrations"
```

You can publish the configuration file by using:

```bash
$ php artisan vendor:publish --tag="laravel-guardian-config"
```

You can publish the views by using:

```bash
$ php artisan vendor:publish --tag="laravel-guardian-views"
```

## Usage

Please review the contents of [our test suite](/tests) for detailed usage examples.
