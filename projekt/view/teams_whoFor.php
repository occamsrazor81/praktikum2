<?php require_once __DIR__.'/_header_endDraft.php'; ?>

<form  action="index.php?rt=teams/confirmTradeRequest" method="post">

<br>
<table>

<tr><th>Player Name</th><th>Position</th></tr>

  <?php

  foreach($myPlayers as $player)
  {
    echo '<tr>'.
    '<td><button type="submit" name="player_id" value="'.
    $player->id.'">'.$player->name.'</button></td>'.
    '<td>'.$player->position.'</td>';

    // '<td><button type="submit" name="player_id" value="'.
    // $player->id.'" id="'.$player->id.'">'.'Cut from Team</button></td>';

    echo '</tr>';
  }


   ?>


</table>

<br>
<button type="submit" name="cancel">Cancel Trade</button>


</form>




<?php require_once __DIR__.'/_footer.php'; ?>
