<!DOCTYPE html>

<?php

  //print_r($_GET);

  $bojaPozadine = 'white';

  if(isset($_GET["bojaText"]) && $_GET["bojaText"] !== '')
  {
    if(preg_match('/^(#[0-9a-f]{3})|(#[0-9a-f]{6})$/',$_GET['bojaText']))
    $bojaPozadine = htmlentities($_GET["bojaText"]);
    else $error = "Krivi unos u textbox.<br/>";

  }
  elseif ($_GET["bojaSelect"] )
  {
    if(preg_match('/^[a-z]{1,20}$/',$_GET['bojaSelect']))
    $bojaPozadine = $_GET["bojaSelect"];
    else $error = "Krivi unos u select.<br/>";
  }
  elseif(isset($_COOKIE['bojaPozadine']))
    $bojaPozadine = $_COOKIE['bojaPozadine'];



    if(isset($error)) echo $error."<br>";
  setcookie('bojaPozadine',$bojaPozadine,time()+60*60*24);

  //crtaj_html($bojaPozadine);

//----------------------------



?>

<HTML>
<HEAD>
  <title>vjezbe3</title>
  <style>
    body
    {
      background-color: <?php echo $bojaPozadine ?>;
    }
  </style>

</HEAD>

<body>

<form action = "zadatak1.php" method = "GET">
  Boja Select: <select name = "bojaSelect">
    <option value = "yellow">Zuta</option>
    <option value = "red">Crvena</option>
    <option value = "blue">Plava</option>


  </select>

  <br/>
  <br/>
     HTML  Boja: <input type = "text" name = "bojaText" />
  <br/>
  <br/>
  <input type = "submit" value = "Promijeni boju" />

  <br/>
  <br/>

</form>




</body>
</HTML>
