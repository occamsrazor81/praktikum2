<?php //session_start(); ?>
<?php require_once __DIR__.'/_header_ulogiranog.php'; ?>


<form  action="index.php?rt=leagues/acceptOrRejectApplicants" method="post">


<table>
	<tr><th>Admin</th><th>Title</th><th>Type</th><th>Status</th><th>Applicants</th></tr>
	<?php
			if(isset($leagueList))
      foreach( $leagueList as $league )
      {

        echo '<tr>';

        echo '<td>'.$league['admin'].'</td>';
        // echo '<td>'.$league['title'].'</td>';
				echo '<td><button type="submit" name="league_id" value="'.
				$league['id'].'">'.$league['title'].'</button></td>';
        echo '<td>'.$league['league_type'].'</td>';
        echo '<td>'.$league['status'].'</td>';

        echo '<td><ul>';
        if( strcmp($_SESSION['name'], $league['admin']) === 0 &&
        ( strcmp($league['league_type'], 'private') === 0 ||
        strcmp($league['league_type'], 'paid_private') === 0 ))
          foreach ($league['applicants'] as $applicants)
          {
            echo '<li>'.$applicants->username.' '.
						'<button type="submit" name="accept" value="'.
						$league['id'].'_'.$applicants->id.'">'.
						'Accept application.</button> '.
						'<button type="submit" name="reject" value="'.
						$league['id'].'_'.$applicants->id.'">'.
						'Reject application.</button>'.
						'</li><hr>';
            //dodati gumbe za prihvat odnosno odbijanje aplikanata
          }
					echo '</ul></td>';


        echo '</tr>';

      }

	?>
</table>
</form>

<?php require_once __DIR__.'/_footer.php'; ?>
