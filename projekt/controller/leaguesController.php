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







};

?>
