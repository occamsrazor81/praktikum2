<?php require_once __DIR__.'/_header_endDraft.php'; ?>

<form  action="index.php?rt=teams/checkTeam" method="post">

<br>
<table>

<tr><th>Username</th><th>Team Name</th></tr>

  <?php

  foreach($otherTeams as $teams)
  {
    echo '<tr>'.
    '<td>'.$teams['username'].'</td>'.
    '<td><button type="submit" name="team_id" '.
    'value="'.$teams['id'].'">'.
    $teams['team_name'].'</button></td>'.

    '<tr>';
  }


   ?>

</table>

</form>




<?php require_once __DIR__.'/_footer.php'; ?>
