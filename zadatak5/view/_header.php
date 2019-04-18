<!DOCTYPE html>
<html>
<head>
	<meta charset="utf8">
	<title>KnjižnicaApp</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<h1><?php echo $title; ?></h1>

	<nav>
		<ul>
			<li><a href="index.php?rt=users">Popis svih korisnika</a></li>
			<li><a href="index.php?rt=books">Popis svih knjiga</a></li>
			<li><a href="index.php?rt=loans">Popis svih posudbi</a></li>
			<li><a href="index.php?rt=books/search">Tražilica knjiga po autoru</a></li>
			<li><a href="index.php?rt=books/find">Nađi autora</a></li>
			<li><a href="index.php?rt=loans/search">Nađi posudbu po danu završetka</a></li>
			<li><a href="index.php?rt=loans/findBookLoan">Nađi Knjigu</a></li>

		</ul>
	</nav>
