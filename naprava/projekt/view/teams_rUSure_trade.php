<?php require_once __DIR__.'/_header_rUSure.php'; ?>


<form  action="index.php?rt=teams/sendTradeRequest" method="post">


  <p>Are you sure you want to trade
    <?php
    $cnt1 = 1;
    foreach($myPlayers as $myPlayer)
    {
      echo ' '.$myPlayer->name;
      if($cnt1 < $_SESSION['trade_count']) echo ',';
      $cnt1++;
    }
    ?>
  for
  <?php
  $cnt2 = 1;
  foreach($otherPlayers as $otherPlayer)
  {
    echo ' '.$otherPlayer->name;
    if($cnt2 < $_SESSION['my_trade_count']) echo ',';
    $cnt2++;
  }
   ?>


  <?php
  // echo ' '.$otherPlayer->name.' ';
  ?>
  ?
</p>

<button type="submit" name="yes">Yes</button>
<button type="submit" name="no">No</button>

</form>

<?php require_once __DIR__.'/_footer.php'; ?>
