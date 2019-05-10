<?php //session_start(); ?>
<?php require_once __DIR__.'/_header_ulogiranog.php'; ?>

<form  action="index.php?rt=projects/findProjectDetails" method="post">

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

							 '<td><button type="submit" name="project_id" value="'.$project['id'].'">'.
							 $project['title'] . '</button></td>' .

							// '<td><input type="submit" name="'.$project['id'].'" value="'.$project['title'].'"</td>' .
							//'<td><input type="submit" name="pName" value="'.$project['title'].'"</td>' .


							 //'<td><a href="index.php?rt=projects/projectDetails">'.$project['title'].'</a></td>'.

							 '<td>' . $project['status'] . '</td>' .
		 			     '</tr>';
							 //<li><a href="index.php?rt=projects/myProjects">All projects</a></li>
		}
	?>
</table>
</form>

<?php require_once __DIR__.'/_footer.php'; ?>
