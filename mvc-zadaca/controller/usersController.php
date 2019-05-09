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



		if( !isset( $_POST['username'] ) || !preg_match( '/^[a-zA-Z]{1,20}$/', $_POST['username'] )
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


	public function register()
	{
		$title = 'Register';

		require_once __DIR__.'/../view/users_register.php';

	}

	public function registerResults()
	{

		$ps = new ProjectService();


		if( !isset( $_POST['username'] ) || !preg_match( '/^[a-zA-Z]{1,20}$/', $_POST['username'] )
		|| !isset($_POST['password']) || !isset($_POST['email'])
		|| !preg_match('/^[a-z][a-z0-9.]*@[a-z]+.[a-z]{2,7}$/',$_POST['email']))
		{

			header( 'Location: index.php?rt=users/register');
			exit();
		}

		$title = 'Registration';

		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];

		$user = $ps->getUserByName($username);

		if( $user !== null )
		{
			header( 'Location: index.php?rt=users/register');
			exit();
		}


		$hash = password_hash($password, PASSWORD_DEFAULT);

		$brSlova = 20;
		$registration_sequence = ''; // nasumican niz 20 znakova
		for($j=0;$j<$brSlova;++$j)
		{
			$znak = chr(rand(ord('a'),ord('z')));
			$registration_sequence .= $znak;
		}


		$ps->registerUser($username, $hash, $email, $registration_sequence, 0);

		$ps->sendConfirmationCode($email, $registration_sequence);

		require_once __DIR__.'/../view/users_confirm.php';



	}



};

?>
