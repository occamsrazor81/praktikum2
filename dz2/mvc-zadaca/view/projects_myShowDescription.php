<?php //session_start(); ?>
<?php require_once __DIR__.'/_header_ulogiranog.php'; ?>


<ul>
<form  action="index.php?rt=projects/inviteSomeone" method="post">


	<?php

			 echo '<li>Author: '.$projectDescriptionList['author'].'</li>'.
					'<li>Title: '.$projectDescriptionList['title'].'</li>'.
					'<li><p>Description: <br>'.$projectDescriptionList['description'].'</p></li>';

				echo '<li>( ';

			$provjera = 0;
			foreach ($projectDescriptionList['members'] as $members)
			{
				echo $members.' ';
				if(strcmp($members, $_SESSION['name']) == 0)
					$provjera = 1;
			}

				echo ') -> target team size: '.$projectDescriptionList['targetSize'];
				echo '</li>';

				echo '<br>';


				if((count($projectDescriptionList['members']) + 1 < (int)$projectDescriptionList['targetSize'])
				&& strcmp($_SESSION['name'],$projectDescriptionList['author']) != 0 && $provjera == 0 &&
				$projectDescriptionList['status'] != 'closed')
				echo '<li><button type="submit" name="id_project_apply" value="'.$projectDescriptionList['id_project'].'">'.
				'Apply for this project!</button></li>';

				if(strcmp($projectDescriptionList['status'],'closed') !== 0 &&
				strcmp($_SESSION['name'], $projectDescriptionList['author']) === 0)
        echo '<li>Send invitation to: '.
        '<input type="text" name="invite_name" >'.
        '<button type="submit" name="id_project_invite" value="'.$projectDescriptionList['id_project'].'">'.
        'Invite</button> </li>';






	?>


</ul>
</form>

<?php require_once __DIR__.'/_footer.php'; ?>
