<?php

namespace RestDoc;

class Resp
{
	static function get($code, $desc, $sample = '', $model = '', array $headers = [])
	{
		return [
			'code' => $code,
			'desc' => $desc,
			'sample' => $sample,
			'model' => $model,
			'headers' => $headers
		];
	}
}