<?php require_once __DIR__.'/_header_endDraft.php'; ?>

<form  action="index.php?rt=teams/askForTrade" method="post">

<br>
<!-- <table>

<tr><th>Player Name</th><th>Position</th></tr> -->

  <?php

  // foreach($playersFromSelectedTeam as $player)
  // {
  //   echo '<tr>'.
  //   '<td><button type="submit" name="player_id" value="'.
  //   $player->id.'">'.$player->name.'</button></td>'.
  //   '<td>'.$player->position.'</td>';
  //
  //   // '<td><button type="submit" name="player_id" value="'.
  //   // $player->id.'" id="'.$player->id.'">'.'Propose Trade</button></td>';
  // }
  ?>

<!-- </table> -->

  <ul>


  <?php
  foreach($playersFromSelectedTeam as $player)
  {
    echo '<li><input type="checkbox" name="players[]"'.
    'value="'.$player->id.'" id="'.$player->id.'">'.$player->name.'</li>';

  }

  echo '<br><button type="submit" name="propose" value="propose">'.'Propose Trade</button>';


   ?>

   </ul>



</form>




<?php require_once __DIR__.'/_footer.php'; ?>
