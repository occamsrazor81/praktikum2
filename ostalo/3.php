<!DOCTYPE html>
<?php

  function zbroji()
{  if(!isset($_COOKIE['suma'])) $suma = 0;
  else $suma = $_COOKIE['suma'];
  $broj = $_GET['broj'];
  $suma += $broj;
  setcookie('suma',$suma,time()+60*60*24);
  return $suma;
}

?>
<HTML>
<HEAD>
  <title>vjezbe0->zad3</title>
</HEAD>

<BODY>

<form action="3.php" method="GET">
  Broj = <input type="text" name="broj">
  <input type="submit" value="Zbroji">
  <br/><br/>
  Suma = <?php echo zbroji(); ?>
</form>



</BODY>
</HTML>
