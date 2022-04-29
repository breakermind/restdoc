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
			static::Get => 'GET',
			static::Post => 'POST',
			static::Put => 'PUT',
			static::Patch => 'PATCH',
			static::Delete => 'DELETE',
		};
	}
}