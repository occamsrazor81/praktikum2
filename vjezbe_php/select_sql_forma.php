<?php

$user = 'student';
$pass = 'pass.mysql';


try {
  $db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=knezic;charset=utf8',$user,$pass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);


} catch (PDOException $e) {
  echo "Greska".$e->getMessage();
  exit();

}

if(isset($_POST['ocj']) && isset($_POST['ispisi']))
try {

  $st = $db->prepare('SELECT JMBAG,Ime,Prezime,Ocjena from Studenti where Ocjena=:ocjena');
  $st->execute(array('ocjena'=>(int)$_POST['ocj']));


} catch (PDOException $e) {
  echo "Greska".$e->getMessage();
  exit();
}

elseif (isset($_POST['ubaci']) && isset($_POST['jmbag']) && isset($_POST['ime']) &&
isset($_POST['prezime']) && isset($_POST['ocjena']))
try {

  $st = $db -> prepare('INSERT into Studenti(JMBAG,Ime,Prezime,Ocjena) values (:jmbag,:ime,:prezime,:ocjena)');
  $st -> execute(array('jmbag' => (int)$_POST['jmbag'],
  'ime' => $_POST['ime'], 'prezime' => $_POST['prezime'], 'ocjena' => $_POST['ocjena']));

} catch (PDOException $e) {
  echo "Greska".$e->getMessage();
  exit();

}


elseif (isset($_POST['promijeni']) &&  $_POST['prezime_promijeni'] &&
        isset($_POST['ocjena_promijeni']))
try {

    $st = $db->prepare('UPDATE Studenti set Ocjena=:ocjena_promijeni where Prezime like :prezime_promijeni');
    $st->execute(array('ocjena_promijeni' => $_POST['ocjena_promijeni'],
                        'prezime_promijeni' => $_POST['prezime_promijeni']));


} catch (PDOException $e) {
  echo "Greska".$e->getMessage();
  exit();

}

elseif(isset($_POST['izbaci']) && isset($_POST['ime_izbaci']))
try {

  $st = $db->prepare('DELETE from Studenti where Ime like :ime_izbaci');
  $st->execute( array('ime_izbaci' => $_POST['ime_izbaci'] ));

} catch (PDOException $e) {
  echo "Greska".$e->getMessage();
  exit();

}










 ?>

 <!DOCTYPE html>

 <HTML>
 <HEAD>
   <title>predavanja0</title>
   <style media="screen">
     table,tr,td {border: solid 1px;}
   </style>

 </HEAD>

 <BODY>

 <form action = <?php echo $_SERVER['PHP_SELF']; ?> method = "POST">

  Za Ispis:<br/>
   Ocjena = <input type="text" name="ocj" />
   <br/><br/>

   Za ubacivanje novog retka:<br/>
   JMBAG = <input type="text" name="jmbag" /><br/>
   Ime =  <input type="text" name="ime" /><br/>
   Prezime =  <input type="text" name="prezime" /><br/>
   Ocjena =  <input type="text" name="ocjena" /><br/>
   <br/><br/>

   Za promjenu ocjene tamo gdje je Prezime:<br/>
   Prezime = <input type="text" name="prezime_promijeni" /><br/>
   Ocjena =  <input type="text" name="ocjena_promijeni" /><br/>
   <br/><br/>

   Za izbacivanje retka/redaka tamo gdje je Ime:<br/>
   Ime = <input type="text" name="ime_izbaci" /><br/>
   <br/><br/>


   <input type="submit" name="ispisi" value="Ispisi" />
   <input type="submit" name="ubaci" value="Ubaci" />
   <input type="submit" name="promijeni" value="Promijeni" />
   <input type="submit" name="izbaci" value="Izbaci" />

 </form>

 <table>
   <hr/>
   <?php
   if(isset($_POST['ispisi']))
   foreach ($st->fetchAll() as $row) {
     echo "<tr>";
     echo "<td>".$row['JMBAG']."</td>";
     echo "<td>".$row['Ime']."</td>";
     echo "<td>".$row['Prezime']."</td>";
     echo "<td>".$row['Ocjena']."</td>";
     echo "</tr>";
   }


    ?>
 </table>

 </BODY>
 </HTML>
