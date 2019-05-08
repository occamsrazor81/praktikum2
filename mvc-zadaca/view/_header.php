<!DOCTYPE html>
<html>
<head>
	<meta charset="utf8">
	<title>ProjectsApp</title>

	<style media="screen">
	td { border: solid 2px; background-color: yellow;}
	tr {background-color: yellow;}
	</style>

</head>
<body>
	<h1><?php echo $title; ?></h1>

	<nav>
		<ul>
			<li><a href="index.php?rt=users">All users</a></li>
			<li><a href="index.php?rt=users/login">Login</a></li>

		</ul>
	</nav>
