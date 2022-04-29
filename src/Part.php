<?php

namespace RestDoc;

use RestDoc\Http;

class Part
{
	public $methods = [];

	function __construct($title, $description)
	{
		$this->id = uniqid();
		$this->title = $title;
		$this->description = $description;
	}

	function add(Http $method, $route, $desc, array $params, array $responses, $auth = false)
	{
		$this->methods[] = [
			'method' => $method,
			'route' => $route,
			'desc' => $desc,
			'params' => $params,
			'responses' => $responses,
			'auth' => $auth
		];
	}
}