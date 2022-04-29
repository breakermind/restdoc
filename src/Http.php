<?php

namespace RestDoc;

enum Http: string
{
	case Get = 'GET';
	case Post = 'POST';
	case Put = 'PUT';
	case Patch = 'PATCH';
	case Delete = 'DELETE';

	public function label(): string
	{
		return match($this) {
			static::Get => 'Get',
			static::Post => 'Post',
			static::Put => 'Put',
			static::Patch => 'Patch',
			static::Delete => 'Delete',
		};
	}
}