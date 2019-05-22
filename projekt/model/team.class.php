<?php

class Team
{
	protected $id, $team_name, $id_league, $id_user, $id_player, $points;

	function __construct( $id, $team_name, $id_league, $id_user, $id_player, $points )
	{
		$this->id = $id;
		$this->team_name = $team_name;
    $this->id_league = $id_league;
		$this->id_user = $id_user;
    $this->id_player = $id_player;
    $this->points = $points;

	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>
