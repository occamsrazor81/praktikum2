<?php

session_start();
require_once __DIR__.'/../model/fantasyservice.class.php';
require_once __DIR__.'/../model/fantasyserviceteams.class.php';

class TeamsController
{

  public function index()
  {
    $title = 'Users in League';

    if(!isset($_SESSION['id_user']))
      header( 'Location: index.php?rt=users/login' );

    if (isset($_SESSION['id_league']))
      require_once __DIR__.'/../view/teams_frontPage.php';

    else
      require_once __DIR__.'/../view/users_ulogirani.php';
  }


  public function usersInLeague()
  {
    $fst = new FantasyServiceTeams();
    $fs = new FantasyService();

    $title = 'Users in League';

    $oldLeagueUsers = $fst->getAllUsersInsideLeague($_SESSION['id_league']);
    $league = $fs->getLeagueById($_SESSION['id_league']);

    $leagueUsers = array();

    foreach($oldLeagueUsers as $lUser)
    {
    	$leagueUsers[] = array('id_league' => $_SESSION['id_league'],
    	'id_user' => $lUser->id, 'username' => $lUser->username,
    	'league_title' => $league->title, 'league_type' => $league->league_type,
      'admin' => $_SESSION['name']	);

    }

    require_once __DIR__.'/../view/teams_usersInLeague.php';
  }

};





 ?>
