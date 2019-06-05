<?php require_once __DIR__.'/_header_endDraft.php'; ?>

<form  action="index.php?rt=teams/cutPlayer" method="post">


<table>

<tr><th>Player Name</th><th>Position</th><th>Cut</th></tr>

  <?php

  foreach($myPlayers as $player)
  {
    echo '<tr>'.
    '<td>'.$player->name.'</td>'.
    '<td>'.$player->position.'</td>'.

    '<td><button type="submit" name="player_id" value="'.
    $player->id.'" id="'.$player->id.'">'.'Cut from Team</button></td>';

    echo '</tr>';
    }


   ?>

</table>

</form>




<?php require_once __DIR__.'/_footer.php'; ?>
