<?php


  session_start();
  print_r($_POST);
  print_r($_SESSION);
  echo "<br/>";
 //
 // if(isset($_COOKIE['broj_pokusaja']))
 //  $broj_pokusaja = $_COOKIE['broj_pokusaja'];
 //  else $broj_pokusaja = 0;

$gameOver = false;

if(isset($_SESSION["user"]))
  $user = $_SESSION["user"];

else
  {
    $user = $_POST["user"];
    $_SESSION["user"] = $_POST["user"];
  }


  if(isset($_POST["pokusaj"]))
{
  $pokusaj = (int)$_POST["pokusaj"];
  if( !preg_match('/^\d+$/',$pokusaj))
   $message = "Trebate unijeti broj.<br/>";



  $trazeni = (int)$_SESSION["zamisljeni_broj"];


  if(isset($trazeni))
  {
    if($trazeni === $pokusaj)
    {

      $message = "Cestitamo, pogodili ste.<br/>";
      $gameOver = true;
    }

    elseif ($trazeni < $pokusaj)
    $message = "Trazeni broj je manji od vaseg pokusaja.<br/>";

    else
    $message = "Trazeni broj je veci od vaseg pokusaja.<br/>";

  //  echo "Broj pokusaja = ".$broj_pokusaja."<br/>";
  }
}
// $broj_pokusaja++;
// setcookie('broj_pokusaja',$broj_pokusaja,time()+24*60*60);

 ?>







<!DOCTYPE html>
<html>
<head>
  <title>Pogodi</title>
  <meta charset="utf-8">
</head>
<body>
  <?php echo "Dobro dosao,".$user."<br/>"; ?>
  <?php if(isset($message)) echo $message; ?>

  <?php

    if(!$gameOver)
    {
      ?>
  <form action="zadatak3_pogodi.php" method="POST"/>
    Pokusaj = <input type="text" name="pokusaj" />
    <br/><br/>
    <input type="submit" name="posalji" value="Pogodi"/>

  </form>
  <?php
    }
    else {
      //$broj_pokusaja = 0;
      session_unset();
      session_destroy();
    }

?>
<a href="https://rp2.studenti.math.hr/~knivan/praktikum2/vjezbe/zadatak3_index.php">Zapocni novu igru</a>
</body>
</html>
