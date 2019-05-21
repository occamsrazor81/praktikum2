<?php //session_start(); ?>
<?php require_once __DIR__.'/_header_ulogiranog.php'; ?>


<ul>
<form  action="index.php?rt=leagues/applyForLeague" method="post">


	<?php

			 echo '<li>Admin: '.$leagueInformationList['admin'].'</li>'.
					'<li>Title: '.$leagueInformationList['title'].'</li>';


				echo '<li>( ';

			$provjera = 0;
			foreach ($leagueInformationList['members'] as $members)
			{
				echo $members.' ';
				if(strcmp($members, $_SESSION['name']) == 0)
					$provjera = 1;
			}

				echo ') -> target team size: '.$leagueInformationList['targetSize'];
				echo '</li>';

				echo '<br>';

				//$nm = count($leagueInformationList['members']) + 1;
				//echo '<li>'.$nm .'</li>';

				//treba dodat i da nije member vec
				if((count($leagueInformationList['members']) + 1 < (int)$leagueInformationList['targetSize'])
				&& $_SESSION['name'] != $leagueInformationList['admin'] && $provjera == 0 &&
				$leagueInformationList['status'] != 'closed')
				{
					if(strcmp($leagueInformationList['league_type'], 'private') === 0
					|| strcmp($leagueInformationList['league_type'], 'paid_private') === 0)
						echo '<li><button type="submit" name="id_league_apply" value="'.
						$leagueInformationList['id_league'].'">'.
						'Apply for this league!</button></li>';

					elseif (strcmp($leagueInformationList['league_type'], 'public') === 0
					|| strcmp($leagueInformationList['league_type'], 'paid_public') === 0)
						echo '<li><button type="submit" name="id_league_enter" value="'.
						$leagueInformationList['id_league'].'">'.
						'Enter this league!</button></li>';

				}





	?>

</ul>
</form>

<?php require_once __DIR__.'/_footer.php'; ?>
