<?php

namespace RestDoc;

use RestDoc\Http;

class Part
{
	private $methods = [];

	function __construct($title, $desc, $uid = '')
	{
		$this->id = uniqid();

		if(!empty($uid)) {
			$this->id = $uid;
		}

		$this->title = $title;
		$this->desc = $desc;
	}

	function add(Http $method, $route, $desc, array $params, array $responses, $auth = false, array $headers = [])
	{
		$this->methods[] = [
			'method' => $method,
			'route' => $route,
			'desc' => $desc,
			'params' => $params,
			'responses' => $responses,
			'auth' => $auth,
			'headers' => $headers,
		];
	}

	function methods() {
		return $this->methods;
	}
}