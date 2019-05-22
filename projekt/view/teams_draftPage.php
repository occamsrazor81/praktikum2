<?php require_once __DIR__.'/_header_timova.php'; ?>

<p>Na redu: <?php if(isset($_SESSION['redoslijed'])) echo $_SESSION['redoslijed'][0]->username; ?></p>

<!-- pobojati selectove u crveno odnosno zeleno ovisno moze li se igrac odabrat -->

<form  action="index.php?rt=teams/processDraft" method="post">


<table>

<tr><th>Player Name</th><th>Position</th><th>Pick</th></tr>

  <?php

  foreach($players as $player)
  {
    echo '<tr>'.
    '<td>'.$player->name.'</td>'.
    '<td>'.$player->position.'</td>'.

    '<td><button type="submit" name="player_id" value="'.
    $player->id.'" id="'.$player->id.'">'.'Select</button></td>';
  }

   ?>

</table>

</form>



<?php require_once __DIR__.'/_footer.php'; ?>
