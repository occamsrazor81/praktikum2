<?php require_once __DIR__.'/_header_timova.php'; ?>

<ul>

  <li><h2> <?php echo $_SESSION['league_title']; ?></h2></li>

  <?php

  foreach($leagueUsers as $lUser)
    echo '<li>'.$lUser['username'].'</li>';


   ?>


</ul>




<?php require_once __DIR__.'/_footer.php'; ?>
