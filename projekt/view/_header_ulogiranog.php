<?php //session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>FantasyApp</title>

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
			<li><a href="index.php?rt=leagues">All Leagues</a></li>
			<li><a href="index.php?rt=leagues/myLeagues">My Leagues</a></li>
      <li><a href="index.php?rt=leagues/createNew">Start new League</a></li>
			<li><a href="index.php?rt=leagues/pendingApplications">League Applications</a></li>
			<li><a href="index.php?rt=leagues/pendingInvitations">League Invitations</a></li>
		</ul>
	</nav>


  <form method="post" action="index.php?rt=users/login">

  	<button type="submit" name="logout">Logout</button>
  </form>
