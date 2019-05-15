<?php

require_once __DIR__.'/db.class.php';
require_once __DIR__.'/user.class.php';
require_once __DIR__.'/league.class.php';

class FantasyService
{
  ///////////////////////////////////////////////////////////////////
  //users

  function getUserById($id)
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, username, password_hash, email,
				registration_sequence, has_registered, bank_account FROM project_users where id=:id' );
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if($row === false)
			return null;

		else
			return new User($row['id'], $row['username'], $row['password_hash'],
			$row['email'], $row['registration_sequence'], $row['has_registered'],
    $row['bank_account'] );


	}


  function getAllUsers( )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, username, password_hash,
        email, registration_sequence, has_registered, bank_account FROM project_users' );
			$st->execute();
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new User( $row['id'], $row['username'], $row['password_hash'], $row['email'], $row['registration_sequence'], $row['has_registered'], $row['bank_account'] );
		}

		return $arr;
	}

  function getUserByUsernameAndPassword($username, $password)
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, username, password_hash,
				email, registration_sequence, has_registered, bank_account FROM project_users
				where username=:username' );

			$st->execute(array('username' => $username));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }



		$row = $st->fetch();
		$arr = array();

		if($row === false)
			return $arr;

		else
		{
			$hash = $row['password_hash'];


			if(password_verify($password, $hash) && $row['has_registered'] == 1)
			{
				$arr[] = new User( $row['id'], $row['username'], $row['password_hash'],
				 $row['email'], $row['registration_sequence'], $row['has_registered'], $row['bank_account'] );

				return $arr;
			}



			else return $arr;

		}

	}


  ////////////////////////////////////////////////////////////////////
  //leagues

  function getAllLeagues()
  {
    try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, id_user, title, number_of_members,
         week, day, trade_deadline, league_type, status FROM project_leagues' );

			$st->execute();
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();
    while($row = $st->fetch())
      $arr[] = new League( $row['id'], $row['id_user'], $row['title'],
       $row['number_of_members'],  $row['week'], $row['day'],
       $row['trade_deadline'], $row['league_type'], $row['status'] );

    return $arr;

  }


  function getAllMyLeagues($id_user)
  {
    try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, id_user, title, number_of_members,
         week, day, trade_deadline, league_type, status FROM project_leagues
         where id_user=:id_user' );

			$st->execute(array('id_user' => $id_user));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();
    while($row = $st->fetch())
      $arr[] = new League( $row['id'], $row['id_user'], $row['title'],
       $row['number_of_members'],  $row['week'], $row['day'],
       $row['trade_deadline'], $row['league_type'], $row['status'] );

    return $arr;

  }

  function getApplicantsViaLeagueId($league_id)
  {
    try
  	{
  		$db = DB::getConnection();
  		$st = $db->prepare('SELECT id, username, password_hash, email,
  			registration_sequence, has_registered, bank_account from project_users
        where id in (SELECT id_user from project_members
  				where id_league=:league_id and member_type=:member_pending)');

  		$st->execute(array('league_id' => $league_id, 'member_pending' => 'application_pending'));


  	}
  	catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

  	$arr = array();
  	while( $row = $st->fetch() )
  	{
  		$arr[] = new User( $row['id'], $row['username'], $row['password_hash'],
        $row['email'], $row['registration_sequence'], $row['has_registered'],
        $row['bank_account'] );
  	}

  	return $arr;


  }






};

 ?>
