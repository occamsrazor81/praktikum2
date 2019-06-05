<?php require_once __DIR__.'/_header_ulogiranog.php'; ?>


<form  action="index.php?rt=leagues/acceptOrRejectInvitations" method="post">


<ul>


<?php

foreach($leagueInvites as $invites)
{
  echo '<li>Admin: '.$invites['admin'].' (status: '.$invites['status'].')</li>'.
      '<li><h4>'.$invites['title'].'</h4></li>'.

     '<li><button type="submit" name="id_league_accept" value="'.$invites['id_league'].'">'.
      'Accept Invitation!</button></li>'.
      '<li><button type="submit" name="id_league_reject" value="'.$invites['id_league'].'">'.
       'Reject Invitation!</button></li>';

    echo '<hr>';

}


 ?>
</ul>
</form>


<?php require_once __DIR__.'/_footer.php'; ?>
