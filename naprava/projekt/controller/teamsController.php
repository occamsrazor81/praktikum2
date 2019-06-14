<?php

session_start();
require_once __DIR__.'/../model/fantasyservice.class.php';
require_once __DIR__.'/../model/fantasyserviceteams.class.php';

function sendJSONandExit( $message )
{
    // Kao izlaz skripte pošalji $message u JSON formatu i prekini izvođenje.
    header( 'Content-type:application/json;charset=utf-8' );
    echo json_encode( $message );
    flush();
    exit( 0 );
}
///////////////////////////////////////


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

    $user = $fst->getMinimalCurrentUser($_SESSION['id_league']);//

    $_SESSION['na_redu'] = $user->username;



    require_once __DIR__.'/../view/teams_draftPage.php';


  }


// korak po korak draft
  public function processDraft()
  {

    $fst = new FantasyServiceTeams();
    $fs = new FantasyService();

    $title = 'Draft';

    ///---------------------ajax

    if(!isset($_POST['player_id']))
    {
      sendJSONandExit(['error' => 'You need to send player_id']);
    }

    $id_player = $_POST['player_id'];
    $id_league = $_SESSION['id_league'];
    $user_na_redu = $fs->getUserByName($_SESSION['na_redu']);
    $user_na_redu_id = $user_na_redu->id;
    $team_name = $_SESSION['na_redu'];
    $team_name .= "'s team";


    ///---------------------ajax

    //zelimo ubaciti igrace u timove
    //user na redu je onaj na pocetku $_SESSION['redoslijed']
    //odabrani igrac se dobije iz gumba



///bez ajaxa


    // $id_league = $_SESSION['id_league'];
    // $user_na_redu = $fs->getUserByName($_SESSION['na_redu']);
    // $user_na_redu_id = $user_na_redu->id;
    // $id_player = $_POST['player_id'];
    // $team_name = $_SESSION['na_redu'];
    //
    // $team_name .= "'s team";


//kraj bez ajaxa


  
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


    $user = $fst->getMinimalCurrentUser($_SESSION['id_league']);
    $fst->deleteMinimalCurrent($_SESSION['id_league']);
    $fst->updateOtherCurrents($_SESSION['id_league']);

    $current = $fst->getMaxCurrentDraft($_SESSION['id_league']);
    $current++;
    $fst->pushBackCurrent($id_league, $user_na_redu->id, $current, $starting);

    //ovdje jos trebamo redoslijed 1,2,...n, n,...,2,1



  //  nastavi draft
    //header( 'Location: index.php?rt=teams/startDraft' );




//--------------- ajax - nastavak

$msg = [];

$new_na_redu = $fst->getMinimalCurrentUser($_SESSION['id_league']);

$msg['player_id'] = $id_player;
$msg['na_redu'] = $new_na_redu->username;

sendJSONandExit($msg);

//--------------- ajax - nastavak


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

      //dodati reject ostalima koji ga traze ili kojima ga nudim

      $tradesRejected = $fst->getAllTradesInvolvingPlayerInLeague($_SESSION['id_league'], $_SESSION['kicked_player_id']);
      foreach($tradesRejected as $trades)
      $fst->setTradeStatusRejected($trades->id);

      //////////////////////////////////////

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

      //dodati reject ostalima koji ga traze ili kojima ga nudim

      $tradesRejected = $fst->getAllTradesInvolvingPlayerInLeague($_SESSION['id_league'], $_SESSION['kicked_player_id']);
      foreach($tradesRejected as $trades)
      $fst->setTradeStatusRejected($trades->id);

      //////////////////////////////////////

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

    // $id_player = $_POST['player_id'];
    // $targetPlayer = $fst->getPlayerById($id_player);
    //
    // $_SESSION['trade_player_id'] = $id_player;
    //
    // $myPlayers = $fst->getAllPlayersInMyTeam($_SESSION['id_league'], $_SESSION['id_user']);

    if(!isset($_POST['propose']) || (count($_POST['players']) > 3))
    {
      unset($_SESSION['other_user_id']);
      header('Location: index.php?rt=teams/proposeTrade');
      exit();
    }

    else
    {
      $targetPlayers = array();

      $_SESSION['trade_count'] = count($_POST['players']);
      $_SESSION['trade_ids'] = array();

      if(!empty($_POST['players']))
      {
        //$cnt = 1;
        foreach($_POST['players'] as $id_player)
        {
          $player = $fst->getPlayerById($id_player);
          $targetPlayers[] = $player;

          $_SESSION['trade_ids'][] = $id_player;
          $string = 'trade_player_'.$id_player;
          $_SESSION[$string] = $id_player;
        //  $cnt++;
        }
      }

      $myPlayers = $fst->getAllPlayersInMyTeam($_SESSION['id_league'], $_SESSION['id_user']);

    }

    require_once __DIR__.'/../view/teams_whoFor.php';

  }


  public function confirmTradeRequest()
  {

    $fs = new FantasyService();
    $fst = new FantasyServiceTeams();

    $title = 'Trade Request Confirmation';

    // if(isset($_POST['cancel']))
    // {
    //
    //   unset($_SESSION['other_user_id']);
    //   unset($_SESSION['trade_player_id']);
    //   header('Location: index.php?rt=teams/proposeTrade');
    //   exit();
    // }
    //
    // $myPlayerId = $_POST['player_id'];
    // $otherPlayerId = $_SESSION['trade_player_id'];
    //
    // $_SESSION['my_player_id'] = $myPlayerId;
    //
    // $myPlayer = $fst->getPlayerById($myPlayerId);
    // $otherPlayer = $fst->getPlayerById($otherPlayerId);
    //
    //
    // //$fst->requestTrade($_SESSION['id_league'], $myPlayerId, $otherPlayerId);
    //

    $otherCnt = $_SESSION['trade_count'];
    if(isset($_POST['cancel']) || (count($_POST['myplayers']) < 1))
    {
      unset($_SESSION['other_user_id']);

      for($i = 0; $i < $_SESSION['trade_count']; $i++)
      {
        $string = 'trade_player_'.$_SESSION['trade_ids'][$i];
        unset($_SESSION[$string]);
      }

      unset($_SESSION['trade_count']);
      unset($_SESSION['trade_ids']);

      header('Location: index.php?rt=teams/proposeTrade');
      exit();
    }

    $myPlayers = array();
    $_SESSION['my_trade_ids'] = array();

    $_SESSION['my_trade_count'] = count($_POST['myplayers']);

    foreach($_POST['myplayers'] as $myPlayerId)
    {
      $myPlayer = $fst->getPlayerById($myPlayerId);
      $myPlayers[] = $myPlayer;

      $_SESSION['my_trade_ids'][] = $myPlayerId;

    }

    $otherPlayers = array();
    foreach($_SESSION['trade_ids'] as $id_other)
    {
      $otherPlayer = $fst->getPlayerById($id_other);
      $otherPlayers[] = $otherPlayer;

    }



    require_once __DIR__.'/../view/teams_rUSure_trade.php';

  }



  public function sendTradeRequest()
  {

    $fs = new FantasyService();
    $fst = new FantasyServiceTeams();


    // if(isset($_POST['no']))
    // {
    //   $title = 'Canceled';
    //
    //   unset($_SESSION['other_user_id']);
    //   unset($_SESSION['my_player_id']);
    //   unset($_SESSION['trade_player_id']);
    //   header('Location: index.php?rt=teams/proposeTrade');
    //   exit();
    //
    // }

    if(isset($_POST['no']))
    {
      unset($_SESSION['other_user_id']);

      for($i = 0; $i < $_SESSION['trade_count']; $i++)
      {
        $string = 'trade_player_'.$_SESSION['trade_ids'][$i];
        unset($_SESSION[$string]);
      }

      unset($_SESSION['trade_count']);
      unset($_SESSION['trade_ids']);


      unset($_SESSION['my_trade_count']);
      unset($_SESSION['my_trade_ids']);

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

      // $fst->requestTrade($_SESSION['id_league'], $myTeamId, $otherTeamId,
      // $_SESSION['my_player_id'], $_SESSION['trade_player_id'],
      // null, null, null, null); //ostali igraci nisu ukljuceni



      // unset($_SESSION['other_user_id']);
      // unset($_SESSION['my_player_id']);
      // unset($_SESSION['trade_player_id']);

      // ///////////////////////////////////
      // function requestTrade($id_league, $myTeamId, $otherTeamId,
      // $id_player1, $id_player2,
      // $id_player11, $id_player12, $id_player21, $id_player22)
      ///////////////////////////////////////////////

      $myCount = $_SESSION['my_trade_count'];
      $otherCnt = $_SESSION['trade_count'];


      $myPlayerId1 = $_SESSION['my_trade_ids'][0];
      $myCount--;

      if($myCount > 0)
      {
        $myPlayerId11 = $_SESSION['my_trade_ids'][1];
        $myCount--;
      }
      else $myPlayerId11 = null;

      if($myCount > 0)
      {
        $myPlayerId12 = $_SESSION['my_trade_ids'][2];
        $myCount--;
      }
      else $myPlayerId12 = null;

//***********************************

      $myPlayerId2 = $_SESSION['trade_ids'][0];
      $otherCnt--;

      if($otherCnt > 0)
      {
        $myPlayerId21 = $_SESSION['trade_ids'][1];
        $otherCnt--;
      }
      else $myPlayerId21 = null;

      if($otherCnt > 0)
      {
        $myPlayerId22 = $_SESSION['trade_ids'][2];
        $otherCnt--;
      }
      else $myPlayerId22 = null;


      $fst->requestTrade($_SESSION['id_league'], $myTeamId, $otherTeamId,
      $myPlayerId1, $myPlayerId2,
      $myPlayerId11, $myPlayerId12, $myPlayerId21, $myPlayerId22);


      unset($_SESSION['other_user_id']);

      for($i = 0; $i < $_SESSION['trade_count']; $i++)
      {
        $string = 'trade_player_'.$_SESSION['trade_ids'][$i];
        unset($_SESSION[$string]);
      }

      unset($_SESSION['trade_count']);
      unset($_SESSION['trade_ids']);


      unset($_SESSION['my_trade_count']);
      unset($_SESSION['my_trade_ids']);


      // require_once __DIR__.'/../view/teams_myTrades.php';

      header('Location: index.php?rt=teams/pendingTrades');


    }

  }



  public function pendingTrades()
  {

    $fs = new FantasyService();
    $fst = new FantasyServiceTeams();

    $title = 'My Trades';

    $myTeamIds = $fst->getMyTeamIds($_SESSION['id_league'], $_SESSION['id_user']);

    //print_r($myTeamIds);

    $allMyTrades = array();
    foreach($myTeamIds as $id_team)
    {
      //print_r($id_team);
      $myTrades = $fst->getMyPendingTradesViaLeagueAndTeam($_SESSION['id_league'], $id_team);
      $myAcceptedTrades = $fst->getMyAcceptedTradesViaLeagueAndTeam($_SESSION['id_league'], $id_team);

       //print_r($myTrades);

      if(isset($myTrades))
      foreach($myTrades as $trades)
      {
        $player1 = $fst->getPlayerById($trades->id_player1);
        $player11 = $fst->getPlayerById($trades->id_player11);
        $player12 = $fst->getPlayerById($trades->id_player12);

        $player21 = $fst->getPlayerById($trades->id_player21);
        $player22 = $fst->getPlayerById($trades->id_player22);
        $player2  = $fst->getPlayerById($trades->id_player2);

        $team1 = $fst->getTeamById($trades->id_team1);
        $team2 = $fst->getTeamById($trades->id_team2);

        if($player11 === null)
          $player11_name = null;

        else $player11_name = $player11->name;


        if($player12 === null)
        $player12_name = null;

        else $player12_name = $player12->name;


        if($player21 === null)
          $player21_name = null;

        else $player21_name = $player21->name;



        if($player22 === null)
          $player22_name = null;

        else $player22_name = $player22->name;


        $allMyTrades[] = array('id_player1' => $trades->id_player1,
      'id_player11' => $trades->id_player11,
      'id_player12' => $trades->id_player12,
      'id_player21' => $trades->id_player21,
      'id_player22' => $trades->id_player22,
      'id_player2' => $trades->id_player2,
      'player1_name' => $player1->name,
      'player11_name' => $player11_name,
      'player12_name' => $player21_name,
      'player21_name' => $player21_name,
      'player22_name' => $player22_name,
      'player2_name' => $player2->name,
      'team1_name' => $team1->team_name,
      'team2_name' => $team2->team_name,
      'trade_status' => $trades->trade_status);


      }

      unset($myTrades);


      if(isset($myAcceptedTrades))
      foreach($myAcceptedTrades as $trades)
      {
        $player1 = $fst->getPlayerById($trades->id_player1);
        $player11 = $fst->getPlayerById($trades->id_player11);
        $player12 = $fst->getPlayerById($trades->id_player12);

        $player21 = $fst->getPlayerById($trades->id_player21);
        $player22 = $fst->getPlayerById($trades->id_player22);
        $player2  = $fst->getPlayerById($trades->id_player2);

        $team1 = $fst->getTeamById($trades->id_team1);
        $team2 = $fst->getTeamById($trades->id_team2);

        if($player11 === null)
          $player11_name = null;

        else $player11_name = $player11->name;


        if($player12 === null)
        $player12_name = null;

        else $player12_name = $player12->name;


        if($player21 === null)
          $player21_name = null;

        else $player21_name = $player21->name;



        if($player22 === null)
          $player22_name = null;

        else $player22_name = $player22->name;


        $allMyTrades[] = array('id_player1' => $trades->id_player1,
      'id_player11' => $trades->id_player11,
      'id_player12' => $trades->id_player12,
      'id_player21' => $trades->id_player21,
      'id_player22' => $trades->id_player22,
      'id_player2' => $trades->id_player2,
      'player1_name' => $player1->name,
      'player11_name' => $player11_name,
      'player12_name' => $player21_name,
      'player21_name' => $player21_name,
      'player22_name' => $player22_name,
      'player2_name' => $player2->name,
      'team1_name' => $team1->team_name,
      'team2_name' => $team2->team_name,
      'trade_status' => $trades->trade_status);


      }

      unset($myAcceptedTrades);

    }


    require_once __DIR__.'/../view/teams_myTrades.php';

  }



  public function tradeRequests()
  {

    $fs = new FantasyService();
    $fst = new FantasyServiceTeams();

    $title = 'Trade Requests';

    $myTeamIds = $fst->getMyTeamIds($_SESSION['id_league'], $_SESSION['id_user']);

    $allMyTrades = array();
    foreach($myTeamIds as $id_team)
    {
      $myPendingTrades = $fst->getRecievedTradeRequestsViaLeagueAndTeam($_SESSION['id_league'], $id_team);

      foreach($myPendingTrades as $trades)
      {
        $player1 = $fst->getPlayerById($trades->id_player1);
        $player11 = $fst->getPlayerById($trades->id_player11);
        $player12 = $fst->getPlayerById($trades->id_player12);

        $player21 = $fst->getPlayerById($trades->id_player21);
        $player22 = $fst->getPlayerById($trades->id_player22);
        $player2  = $fst->getPlayerById($trades->id_player2);

        $team1 = $fst->getTeamById($trades->id_team1);
        $team2 = $fst->getTeamById($trades->id_team2);

        if($player11 === null)
          $player11_name = null;

        else $player11_name = $player11->name;


        if($player12 === null)
        $player12_name = null;

        else $player12_name = $player12->name;


        if($player21 === null)
          $player21_name = null;

        else $player21_name = $player21->name;



        if($player22 === null)
          $player22_name = null;

        else $player22_name = $player22->name;


        $allMyTrades[] = array('id_trade' => $trades->id,
        'id_player1' => $trades->id_player1,
      'id_player11' => $trades->id_player11,
      'id_player12' => $trades->id_player12,
      'id_player21' => $trades->id_player21,
      'id_player22' => $trades->id_player22,
      'id_player2' => $trades->id_player2,
      'player1_name' => $player1->name,
      'player11_name' => $player11_name,
      'player12_name' => $player21_name,
      'player21_name' => $player21_name,
      'player22_name' => $player22_name,
      'player2_name' => $player2->name,
      'id_team1' => $team1->id,
      'id_team2' => $team2->id,
      'team1_name' => $team1->team_name,
      'team2_name' => $team2->team_name,
      'trade_status' => $trades->trade_status);
      }

      unset($myPendingTrades);

    }


    require_once __DIR__.'/../view/teams_pendingTrades.php';


  }


  public function acceptOrRejectTrade()
  {

    $fs = new FantasyService();
    $fst = new FantasyServiceTeams();

    if(isset($_POST['accept_trade_id']))
    {
      $title = 'Trade accepted';

      $trade = $fst->getTradeById($_POST['accept_trade_id']);
      $id_trade = $trade->id;
      $id_team1 = $trade->id_team1;
      $id_team2 = $trade->id_team2;
      $team1 = $fst->getTeamById($id_team1);
      $team2 = $fst->getTeamById($id_team2);

      $id_player1 = $trade->id_player1;
      $id_player11 = $trade->id_player11;
      $id_player12 = $trade->id_player12;

      $id_player21 = $trade->id_player21;
      $id_player22 = $trade->id_player22;
      $id_player2 = $trade->id_player2;

      // echo 'id_p1 = '.$id_player1.', id_p11 = '.$id_player11.', id_p12 = '.$id_player12;
      // echo "<br>";
      // echo 'id_p2 = '.$id_player2.', id_p21 = '.$id_player21.', id_p22 = '.$id_player22;

      //prvo upisemo u tablicu teams novog igraca, izbrisemo ga iz starog tima
      // $fst->addPlayerToTeam($team2->team_name, $team2->id_league,
      // $team2->id_user, $id_player1, 0);
      // $fst->addPlayerToTeam($team1->team_name, $team1->id_league,
      // $team1->id_user, $id_player2, 0);




      //dodati reject ostalima koji ga traze ili kojima ga nudim
      //za sve od donjih igraca

//***************************************


        $fst->addPlayerToTeam($team2->team_name, $team2->id_league,
         $team2->id_user, $id_player1, 0);
        $fst->popFromTeam($team1->team_name, $team1->id_league, $id_player1);

        $fst->addPlayerToTeam($team1->team_name, $team1->id_league,
         $team1->id_user, $id_player2, 0);
        $fst->popFromTeam($team2->team_name, $team2->id_league, $id_player2);

      // $fst->replacePlayerInTeamTrade($_SESSION['id_league'], $id_team1,  $id_player2);
      // $fst->replacePlayerInTeamTrade($_SESSION['id_league'], $id_team2,  $id_player1);

      $tradesRejected = $fst->getAllTradesInvolvingPlayerInLeague($_SESSION['id_league'], $id_player2);
      foreach($tradesRejected as $trades)
      if($trades->id != $id_trade)
      $fst->setTradeStatusRejected($trades->id);
      unset($tradesRejected);

      $tradesRejected = $fst->getAllTradesInvolvingPlayerInLeague($_SESSION['id_league'], $id_player1);
      foreach($tradesRejected as $trades)
      if($trades->id != $id_trade)
      $fst->setTradeStatusRejected($trades->id);
      unset($tradesRejected);

      if($id_player11 !== null)
      {
        $fst->addPlayerToTeam($team2->team_name, $team2->id_league,
         $team2->id_user, $id_player11, 0);
        $fst->popFromTeam($team1->team_name, $team1->id_league, $id_player11);

        //$fst->replacePlayerInTeamTrade($_SESSION['id_league'], $id_team2,  $id_player11);

        $tradesRejected = $fst->getAllTradesInvolvingPlayerInLeague($_SESSION['id_league'], $id_player11);
        foreach($tradesRejected as $trades)
        if($trades->id != $id_trade)
        $fst->setTradeStatusRejected($trades->id);
        unset($tradesRejected);

      }

      if($id_player12 !== null)
      {
        $fst->addPlayerToTeam($team2->team_name, $team2->id_league,
         $team2->id_user, $id_player12, 0);
        $fst->popFromTeam($team1->team_name, $team1->id_league, $id_player12);

        //$fst->replacePlayerInTeamTrade($_SESSION['id_league'], $id_team2,  $id_player12);

        $tradesRejected = $fst->getAllTradesInvolvingPlayerInLeague($_SESSION['id_league'], $id_player12);
        foreach($tradesRejected as $trades)
        if($trades->id != $id_trade)
        $fst->setTradeStatusRejected($trades->id);
        unset($tradesRejected);

      }

      if($id_player21 !== null)
      {
        $fst->addPlayerToTeam($team1->team_name, $team1->id_league,
         $team1->id_user, $id_player21, 0);
        $fst->popFromTeam($team2->team_name, $team2->id_league, $id_player21);

        //$fst->replacePlayerInTeamTrade($_SESSION['id_league'], $id_team1,  $id_player21);

        $tradesRejected = $fst->getAllTradesInvolvingPlayerInLeague($_SESSION['id_league'], $id_player21);
        foreach($tradesRejected as $trades)
        if($trades->id != $id_trade)
        $fst->setTradeStatusRejected($trades->id);
        unset($tradesRejected);

      }

      if($id_player22 !== null)
      {
        $fst->addPlayerToTeam($team1->team_name, $team1->id_league,
         $team1->id_user, $id_player22, 0);
        $fst->popFromTeam($team2->team_name, $team2->id_league, $id_player22);

        //$fst->replacePlayerInTeamTrade($_SESSION['id_league'], $id_team1,  $id_player22);

        $tradesRejected = $fst->getAllTradesInvolvingPlayerInLeague($_SESSION['id_league'], $id_player22);
        foreach($tradesRejected as $trades)
        if($trades->id != $id_trade)
        $fst->setTradeStatusRejected($trades->id);
        unset($tradesRejected);

      }

      $fst->setTradeStatusAccepted($id_trade);

    }

    elseif(isset($_POST['reject_trade_id']))
    {

      $title = 'Trade rejected';

      $trade = $fst->getTradeById($_POST['reject_trade_id']);
      $id_trade = $trade->id;
      $id_team1 = $trade->id_team1;
      $id_team2 = $trade->id_team2;

      $fst->setTradeStatusRejected($id_trade);

    }


    header('Location: index.php?rt=teams/tradeRequests');


  }


//////

  public function determineWeeklyMatchUp()
  {
    $fs = new FantasyService();
    $fst = new FantasyServiceTeams();

    $title = 'Weekly MatchUp';

    $leagueUsers = $fst->getAllUsersInsideLeague($_SESSION['id_league']);

    $usersIds = array();
    foreach($leagueUsers as $user)
    $usersIds[] = $user->id;

    $numberOfMatchups = floor(count($usersIds) / 2);

    shuffle($usersIds);


    for($i = 0; $i < $numberOfMatchups; ++$i)
    {
      $id_user1 = $usersIds[2*$i];
      $id_user2 = $usersIds[2*$i + 1];

      $fst->makeFirstWeeklyMatchUp($_SESSION['id_league'], $id_user1, $id_user2);
    }


    //require_once __DIR__.'/../view/weekly_matchup_Intro.php';




  }










};





 ?>
