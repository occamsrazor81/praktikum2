<?php
session_start();
require_once __DIR__.'/../model/fantasyservice.class.php';

class LeaguesController
{

	public function index()
	{
		$fs = new FantasyService();

		$title = 'All leagues';
		$idLeagueList = $fs->getAllLeagues();

		$leagueList = array();

		foreach ($idLeagueList as $league )
		{
			$user = $fs->getUserById($league->id_user);
			if( $user === null )
					exit( 'There is no user with id = ' . $league->id_user );

			$leagueList[] = array('id' => $league->id, 'title' => $league->title,
			'admin' => $user->username, 'league_type' => $league->league_type,
			'status' => $league->status);
		}


		require_once __DIR__.'/../view/leagues_index.php';
	}


	public function myLeagues()
  {
    $fs = new FantasyService();

    $title = 'My leagues';


		$idLeagueList = $fs->getAllMyLeagues($_SESSION['id_user']);



		$leaguetList = array();
		foreach ($idLeagueList as $league )
		{
			$user = $fs->getUserById($league->id_user);
			if( $user === null )
					exit( 'There is no user with id = ' . $league->id_user );

			$applicants = $fs->getApplicantsViaLeagueId($league->id);


			$leagueList[] = array('id' => $league->id, 'title' => $league->title,
			'admin' => $user->username, 'league_type' => $league->league_type,
			'status' => $league->status, 'applicants' => $applicants);


		}


    require_once __DIR__.'/../view/leagues_myIndex.php';

  }

	public function createNew()
	{
		$title = 'Create new League';

		require_once __DIR__.'/../view/leagues_newLeague.php';
	}


	public function createNewLeague()
	{

		$fs = new FantasyService();

		if(!isset($_SESSION['id_user']))
		{
			header('Location: index.php?rt=leagues/newLeague');
			exit();
		}

		$id_user = $_SESSION['id_user'];



////////////////////////
		if(!isset($_POST['leagueName']) || !isset($_POST['leagueSelect'])
		|| !isset($_POST['leagueNumber'])
		|| !preg_match('/^[a-zA-Z0-9 ,.]+$/',$_POST['leagueName'])
		|| !preg_match('/^[1-9]0*$/',(int)$_POST['leagueNumber']))
		{
			header('Location: index.php?rt=leagues/newLeague');
			exit();
		}

		//////////////////////////////////

		$leagueName = $_POST['leagueName'];
		$leagueSelect = $_POST['leagueSelect'];
		$leagueNumber = (int)$_POST['leagueNumber'];

		$trade_deadline = $leagueNumber - 2;
		//ukupno za sebe i jedan tjedan manje
		//week i day na pocetku (1,1)
		$fs->createLeague($id_user, $leagueName, $leagueNumber, 1, 1,
			$trade_deadline, $leagueSelect, 'open');

		// dodaj ga u svoj projekt kao membera

		$targetLeague = $fs->getMyLastAddedLeague($id_user);

		$fs->initializeLeague($targetLeague->id,$id_user);

		header('Location: index.php?rt=leagues/newLeague');
		exit();

	}







};

?>
