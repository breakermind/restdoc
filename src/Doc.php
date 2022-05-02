<?php

namespace RestDoc;

class Doc
{
	private $parts = [];

	function __construct($title, $desc, $version = 1.0)
	{
		$this->title = $title;
		$this->desc = $desc;
		$this->version = $version;
	}

	function part(Part $p)
	{
		$this->parts[] = $p;
	}

	function parts()
	{
		return $this->parts;
	}

	static function jsonPretty($json)
	{
		return json_encode(json_decode($json, true), JSON_PRETTY_PRINT);
	}

	static function param($name, $type, $desc, $required = false, $sample = '', $default = '')
	{
		return [
			'name' => $name,
			'type' => $type,
			'desc' => $desc,
			'required' => $required,
			'sample' => $sample,
			'default' => $default
		];
	}

	static function resp($code, $desc, $message = '', $model = '', array $headers = [])
	{
		return [
			'code' => $code,
			'desc' => $desc,
			'message' => $message,
			'model' => $model,
			'headers' => $headers
		];
	}

	static function header($name, $desc, $type)
	{
		return [
			'name' => $name,
			'desc' => $desc,
			'type' => $type,
		];
	}
}