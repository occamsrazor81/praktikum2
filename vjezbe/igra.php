
<?php

//inicijaliziraj();
session_start();
$boja = "white";

//---------------------------


      if(!isset($_SESSION['br_redova']) && !isset($_SESSION['br_stupaca']))
      {
        $_SESSION['br_redova'] = 1;
        $_SESSION['br_stupaca'] = [10,0,0,0];
        $_SESSION['min'] = 10;
        $_SESSION['max'] = 10;
        $_SESSION['trenutno'] = 10;
      }

      else
      {

      if(isset($_POST['napravi']) && isset($_POST['submit_napravi']))
      {
          $boja = "red";
          if(isset($_POST['dodaj']) && preg_match('/^[0-9]*$/',$_POST['dodaj']))
          {

              $dodaj = (int)$_POST['dodaj'];
              $ured = (int)$_POST['dodaj_select'];
              if($ured <= $_SESSION['br_redova'])
              {
                  if($_SESSION['br_stupaca'][$ured-1]+$dodaj > 10)
                      echo "Previse ih je <br>";
                  else
                  {
                      $_SESSION['br_stupaca'][$ured-1] += $dodaj;
                      $_SESSION['trenutno'] += $dodaj;

                      if($_SESSION['trenutno'] > $_SESSION['max'])
                        $_SESSION['max'] = $_SESSION['trenutno'];




                      echo $ured." ".$_SESSION['br_stupaca'][$ured-1]."<br>";
                      print_r($_SESSION['br_stupaca']);
                      echo "<br>";

                  }
              }
          }

          if(isset($_POST['ukloni']) && preg_match('/^[0-9]*$/',$_POST['ukloni']))
          {

              $ukloni = (int)$_POST['ukloni'];
              $izreda = (int)$_POST['ukloni_select'];
              //echo $ukloni."<br>";
              if($izreda <= $_SESSION['br_redova'])
              {
                  if($_SESSION['br_stupaca'][$izreda-1]-$ukloni < 0)
                      echo "nema ih toliko<br/>";

                  else
                  {
                      $_SESSION['br_stupaca'][$izreda-1] -= $ukloni;
                      $_SESSION['trenutno'] -= $ukloni;

                      if($_SESSION['trenutno'] < $_SESSION['min'])
                        $_SESSION['min'] = $_SESSION['trenutno'];



                      echo $izreda." ".$_SESSION['br_stupaca'][$izreda-1]."<br>";
                      print_r($_SESSION['br_stupaca']);
                      echo "<br>";
                  }

              }

          }

          if($_POST['napravi'] == 'nr')
          {
              $_SESSION['br_redova']++;
              //echo $_SESSION['br_redova'];
              if($_SESSION['br_redova'] > 4)
              $_SESSION['br_redova'] = 4;
          }
    }
  }

  if(isset($_POST['kraj_igre']))
  {
    echo "min = ".$_SESSION['min']."<br/>";
    echo "max = ".$_SESSION['max']."<br/>";
    session_unset();
    session_destroy();
  }




?>



<!DOCTYPE html>
<html>
<head>
<title>Igra K</title>
<style>
td { border:solid 2px; background-color:<?php echo $boja ?>;}

</style>
</head>
<body>


<table>

<?php
if(isset ($_SESSION['br_redova']) && isset ($_SESSION['br_stupaca']))
for($i = 0; $i < $_SESSION['br_redova'];$i++)
{
    echo "<tr>";
    for($j = 0; $j < $_SESSION['br_stupaca'][$i];$j++)
    echo "<td>"."K"."</td>";
    echo "</tr>";
}

?>

</table>
<br/><hr/><br/>


<form action = <?php echo $_SERVER['PHP_SELF'];?> method = "post">

<input type="radio" name ="napravi">
Dodaj : <input type="text" name="dodaj"/> kocaka u red
<select name='dodaj_select'>
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
</select>
<br/><br/>

<input type="radio" name ="napravi">
Ukloni : <input type="text" name="ukloni"/> kocaka iz reda
<select name='ukloni_select'>
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
</select>
<br/><br/>

<input type="radio" name ="napravi" value="nr">
Dodaj novi red.
<br/><br/>

<input type = "submit" name="submit_napravi" value="Napravi!">
<input type = "submit" name="kraj_igre" value="Kraj Igre!">

</form>

</body>
</html>
