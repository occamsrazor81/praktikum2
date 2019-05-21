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

  function getLeagueById($id)
  {

    try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id,id_user,title,number_of_members,week,day,
        trade_deadline,league_type,status FROM project_leagues where id=:id' );

			$st->execute(array('id' => $id));

		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if($row === false)
			return null;

		else
			return new League( $row['id'], $row['id_user'], $row['title'],
       $row['number_of_members'],  $row['week'], $row['day'],
       $row['trade_deadline'], $row['league_type'], $row['status'] );

  }

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
			// $st = $db->prepare( 'SELECT id, id_user, title, number_of_members,
      //    week, day, trade_deadline, league_type, status FROM project_leagues
      //    where id_user=:id_user' );

      $st = $db->prepare( 'SELECT id,id_user,title,number_of_members,
        week,day,trade_deadline,league_type,status FROM project_leagues
        where id in (SELECT id_league from project_members
        where id_user=:id_user and member_type in
        (:member_member, :application_accepted, :invitation_accepted,:member_admin))' );

			$st->execute(array('id_user' => $id_user, 'member_member' => 'member',
      'application_accepted' => 'application_accepted', 'invitation_accepted' => 'invitation_accepted',
      'member_admin' => 'admin'));
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

  function createLeague($id_user, $leagueName, $leagueNumber, $week, $day,
    $trade_deadline, $leagueSelect, $status)
  {

    try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'INSERT into
				project_leagues(id_user,title,number_of_members,week,day,
          trade_deadline,league_type,status)
				values (:id_user,:title,:number_of_members,:week,:day,
          :trade_deadline,:league_type,:status)' );

			$st->execute(array('id_user' => $id_user, 'title' => $leagueName,
			 'number_of_members' => $leagueNumber, 'week' => $week, 'day' => $day,
       'trade_deadline' => $trade_deadline, 'league_type' => $leagueSelect,
		 		'status' => $status));


		}
		catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

  }

  function getMyLastAddedLeague($id_user)
  {

    try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id,id_user,title,number_of_members,
        week,day,trade_deadline,league_type,status FROM project_leagues
				where id = (SELECT MAX(id) from project_leagues where id_user =:id_user)' );

			$st->execute(array('id_user' => $id_user));

		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if($row === false)
			return null;

		else
			return new League($row['id'], $row['id_user'], $row['title'],
			  $row['number_of_members'], $row['week'], $row['day'],
        $row['trade_deadline'], $row['league_type'], $row['status']);

  }

  function initializeLeague($id_league,$id_user)
  {
    try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'INSERT into project_members(id_league,id_user,member_type)
			values (:id_league, :id_user, :member_type)' );

			$st->execute(array('id_league' => $id_league, 'id_user' => $id_user, 'member_type' => 'admin' ));


		}
		catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

  }

  function getApplicationPendingLeaguesByUserId($id_user)
  {

    try
	  {
		   $db = DB::getConnection();
		   $st = $db->prepare(' SELECT id,id_user,title,number_of_members,week,day,
         trade_deadline,league_type,status
			 from project_leagues where id in
			(SELECT id_league from project_members where id_user=:id_user and
			member_type=:member_pending)');


		   $st->execute(array('id_user' => $id_user,'member_pending' => 'application_pending'));


	  }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

	  $arr = array();
	  while( $row = $st->fetch() )
	  {
      $arr[] = new League($row['id'], $row['id_user'], $row['title'],
			  $row['number_of_members'], $row['week'], $row['day'],
        $row['trade_deadline'], $row['league_type'], $row['status']);
    }

	   return $arr;

  }


  function getApplicationAcceptedLeaguesByUserId($id_user)
  {

    try
	  {
		   $db = DB::getConnection();
		   $st = $db->prepare(' SELECT id,id_user,title,number_of_members,week,day,
         trade_deadline,league_type,status
			 from project_leagues where id in
			(SELECT id_league from project_members where id_user=:id_user and
			member_type=:member_accepted)');


		   $st->execute(array('id_user' => $id_user,'member_accepted' => 'application_accepted'));


	  }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

	  $arr = array();
	  while( $row = $st->fetch() )
	  {
      $arr[] = new League($row['id'], $row['id_user'], $row['title'],
			  $row['number_of_members'], $row['week'], $row['day'],
        $row['trade_deadline'], $row['league_type'], $row['status']);
    }

	   return $arr;

  }


  function getUsersFromMembersByLeagueId($league_id)
  {


		try
		{
			$db = DB::getConnection();

			// $st = $db->prepare( 'SELECT id, username, password_hash, email,
			// 	 registration_sequence, has_registered from dz2_users where id in
			// 	(SELECT id_user from dz2_members where id_project=:project_id)' );

			$st = $db->prepare( 'SELECT id, username, password_hash, email,
				 registration_sequence, has_registered, bank_account from project_users where id in
				(SELECT id_user from project_members where id_league=:league_id
				and member_type in (:member_member, :member_accepted, :invitation_accepted))' );

			$st->execute(array('league_id' => $league_id, 'member_member' => 'member',
			 'member_accepted' => 'application_accepted','invitation_accepted' => 'invitation_accepted'));


		}
		catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new User( $row['id'], $row['username'], $row['password_hash'],
       $row['email'], $row['registration_sequence'], $row['has_registered'],
        $row['bank_account']);
		}

		return $arr;

  }



  function setApplicationAccepted($id_league, $id_user)
  {
    try
    {
      $db = DB::getConnection();
      $st = $db->prepare('UPDATE project_members set member_type=:member_accepted
           where id_league=:id_league and id_user=:id_user ');

      $st->execute(array('member_accepted' => 'application_accepted',
       'id_league' => $id_league, 'id_user' => $id_user));


    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

  }



  function setApplicationRejected($id_league, $id_user)
  {

    try
    {
      $db = DB::getConnection();
      $st = $db->prepare('UPDATE project_members set member_type=:member_rejected
           where id_league=:id_league and id_user=:id_user ');

      $st->execute(array('member_rejected' => 'application_rejected',
       'id_league' => $id_league, 'id_user' => $id_user));


    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

  }



  function setStatusToClosed($id_league)
  {
    try
	  {
      $db = DB::getConnection();
		  $st = $db->prepare('UPDATE project_leagues set status=:status
        where id=:id_league');

		 $st->execute(array('status' => 'closed', 'id_league' => $id_league));


	}
	catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

  }


  function sendApplication($id_league, $id_user)
  {
    try
	  {
      $db = DB::getConnection();
		  $st = $db->prepare('INSERT into project_members
        (id_league,id_user,member_type)
		    values (:id_league, :id_user, :member_type) ');

		  $st->execute(array('id_league' => $id_league, 'id_user' => $id_user,
      'member_type' => 'application_pending' ));
    }
    catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

  }




};

 ?>
