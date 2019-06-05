<?php //session_start(); ?>
<?php require_once __DIR__.'/_header_ulogiranog.php'; ?>


<ul>
<form  action="index.php?rt=leagues/inviteSomeone" method="post">


	<?php

			 echo '<li>Admin: '.$leagueInformationList['admin'].'</li>'.
					'<li>Title: '.$leagueInformationList['title'].'</li>';
					//'<li><p>Description: <br>'.$projectDescriptionList['description'].'</p></li>';

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


				// if((count($leagueInformationList['members']) + 1 < (int)$leagueInformationList['targetSize'])
				// && strcmp($_SESSION['name'],$leagueInformationList['admin']) != 0 && $provjera == 0 &&
				// $leagueInformationList['status'] != 'closed')
				// echo '<li><button type="submit" name="id_league_apply" value="'.$leagueInformationList['id_league'].'">'.
				// 'Apply for this league!</button></li>';

				if(strcmp($leagueInformationList['status'],'closed') !== 0 &&
				strcmp($_SESSION['name'], $leagueInformationList['admin']) === 0)
        echo '<li>Send invitation to: '.
        '<input type="text" name="invite_name" >'.
        '<button type="submit" name="id_league_invite" value="'.$leagueInformationList['id_league'].'">'.
        'Invite</button> </li>';


				if(strcmp($_SESSION['name'],$leagueInformationList['admin']) !== 0
				&&  strcmp($leagueInformationList['status'], 'closed') !== 0)
				echo '<li><button type="submit" name="id_league_exit" value="'.
				$leagueInformationList['id_league'].'">'.
				'Leave league!</button></li>';

				if(strcmp($leagueInformationList['status'],'closed') === 0)
				echo '<li><button type="submit" name="id_league_start_draft" value="'.
				$leagueInformationList['id_league'].'">'.
				'League Page!</button></li>';






	?>


</ul>
</form>

<?php require_once __DIR__.'/_footer.php'; ?>
