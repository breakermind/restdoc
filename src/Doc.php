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
}