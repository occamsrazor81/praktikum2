<?php require_once __DIR__.'/_header_endDraft.php'; ?>


<hr>

<form  action="index.php?rt=teams/acceptOrRejectTrade" method="post">


<ul>


<?php

//zelimo imena svih mojih i svih suparnikovih igraca
foreach($allMyTrades as $trades)
{
  echo '<li><ul>';

  echo '<li>Recieve -> '.$trades['player1_name'];
  if($trades['id_player11'] !== null)
  echo ', '.$trades['player11_name'];
  if($trades['id_player12'] !== null)
  echo ', '.$trades['player22_name'].'</li>';


  echo '<li>Give away -> '.$trades['player2_name'];
  if($trades['id_player21'] !== null)
  echo ', '.$trades['player21_name'];
  if($trades['id_player22'] !== null)
  echo ', '.$trades['player22_name'].'</li>';


  echo '<li><button type="submit" name="accept_trade_id"'.
  ' value="'.$trades['id_trade'].'">Accept Trade</button>';

  echo ' <button type="submit" name="reject_trade_id"'.
  ' value="'.$trades['id_trade'].'">Reject Trade</button></li><br>';


  echo '</ul></li>';

}





 ?>
</ul>

</form>

<?php require_once __DIR__.'/_footer.php'; ?>
