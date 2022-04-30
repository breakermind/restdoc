<?php

namespace RestDoc;

class Resp
{
	static function get($code, $desc, $message = '', $model = '', array $headers = [])
	{
		return [
			'code' => $code,
			'desc' => $desc,
			'message' => $message,
			'model' => $model,
			'headers' => $headers
		];
	}
}