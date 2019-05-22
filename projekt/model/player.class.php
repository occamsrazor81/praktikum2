<?php

class Player
{
	protected $id, $name, $position;

	function __construct( $id, $name, $position )
	{
		$this->id = $id;
    $this->name = $name;
    $this->position = $position;

	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>
