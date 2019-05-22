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



  public function startDraft()
  {
    $fs = new FantasyService();
    $fst = new FantasyServiceTeams();

    $title = 'Draft';

    $players = $fst->getAllPlayers();

    $oldLeagueUsers = $fst->getAllUsersInsideLeague($_SESSION['id_league']);
    $_SESSION['redoslijed'] = $oldLeagueUsers;

    shuffle($_SESSION['redoslijed']);


    require_once __DIR__.'/../view/teams_draftPage.php';


  }


// korak po korak draft
  public function processDraft()
  {

    $fst = new FantasyServiceTeams();
    $fs = new FantasyService();

    $title = 'Draft';




    //zelimo ubaciti igrace u timove
    //user na redu je onaj na pocetku $_SESSION['redoslijed']
    //odabrani igrac se dobije iz gumba

    $id_league = $_SESSION['id_league'];
    $id_user = $_SESSION['redoslijed'][0]->id;
    $id_player = $_POST['player_id'];
    $team_name = $_SESSION['redoslijed'][0]->username;

    $team_name .= "'s team";

    //brojimo jesmo li na kraju ( ako svaki user ima 7 igraca )

    $brojSelektiranihIgraca = $fst->countSelectedPlayersByUserInLeague($id_league, $id_user);
    if(count($brojSelektiranihIgraca) === 7)
      require_once __DIR__.'/../view/teams_endDraft,php';


    $fst->addPlayerToTeam($team_name, $id_league, $id_user, $id_player, 0);

    //oznaci da je sad taj igrac nedostupan
    //-> to cemo napraviti tako da svaki put provjeravamo poklapa li se
    //player_id sa nekim u tablici, pri cemu liga mora biti ista

    //$fst->checkPlayer($id_league, $id_player);

    //moramo pop() prvi element $_SESSION['redoslijed'] i stavit ga na kraj

    $first = array_shift($_SESSION['redoslijed']);
    array_push($_SESSION['redoslijed'], $first);







    //nastavi draft
    require_once __DIR__.'/../view/teams_draftPage.php';


  }










};





 ?>
