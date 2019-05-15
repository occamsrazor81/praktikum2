<?php
session_start();
require_once __DIR__.'/../model/fantasyservice.class.php';

class UsersController
{
	public function index()
	{
		$fs = new FantasyService();

		$title = 'Users';
		$userList = $fs->getAllUsers();

		require_once __DIR__.'/../view/users_index.php';
	}


	public function login()
	{

		$title = 'Login';

		if(isset($_POST['logout']))
		{
			session_unset();
			session_destroy();
			require_once __DIR__.'/../view/users_login.php';

		}



		require_once __DIR__.'/../view/users_login.php';
	}


	public function loginResults()
	{
		$fs = new FantasyService();



		if( !isset( $_POST['username'] ) || !preg_match( '/^[a-zA-Z]{1,20}$/', $_POST['username'] )
		|| !isset($_POST['password']) )
		{

			header( 'Location: index.php?rt=users/login');
			exit();
		}

		$title = 'Stranica';
		$userList = $fs->getUserByUsernameAndPassword($_POST['username'], $_POST['password']);

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


	// public function register()
	// {
	// 	$title = 'Register';
	//
	// 	require_once __DIR__.'/../view/users_register.php';
	//
	// }
	//
	// public function registerResults()
	// {
	//
	// 	$fs = new FantasyService();
	//
	//
	// 	if( !isset( $_POST['username'] ) || !preg_match( '/^[a-zA-Z]{1,20}$/', $_POST['username'] )
	// 	|| !isset($_POST['password']) || !isset($_POST['email'])
	// 	|| !preg_match('/^[a-z][a-z0-9.]*@[a-z]+.[a-z]{2,7}$/',$_POST['email']))
	// 	{
	// 		$message = 'Not valid choice of characters.';
	//
	// 		header( 'Location: index.php?rt=users/register');
	// 		exit();
	// 	}
	//
	// 	$title = 'Registration';
	//
	// 	$username = $_POST['username'];
	// 	$password = $_POST['password'];
	// 	$email = $_POST['email'];
	//
	// 	$user = $fs->getUserByName($username);
	//
	// 	if( $user !== null )
	// 	{
	// 		$message = 'User already in database.';
	// 		header( 'Location: index.php?rt=users/register');
	// 		exit();
	// 	}
	//
	//
	// 	$hash = password_hash($password, PASSWORD_DEFAULT);
	//
	// 	$brSlova = 20;
	// 	$registration_sequence = ''; // nasumican niz 20 znakova
	// 	for($j=0;$j<$brSlova;++$j)
	// 	{
	// 		$znak = chr(rand(ord('a'),ord('z')));
	// 		$registration_sequence .= $znak;
	// 	}
	//
	//
	// 	$fs->registerUser($username, $hash, $email, $registration_sequence, 0);
	//
	// 	$fs->sendConfirmationCode($email, $registration_sequence);
	//
	// 	require_once __DIR__.'/../view/users_confirm.php';
	//
	//
	//
	// }
	//
	//
	// public function confirm()
	// {
	//
	// 	$title = 'Confirm';
	//
	// 	require_once __DIR__.'/../view/users_confirm.php';
	//
	// }
	//
	//
	//
	// public function confirmCode()
	// {
	//
	// 	$fs = new FantasyService();
	//
	// 	if(!isset($_POST['confirmation']) || !isset($_POST['username'])
	// 	|| !preg_match('/^[a-zA-Z]{1,20}$/',$_POST['username']))
	// 	{
	//
	// 			header( 'Location: index.php?rt=users/register');
	// 			exit();
	//
	// 	}
	//
	// 	$title = 'Confirmation of registration';
	//
	// 	$inputCode = $_POST['confirmation'];
	//
	// 	$targetUser = $fs->getUserByName($_POST['username']);
	// 	$targetCode = $targetUser->registration_sequence;
	//
	// 	if(strcmp($inputCode, $targetCode) !== 0)
	// 	{
	// 		header( 'Location: index.php?rt=users/confirm');
	// 		exit();
	// 	}
	//
	//
	//
	// 	else
	// 	{
	// 		$fs->setHasRegistered($targetUser->id);
	// 		require_once __DIR__.'/../view/users_login.php';
	//
	// 	}
	//
	//
	// }
	//


};

?>
