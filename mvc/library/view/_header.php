<?php

 ?>
<!DOCTYPE html>
<html>
 <head>
 	<meta charset="utf-8">
 	<title>Knjižnica</title>
  <style>
    table,th,tr,td {border: solid 2px;}
  </style>
 </head>
 <body>
  <h1>Knjižnica</h1>
  <hr/>
  <ul>
    <li><a href="index.php?rt=users/index">Popis svih korisnika</a></li>
    <li><a href="index.php?rt=books/index">Popis svih knjiga</a></li>
    <li><a href="index.php?rt=books/search">Pretraživanje po autoru</a></li>
  </ul>

  <h2><?php echo $title; ?></h2>
