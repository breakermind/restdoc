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
	$part = new Part('User', 'Users operations.');

	// Get
	$part->add(
		Http::Get,
		'/users',
		'Get users list',
		[
			Param::get('search', 'string (query)', 'Search user query string', false),
		],
		[
			Resp::get(200, 'Success', json_encode(['users' => [
				['id' => 1, 'email' => 'user1@email.here', 'password' => 'password hash here'],
				['id' => 2, 'email' => 'user2@email.here', 'password' => 'password hash here'],
			]])),
			Resp::get(401, 'Unauthenticated'),
			Resp::get(402, 'Unauthorized'),
			Resp::get(404, 'Not Found'),
		],
		true
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
			Resp::get(200, 'Success', json_encode(['user' => [
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
			Param::get('body', 'json', 'User email and password', true, json_encode([
				'email' => 'user@email.here',
				'password' => 'Secret Pass Here'
			])),
		],
		[
			Resp::get(200, 'Success'),
			Resp::get(401, 'Unauthenticated'),
			Resp::get(402, 'Unauthorized'),
			Resp::get(404, 'Not Found'),
		],
		true
	);

	// Get
	$part->add(
		Http::Delete,
		'/users/{userId}',
		'Delete user with id',
		[
			Param::get('userId', 'integer', 'User id', true),
		],
		[
			Resp::get(200, 'Success', json_encode(['id' => '1']), '', [
				Header::get('X-Rate-Limit', 'Calls per hour allowed by the user', 'integer'),
				Header::get('X-Expires-After', 'Date in UTC when user deleted', 'string'),
			]),
			Resp::get(401, 'Unauthenticated'),
			Resp::get(402, 'Unauthorized'),
			Resp::get(404, 'Not Found'),
		],
		true
	);

	// Add part to docs
	$doc->part($part);

	// Show json
	return $doc->parts();

	// Show html
	// return view('restdoc::main', ['doc' => $doc]);

})->name('doc.v1');