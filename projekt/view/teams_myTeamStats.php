<?php require_once __DIR__.'/_header_endDraft.php'; ?>



<table>

<tr><th>Player</th><th>Position</th>
  <th>FGM</th><th>FGA</th><th>FG%</th><th>FTM</th><th>FTM</th><th>FT%</th>
  <th>PTS</th><th>REB</th><th>AST</th><th>ST</th><th>BLK</th><th>TOV</th>
</tr>

  <?php
echo count($myPlayers);
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






<?php require_once __DIR__.'/_footer.php'; ?>
