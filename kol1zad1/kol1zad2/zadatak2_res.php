<?php

require_once __DIR__.'/formula.php';

function swap(&$polje,$idx_prestignutog,$idx_prestigao)
{
  $tmp = $polje[$idx_prestigao];
  $polje[$idx_prestigao] = $polje[$idx_prestignutog];
  $polje[$idx_prestignutog] = $tmp;
}

session_start();

if( isset($_POST['radio']))
{
  $_SESSION['title'] = $_POST['radio'];
  $_SESSION['poredak'] = array();
}


$user = 'student';
$pass = 'pass.mysql';

try
{
  $db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=kolokvij;charset=utf8',$user,$pass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);


} catch (PDOException $e) { echo "Greska".$e->getMessage(); exit(); }


if(isset($_POST['odaberi']))
{
  //echo "string";
  try
  {
    $st = $db->prepare('SELECT id,utrka,trenutak,vozac from formula
    where utrka =:utrka order by trenutak');
    $st->execute(array('utrka' => $_SESSION['title']));
  // utrka koju trebamo je ustvari spremljena u title
  }
  catch (PDOException $e) { echo "Greska".$e->getMessage(); exit(); }

  $a = array();
  $t = array();

  while($row = $st->fetch())
  {
    array_push($t,$row['vozac']);
    $t = array_unique($t);
    $a[] = new Formula($row['id'], $row['utrka'], $row['trenutak'], $row['vozac']);
  }
  $_SESSION['poredak'] = $t;
  $_SESSION['sve'] = $a;
  $_SESSION['trenutak'] = 0;
  sort($t);
  $_SESSION['trenutni'] = 0;
}

elseif(isset($_POST['prethodno']))
{
  if($_SESSION['trenutni']-1 < 0)
  {
    echo "Nema prethodnog.<br>";
  }

  else
  {
    $prestignuti = $_SESSION['sve'][$_SESSION['trenutni']]->vozac;
    $idx_prestignutog = $_SESSION['trenutni'];
    $_SESSION['trenutni']--;
    $_SESSION['trenutak'] = $_SESSION['sve'][$_SESSION['trenutni']]->trenutak;
    $prestigao = $_SESSION['sve'][$_SESSION['trenutni']]->vozac;
    $idx_prestigao = $_SESSION['trenutni'];

    swap($_SESSION['poredak'],$idx_prestignutog,$idx_prestigao);


  }


}

elseif (isset($_POST['sljedece']))
{
  // $maxtrenutak = $_SESSION['sve'][count($_SESSION['sve'])-1]->trenutak;
  if($_SESSION['trenutni']+1 > count($_SESSION['sve'])-1)
  {
    echo "Nema sljedeceg.<br>";
  }

  else
  {
    $prestignuti = $_SESSION['sve'][$_SESSION['trenutni']]->vozac;
    $idx_prestignutog = $_SESSION['trenutni'];
    $_SESSION['trenutni']++;
    $_SESSION['trenutak'] = $_SESSION['sve'][$_SESSION['trenutni']]->trenutak;
    $prestigao = $_SESSION['sve'][$_SESSION['trenutni']]->vozac;
    $idx_prestigao = $_SESSION['trenutni'];


    swap($_SESSION['poredak'],$idx_prestignutog,$idx_prestigao);






  }

}




 ?>

 <!DOCTYPE html>

 <HTML>
 <HEAD>
   <title>z2</title>
 </HEAD>

 <BODY>
   <h3><?php if(isset($_SESSION['title'])) echo $_SESSION['title'];?></h3>
   <hr/>


   <form  action= <?php echo $_SERVER['PHP_SELF']; ?> method="post">

     Poredak nakon trenutka: <?php echo $_SESSION['trenutak']; ?>
     <br>

     <?php

     foreach($_SESSION['poredak'] as $vozac)
     {
       echo $vozac."<br>";
     }

      ?>


     <br><br>
     <input type="submit" name="prethodno" value="Prethodno pretjecanje">
     <input type="submit" name="sljedece" value="Sljedece pretjecanje">

   </form>




</BODY>
</HTML>
