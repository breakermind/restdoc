<?php

namespace RestDoc;

use RestDoc\Http;

class Part
{
	private $methods = [];

	function __construct($title, $desc)
	{
		$this->id = uniqid();
		$this->title = $title;
		$this->desc = $desc;
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

	function methods() {
		return $this->methods;
	}
}