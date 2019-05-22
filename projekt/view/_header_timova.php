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

  <p>
    User: <?php if(isset($_SESSION['name'])) echo $_SESSION['name']; ?> <br>
    League: <?php if(isset($_SESSION['league_title']) )  echo $_SESSION['league_title']; ?>
  </p>

	<nav>
		<ul>
			<li><a href="index.php?rt=leagues/myLeagues">Return to MyLeagues</a></li>
      <li><a href="index.php?rt=teams/usersInLeague">Users in League</a></li>
		</ul>
	</nav>


  <form method="post" action="index.php?rt=users/login">

  	<button type="submit" name="logout">Logout</button>
  </form>
