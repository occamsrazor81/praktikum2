<?php //session_start(); ?>
<?php require_once __DIR__.'/_header_ulogiranog.php'; ?>

<!-- ovo promijeniti -->
<form  action="index.php?rt=leagues/findLeagueDetails" method="post">

<table>
	<tr><th>Admin</th><th>Title</th><th>Type</th><th>Status</th></tr>
	<?php
		foreach( $leagueList as $league )
		{

      echo '<tr>';

      echo '<td>'.$league['admin'].'</td>';
      echo '<td>'.$league['title'].'</td>';
      echo '<td>'.$league['league_type'].'</td>';
      echo '<td>'.$league['status'].'</td>';


      echo '</tr>';

		}
	?>
</table>
</form>

<?php require_once __DIR__.'/_footer.php'; ?>
