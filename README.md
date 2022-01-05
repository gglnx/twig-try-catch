# `try/catch` for Twig

[![Packagist](https://img.shields.io/packagist/v/gglnx/twig-try-catch.svg)](https://packagist.org/packages/gglnx/twig-try-catch)

This library extends [Twig](https://twig.symfony.com/) with an tag to catch and handle exceptions:

```twig
{% try %}
  <li>{{ throws_exception() }}</li>
{% catch %}
  {# The exception can be accessed using `e` #}
  User Error: {{ e.message }}
{% endcatch %}
```

## Requirements

* Twig >=2.14 and Twig >=3.0
* PHP >=7.4

## Installation

The recommended way to install this loader is via [Composer](https://getcomposer.org/):

```bash
composer require gglnx/twig-try-catch
```

You can install this library as extension in:  

```php
require_once '/path/to/vendor/autoload.php';

$twig = new \Twig\Environment($loader);
$twig->addExtension(new \Gglnx\TwigTryCatch\Extension\TryCatchExtension());
```

## Acknowledgements

This extension is extracted from [Grav CMS](https://github.com/getgrav/grav). See the file headers and `LICENSE` file for copyright information.
