<?php require_once __DIR__.'/_header_weekly.php'; ?>

<table>


  <?php

  echo '<tr><th>'.$myTeamName.'</th><th></th><th>'.$hisTeamName.'</th></tr>';

  if(isset($weeklyStats1))
  {

    echo '<tr><td>'.$weeklyStats1->fgm1.' / '.$weeklyStats1->fga1.
    '</td><td>FGM/A</td><td>'.
    $weeklyStats1->fgm2.'/'.$weeklyStats1->fga2.'</td></tr>';

    echo '<tr><td>'.$weeklyStats1->fg_perc1.
    '</td><td>FG%</td><td>'.
    $weeklyStats1->fg_perc2.'</td></tr>';

    echo '<tr><td>'.$weeklyStats1->ftm1.'/'.$weeklyStats1->fta1.
    '</td><td>FTM/A</td><td>'.
    $weeklyStats1->ftm2.' / '.$weeklyStats1->fta2.'</td></tr>';

    echo '<tr><td>'.$weeklyStats1->ft_perc1.
    '</td><td>FT%</td><td>'.
    $weeklyStats1->ft_perc2.'</td></tr>';

    echo '<tr><td>'.$weeklyStats1->tpm1.
    '</td><td>3PTM</td><td>'.
    $weeklyStats1->tpm2.'</td></tr>';

    echo '<tr><td>'.$weeklyStats1->pts1.
    '</td><td>PTS</td><td>'.
    $weeklyStats1->pts2.'</td></tr>';

    echo '<tr><td>'.$weeklyStats1->reb1.
    '</td><td>REB</td><td>'.
    $weeklyStats1->reb2.'</td></tr>';

    echo '<tr><td>'.$weeklyStats1->ast1.
    '</td><td>AST</td><td>'.
    $weeklyStats1->ast2.'</td></tr>';

    echo '<tr><td>'.$weeklyStats1->st1.
    '</td><td>ST</td><td>'.
    $weeklyStats1->st2.'</td></tr>';

    echo '<tr><td>'.$weeklyStats1->blk1.
    '</td><td>BLK</td><td>'.
    $weeklyStats1->blk2.'</td></tr>';

    echo '<tr><td>'.$weeklyStats1->tov1.
    '</td><td>TO</td><td>'.
    $weeklyStats1->tov2.'</td></tr>';


  }


  else
  {

    echo '<tr><td>'.$weeklyStats2->fgm1.' / '.$weeklyStats2->fga1.
    '</td><td>FGM/A</td><td>'.
    $weeklyStats2->fgm2.'/'.$weeklyStats2->fga2.'</td></tr>';

    echo '<tr><td>'.$weeklyStats2->fg_perc1.
    '</td><td>FG%</td><td>'.
    $weeklyStats2->fg_perc2.'</td></tr>';

    echo '<tr><td>'.$weeklystats2->ftm1.'/'.$weeklystats2->fta1.
    '</td><td>FTM/A</td><td>'.
    $weeklystats2->ftm2.' / '.$weeklystats2->fta2.'</td></tr>';

    echo '<tr><td>'.$weeklystats2->ft_perc1.
    '</td><td>FT%</td><td>'.
    $weeklystats2->ft_perc2.'</td></tr>';

    echo '<tr><td>'.$weeklystats2->tpm1.
    '</td><td>3PTM</td><td>'.
    $weeklystats2->tpm2.'</td></tr>';

    echo '<tr><td>'.$weeklystats2->pts1.
    '</td><td>PTS</td><td>'.
    $weeklystats2->pts2.'</td></tr>';

    echo '<tr><td>'.$weeklystats2->reb1.
    '</td><td>REB</td><td>'.
    $weeklystats2->reb2.'</td></tr>';

    echo '<tr><td>'.$weeklystats2->ast1.
    '</td><td>AST</td><td>'.
    $weeklystats2->ast2.'</td></tr>';

    echo '<tr><td>'.$weeklystats2->st1.
    '</td><td>ST</td><td>'.
    $weeklystats2->st2.'</td></tr>';

    echo '<tr><td>'.$weeklystats2->blk1.
    '</td><td>BLK</td><td>'.
    $weeklystats2->blk2.'</td></tr>';

    echo '<tr><td>'.$weeklystats2->tov1.
    '</td><td>TO</td><td>'.
    $weeklystats2->tov2.'</td></tr>';


  }

   ?>

</table>

<script>

$(document).ready(function()
{
      $("body").css("background-color", "orange");
      $("table").css("background-color", "gold")
								.css("border-collapse","collapse")
								.css("border-spacing","0")
								.css("width","100%");

      $("th").css("border", "0.7px solid black")
      			 .css("background-color", 'gold')
             .css("width", "80").css("height", "40")
             .css("text-align", "center")
             .css("margin", "0").css("padding", "16px")
             .css("text-transform", "uppercase")
             .css("letter-spacing", "1.6")
             .css("font-weight", "900")
             .css("font-style", "italic");

      $("td").css("border", "0.5px solid black")
      			 .css("background-color", 'gold')
             .css("width", "80").css("height", "40")
             .css("text-align", "center")
             .css("margin", "0").css("padding", "16px")
             .css("letter-spacing", "1.1");




});


</script>


<?php require_once __DIR__.'/_footer.php'; ?>
