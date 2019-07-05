<?php

session_start();
require_once __DIR__.'/../model/fantasyservice.class.php';
require_once __DIR__.'/../model/fantasyserviceteams.class.php';
require_once __DIR__.'/../model/fantasyserviceweekly.class.php';

function sendJSONandExit( $message )
{
    // Kao izlaz skripte pošalji $message u JSON formatu i prekini izvođenje.
    header( 'Content-type:application/json;charset=utf-8' );
    echo json_encode( $message );
    flush();
    exit( 0 );
}


function sendErrorAndExit( $messageText )
{
	$message = [];
	$message[ 'error' ] = $messageText;
	sendJSONandExit( $message );
}

////////////////////////////////////////


class GamesController
{

  public function index()
  {
    $title = 'Empty Title';

    if(!isset($_SESSION['id_user']))
      { header( 'Location: index.php?rt=users/login' ); exit();}

    if (isset($_SESSION['id_league']))
      require_once __DIR__.'/../view/teams_frontPage.php';

    else
      require_once __DIR__.'/../view/weekly_matchup_Intro.php';
  }


  public function thisWeek()
  {
    $fst = new FantasyServiceTeams();
    $fs = new FantasyService();
    $fsw = new FantasyServiceWeekly();

    $title = "This week's MatchUp";

    $id_league = $_SESSION['id_league'];
    $my_id = $_SESSION['id_user'];

    $row = $fsw->getDayAndWeekInLeague($id_league);
    $week = $row['week'];


    $matchup = $fsw->getWeeklyOpponent( $id_league, $my_id, $week);

    if($my_id == $matchup['id_user1'])
    {
      //my_id == user1_id
      $his_id = $matchup['id_user2'];
      $weeklyStats1 = $fsw->getWeeklyStats($id_league, $my_id, $his_id, $week);

      //$weeklyStats1->iterateVisible();

      $myTeamName = $fst->getTeamName($id_league, $my_id);
      $hisTeamName = $fst->getTeamName($id_league, $his_id);

      //print_r($weeklyStats1);

    //  if( $weeklyStats1->fgm1  === null) echo "string" ;

    }

    // $myPlayers = $fst->getPlayersFromTeam( $id_league, $my_id);
    // $hisPlayers = $fst->getPlayersFromTeam($id_league, $his_id);

    else
    {
      $his_id = $matchup['id_user1'];
      $weeklyStats2 = $fsw->getWeeklyStats($id_league, $his_id, $my_id, $week);

      $myTeamName = $fst->getTeamName($id_league, $my_id);
      $hisTeamName = $fst->getTeamName($id_league, $his_id);


    }

      require_once __DIR__.'/../view/weekly_myMatchup.php';


  }


  public function changeLineup()
  {

    $title = 'Change LineUp';

    $fsw = new FantasyServiceWeekly();
    $fst = new FantasyServiceTeams();
    $fs = new FantasyService();

    $myPlayers = $fst->getAllPlayersInMyTeam($_SESSION['id_league'], $_SESSION['id_user']);

    //print_r($myPlayers);

    //echo $myPlayers[0]->name;

    // foreach($myPlayers as $player)
    // echo "<br>".$player->name;

    require_once __DIR__.'/../view/weekly_changeLineUp.php';


  }






};





 ?>