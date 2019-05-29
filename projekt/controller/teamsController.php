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

    //postaviti mozda pomocu JSa localStorage

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

  ///////////////////////////////////////////////////////////
  ///POSLIJE DRAFTA

  public function myTeam()
  {

    $fst = new FantasyServiceTeams();
    $fs = new FantasyService();

    $title = $fst->getTeamName($_SESSION['id_league'], $_SESSION['id_user']);

    $myPlayers = $fst->getAllPlayersInMyTeam($_SESSION['id_league'], $_SESSION['id_user']);

    // print_r($myPlayers);

    require_once __DIR__.'/../view/teams_myTeam.php';

  }


  public function myTeamStats()
  {
    //svi igraci tima i njihovi statsi

    $fst = new FantasyServiceTeams();
    $fs = new FantasyService();

    $title = $fst->getTeamName($_SESSION['id_league'], $_SESSION['id_user']). ' stats';

    $players = $fst->getAllPlayersInMyTeam($_SESSION['id_league'], $_SESSION['id_user']);

    $myPlayers = array();

    //za svakog igraca dohvati id, ime, poziciju i statse
    foreach($players as $plr)
    {
     $plyr_stats = $fst->getPlayerStatsByPlayerId($plr->id);

     //print_r($plyr_stats);


     if(isset($plr->id))
      $myPlayers[] = array(
    'id_player' => $plr->id, 'player_name' => $plr->name,'position' => $plr->position,
    'fgm' => $plyr_stats->fgm, 'fga' => $plyr_stats->fga, 'fg_perc' => $plyr_stats->fg_perc,
    'tpm' => $plyr_stats->tpm,
    'ftm' => $plyr_stats->ftm, 'fta' => $plyr_stats->fta, 'ft_perc' => $plyr_stats->ft_perc,
    'pts' => $plyr_stats->pts, 'reb' => $plyr_stats->reb, 'ast' => $plyr_stats->ast,
    'st' => $plyr_stats->st, 'blk' => $plyr_stats->blk, 'tov' => $plyr_stats->tov  );

    //echo $plr->id;
    //print_r($myPlayers);

    }



    require_once __DIR__.'/../view/teams_myTeamStats.php';

  }


  public function changeTeamName()
  {
    $title = 'Change Team Name';

    require_once __DIR__.'/../view/teams_change_team_name.php';

  }

  public function changeTeamNameResults()
  {

    $fst = new FantasyServiceTeams();
    $fs = new FantasyService();

    if(!isset($_POST['team_name']) || !preg_match('/^[a-zA-Z][a-zA-Z0-9,\' ]*$/',$_POST['team_name']))
    {
      header( 'Location: index.php?rt=teams/changeTeamName' );
      exit();
    }

    $fst->changeTName($_POST['team_name'], $_SESSION['id_league'], $_SESSION['id_user']);

    $title = $fst->getTeamName($_SESSION['id_league'], $_SESSION['id_user']);

    header('Location: index.php?rt=teams/myTeam');


  }



  public function addPlayer()
  {

    $fst = new FantasyServiceTeams();
    $fs = new FantasyService();

    $title = 'Free agents';

    $freeAgents = $fst->getAllFreeAgents($_SESSION['id_league']);

    require_once __DIR__.'/../view/teams_freeAgents.php';

  }


  public function pickUpFreeAgent()
  {

    $fst = new FantasyServiceTeams();
    $fs = new FantasyService();

    $myCurrentPlayers = $fst->getAllPlayersInMyTeam($_SESSION['id_league'], $_SESSION['id_user']);

    //promijeniti u 7
    if(count($myCurrentPlayers) == 2)
    {
      $_SESSION['new_player_id'] = $_POST['player_id'];
      $team_name = $fst->getTeamName($_SESSION['id_league'], $_SESSION['id_user']);
      $title = 'Replace player from '.$team_name;
      require_once __DIR__.'/../view/teams_kickFromTeam.php';
      exit();
    }

    $team_name = $fst->getTeamName($_SESSION['id_league'], $_SESSION['id_user']);
    $title = 'Add player to '.$team_name;

    $_SESSION['new_player_id'] = $_POST['player_id'];

    $newPlayer = $fst->getPlayerById($_SESSION['new_player_id']);

    // $fst->addPlayerToTeam($team_name, $_SESSION['id_league'], $_SESSION['id_user'], $_POST['player_id'], 0);
    //
    // header('Location: index.php?rt=teams/myTeam');

    require_once __DIR__.'/../view/teams_confirmAddingPlayer.php';

  }


  public function kickPlayerFromTeam()
  {
    $fst = new FantasyServiceTeams();
    $fs = new FantasyService();

    $team_name = $fst->getTeamName($_SESSION['id_league'], $_SESSION['id_user']);
    $title = 'Replace player from '.$team_name;

    if(!isset($_SESSION['new_player_id']))
    {
      header('Location: index.php?rt=teams/addPlayer');
      exit();
    }

    $id_new = $_SESSION['new_player_id'];
    $id_kicked = $_POST['player_id'];

    $_SESSION['kicked_player_id'] = $id_kicked;

    $newPlayer = $fst->getPlayerById($id_new);
    $kickedPlayer = $fst->getPlayerById($id_kicked);


    require_once __DIR__.'/../view/teams_rUSure.php';



  }


  public function confirmAddingFreeAgent()
  {
    $fst = new FantasyServiceTeams();
    $fs = new FantasyService();

    if(isset($_POST['no']))
    {
      unset($_SESSION['new_player_id']);
      unset($_SESSION['kicked_player_id']);
      header('Location: index.php?rt=teams/myTeam');
      exit();
    }

    else
    {

      $fst->replacePlayerInTeam($_SESSION['id_league'],
      $_SESSION['kicked_player_id'], $_SESSION['new_player_id']);

      unset($_SESSION['new_player_id']);
      unset($_SESSION['kicked_player_id']);

      header('Location: index.php?rt=teams/myTeam');
      exit();

    }


  }


  public function cutPlayer()
  {

    $fst = new FantasyServiceTeams();
    $fs = new FantasyService();

    $team_name = $fst->getTeamName($_SESSION['id_league'], $_SESSION['id_user']);
    $title = 'Cut player from '.$team_name;

    $id_kicked = $_POST['player_id'];
    $_SESSION['kicked_player_id'] = $id_kicked;

    $kickedPlayer = $fst->getPlayerById($id_kicked);

//    $fst->cutPlayerFromTeam($_SESSION['id_league'], $_SESSION['kicked_player_id']);

    require_once __DIR__.'/../view/teams_rUSure_cut.php';

  }

  public function confirmCuttingPlayer()
  {
    $fst = new FantasyServiceTeams();
    $fs = new FantasyService();


    if(isset($_POST['no']))
    {
      unset($_SESSION['kicked_player_id']);
      header('Location: index.php?rt=teams/myTeam');
      exit();

    }

    else
    {
      $fst->cutPlayerFromTeam($_SESSION['id_league'], $_SESSION['kicked_player_id']);

      unset($_SESSION['kicked_player_id']);
      header('Location: index.php?rt=teams/myTeam');
      exit();


    }
  }



  public function confirmAddingPlayer()
  {

    $fst = new FantasyServiceTeams();
    $fs = new FantasyService();

    $team_name = $fst->getTeamName($_SESSION['id_league'], $_SESSION['id_user']);

    if(isset($_POST['no']))
    {
      unset($_SESSION['new_player_id']);
      header('Location: index.php?rt=teams/myTeam');
      exit();

    }

    else
    {

      $fst->addPlayerToTeam($team_name, $_SESSION['id_league'], $_SESSION['id_user'], $_SESSION['new_player_id'], 0);

      unset($_SESSION['new_player_id']);
      header('Location: index.php?rt=teams/myTeam');
      exit();


    }

  }



  public function proposeTrade()
  {

    $fs = new FantasyService();
    $fst = new FantasyServiceTeams();

    $title = 'Propose Trade';

    $otherTeamsInLeague = $fst->getOtherTeams($_SESSION['id_league'], $_SESSION['id_user']);

    $otherTeams = array();

    foreach($otherTeamsInLeague as $team)
    {
      $user = $fs->getUserById($team->id_user);

      $otherTeams[] = array('id' => $team->id, 'id_user' => $user->id,
      'id_league' => $team->id_league, 'username' => $user->username,
      'team_name' => $team->team_name);

    }


    require_once __DIR__.'/../view/teams_otherTeams.php';


  }


  public function checkTeam()
  {

    $fs = new FantasyService();
    $fst = new FantasyServiceTeams();

    $id_team = $_POST['team_id'];
    $team = $fst->getTeamById($id_team);

    $title = 'Propose Trade to '.$team->team_name;

    $_SESSION['other_user_id'] = $team->id_user;

    $playersFromSelectedTeam = $fst->getPlayersFromTeam($team->id_league, $team->id_user);


    require_once __DIR__.'/../view/teams_checkTeam.php';

  }


  public function askForTrade()
  {

    $fs = new FantasyService();
    $fst = new FantasyServiceTeams();

    $title = 'Trade from my Team';

    $id_player = $_POST['player_id'];
    $targetPlayer = $fst->getPlayerById($id_player);

    $_SESSION['trade_player_id'] = $id_player;

    $myPlayers = $fst->getAllPlayersInMyTeam($_SESSION['id_league'], $_SESSION['id_user']);

    require_once __DIR__.'/../view/teams_whoFor.php';

  }


  public function confirmTradeRequest()
  {

    $fs = new FantasyService();
    $fst = new FantasyServiceTeams();

    $title = 'Trade Request Confirmation';

    if(isset($_POST['cancel']))
    {

      unset($_SESSION['other_user_id']);
      unset($_SESSION['trade_player_id']);
      header('Location: index.php?rt=teams/proposeTrade');
      exit();
    }

    $myPlayerId = $_POST['player_id'];
    $otherPlayerId = $_SESSION['trade_player_id'];

    $_SESSION['my_player_id'] = $myPlayerId;

    $myPlayer = $fst->getPlayerById($myPlayerId);
    $otherPlayer = $fst->getPlayerById($otherPlayerId);


    //$fst->requestTrade($_SESSION['id_league'], $myPlayerId, $otherPlayerId);

    require_once __DIR__.'/../view/teams_rUSure_trade.php';

  }



  public function sendTradeRequest()
  {

    $fs = new FantasyService();
    $fst = new FantasyServiceTeams();


    if(isset($_POST['no']))
    {
      $title = 'Canceled';

      unset($_SESSION['other_user_id']);
      unset($_SESSION['my_player_id']);
      unset($_SESSION['trade_player_id']);
      header('Location: index.php?rt=teams/proposeTrade');
      exit();

    }

    else
    {
      $title = 'Trade Request Sent';

      $myTeam = $fst->getTeamByUserAndLeague($_SESSION['id_league'], $_SESSION['id_user']);
      $otherTeam = $fst->getTeamByUserAndLeague($_SESSION['id_league'], $_SESSION['other_user_id']);

      $myTeamId = $myTeam->id;
      $otherTeamId = $otherTeam->id;

      $fst->requestTrade($_SESSION['id_league'], $myTeamId, $otherTeamId,
      $_SESSION['my_player_id'], $_SESSION['trade_player_id'],
      null, null, null, null); //ostali igraci nisu ukljuceni



      unset($_SESSION['other_user_id']);
      unset($_SESSION['my_player_id']);
      unset($_SESSION['trade_player_id']);


      // require_once __DIR__.'/../view/teams_myTrades.php';

      header('Location: index.php?rt=teams/pendingTrades');


    }

  }



  public function pendingTrades()
  {

    $fs = new FantasyService();
    $fst = new FantasyServiceTeams();

    $title = 'My pending Trades';

    $myTeamIds = $fst->getMyTeamIds($_SESSION['id_league'], $_SESSION['id_user']);

    //print_r($myTeamIds);

    $allMyTrades = array();
    foreach($myTeamIds as $id_team)
    {
      //print_r($id_team);
      $myTrades = $fst->getMyPendingTradesViaLeagueAndTeam($_SESSION['id_league'], $id_team);
       //print_r($myTrades);

      if(isset($myTrades))
      foreach($myTrades as $trades)
      {
        //print_r($myTrades);
        $allMyTrades[] = array('id_player1' => $trades->id_player1,
      'id_player11' => $trades->id_player11,
      'id_player12' => $trades->id_player12,
      'id_player21' => $trades->id_player21,
      'id_player22' => $trades->id_player22,
      'id_player2' => $trades->id_player2,
      'trade_status' => $trades->trade_status);


      }

      unset($myTrades);

    }

    require_once __DIR__.'/../view/teams_myTrades.php';

  }







};





 ?>
