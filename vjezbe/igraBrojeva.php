<?php

  session_start();

  $x = rand(1,100);

  // if(isset($_SESSION['zamisljeni_broj']))
  // {
  //   header('Location: zadatak3_pogodi.php');
  //   exit();
  // }

  $_SESSION["zamisljeni_broj"] = $x;
//  $_SESSION["broj_pokusaja"] = 0;

 ?>







<!DOCTYPE html>
<html>
<head>
  <title>Pogodi</title>
  <meta charset="utf-8">
</head>
<body>
  <form action = "pogodiBroj.php" method = "POST" />
  Username = <input type="text" name="user" />
  <br/><br/>
  <input type="submit" value="Posalji" />

  </form>

</body>
</html>
