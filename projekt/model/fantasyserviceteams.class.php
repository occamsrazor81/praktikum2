<?php

require_once __DIR__.'/db.class.php';
require_once __DIR__.'/user.class.php';
require_once __DIR__.'/league.class.php';
require_once __DIR__.'/team.class.php';
require_once __DIR__.'/player.class.php';
require_once __DIR__.'/draft.class.php';


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







};


 ?>
