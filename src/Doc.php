<?php

namespace RestDoc;

class Doc
{
	private $parts = [];

	function __construct($title, $description, $version = 1.0)
	{
		$this->title = $title;
		$this->description = $description;
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