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

    $myStarters = $fsw->getStartersInMyTeam($_SESSION['id_league'], $_SESSION['id_user']);
    $myBench = $fsw->getBenchInMyTeam($_SESSION['id_league'], $_SESSION['id_user']);


    // print_r($myStarters);
    // print_r($myBench);

    require_once __DIR__.'/../view/weekly_changeLineUp.php';


  }

  public function saveLineUp()
  {
    $title = 'Change LineUp';

    $fsw = new FantasyServiceWeekly();
    $fst = new FantasyServiceTeams();
    $fs = new FantasyService();

    if(isset($_POST['starterPlayers'], $_POST['benchPlayers']))
    {
      $starterPlayers = $_POST['starterPlayers'];
      $benchPlayers = $_POST['benchPlayers'];

      // foreach ($starterPlayers as $starter)
      // {
      //   $playerId = $fsw->getPlayerIdViaName($starter['name']);
      //   echo "<br>".$playerId;
      // }

      $allPlayers = $fst->getPlayersFromTeam($_SESSION['id_league'], $_SESSION['id_user']);


      $id_league = $_SESSION['id_league'];

      foreach ($allPlayers as $player)
      {
        foreach ($starterPlayers as $starter)
        {
          if(strcmp($starter['name'], $player->name) == 0)
          {

            $fsw->updateRosterStatus($id_league, $player->id, 1);

          }
        }

        foreach ($benchPlayers as $bench)
        {

          if(strcmp($bench['name'], $player->name) == 0)
          {
            $fsw->updateRosterStatus($id_league, $player->id, 0);

          }

        }
      }

      $message['starterPlayers'] = $starterPlayers;
      $message['benchPlayers'] = $benchPlayers;
      sendJSONandExit($message);

    }

    else
    {
      sendErrorAndExit("Expected parameters have not been sent.");

    }



  }

  public function simulateDay()
  {
    $title = "Simulate";

//     Možemo hvatati usere po parovima iz weekly_mathcup
//
// 1. uhvati sve weekly_matchupove gdje je week = week and id_league = id_league;
// 2. foreach weekly_matchup:
//                 3. uhvati user1, uhvati user2;
//
//                 4.a)(*)uhvati sve igrace usera1;
//                  za svakog od tih igraca uhvati statse tako da week = week and day = day;
//                  zbroji sve te statse u sumu1 (za svaki) (npr. pts_user1,rebs_user1....);(*)
//
//                 4.b) napravi izmedu (*) i (*) za usera2;
//
//                  5. osvjezi tablicu u tom weekly_matchupu
//
// 6. nakon svih osvjezi dan u toj ligi tj. prebaci se na sljedeci dan.(pazi prelazak u novi tjedan)

    $fsw = new FantasyServiceWeekly();
    $fst = new FantasyServiceTeams();
    $fs = new FantasyService();

    $id_league = $_SESSION['id_league'];
    $leagueDate = $fsw->getDayAndWeekInLeague($id_league);

    $leagueWeek = $leagueDate['week'];
    $leagueDay = $leagueDate['day'];


    // echo "<br>week = ".$leagueWeek;
    // echo "<br>day = ".$leagueDay;

    $weeklyMatchups = $fsw->getAllWeeklyMatchups($id_league, $leagueWeek);



    //echo $weeklyMatchups[0]->week;


    //print_r($weeklyMatchups);

    foreach($weeklyMatchups as $wm)
    {
      $user1 = $fs->getUserById($wm->id_user1);
      $players1 = $fst->getPlayersFromTeam($id_league, $user1->id);

      $stats1 = new Stats($user1->id, $user1->id,
       0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, $leagueWeek, $leagueDay);


       // $id, $id_player, $fgm, $fga, $fg_perc, $ftm, $fta, $ft_perc,
       // $tpm, $pts, $reb, $ast, $st, $blk, $tov, $week, $day;

      foreach($players1 as $p1)
      {
        //echo "<br>p1 -- ".$stats1->fgm;
        $p1Stats = $fst->getPlayerStatsByPlayerIdAndWeekAndDay($p1->id,
        $leagueWeek, $leagueDay);

        if($p1Stats === null) continue;

        //echo "<br>".$p1Stats->id_player." ->  ".$p1Stats->fgm;

        $stats1->fgm += $p1Stats->fgm;
        $stats1->fga += $p1Stats->fga;

        $stats1->ftm += $p1Stats->ftm;
        $stats1->fta += $p1Stats->fta;

        $stats1->tpm += $p1Stats->tpm;
        $stats1->pts += $p1Stats->pts;
        $stats1->reb += $p1Stats->reb;
        $stats1->ast += $p1Stats->ast;
        $stats1->st += $p1Stats->st;
        $stats1->blk += $p1Stats->blk;
        $stats1->tov += $p1Stats->tov;

      }

      if($stats1->fgm != 0)
      $stats1->fg_perc = round( $stats1->fgm / $stats1->fga, 2);

      if($stats1->ftm != 0)
      $stats1->ft_perc = round( $stats1->ftm / $stats1->fta, 2 );

      //print_r($stats1);

      ///user2
      $user2 = $fs->getUserById($wm->id_user2);
      $players2 = $fst->getPlayersFromTeam($id_league, $user2->id);

      $stats2 = new Stats($user2->id, $user2->id,
       0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, $leagueWeek, $leagueDay);

      foreach($players2 as $p2)
      {

        $p2Stats = $fst->getPlayerStatsByPlayerIdAndWeekAndDay($p2->id,
        $leagueWeek, $leagueDay);

        if($p2Stats === null) continue;

        //echo "<br>".$p1Stats->id_player." ->  ".$p1Stats->fgm;

        $stats2->fgm += $p2Stats->fgm;
        $stats2->fga += $p2Stats->fga;

        $stats2->ftm += $p2Stats->ftm;
        $stats2->fta += $p2Stats->fta;

        $stats2->tpm += $p2Stats->tpm;
        $stats2->pts += $p2Stats->pts;
        $stats2->reb += $p2Stats->reb;
        $stats2->ast += $p2Stats->ast;
        $stats2->st += $p2Stats->st;
        $stats2->blk += $p2Stats->blk;
        $stats2->tov += $p2Stats->tov;

      }

      if($stats2->fgm != 0)
      $stats2->fg_perc = round( $stats2->fgm / $stats2->fga, 2);

      if($stats2->ftm != 0)
      $stats2->ft_perc = round( $stats2->ftm / $stats2->fta, 2 );


      //trebamo jos azuirati ukupne statse u weekly_matchups


      //echo $wm->fgm2 + $stats2->fgm;

      $wm->fgm1 += $stats1->fgm;
      $wm->fga1 += $stats1->fga;

      $wm->ftm1 += $stats1->ftm;
      $wm->fta1 += $stats1->fta;

      $wm->tpm1 += $stats1->tpm;
      $wm->pts1 += $stats1->pts;
      $wm->reb1 += $stats1->reb;
      $wm->ast1 += $stats1->ast;
      $wm->st1 += $stats1->st;
      $wm->blk1 += $stats1->blk;
      $wm->tov1 += $stats1->tov;

      if($wm->fgm1 != 0)
      $wm->fg_perc1 = round( $wm->fgm1 / $wm->fga1, 2);

      if($wm->ftm1 != 0)
      $wm->ft_perc1 = round( $wm->ftm1 / $wm->fta1, 2);

///user2

      $wm->fgm2 += $stats2->fgm;
      $wm->fga2 += $stats2->fga;

      $wm->ftm2 += $stats2->ftm;
      $wm->fta2 += $stats2->fta;

      $wm->tpm2 += $stats2->tpm;
      $wm->pts2 += $stats2->pts;
      $wm->reb2 += $stats2->reb;
      $wm->ast2 += $stats2->ast;
      $wm->st2 += $stats2->st;
      $wm->blk2 += $stats2->blk;
      $wm->tov2 += $stats2->tov;

      if($wm->fgm2 != 0)
      $wm->fg_perc2 = round( $wm->fgm2 / $wm->fga2, 2);

      if($wm->ftm2 != 0)
      $wm->ft_perc2 = round( $wm->ftm2 / $wm->fta2, 2);

    }

    $weekOver = 0;
    // ako je sljedeci dan 8 znaci da je ustvari sljedeci tjedan
    if($leagueDay+1 === 8)
    {
      // to_do:
      //spremi statistike u league_table
      //koju takoder treba inicijalizirat nakon drafta
      $leagueDay = 1;
      $leagueWeek++;
      $weekOver = 1; // to_do: obavijesti igracima


    }

    else $leagueDay++;

//refreshWeeklyMatchUp -- postavi vrijednosti dobivene iznad where id = $wm->id
    $fsw->refreshWeeklyMatchUp($wm->id, $wm->fgm1, $wm->fga1, $wm->fg_perc1,
    $wm->ftm1, $wm->fta1, $wm->ft_perc1, $wm->tpm1, $wm->pts1,
    $wm->reb1, $wm->ast1, $wm->st1, $wm->blk1, $wm->tov1,
    $wm->fgm2, $wm->fga2, $wm->fg_perc2, $wm->ftm2, $wm->fta2, $wm->ft_perc2,
    $wm->tpm2, $wm->pts2, $wm->reb2, $wm->ast2, $wm->st2, $wm->blk2, $wm->tov2);


    $fsw->refresLeagueDate($id_league, $leagueWeek, $leagueDay);

//
//     print_r($wm);
//     echo "<br><br>";
//    print_r($stats2);

    header( 'Location: index.php?rt=games/thisWeek' );

  }

};

 ?>
