<?php require_once __DIR__.'/_header_weekly.php'; ?>

<table>


  <?php

  echo '<tr><th id=myScore>'.$myTeamName.'</th><th id=time>week = '.
  $week.'<br><br>day = '.$day.'</th><th id=theirScore>'.$hisTeamName.'</th></tr>';

  if(isset($weeklyStats1))
  {

////
    echo '<tr><td>'.$weeklyStats1->fgm1.' / '.$weeklyStats1->fga1.
    '</td><td>FGM/A</td><td>'.
    $weeklyStats1->fgm2.'/'.$weeklyStats1->fga2.'</td></tr>';
///
    echo '<tr><td class=my>'.$weeklyStats1->fg_perc1.
    '</td><td>FG%</td><td class=their>'.
    $weeklyStats1->fg_perc2.'</td></tr>';

///
    echo '<tr><td>'.$weeklyStats1->ftm1.' / '.$weeklyStats1->fta1.
    '</td><td>FTM/A</td><td>'.
    $weeklyStats1->ftm2.' / '.$weeklyStats1->fta2.'</td></tr>';
////
    echo '<tr><td class=my>'.$weeklyStats1->ft_perc1.
    '</td><td>FT%</td><td class=their>'.
    $weeklyStats1->ft_perc2.'</td></tr>';

    echo '<tr><td class=my>'.$weeklyStats1->tpm1.
    '</td><td>3PTM</td><td class=their>'.
    $weeklyStats1->tpm2.'</td></tr>';

    echo '<tr><td class=my>'.$weeklyStats1->pts1.
    '</td><td>PTS</td><td class=their>'.
    $weeklyStats1->pts2.'</td></tr>';

    echo '<tr><td class=my>'.$weeklyStats1->reb1.
    '</td><td>REB</td><td class=their>'.
    $weeklyStats1->reb2.'</td></tr>';

    echo '<tr><td class=my>'.$weeklyStats1->ast1.
    '</td><td>AST</td><td class=their>'.
    $weeklyStats1->ast2.'</td></tr>';

    echo '<tr><td class=my>'.$weeklyStats1->st1.
    '</td><td>ST</td><td class=their>'.
    $weeklyStats1->st2.'</td></tr>';

    echo '<tr><td class=my>'.$weeklyStats1->blk1.
    '</td><td>BLK</td><td class=their>'.
    $weeklyStats1->blk2.'</td></tr>';

    echo '<tr><td class=my>'.$weeklyStats1->tov1.
    '</td><td>TO</td><td class=their>'.
    $weeklyStats1->tov2.'</td></tr>';


  }


  else if(isset($weeklyStats2))
  {



    echo '<tr><td>'.$weeklyStats2->fgm2.' / '.$weeklyStats2->fga2.
    '</td><td>FGM/A</td><td>'.
    $weeklyStats2->fgm1.'/'.$weeklyStats2->fga1.'</td></tr>';

    echo '<tr><td class=my>'.$weeklyStats2->fg_perc2.
    '</td><td>FG%</td><td class=their>'.
    $weeklyStats2->fg_perc1.'</td></tr>';

    echo '<tr><td>'.$weeklyStats2->ftm2.' / '.$weeklyStats2->fta2.
    '</td><td>FTM/A</td><td>'.
    $weeklyStats2->ftm1.' / '.$weeklyStats2->fta1.'</td></tr>';

    echo '<tr><td class=my>'.$weeklyStats2->ft_perc2.
    '</td><td>FT%</td><td class=their>'.
    $weeklyStats2->ft_perc1.'</td></tr>';

    echo '<tr><td class=my>'.$weeklyStats2->tpm2.
    '</td><td>3PTM</td><td class=their>'.
    $weeklyStats2->tpm1.'</td></tr>';

    echo '<tr><td class=my>'.$weeklyStats2->pts2.
    '</td><td>PTS</td><td class=their>'.
    $weeklyStats2->pts1.'</td></tr>';

    echo '<tr><td class=my>'.$weeklyStats2->reb2.
    '</td><td>REB</td><td class=their>'.
    $weeklyStats2->reb1.'</td></tr>';

    echo '<tr><td class=my>'.$weeklyStats2->ast2.
    '</td><td>AST</td><td class=their>'.
    $weeklyStats2->ast1.'</td></tr>';

    echo '<tr><td class=my>'.$weeklyStats2->st2.
    '</td><td>ST</td><td class=their>'.
    $weeklyStats2->st1.'</td></tr>';

    echo '<tr><td class=my>'.$weeklyStats2->blk2.
    '</td><td>BLK</td><td class=their>'.
    $weeklyStats2->blk1.'</td></tr>';

    echo '<tr><td class=my>'.$weeklyStats2->tov2.
    '</td><td>TO</td><td class=their>'.
    $weeklyStats2->tov1.'</td></tr>';


  }

   ?>

</table>
<br>



<script>

$(document).ready(function()
{


    oznaci();

    uredi();



});

function oznaci()
{
  // $(".my").css({"font-weight": "900", "color": "#008080"});

  var len = $(".my").length; // isto kao i za their

  var cntMy = 0;
  var cntTheir = 0;

  for(var i = 0; i < len; ++i)
  {
    var my = $(".my").eq(i).html();
    var their = $(".their").eq(i).html();

    my = Number(my);
    thier = Number(their);

    if(my < their)
    {
      cntTheir++;
      $(".their").eq(i).css({"font-weight": "900", "color": "#008080"});
    }

    else if (my > their)
    {
      cntMy++;
      $(".my").eq(i).css({"font-weight": "900", "color": "#008080"});
    }

    else continue;


  }

  var myName = $("#myScore").html();
  var theirName = $("#theirScore").html();

  $("#myScore").html(myName + '<br><br>' + cntMy);
  $("#theirScore").html(theirName + '<br><br>' + cntTheir);

  if(cntMy > cntTheir)
  $("#myScore").css({"font-weight": "900", "color": "#008080"});

  else if (cntTheir > cntMy)
  $("#theirScore").css({"font-weight": "900", "color": "#008080"});





}




function uredi()
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
         .css("font-style", "italic")
         .css("font-size", "18pt");

  $("td").css("border", "0.5px solid black")
         .css("background-color", 'gold')
         .css("width", "80").css("height", "40")
         .css("text-align", "center")
         .css("margin", "0").css("padding", "16px")
         .css("letter-spacing", "1.1");
}


</script>


<?php require_once __DIR__.'/_footer.php'; ?>
