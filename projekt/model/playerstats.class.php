<?php

class Stats
{
	protected $id, $id_player, $fgm, $fga, $fg_perc, $ftm, $fta, $ft_perc,
   $pts, $reb, $ast, $st, $blk, $tov, $week, $day;

	function __construct( $id, $id_player, $fgm, $fga, $fg_perc, $ftm, $fta, $ft_perc,
   $pts, $reb, $ast, $st, $blk, $tov, $week, $day )
	{
		$this->id = $id;
    $this->id_player = $id_player;
    $this->fgm = $fgm;
    $this->fga = $fga;
    $this->fg_perc = $fg_perc;
    $this->ftm = $ftm;
    $this->fta = $fta;
    $this->ft_perc = $ft_perc;
    $this->pts = $pts;
    $this->reb = $reb;
    $this->ast = $ast;
    $this->st = $st;
    $this->blk = $blk;
    $this->tov = $tov;
    $this->week = $week;
    $this->day = $day;

	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>
