<?php require_once __DIR__.'/_header_ulogiranog.php'; ?>

<ul>


<?php

foreach($projectApps as $apps)
{
  echo '<li>Author: '.$apps['author'].' (status: '.$apps['status'].')</li>'.
      '<li><h4>'.$apps['title'].'</h4></li>';

      if(strcmp($apps['application'],'accepted') == 0)
      echo '<li>Your application has been accepted.</li>';

      else
      echo '<li>Your application is  still pending.</li>';

    echo '<hr>';

}


 ?>
</ul>

<?php require_once __DIR__.'/_footer.php'; ?>
