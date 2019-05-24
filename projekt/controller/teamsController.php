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

    if($fst->countSelectedPlayersByUserInLeague($_SESSION['id_league'], $_SESSION['id_user']) >= 2)
    {
      require_once __DIR__.'/../view/teams_endDraft.php';
      exit();
    }

    $players = $fst->getAllPlayers();

    $user = $fst->getMinimalCurrentUser();

    $_SESSION['na_redu'] = $user->username;


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
    $user_na_redu = $fs->getUserByName($_SESSION['na_redu']);
    $user_na_redu_id = $user_na_redu->id;
    $id_player = $_POST['player_id'];
    $team_name = $_SESSION['na_redu'];

    $team_name .= "'s team";

    //brojimo jesmo li na kraju ( ako svaki user ima 7 igraca )

    $brojSelektiranihIgraca = $fst->countSelectedPlayersByUserInLeague($id_league, $user_na_redu_id);
    if($brojSelektiranihIgraca === 2)
    {
      header( 'Location: index.php?rt=teams/endDraft' );
      exit();
    }

      //oznaci da je sad taj igrac nedostupan
      //-> to cemo napraviti tako da svaki put provjeravamo poklapa li se
      //player_id sa nekim u tablici, pri cemu liga mora biti ista

    $bool = $fst->checkPlayerAvailability($id_league, $id_player);

    if($bool === 1)
      $fst->addPlayerToTeam($team_name, $id_league, $user_na_redu_id, $id_player, 0);

    else
      {
        header( 'Location: index.php?rt=teams/startDraft' );
        exit();
      }

  //  brisemo iz tablice najmanji current i stavljamo ga na kraj sa brojem max()+1
    $draft = $fst->getDraftByUserIdInLeague($id_league, $user_na_redu_id);
    $starting = $draft->starting_number;


    $user = $fst->getMinimalCurrentUser();
    $fst->deleteMinimalCurrent();
    $fst->updateOtherCurrents();

    $current = $fst->getMaxCurrentDraft();
    $current++;
    $fst->pushBackCurrent($id_league, $user_na_redu->id, $current, $starting);

    //ovdje jos trebamo redoslijed 1,2,...n, n,...,2,1



  //  nastavi draft
    header( 'Location: index.php?rt=teams/startDraft' );


  }










};





 ?>
