<?php require_once __DIR__.'/_header_timova.php'; ?>

<p>Na redu: <?php if(isset($_SESSION['na_redu'])) echo $_SESSION['na_redu']; ?></p>

<!-- pobojati selectove u crveno odnosno zeleno ovisno moze li se igrac odabrat -->

<form  action="index.php?rt=teams/processDraft" method="post">


<table>

<tr><th>Player Name</th><th>Position</th><th>Pick</th></tr>

  <?php

  if(strcmp($_SESSION['na_redu'], $_SESSION['name']) === 0)
  foreach($players as $player)
  {
    echo '<tr>'.
    '<td>'.$player->name.'</td>'.
    '<td>'.$player->position.'</td>'.

    '<td><button type="submit" name="player_id" value="'.
    $player->id.'" id="'.$player->id.'">'.'Select</button></td>';
  }

  else
  foreach($players as $player)
  {
    echo '<tr>'.
    '<td>'.$player->name.'</td>'.
    '<td>'.$player->position.'</td>'.

    '<td><button type="submit" name="player_id" value="'.
    $player->id.'" id="'.$player->id.'" disabled>'.'Select</button></td>';
  }


   ?>

</table>

</form>



<?php require_once __DIR__.'/_footer.php'; ?>
