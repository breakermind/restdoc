<?php

namespace RestDoc;

class Param
{
	static function get($name, $type, $desc, $required = false, $sample = '', $default = '')
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
}