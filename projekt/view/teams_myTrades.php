<?php require_once __DIR__.'/_header_endDraft.php'; ?>


<hr>
<ul>


<?php

//zelimo imena svih mojih i svih suparnikovih igraca
foreach($allMyTrades as $trades)
{
  echo '<li><ul>';

  echo '<li>Mine: '.$trades['id_player1'];
  if($trades['id_player11'] !== null)
  echo ', '.$trades['id_player11'];
  if($trades['id_player12'] !== null)
  echo ', '.$trades['id_player12'].'</li>';


  echo '<li>Other: '.$trades['id_player2'];
  if($trades['id_player21'] !== null)
  echo ', '.$trades['id_player21'];
  if($trades['id_player22'] !== null)
  echo ', '.$trades['id_player22'].'</li>';




  echo '</ul></li>';

}





 ?>
</ul>

<?php require_once __DIR__.'/_footer.php'; ?>
