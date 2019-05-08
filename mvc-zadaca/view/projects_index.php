<?php //session_start(); ?>
<?php require_once __DIR__.'/_header_ulogiranog.php'; ?>

<table>
	<tr><th>Project</th></tr>
	<?php
		foreach( $projectList as $project )
		{
			echo '<tr>' .
			     '<td>' . $project->title . '</td>' .
			     '</tr>';
		}
	?>
</table>

<?php require_once __DIR__.'/_footer.php'; ?>
