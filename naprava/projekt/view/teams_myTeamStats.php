<?php require_once __DIR__.'/_header_endDraft.php'; ?>



<table>

<tr><th>Player</th><th>Position</th>
  <th>FGM</th><th>FGA</th><th>FG%</th><th>FTM</th><th>FTM</th><th>FT%</th><th>3PM</th>
  <th>PTS</th><th>REB</th><th>AST</th><th>ST</th><th>BLK</th><th>TOV</th>
</tr>

  <?php

  //ubaciti po datumima tj ovisno o danu u ligi ispisati samo za taj dan
  foreach($myPlayers as $player)
  {
    echo '<tr>'.
    '<td>'.$player['player_name'].'</td>'.
    '<td>'.$player['position'].'</td>'.
    '<td>'.$player['fgm'].'</td>'.
    '<td>'.$player['fga'].'</td>'.
    '<td>'.$player['fg_perc'].'</td>'.
    '<td>'.$player['ftm'].'</td>'.
    '<td>'.$player['fta'].'</td>'.
    '<td>'.$player['ft_perc'].'</td>'.
    '<td>'.$player['tpm'].'</td>'.
    '<td>'.$player['pts'].'</td>'.
    '<td>'.$player['reb'].'</td>'.
    '<td>'.$player['ast'].'</td>'.
    '<td>'.$player['st'].'</td>'.
    '<td>'.$player['blk'].'</td>'.
    '<td>'.$player['tov'].'</td>';



    echo '</tr>';
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
