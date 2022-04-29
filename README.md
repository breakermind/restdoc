# RestDoc
Rest api documentation library.

## Install
```sh
composer require breakermind/restdoc 1.0.*
```

### Update packages
```sh
# update
composer update

# refresh
composer dump-autoload -o
```

### Publish routes
```sh
# edit routes routes/restdoc.php
php artisan vendor:publish --tag=restdoc-routes
```

### Add RestDoc routes (restdoc example)
```php
<?php
// Add in routes/routes.php
require_once('restdoc/routes.php');
```

### Run in browser
```sh
http://localhost/doc/v1
```

## Edit views (optional)
```sh
# edit views views/vendor/restdoc
php artisan vendor:publish --tag=restdoc-views --force
```

## Publish config (optional)
```sh
# create payu config/restdoc.php file
php artisan vendor:publish --tag=restdoc-config

# with provider
php artisan vendor:publish --provider="RestDoc\RestDocServiceProvider.php" --tag=restdoc-config
```