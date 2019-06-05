<?php
session_start();

require_once __DIR__.'/../model/fantasyservice.class.php';

class _404Controller
{
	public function index()
	{
		$title = 'Stranica nije pronađena.';

		if(!isset($_SESSION['id_user']))
			require_once 'view/users_login.php';

		else
			require_once 'view/users_ulogirani.php';

	}
};

?>
