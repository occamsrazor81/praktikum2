<?php

require_once __DIR__.'/db.class.php';
require_once __DIR__.'/user.class.php';
require_once __DIR__.'/league.class.php';
require_once __DIR__.'/team.class.php';
require_once __DIR__.'/player.class.php';
require_once __DIR__.'/draft.class.php';
require_once __DIR__.'/playerstats.class.php';
require_once __DIR__.'/trade.class.php';
require_once __DIR__.'/weeklymatchup.class.php';


class FantasyServiceWeekly
{

  function getDayAndWeekInLeague($id_league)
  {
    try
    {
      $db = DB::getConnection();
      $st = $db->prepare('SELECT day,week from project_leagues
      where id=:id_league limit 1');

      $st->execute(array('id_league' => $id_league));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $row = $st->fetch();

    return $row;

  }

  function getCount($id_league)
  {
    try
    {
      $db = DB::getConnection();
      $st = $db->prepare('SELECT * from project_weekly_matchups
      where id_league=:id_league');

      $st->execute(array('id_league' => $id_league));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $row = $st->fetch();

    if($row) return 1;

    else return 0;


  }

// my_id moze biti ili user1_id, ili user2_id
  function getWeeklyOpponent($id_league, $my_id, $week)
  {

    try
    {
      $db = DB::getConnection();
      $st = $db->prepare('SELECT * from project_weekly_matchups
      where id_league=:id_league and week=:week
      and (id_user1=:my_id or id_user2=:my_id)');

      $st->execute(array('id_league' => $id_league,
    'week' => $week, 'my_id' => $my_id));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $row = $st->fetch();

    return $row;

  }


// ako je my_id == user1_id
  function getWeeklyStats($id_league, $id_user1, $id_user2, $week)
  {

    try
    {
      $db = DB::getConnection();
      $st = $db->prepare('SELECT * from project_weekly_matchups
      where id_league=:id_league and week=:week
      and id_user1=:id_user1 and id_user2=:id_user2');

      $st->execute(array('id_league' => $id_league,
    'week' => $week, 'id_user1' => $id_user1, 'id_user2' => $id_user2));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $row = $st->fetch();
		if($row === false)
			return null;

    else return new WeeklyMatchup($row['id'], $row['id_league'],
  $row['id_user1'], $row['id_user2'], $row['week'],
  $row['FGM1'], $row['FGA1'], $row['FG_PERC1'],
  $row['FTM1'], $row['FTA1'], $row['FT_PERC1'],
  $row['3PTM1'], $row['PTS1'], $row['REB1'],
  $row['AST1'], $row['ST1'], $row['BLK1'], $row['TO1'],
  $row['FGM2'], $row['FGA2'], $row['FG_PERC2'],
  $row['FTM2'], $row['FTA2'], $row['FT_PERC2'],
  $row['3PTM2'], $row['PTS2'], $row['REB2'],
  $row['AST2'], $row['ST2'], $row['BLK2'], $row['TO2']);



  }


  function getStartersInMyTeam($id_league, $id_user)
  {
    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('SELECT id, name, position from project_players
        where id in (select id_player from project_teams
      where id_league=:id_league and id_user=:id_user and points=:rs)');

      $st->execute(array('id_league' => $id_league,
      'id_user' => $id_user, 'rs' => 1));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();
    while($row = $st->fetch())
      $arr[] = new Player($row['id'], $row['name'], $row['position']);

    return $arr;


  }



  function getBenchInMyTeam($id_league, $id_user)
  {
    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('SELECT id, name, position from project_players
        where id in (select id_player from project_teams
      where id_league=:id_league and id_user=:id_user and points=:rs)');

      $st->execute(array('id_league' => $id_league,
      'id_user' => $id_user, 'rs' => 0));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();
    while($row = $st->fetch())
      $arr[] = new Player($row['id'], $row['name'], $row['position']);

    return $arr;


  }

  // function getPlayerIdViaName($name)
  // {
  //
  //   $newName = '"'.$name.'"';
  //
  //   //echo $newName;
  //
  //
  //   try
  //   {
  //
  //     $db = DB::getConnection();
  //     $st = $db->prepare('SELECT id from project_players
  //     where name like :name');
  //
  //     $st->execute(array('name' => $newName));
  //
  //   }
  //   catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }
  //
  //   $row = $st->fetch();
  //   if($row === false)
  //     return null;
  //
  //   return $row['id'];
  //
  // }


  function updateRosterStatus($id_league, $id_player, $rs)
  {

    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('UPDATE project_teams set points=:rs
        where id_league=:id_league and id_player=:id_player');

      $st->execute(array('rs' => $rs,
      'id_league' => $id_league, 'id_player' => $id_player ));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

  }

  function getAllWeeklyMatchups($id_league, $week)
  {

    try
    {
      $db = DB::getConnection();
      $st = $db->prepare('SELECT * from project_weekly_matchups
      where id_league=:id_league and week=:week');

      $st->execute(array('id_league' => $id_league,'week' => $week));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();
    while($row = $st->fetch())
      $arr[] = new WeeklyMatchup($row['id'], $row['id_league'],
        $row['id_user1'], $row['id_user2'], $row['week'],
        $row['FGM1'], $row['FGA1'], $row['FG_PERC1'],
        $row['FTM1'], $row['FTA1'], $row['FT_PERC1'],
        $row['3PTM1'], $row['PTS1'], $row['REB1'],
        $row['AST1'], $row['ST1'], $row['BLK1'], $row['TO1'],
        $row['FGM2'], $row['FGA2'], $row['FG_PERC2'],
        $row['FTM2'], $row['FTA2'], $row['FT_PERC2'],
        $row['3PTM2'], $row['PTS2'], $row['REB2'],
        $row['AST2'], $row['ST2'], $row['BLK2'], $row['TO2']);


    return $arr;

  }


  function refresLeagueDate($id_league, $week, $day)
  {
    try
    {
      $db = DB::getConnection();
      $st = $db->prepare('UPDATE project_leagues set
        week=:week, day =:day where id=:id_league');

     $st->execute(array( 'week' => $week, 'day' => $day,
      'id_league' => $id_league));


    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }
  }


  function refreshWeeklyMatchUp($id, $fgm1, $fga1, $fg_perc1,
  $ftm1, $fta1, $ft_perc1, $tpm1, $pts1,
  $reb1, $ast1, $st1, $blk1, $tov1,
  $fgm2, $fga2, $fg_perc2, $ftm2, $fta2, $ft_perc2,
  $tpm2, $pts2, $reb2, $ast2, $st2, $blk2, $tov2)
  {

    try
    {
      $db = DB::getConnection();
      $st = $db->prepare('UPDATE project_weekly_matchups set
        FGM1=:fgm1, FGA1=:fga1, FG_PERC1=:fg_perc1, FTM1=:ftm1,
        FTA1=:fta1, FT_PERC1=:ft_perc1, 3PTM1=:tpm1, PTS1=:pts1,
        REB1=:reb1, AST1=:ast1, ST1=:st1, BLK1=:blk1, TO1=:tov1,
        FGM2=:fgm2, FGA2=:fga2, FG_PERC2=:fg_perc2, FTM2=:ftm2,
        FTA2=:fta2, FT_PERC2=:ft_perc2, 3PTM2=:tpm2, PTS2=:pts2,
        REB2=:reb2, AST2=:ast2, ST2=:st2, BLK2=:blk2, TO2=:tov2
        where id=:id');

      $st->execute(array('fgm1' => $fgm1, 'fga1' => $fga1, 'fg_perc1' => $fg_perc1,
      'ftm1' => $ftm1, 'fta1' => $fta1, 'ft_perc1' => $ft_perc1,
      'tpm1' => $tpm1, 'pts1' => $pts1, 'reb1' => $reb1, 'ast1' => $ast1,
      'st1' => $st1, 'blk1' => $blk1, 'tov1' => $tov1,
      'fgm2' => $fgm2, 'fga2' => $fga2, 'fg_perc2' => $fg_perc2,
      'ftm2' => $ftm2, 'fta2' => $fta2, 'ft_perc2' => $ft_perc2,
      'tpm2' => $tpm2, 'pts2' => $pts2, 'reb2' => $reb2, 'ast2' => $ast2,
      'st2' => $st2, 'blk2' => $blk2, 'tov2' => $tov2,
      'id' => $id));


    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

  }





};


 ?>
