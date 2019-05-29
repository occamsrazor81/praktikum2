<?php

class Trade
{
	protected $id, $id_league, $id_team1, $id_team2, $id_player1,
  $id_player11, $id_player12, $id_player21, $id_player22,
  $id_player2, $trade_status;

	function __construct( $id, $id_league, $id_team1, $id_team2, $id_player1,
  $id_player11, $id_player12, $id_player21, $id_player22,
  $id_player2, $trade_status )
	{
		$this->id = $id;
    $this->id_league = $id_league;
    $this->id_team1 = $id_team1;
    $this->id_team2 = $id_team2;
    $this->id_player1 = $id_player1;
    $this->id_player11 = $id_player11;
    $this->id_player12 = $id_player12;
    $this->id_player21 = $id_player21;
    $this->id_player22 = $id_player22;
    $this->id_player2 = $id_player2;
    $this->trade_status = $trade_status;

	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>
