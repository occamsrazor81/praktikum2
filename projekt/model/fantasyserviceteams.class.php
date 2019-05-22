<?php

require_once __DIR__.'/db.class.php';
require_once __DIR__.'/user.class.php';
require_once __DIR__.'/league.class.php';
require_once __DIR__.'/team.class.php';
require_once __DIR__.'/player.class.php';


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






};


 ?>
