<?php

require_once __DIR__.'/db.class.php';
require_once __DIR__.'/user.class.php';
require_once __DIR__.'/project.class.php';

class ProjectService
{
	//---------------------------------------------------------------
	//users

	function getUserById($id)
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, username, password_hash, email,
				 registration_sequence, has_registered FROM dz2_users where id=:id' );
			$st->execute(array('id' => $id));
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if($row === false)
			return null;

		else
			return new User($row['id'], $row['username'], $row['password_hash'],
			$row['email'], $row['registration_sequence'], $row['has_registered'] );


	}


	function getAllUsers( )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, username, password_hash,
        email, registration_sequence, has_registered FROM dz2_users' );
			$st->execute();
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new User( $row['id'], $row['username'], $row['password_hash'], $row['email'], $row['registration_sequence'], $row['has_registered'] );
		}

		return $arr;
	}

	function getUserByUsernameAndPassword($username, $password)
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, username, password_hash,
				email, registration_sequence, has_registered FROM dz2_users
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


			if(password_verify($password, $hash))
			{
				$arr[] = new User( $row['id'], $row['username'], $row['password_hash'],
				 $row['email'], $row['registration_sequence'], $row['has_registered'] );

				return $arr;
			}



			else return $arr;

		}

	}


	////////////////////////////////////////////////////////////////
	//projects


	function getProjectById($id)
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id,id_user,title,abstract,number_of_members,status
				FROM dz2_projects where id=:id' );

			$st->execute(array('id' => $id));

		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if($row === false)
			return null;

		else
			return new Project($row['id'], $row['id_user'], $row['title'],
			 $row['abstract'], $row['number_of_members'], $row['status']);

	}



	function getAllProjects()
	{

		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id,id_user,title,
				abstract,number_of_members,status FROM dz2_projects' );
			$st->execute();
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Project( $row['id'], $row['id_user'], $row['title'],
			 $row['abstract'], $row['number_of_members'], $row['status'] );
		}

		return $arr;

	}

	function getMyProjects($id_user)
	{

		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id,id_user,title, abstract,
				number_of_members,status FROM dz2_projects where id_user=:id_user' );
			$st->execute(array('id_user' => $id_user));

		}
		catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Project( $row['id'], $row['id_user'], $row['title'],
			 $row['abstract'], $row['number_of_members'], $row['status'] );
		}

		return $arr;



	}

	function createProject($id_user,$projectName,$projectDescription,$projectNumber)
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'INSERT into
				dz2_projects(id_user,title,abstract,number_of_members,status)
				values (:id_user,:title,:abstract,:number_of_members,:status)' );

			$st->execute(array('id_user' => $id_user, 'title' => $projectName,
			 'abstract' => $projectDescription, 'number_of_members' => $projectNumber,
		 		'status' => 'open'));


		}
		catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }



	}

	function getUsersFromMembersByProjectId($project_id)
	{
		try
		{
			$db = DB::getConnection();

			// $st = $db->prepare( 'SELECT id, username, password_hash, email,
			// 	 registration_sequence, has_registered from dz2_users where id in
			// 	(SELECT id_user from dz2_members where id_project=:project_id)' );

			$st = $db->prepare( 'SELECT id, username, password_hash, email,
				 registration_sequence, has_registered from dz2_users where id in
				(SELECT id_user from dz2_members where id_project=:project_id
				and member_type in (:member_member, :member_accepted, :invitation_accepted))' );

			$st->execute(array('project_id' => $project_id, 'member_member' => 'member',
			 'member_accepted' => 'application_accepted','invitation_accepted' => 'invitation_accepted'));


		}
		catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new User( $row['id'], $row['username'], $row['password_hash'], $row['email'], $row['registration_sequence'], $row['has_registered'] );
		}

		return $arr;

	}



function addNewMember($id_project, $id_user)
{
	try
	{
		$db = DB::getConnection();
		$st = $db->prepare( 'INSERT into dz2_members(id_project,id_user,member_type)
		values (:id_project, :id_user, :member_type)' );

		$st->execute(array('id_project' => $id_project, 'id_user' => $id_user, 'member_type' => 'member' ));


	}
	catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }


}



function setStatusToClosed($id_project)
{
	try
	{
		$db = DB::getConnection();
		$st = $db->prepare('UPDATE dz2_projects set status=:status where id=:id_project');

		$st->execute(array('status' => 'closed', 'id_project' => $id_project));


	}
	catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

}


///////////////////////////////////


function sendApplication($id_project, $id_user)
{

	try
	{
		$db = DB::getConnection();
		$st = $db->prepare('INSERT into dz2_members(id_project,id_user,member_type)
		values (:id_project, :id_user, :member_type) ');

		$st->execute(array('id_project' => $id_project, 'id_user' => $id_user, 'member_type' => 'application_pending' ));


	}
	catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

}


function getApplicationPendingProjectsByUserId($id_user)
{

	try
	{
		$db = DB::getConnection();
		$st = $db->prepare(' SELECT id,id_user,title,abstract,number_of_members,status
			from dz2_projects where id in
			(SELECT id_project from dz2_members where id_user=:id_user and
			member_type=:member_pending)');


		$st->execute(array('id_user' => $id_user,'member_pending' => 'application_pending'));


	}
	catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

	$arr = array();
	while( $row = $st->fetch() )
	{
		$arr[] = new Project( $row['id'], $row['id_user'], $row['title'],
		 $row['abstract'], $row['number_of_members'], $row['status'] );
	}

	return $arr;
}



function getApplicationAcceptedProjectsByUserId($id_user)
{
	try
	{
		$db = DB::getConnection();
		$st = $db->prepare(' SELECT id,id_user,title,abstract,number_of_members,status
			from dz2_projects where id in
			(SELECT id_project from dz2_members where id_user=:id_user and
			member_type=:member_accepted)');


		$st->execute(array('id_user' => $id_user,'member_accepted' => 'application_accepted'));


	}
	catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

	$arr = array();
	while( $row = $st->fetch() )
	{
		$arr[] = new Project( $row['id'], $row['id_user'], $row['title'],
		 $row['abstract'], $row['number_of_members'], $row['status'] );
	}

	return $arr;

}



function getApplicantsViaProjectId($project_id)
{

	try
	{
		$db = DB::getConnection();
		$st = $db->prepare('SELECT id, username, password_hash, email,
			registration_sequence, has_registered from dz2_users where id in
			(SELECT id_user from dz2_members
				where id_project=:project_id and member_type=:member_pending)');

		$st->execute(array('project_id' => $project_id, 'member_pending' => 'application_pending'));


	}
	catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

	$arr = array();
	while( $row = $st->fetch() )
	{
		$arr[] = new User( $row['id'], $row['username'], $row['password_hash'], $row['email'], $row['registration_sequence'], $row['has_registered'] );
	}

	return $arr;


}



function setApplicationAccepted($id_project, $id_user)
{

	try
	{
		$db = DB::getConnection();
		$st = $db->prepare('UPDATE dz2_members set member_type=:member_accepted
			where id_project=:id_project and id_user=:id_user ');

		$st->execute(array('member_accepted' => 'application_accepted',
	'id_project' => $id_project, 'id_user' => $id_user));


	}
	catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }


}



function setApplicationRejected($id_project, $id_user)
{

	try
	{
		$db = DB::getConnection();
		$st = $db->prepare('UPDATE dz2_members set member_type=:member_rejected
			where id_project=:id_project and id_user=:id_user ');

		$st->execute(array('member_rejected' => 'application_rejected',
	'id_project' => $id_project, 'id_user' => $id_user));


	}
	catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }


}










	//////////////////////////////////////////////////////////////////////////////
	//members






};


 ?>
