<?php //session_start(); ?>
<?php require_once __DIR__.'/_header_ulogiranog.php'; ?>


<ul>

	<?php

			 echo '<li>Author: '.$projectDescriptionList['author'].'</li>'.
					'<li>Title: '.$projectDescriptionList['title'].'</li>'.
					'<li><p>Description: <br>'.$projectDescriptionList['description'].'</p></li>';

				echo '<li>';

			foreach ($projectDescriptionList['members'] as $members)
						echo $members.' ';

				echo '</li>';






	?>

</ul>


<?php require_once __DIR__.'/_footer.php'; ?>
