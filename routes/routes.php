<?php

use Illuminate\Support\Facades\Route;
use RestDoc\Doc;
use RestDoc\Http;
use RestDoc\Part;

Route::get('/doc/v1', function () {

	// Docs
	$doc = new Doc('Rest Api Docs', 'Rest api documentation.');

	// Rest Api Part
	$part = new Part('User', 'Users rest api routes.');

	// Get
	$part->add(
		Http::Get,
		'/users',
		'Get users list',
		[
			Doc::param('search', 'string (query)', 'Search users with words', false, '', ''),
		],
		[
			Doc::resp(200, 'Ok', json_encode(['users' => [
				['id' => 1, 'name' => 'Ala', 'username' => 'foczka', 'newsletter' => 0],
				['id' => 2, 'name' => 'Marcin', 'username' => 'foczek', 'newsletter' => 1],
			]]), 'App\Models\User'),
			Doc::resp(401, 'Unauthorized'),
			Doc::resp(404, 'Not Found'),
		],
		false
	);

	// Get
	$part->add(
		Http::Get,
		'/users/{userId}',
		'Get user details',
		[
			Doc::param('userId', 'integer', 'User id', true),
		],
		[
			Doc::resp(200, 'Ok', json_encode(['user' => [
					'id' => '1',
					'email' => 'user@email.here',
					'name' => 'Marianek'
				]])
			),
			Doc::resp(401, 'Unauthorized'),
			Doc::resp(404, 'Not Found'),
		],
		true,
		[
			Doc::header('Authorization', 'Bearer {token}', 'string'),
		],
	);

	// Post
	$part->add(
		Http::Post,
		'/users',
		'Add user to the list',
		[
			Doc::param('email', 'string', 'User email address', true, 'user@email.here'),
			Doc::param('password', 'string', 'User new password', true, 'UserpPssword69'),
			Doc::param('body', 'json', 'User email and password', false, json_encode([
				'email' => 'user@email.here',
				'password' => 'Secret Pass Here'
			])),
		],
		[
			Doc::resp(200, 'Ok', json_encode(['msg' => 'User has been created'])),
			Doc::resp(401, 'Unauthorized'),
			Doc::resp(404, 'Not Found'),
			Doc::resp(422, 'Error', json_encode(['msg' => 'Invalid user email address'])),
		],
		true,
		[
			Doc::header('Authorization', 'Bearer {token}', 'string'),
			Doc::header('Content-Type', 'application/json', 'string'),
			Doc::header('Accept', 'application/json', 'string'),
		],
	);

	// Put
	$part->add(
		Http::Put,
		'/users/{userId}',
		'Update user',
		[
			Doc::param('userId', 'integer', 'User id', true),
			Doc::param('email', 'string', 'User email address', true, 'user@email.here'),
			Doc::param('name', 'string', 'User name', true, 'User Name'),
		],
		[
			Doc::resp(200, 'Ok', json_encode(['msg' => 'User has been updated'])),
			Doc::resp(401, 'Unauthorized'),
			Doc::resp(404, 'Not Found'),
		],
		true,
		[
			Doc::header('Authorization', 'Bearer {token}', 'string'),
		],
	);

	// Delete
	$part->add(
		Http::Delete,
		'/users/{userId}',
		'Delete user with id',
		[
			Doc::param('userId', 'integer', 'User id', true),
		],
		[
			Doc::resp(200, 'Ok', json_encode(['msg' => 'User has been deleted']), '', [
				Doc::header('X-Rate-Limit', 'Calls per hour allowed by the user', 'integer'),
				Doc::header('X-Deleted-After', 'Date in UTC when user deleted', 'datetime'),
			]),
			Doc::resp(401, 'Unauthorized'),
			Doc::resp(404, 'Not Found'),
		],
		true,
		[
			Doc::header('Authorization', 'Bearer {token}', 'string'),
		],
	);

	// Add part to docs
	$doc->part($part);

	// Show json
	// return $doc->parts();

	// Show html
	return view('restdoc::main', ['doc' => $doc]);

})->name('doc.v1');