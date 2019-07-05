<?php

class WeeklyMatchup
{
	protected $id, $id_league, $id_user1, $id_user2, $week,
  $fgm1, $fga1, $fg_perc1, $ftm1, $fta1, $ft_perc1,
	$tpm1, $pts1, $reb1, $ast1, $st1, $blk1, $tov1,
  $fgm2, $fga2, $fg_perc2, $ftm2, $fta2, $ft_perc2,
	$tpm2, $pts2, $reb2, $ast2, $st2, $blk2, $tov2;


	function __construct($id, $id_league, $id_user1, $id_user2, $week,
  $fgm1, $fga1, $fg_perc1, $ftm1, $fta1, $ft_perc1,
	$tpm1, $pts1, $reb1, $ast1, $st1, $blk1, $tov1,
  $fgm2, $fga2, $fg_perc2, $ftm2, $fta2, $ft_perc2,
	$tpm2, $pts2, $reb2, $ast2, $st2, $blk2, $tov2 )
	{
		$this->id = $id;
    $this->id_league = $id_league;
    $this->id_user1 = $id_user1;
    $this->id_user2 = $id_user2;
    $this->week = $week;

    $this->fgm1 = $fgm1;
    $this->fga1 = $fga1;
    $this->fg_perc1 = $fg_perc1;
    $this->ftm1 = $ftm1;
    $this->fta1 = $fta1;
    $this->ft_perc1 = $ft_perc1;
		$this->tpm1 = $tpm1;
    $this->pts1 = $pts1;
    $this->reb1 = $reb1;
    $this->ast1 = $ast1;
    $this->st1 = $st1;
    $this->blk1 = $blk1;
    $this->tov1 = $tov1;

    $this->fgm2 = $fgm2;
    $this->fga2 = $fga2;
    $this->fg_perc2 = $fg_perc2;
    $this->ftm2 = $ftm2;
    $this->fta2 = $fta2;
    $this->ft_perc2 = $ft_perc2;
		$this->tpm2 = $tpm2;
    $this->pts2 = $pts2;
    $this->reb2 = $reb2;
    $this->ast2 = $ast2;
    $this->st2 = $st2;
    $this->blk2 = $blk2;
    $this->tov2 = $tov2;


	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }


	function iterateVisible() {
       //echo "MyClass::iterateVisible:\n";
       foreach ($this as $key => $value) {
				 	if($value == null) $value = 0;
          // print "$key => $value\n";
       }
    }

}

?>
