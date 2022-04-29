<?php

namespace RestDoc;

class Header
{
	static function get($name, $desc, $type)
	{
		return [
			'name' => $name,
			'desc' => $desc,
			'type' => $type,
		];
	}
}