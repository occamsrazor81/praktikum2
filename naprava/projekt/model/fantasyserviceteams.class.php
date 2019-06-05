<?php

require_once __DIR__.'/db.class.php';
require_once __DIR__.'/user.class.php';
require_once __DIR__.'/league.class.php';
require_once __DIR__.'/team.class.php';
require_once __DIR__.'/player.class.php';
require_once __DIR__.'/draft.class.php';
require_once __DIR__.'/playerstats.class.php';
require_once __DIR__.'/trade.class.php';


class FantasyServiceTeams
{

  function getAllUsersInsideLeague($id_league)
  {
    try
    {
      $db = DB::getConnection();
      $st = $db->prepare('SELECT id, username, password_hash, email,
				registration_sequence, has_registered, bank_account
         FROM project_users where id in
         (SELECT id_user from project_members where id_league=:id_league) ');

      $st->execute(array('id_league' => $id_league));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();

    while ($row = $st->fetch())
      $arr[] = new User( $row['id'], $row['username'],
      $row['password_hash'], $row['email'], $row['registration_sequence'],
       $row['has_registered'], $row['bank_account'] );

    return $arr;

  }


  function getAllPlayers()
  {

    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('SELECT id, name, position from project_players');

      $st->execute();

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();
    while($row = $st->fetch())
      $arr[] = new Player($row['id'], $row['name'], $row['position']);

    return $arr;



  }


  function getPlayerById($id_player)
  {
    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('SELECT id, name, position from project_players
      where id=:id_player');

      $st->execute(array('id_player' => $id_player));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $row = $st->fetch();
		if($row === false)
			return null;

    else return new Player($row['id'], $row['name'], $row['position']);


  }





  function initializeDraftOrder($id_league, $id_user, $current, $starting)
  {

    try
    {
      $db = DB::getConnection();
      $st = $db->prepare('INSERT into project_draft (id_league, id_user,
         current_number, starting_number)
      values (:id_league, :id_user, :current, :starting) ');

      $st->execute(array('id_league' => $id_league, 'id_user' => $id_user,
          'current' => $current, 'starting' => $starting));
    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }


  }



  function deleteDraftOrderForLeague($id_league)
  {

    try
    {
      $db = DB::getConnection();
      $st = $db->prepare('DELETE from project_draft where id_league=:id_league ');

      $st->execute(array('id_league' => $id_league));
    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

  }


  function getMinimalCurrentUser()
  {
    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('SELECT id, username, password_hash, email,
				registration_sequence, has_registered, bank_account from project_users
        where id = (SELECT id_user from project_draft
        order by current_number asc limit 1)');

      $st->execute();

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $row = $st->fetch();
		if($row === false)
			return null;

		else
    return new User($row['id'], $row['username'], $row['password_hash'],
    $row['email'], $row['registration_sequence'], $row['has_registered'],
  $row['bank_account'] );


  }



  function getMaxCurrentDraft()
  {
    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('SELECT current_number from project_draft
        order by current_number desc limit 1');

      $st->execute();

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $row = $st->fetch();

    return $row['current_number'];



  }






  function getDraftByUserIdInLeague($id_league, $id_user)
  {

    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('SELECT * from project_draft
        where id_league=:id_league and id_user=:id_user');

      $st->execute(array('id_league' => $id_league, 'id_user' => $id_user));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $row = $st->fetch();

    if($row === false)
			return null;

		else
    return new Draft($row['id'], $row['id_league'], $row['id_user'],
  $row['current_number'], $row['starting_number'] );

  }


  function countSelectedPlayersByUserInLeague($id_league, $id_user)
  {

    try
    {
      $db = DB::getConnection();
      $st = $db->prepare('SELECT id, team_name, id_league, id_user, id_player,points
        from project_teams where id_league=:id_league and id_user=:id_user');

      $st->execute(array('id_league' => $id_league, 'id_user' => $id_user));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $number = 0;

    while ($row = $st->fetch())
      $number++;

    return $number;

  }


  function checkPlayerAvailability($id_league, $id_player)
  {

    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('SELECT * from project_teams
        where id_league=:id_league and id_player=:id_player');

      $st->execute(array('id_league' => $id_league, 'id_player' => $id_player));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $row = $st->fetch();
		if($row === false)
      return 1;

    else return 0;


  }


  function addPlayerToTeam($team_name, $id_league, $id_user, $id_player, $points)
  {

    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('INSERT into project_teams (team_name, id_league,
         id_user, id_player, points)
         values (:team_name, :id_league, :id_user, :id_player, :points) ');

      $st->execute(array('team_name' => $team_name, 'id_league' => $id_league,
       'id_user' => $id_user, 'id_player' => $id_player, 'points' => $points));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

  }



  function popFromTeam($team_name, $id_league, $id_player)
  {

    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('DELETE from project_teams
      where team_name=:team_name and id_league=:id_league
      and id_player=:id_player');

      $st->execute(array('team_name' => $team_name, 'id_league' => $id_league,
        'id_player' => $id_player));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

  }
  // 'DELETE from project_teams
  //   where id_league=:id_league and  id_player=:id_kicked '


  function deleteMinimalCurrent()
  {

    try
    {
      $db = DB::getConnection();
      $st = $db->prepare('DELETE from project_draft
        order by current_number asc limit 1');

      $st->execute();
    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

  }


  function updateOtherCurrents()
  {
    try
    {
      $db = DB::getConnection();
      $st = $db->prepare('UPDATE project_draft
        set current_number = current_number - 1');

      $st->execute();
    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

  }

  function pushBackCurrent($id_league, $id_user,$current,$starting)
  {

    try
    {
      $db = DB::getConnection();
      $st = $db->prepare('INSERT into project_draft (id_league, id_user,
         current_number, starting_number)
      values (:id_league, :id_user, :current, :starting)');

      $st->execute(array('id_league' => $id_league, 'id_user' => $id_user,
    'current' => $current,'starting' => $starting) );
    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

  }





  ///////////////////////////////////////////




  function getAllPlayersInMyTeam($id_league, $id_user)
  {

    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('SELECT id, name, position from project_players
        where id in (select id_player from project_teams
          where id_league=:id_league and id_user=:id_user )');

      $st->execute(array('id_league' => $id_league, 'id_user' => $id_user));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();
    while($row = $st->fetch())
      $arr[] = new Player($row['id'], $row['name'], $row['position']);

    return $arr;

  }


  function getPlayerStatsByPlayerId($id_plr)
  {
    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('SELECT id, id_player, FGM, FGA, FG_PERC, FTM, FTA, FT_PERC,
        3PTM, PTS, REB, AST, ST, BLK, TOV, week, day from project_player_stats');
        // where id_player in (select id from project_players
        //   where id=:id_plr )');

      $st->execute(array('id_plr' => $id_plr));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }


    $arr = array();
    while($row = $st->fetch())
      $arr[] = new Stats($row['id'], $row['id_player'],
       $row['FGM'] ,$row['FGA'], $row['FG_PERC'],
        $row['FTM'], $row['FTA'], $row['FT_PERC'],
    $row['3PTM'], $row['PTS'], $row['REB'], $row['AST'], $row['ST'],
    $row['BLK'], $row['TOV'], $row['week'], $row['day']);




    return $arr;


  }


  function getTeamName($id_league, $id_user)
  {

    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('SELECT team_name from project_teams
        where id_league=:id_league and id_user=:id_user ');

      $st->execute(array('id_league' => $id_league, 'id_user' => $id_user));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $row = $st->fetch();

    if($row === false)
      return null;

    else
    return $row['team_name'];


  }



  function changeTName($team_name, $id_league, $id_user)
  {

    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('UPDATE project_teams set team_name=:team_name
        where id_league=:id_league and id_user=:id_user ');

      $st->execute(array('team_name' => $team_name,
      'id_league' => $id_league, 'id_user' => $id_user));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

  }




  function getAllFreeAgents($id_league)
  {

    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('SELECT * from project_players
      where id not in (SELECT id_player from project_teams
      where id_league=:id_league)');

      $st->execute(array('id_league' => $id_league));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();
    while($row = $st->fetch())
      $arr[] = new Player($row ['id'], $row['name'], $row['position']);

    return $arr;


  }



  function replacePlayerInTeam($id_league, $id_kicked, $id_new)
  {

    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('UPDATE project_teams set id_player=:id_new
        where id_league=:id_league and id_player=:id_kicked ');

      $st->execute(array('id_new' => $id_new,
      'id_league' => $id_league, 'id_kicked' => $id_kicked));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

  }





  function replacePlayerInTeamTrade($id_league, $id_team, $id_new)
  {

    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('UPDATE project_teams set id_player=:id_new
        where id_league=:id_league and id=:id_team ');

      $st->execute(array('id_new' => $id_new,
      'id_league' => $id_league, 'id_team' => $id_team));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

  }



  function cutPlayerFromTeam($id_league, $id_kicked)
  {

    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('DELETE from project_teams
        where id_league=:id_league and  id_player=:id_kicked ');

      $st->execute(array('id_league' => $id_league, 'id_kicked' => $id_kicked));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

  }



  function getOtherTeams($id_league, $id_user)
  {

    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('SELECT * from project_teams
        where id_league=:id_league and id_user not in (:id_user)
        group by id_user');

      $st->execute(array('id_league' => $id_league, 'id_user' => $id_user));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();
    while($row = $st->fetch())
      $arr[] = new Team($row['id'], $row['team_name'], $row['id_league'],
                      $row['id_user'], $row['id_player'], $row['points']);


    return $arr;



  }






  function getTeamById($id_team)
  {

    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('SELECT * from project_teams
        where id=:id_team ');

      $st->execute(array('id_team' => $id_team));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $row = $st->fetch();

    if($row === false)
      return null;

    else
      return new Team($row['id'], $row['team_name'], $row['id_league'],
                    $row['id_user'], $row['id_player'], $row['points']);

  }



  function getPlayersFromTeam($id_league, $id_user)
  {


    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('SELECT * from project_players where id in
        (select id_player from project_teams
          where id_league=:id_league and id_user=:id_user) ');

      $st->execute(array('id_league' => $id_league, 'id_user' => $id_user));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();
    while($row = $st->fetch())
      $arr[] = new Player($row['id'], $row['name'], $row['position']);

    return $arr;


  }



  function getTeamByUserAndLeague($id_league, $id_user)
  {

    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('SELECT * from project_teams
        where id_league=:id_league and id_user=:id_user ');

      $st->execute(array('id_league' => $id_league, 'id_user' => $id_user));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }


    $row = $st->fetch();

    if($row === false)
      return null;

    else
      return new Team($row['id'], $row['team_name'], $row['id_league'],
                    $row['id_user'], $row['id_player'], $row['points']);


  }







  function getMyTeamIds($id_league, $id_user)
  {

    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('SELECT id from project_teams
        where id_league=:id_league and id_user=:id_user ');

      $st->execute(array('id_league' => $id_league, 'id_user' => $id_user));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }


    $arr = array();
    while($row = $st->fetch())
      $arr[] = $row['id'];


    return $arr;



  }





  function requestTrade($id_league, $myTeamId, $otherTeamId,
  $id_player1, $id_player2,
  $id_player11, $id_player12, $id_player21, $id_player22)
  {


    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('INSERT into project_trades
        (id_league, id_team1, id_team2,
        id_player1, id_player11, id_player12,
        id_player21, id_player22, id_player2, trade_status)
        values (:id_league, :id_myTeam, :id_otherTeam,
         :id_player1, :id_player11, :id_player12,
         :id_player21, :id_player22, :id_player2,
         :trade_status)');

      $st->execute(array('id_league' => $id_league,
      'id_myTeam' => $myTeamId, 'id_otherTeam' => $otherTeamId,
      'id_player1' => $id_player1, 'id_player11' => $id_player11,
      'id_player12' => $id_player12, 'id_player21' => $id_player21,
      'id_player22' => $id_player22, 'id_player2' => $id_player2,
      'trade_status' => 'pending'));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }




  }



  function getMyPendingTradesViaLeagueAndTeam($id_league, $id_team)
  {


    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('SELECT * from project_trades
      where id_league=:id_league and id_team1=:id_team
      and trade_status=:pending');

      $st->execute(array('id_league' => $id_league,
      'id_team' => $id_team, 'pending' => 'pending'));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();

    while($row = $st->fetch())
      $arr[] = new Trade($row['id'],  $row['id_league'],
      $row['id_team1'], $row['id_team2'],
    $row['id_player1'], $row['id_player11'], $row['id_player12'],
    $row['id_player21'], $row['id_player22'], $row['id_player2'],
    $row['trade_status']);

    return $arr;

  }


  function getMyAcceptedTradesViaLeagueAndTeam($id_league, $id_team)
  {

    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('SELECT * from project_trades
      where id_league=:id_league and id_team1=:id_team
      and trade_status=:accepted');

      $st->execute(array('id_league' => $id_league,
      'id_team' => $id_team, 'accepted' => 'accepted'));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();

    while($row = $st->fetch())
      $arr[] = new Trade($row['id'],  $row['id_league'],
      $row['id_team1'], $row['id_team2'],
    $row['id_player1'], $row['id_player11'], $row['id_player12'],
    $row['id_player21'], $row['id_player22'], $row['id_player2'],
    $row['trade_status']);

    return $arr;

  }


  function getRecievedTradeRequestsViaLeagueAndTeam($id_league, $id_team2)
  {

    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('SELECT * from project_trades
      where id_league=:id_league and id_team2=:id_team2
      and trade_status=:pending');

      $st->execute(array('id_league' => $id_league,
      'id_team2' => $id_team2, 'pending' => 'pending'));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();

    while($row = $st->fetch())
      $arr[] = new Trade($row['id'],  $row['id_league'],
      $row['id_team1'], $row['id_team2'],
    $row['id_player1'], $row['id_player11'], $row['id_player12'],
    $row['id_player21'], $row['id_player22'], $row['id_player2'],
    $row['trade_status']);

    return $arr;

  }


  function getTradeById($id)
  {

    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('SELECT * from project_trades
      where id=:id');

      $st->execute(array('id' => $id));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

    $row = $st->fetch();
    if($row === false)
			return null;

    else
      return new Trade($row['id'],  $row['id_league'],
      $row['id_team1'], $row['id_team2'],
    $row['id_player1'], $row['id_player11'], $row['id_player12'],
    $row['id_player21'], $row['id_player22'], $row['id_player2'],
    $row['trade_status']);

  }


  function setTradeStatusAccepted($id_trade)
  {

    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('UPDATE project_trades
        set trade_status=:accepted
        where id=:id_trade');

      $st->execute(array('id_trade' => $id_trade, 'accepted' => 'accepted'));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

  }


  function setTradeStatusRejected($id_trade)
  {

    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('UPDATE project_trades
        set trade_status=:rejected
        where id=:id_trade');

      $st->execute(array('id_trade' => $id_trade, 'rejected' => 'rejected'));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

  }


  function getAllTradesInvolvingPlayerInLeague($id_league, $id_player)
  {

    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('UPDATE project_trades
        set trade_status=:rejected
        where id_league=:id_league
        and (id_player1=:id_player
          or id_player11=:id_player
          or id_player12=:id_player
          or id_player21=:id_player
          or id_player22=:id_player
          or id_player2=:id_player)');

      $st->execute(array('id_league' => $id_league, 'rejected' => 'rejected',
    'id_player' => $id_player));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

  }

//////////////////////
//promijeniti na usere umjesto timova u insert into
  function makeFirstWeeklyMatchUp($id_league, $id_user1, $id_user2)
  {
    try
    {

      $db = DB::getConnection();
      $st = $db->prepare('INSERT into project_weekly_matchups(id_league, id_team1, id_team2)
      values(:id_league, :id_user1, :id_user2)');

      $st->execute(array('id_league' => $id_league, 'id_user1' => $id_user1,
    'id_user2' => $id_user2 ));

    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

  }









};


 ?>
