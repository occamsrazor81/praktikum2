<?php
session_start();
require_once __DIR__.'/../model/projectservice.class.php';

class UsersController
{
	public function index()
	{
		$ps = new ProjectService();

		$title = 'Users';
		$userList = $ps->getAllUsers();

		require_once __DIR__.'/../view/users_index.php';
	}


	public function login()
	{
		$title = 'Login';

		require_once __DIR__.'/../view/users_login.php';
	}


	public function loginResults()
	{
		$ps = new ProjectService();



		if( !isset( $_POST['username'] ) || !preg_match( '/^[a-zA-Z]{1,10}$/', $_POST['username'] )
		|| !isset($_POST['password']) )
		{

			header( 'Location: index.php?rt=users/login');
			exit();
		}

		$title = 'Stranica';
		$userList = $ps->getUserByUsernameAndPassword($_POST['username'], $_POST['password']);

		if(count($userList) == 1)
		{
			$_SESSION['id_user'] = $userList[0]->id;
			$_SESSION['name'] = $userList[0]->username;
			require_once __DIR__.'/../view/users_ulogirani.php';
			exit();
		}

		else
		{
			require_once __DIR__.'/../view/users_login.php';
			exit();
		}

	}



};

?>
