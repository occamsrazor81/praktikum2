<?php

class League
{
	protected $id, $id_user, $title, $number_of_members, $week, $day,
	$trade_deadline, $league_type, $status;

	function __construct( $id, $id_user, $title, $number_of_members, $week, $day,
	$trade_deadline, $league_type, $status )
	{
    $this->id = $id;
    $this->id_user = $id_user;
    $this->title = $title;
    $this->number_of_members = $number_of_members;
		$this->week = $week;
		$this->day = $day;
		$this->trade_deadline = $trade_deadline;
		$this->league_type = $league_type;
    $this->status = $status;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>
