<?php


class Formula
{
	protected $id, $utrka, $trenutak, $vozac;
	function __construct( $id, $utrka, $trenutak, $vozac )
	{
		$this->id = $id;
		$this->utrka = $utrka;
		$this->trenutak = $trenutak;
    $this->vozac = $vozac;
	}
	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}
 ?>
