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

		if(isset($_SESSION['message']))
		{
			echo $_SESSION['message'];
			unset($_SESSION['message']);

		}



		require_once __DIR__.'/../view/users_login.php';
	}


	public function loginResults()
	{
		$fs = new FantasyService();



		if( !isset( $_POST['username'] ) || !isset($_POST['password'])
		|| !preg_match( '/^[a-zA-Z][a-zA-Z0-9]{1,20}$/', $_POST['username'] )  )
		{
			$_SESSION['message'] = 'Incorrect entry in textbox or textbox left empty.<br>'.
												'Admissible entries only letters and numbers.<br>Username has to start with letter.';
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
			$_SESSION['message'] = 'There is no user with that username and password.';
			header( 'Location: index.php?rt=users/login');
			exit();
		}

	}


	public function register()
	{
		$title = 'Register';

		if(isset($_SESSION['message']))
		{
			echo $_SESSION['message'];
			unset($_SESSION['message']);
		}

		require_once __DIR__.'/../view/users_register.php';

	}

	public function registerResults()
	{

		$fs = new FantasyService();


		if( !isset( $_POST['username'] ) || !preg_match( '/^[a-zA-Z][a-zA-Z0-9]{1,20}$/', $_POST['username'] )
		|| !isset($_POST['password']) || !isset($_POST['email'])
		|| !preg_match('/^[a-z][a-z0-9.]*@[a-z]+.[a-z]{2,7}$/',$_POST['email'])
		|| !isset($_POST['bank_account'])
		|| !preg_match('/^[0-9]+.{0,1}[0-9]*$/', $_POST['bank_account']))
		{
			$_SESSION['message'] = 'Not valid choice of characters.';

			header( 'Location: index.php?rt=users/register');
			exit();
		}

		$title = 'Registration';

		$username = $_POST['username'];
		$password = $_POST['password'];
		$password_confirm = $_POST['password_confirm'];
		$email = $_POST['email'];
		$bank_account = (float)$_POST['bank_account'];

		if(strcmp($password, $password_confirm) !== 0)
		{
			$_SESSION['message'] = 'Password and password confirm do not match.';
			header( 'Location: index.php?rt=users/register');
			exit();

		}

		$user = $fs->getUserByName($username);

		if( $user !== null )
		{
			$_SESSION['message'] = 'User already in database.';
			header( 'Location: index.php?rt=users/register');
			exit();
		}


		$hash = password_hash($password, PASSWORD_DEFAULT);

		$brSlova = rand(16,32);
		$registration_sequence = ''; // nasumican niz 20 znakova
		for($j=0;$j<$brSlova;++$j)
		{
			$znak = chr(rand(ord('a'),ord('z')));
			$registration_sequence .= $znak;
		}


		$fs->registerUser($username, $hash, $email, $registration_sequence, 0, $bank_account);
		$fs->sendConfirmationCode($email, $registration_sequence);

		require_once __DIR__.'/../view/users_confirm.php';



	}


	public function confirm()
	{

		$title = 'Confirm';

		if(isset($_SESSION['message']))
		{
			echo $_SESSION['message'];
			unset($_SESSION['message']);
		}

		require_once __DIR__.'/../view/users_confirm.php';

	}



	public function confirmCode()
	{

		$fs = new FantasyService();

		if(!isset($_POST['confirmation']) || !isset($_POST['username'])
		|| !preg_match('/^[a-zA-Z][a-zA-Z0-9]{1,20}$/',$_POST['username']))
		{

				header( 'Location: index.php?rt=users/register');
				exit();

		}

		$title = 'Confirmation of registration';

		$inputCode = $_POST['confirmation'];
		$username = $_POST['username'];

		$targetUser = $fs->getUserByName($_POST['username']);
		$targetCode = $targetUser->registration_sequence;



		if(count($targetUser) !== 1)
		{
			$_SESSION['message'] = 'No user with that username.';
			header( 'Location: index.php?rt=users/confirm');
			exit();

		}


		if(strcmp($inputCode, $targetCode) !== 0)
		{
			$_SESSION['message'] = 'Incorrect confirmation code.';
			header( 'Location: index.php?rt=users/confirm');
			exit();
		}


		else
		{
			$_SESSION['message'] = 'Confirmation successful.';
			$fs->setHasRegistered($targetUser->id);
			require_once __DIR__.'/../view/users_login.php';

		}


	}



};

?>
