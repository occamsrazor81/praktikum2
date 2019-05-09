<?php require_once __DIR__.'/_header_ulogiranog.php'; ?>


<form  action="index.php?rt=projects/acceptOrRejectInvitations" method="post">


<ul>


<?php

foreach($projectInvites as $invites)
{
  echo '<li>Author: '.$invites['author'].' (status: '.$invites['status'].')</li>'.
      '<li><h4>'.$invites['title'].'</h4></li>'.

     '<li><button type="submit" name="id_project_accept" value="'.$invites['id_project'].'">'.
      'Accept Invitation!</button></li>'.
      '<li><button type="submit" name="id_project_reject" value="'.$invites['id_project'].'">'.
       'Reject Invitation!</button></li>';

    echo '<hr>';

}


 ?>
</ul>
</form>


<?php require_once __DIR__.'/_footer.php'; ?>
