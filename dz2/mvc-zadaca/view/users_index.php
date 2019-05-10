<?php require_once __DIR__.'/_header.php'; ?>



<table>
	<tr><th>username</th><th>password_hash</th></tr>
	<?php
		foreach( $userList as $user )
		{
			echo '<tr>' .
			     '<td>' . $user->username . '</td>' .
			    '<td>' . $user->password_hash . '</td>' .
			     '</tr>';
		}
	?>
</table>

<?php require_once __DIR__.'/_footer.php'; ?>
