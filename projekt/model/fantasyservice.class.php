<?php

require_once __DIR__.'/db.class.php';
require_once __DIR__.'/user.class.php';

class FantasyService
{
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



};

 ?>
