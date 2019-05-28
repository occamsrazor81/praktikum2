<?php require_once __DIR__.'/_header_endDraft.php'; ?>

<form  action="index.php?rt=teams/pickUpFreeAgent" method="post">


<table>

<tr><th>Player Name</th><th>Position</th><th>Select</th></tr>

  <?php

  foreach($freeAgents as $player)
  {
    echo '<tr>'.
    '<td>'.$player->name.'</td>'.
    '<td>'.$player->position.'</td>'.

    '<td><button type="submit" name="player_id" value="'.
    $player->id.'" id="'.$player->id.'">'.'Add to Team</button></td>';
  }


   ?>

</table>

</form>




<?php require_once __DIR__.'/_footer.php'; ?>
