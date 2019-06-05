<?php require_once __DIR__.'/_header_endDraft.php'; ?>


<hr>

<ul>


<?php

//zelimo imena svih mojih i svih suparnikovih igraca
foreach($allMyTrades as $trades)
{
  echo '<li><ul>';

  echo '<li>From '.$trades['team1_name'].' -> '.$trades['player1_name'];
  if($trades['id_player11'] !== null)
  echo ', '.$trades['player11_name'];
  if($trades['id_player12'] !== null)
  echo ', '.$trades['player22_name'].'</li>';


  echo '<li>From '.$trades['team2_name'].' -> '.$trades['player2_name'];
  if($trades['id_player21'] !== null)
  echo ', '.$trades['player21_name'];
  if($trades['id_player22'] !== null)
  echo ', '.$trades['player22_name'].'</li>';

  if(strcmp($trades['trade_status'], 'pending') === 0)
  echo '<li>Trade is still pending.</li>';

  else
  echo '<li>Trade has been accepted.</li>';




  echo '</ul></li>';

}





 ?>
</ul>

<?php require_once __DIR__.'/_footer.php'; ?>
