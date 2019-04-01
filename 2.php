<!DOCTYPE html>

<HTML>
<HEAD>
  <title>vjezbe0->zad2</title>
</HEAD>

<BODY>

<form action = "2.php" method = "GET">
  Broj 1: <input type = "text" name = "br1" />
  <br/><br/>
  Broj 2: <input type = "text" name = "br2" />
  <br/><br/>

  <input type="submit" value = "Zbroji"/>
  <input type="reset" value = "Reset"/>
  <br/><br/>

  Rezultat =
<form>




</BODY>
</HTML>


<?php

    $br1 = $_GET["br1"];
    $br2 = $_GET["br2"];
    $rez = $br1 + $br2;
    echo $rez."<br/>";
    print_r($_GET);


?>
