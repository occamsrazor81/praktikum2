<?php //session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ProjectsApp</title>

	<style media="screen">
	td { border: solid 2px; background-color: yellow;}
	tr {background-color: yellow;}
	</style>

</head>
<body>
	<h1><?php echo $title; ?></h1>

  <p>Welcome,
		<?php
		if(isset($_SESSION['name'])) echo $_SESSION['name'];
		// else {
		// 	$_SESSION['username'] = $userList[0]->username;
		// 	$_SESSION['id_user'] = $userList[0]->id;
		// 	echo $_SESSION['username'].$_SESSION['id_user'];
		//  }


		?> </p>

	<nav>
		<ul>
			<li><a href="index.php?rt=projects">All projects</a></li>
			<li><a href="index.php?rt=projects/myProjects">My projects</a></li>
      <li><a href="index.php?rt=projects/createNew">Create new project</a></li>
			<li><a href="index.php?rt=projects/pendingApplications">Pending Applications</a></li>
			<li><a href="index.php?rt=projects/pendingInvitations">Pending Invitations</a></li>
		</ul>
	</nav>


  <form method="post" action="index.php?rt=users/login">

  	<button type="submit" name="logout">Logout</button>
  </form>
