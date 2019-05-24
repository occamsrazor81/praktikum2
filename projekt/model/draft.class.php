<?php

class Draft
{
	protected $id, $id_league, $id_user, $current_number, $starting_number;

	function __construct( $id, $id_league, $id_user, $current_number, $starting_number )
	{
		$this->id = $id;
    $this->id_league = $id_league;
		$this->id_user = $id_user;
    $this->current_number = $current_number;
    $this->starting_number = $starting_number;

	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>
