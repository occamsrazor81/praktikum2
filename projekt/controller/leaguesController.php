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

	public function pendingApplications()
	{
		 	$fs = new FantasyService();

			$title = 'Pending applications';

			$id_user = $_SESSION['id_user'];

			$pendingLeagues = $fs->getApplicationPendingLeaguesByUserId($id_user);
			$acceptedLeagues = $fs->getApplicationAcceptedLeaguesByUserId($id_user);

			$leagueApps = array();


			foreach($pendingLeagues as $pending)
			{
				$admin = $fs->getUserById($pending->id_user);
				$admin_username = $admin->username;

				$leagueApps[] = array('admin' => $admin_username, 'status' => $pending->status,
			 	'title' => $pending->title, 'application' => 'pending');

			}

			foreach($acceptedLeagues as $accepted)
			{
				$admin = $fs->getUserById($accepted->id_user);
				$admin_username = $admin->username;

				$leagueApps[] = array('admin' => $admin_username, 'status' => $accepted->status,
			 	'title' => $accepted->title, 'application' => 'accepted');

			}




			require_once __DIR__.'/../view/leagues_pendingApps.php';

	}



	public function findLeagueDetails()
	{
		$fs = new FantasyService();


		if(!isset($_POST['league_id']))
		{
			header('Location: index.php?rt=leagues/newLeague');
			exit();
		}

		$title = 'League information';

		$league_id = (int)$_POST['league_id'];

		$targetLeague = $fs->getLeagueById($league_id);

		//sad imamo naslov, description
		//trebamo se dokopati authora i membera

		$admin_id = $targetLeague->id_user;
		$admin = $fs->getUserById($admin_id);
		$admin_username = $admin->username;

		//jos samo ostale members (iz zadnje tablice)

//podesiti td vraca samo membere, ili application_accepted
		$targetUsers = $fs->getUsersFromMembersByLeagueId($league_id);

		$userNames = array();
		foreach($targetUsers as $tUser)
		{
			if($tUser->id != $admin_id)
			$userNames[] = $tUser->username;

		}

		$leagueInformationList = array('id_league' => $targetLeague->id, 'admin' => $admin_username,
		'title' => $targetLeague->title, 'targetSize' => $targetLeague->number_of_members,
		'members' => $userNames , 'status' => $targetLeague->status);


		require_once __DIR__.'/../view/leagues_showInformation.php';


	}







};

?>
