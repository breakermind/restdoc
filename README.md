# RestDoc
Rest Api documentation generator for PHP projects.

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
require_once('_restdoc/routes.php');
```

### Run in browser
```sh
http://127.0.0.1/doc/v1
```

## Usage
Example in: routes/routes.php
```php
<?php

use Illuminate\Support\Facades\Route;
use RestDoc\Doc;
use RestDoc\Http;
use RestDoc\Header;
use RestDoc\Part;
use RestDoc\Param;
use RestDoc\Resp;

Route::get('/doc/v1', function () {

	// Docs
	$doc = new Doc('User Api', 'User rest api documentation.');

	// Rest Api Part
	$part = new Part('User', 'Users rest api routes.');

	// Get
	$part->add(
		Http::Get,
		'/users',
		'Get users list',
		[
			Param::get('search', 'string (query)', 'Search users with words', false, '', ''),
		],
		[
			Resp::get(200, 'Ok', json_encode(['users' => [
				['id' => 1, 'name' => 'Ala', 'username' => 'foczka', 'newsletter' => 0],
				['id' => 2, 'name' => 'Marcin', 'username' => 'foczek', 'newsletter' => 1],
			]]), 'App\Models\User'),
			Resp::get(401, 'Unauthenticated'),
			Resp::get(402, 'Unauthorized'),
			Resp::get(404, 'Not Found'),
		],
		false
	);

	// Get
	$part->add(
		Http::Get,
		'/users/{userId}',
		'Get user details',
		[
			Param::get('userId', 'integer', 'User id', true),
		],
		[
			Resp::get(200, 'Ok', json_encode(['user' => [
					'id' => '1',
					'email' => 'user@email.here',
					'name' => 'Marianek'
				]])
			),
			Resp::get(401, 'Unauthenticated'),
			Resp::get(402, 'Unauthorized'),
			Resp::get(404, 'Not Found'),
		],
		true
	);

	// Post
	$part->add(
		Http::Post,
		'/users',
		'Add user to the list',
		[
			Param::get('email', 'string', 'User email address', true, 'user@email.here'),
			Param::get('password', 'string', 'User new password', true, 'UserpPssword69'),
			Param::get('body', 'json', 'User email and password', false, json_encode([
				'email' => 'user@email.here',
				'password' => 'Secret Pass Here'
			])),
		],
		[
			Resp::get(200, 'Ok', json_encode(['msg' => 'User has been created'])),
			Resp::get(401, 'Unauthenticated'),
			Resp::get(402, 'Unauthorized'),
			Resp::get(404, 'Not Found'),
			Resp::get(422, 'Error', json_encode(['msg' => 'Invalid user email address'])),
		],
		true
	);

	// Put
	$part->add(
		Http::Put,
		'/users/{userId}',
		'Update user',
		[
			Param::get('userId', 'integer', 'User id', true),
			Param::get('email', 'string', 'User email address', true, 'user@email.here'),
			Param::get('name', 'string', 'User name', true, 'User Name'),
		],
		[
			Resp::get(200, 'Ok', json_encode(['msg' => 'User has been updated'])),
			Resp::get(401, 'Unauthenticated'),
			Resp::get(402, 'Unauthorized'),
			Resp::get(404, 'Not Found'),
		],
		true
	);

	// Delete
	$part->add(
		Http::Delete,
		'/users/{userId}',
		'Delete user with id',
		[
			Param::get('userId', 'integer', 'User id', true),
		],
		[
			Resp::get(200, 'Ok', json_encode(['msg' => 'User has been deleted']), '', [
				Header::get('X-Rate-Limit', 'Calls per hour allowed by the user', 'integer'),
				Header::get('X-Deleted-After', 'Date in UTC when user deleted', 'string'),
			]),
			Resp::get(401, 'Unauthenticated'),
			Resp::get(402, 'Unauthorized'),
			Resp::get(404, 'Not Found'),
		],
		true
	);

	// Add part to docs
	$doc->part($part);

	// Show as json
	// return $doc->parts();

	// Show as html
	return view('restdoc::main', ['doc' => $doc]);

})->name('doc.v1');
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

## Image
<img src="https://raw.githubusercontent.com/breakermind/restdoc/main/restdoc.png" width="100%">