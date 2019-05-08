<?php //session_start(); ?>
<?php require_once __DIR__.'/_header_ulogiranog.php'; ?>

<table>
	<tr><th>Author</th><th>Project</th><th>Status</th></tr>
	<?php
		foreach( $projectList as $project )
		{
			// echo '<tr>' .
			// 		 '<td>' . $project->id_user . '</td>' .
			//      '<td>' . $project->title . '</td>' .
			// 		 '<td>' . $project->status . '</td>' .
			//      '</tr>';

					 echo '<tr>' .
		 					 '<td>' . $project['author'] . '</td>' .
		 			     '<td>' . $project['title'] . '</td>' .
		 					 '<td>' . $project['status'] . '</td>' .
		 			     '</tr>';
		}
	?>
</table>

<?php require_once __DIR__.'/_footer.php'; ?>
