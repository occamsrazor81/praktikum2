<?php

$user = 'student';
$pass = 'pass.mysql';
try {

  $db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=knezic;charset=utf8',$user,$pass);


} catch (PDOException $e) {
  echo "Greska".$e->getMessage();
  exit;

}

try {

  // obican select
  //$st = $db->prepare('SELECT Ime,Prezime,Ocjena from Studenti');
  //$st->execute();

  //select where
  // $st = $db->prepare('SELECT Ime,Prezime,Ocjena from Studenti where Ocjena = 5');
  // $st->execute();

// select where sa array
  // $st = $db->prepare('SELECT Ime,Prezime,Ocjena from Studenti where Ocjena =:ocjena');
  // $st->execute(array('ocjena' => 4));

//insert
  // $st = $db->prepare("INSERT into Studenti values ('198273645','Iva','Sulentic','3')");
  // $st->execute();

//insert sa array
// $st = $db->prepare("INSERT into Studenti(JMBAG,Ime,Prezime,Ocjena) values (:jmbag,:ime,:prezime,:ocjena)");
//  $st->execute(array('jmbag' => 444444333, 'ime' => 'Lidija',
//                     'prezime' => 'Bacic', 'ocjena' => 5));

//update sa array
 // $st = $db->prepare("UPDATE Studenti set Ocjena=:ocjena where Prezime=:prezime");
 // $st->execute(array('ocjena' => 4, 'prezime' => 'Sulentic'));

// delete sa array
  // $st = $db->prepare('DELETE from Studenti where Ime like :ime');
  // $st->execute(array('ime' => 'Iva'));

  // vise insertova sa array
  $st = $db->prepare("INSERT into Studenti(JMBAG,Ime,Prezime,Ocjena) values (:jmbag,:ime,:prezime,:ocjena)");
   $st->execute(array('jmbag' => 181818188, 'ime' => 'Miroslav',
                      'prezime' => 'Blazevic', 'ocjena' => 5));

  $st->execute(array('jmbag' => 102030400, 'ime' => 'Nenad',
                      'prezime' => 'Bjelica', 'ocjena' => 4));
  $st->execute(array('jmbag' => 000111222, 'ime' => 'Ella',
                      'prezime' => 'Dvornik', 'ocjena' => 4));
  $st->execute(array('jmbag' => 345000123, 'ime' => 'Maja',
                      'prezime' => 'Suput', 'ocjena' => 5));

  $st->execute(array('jmbag' => 777666888, 'ime' => 'Domagoj',
                      'prezime' => 'Duvnjak', 'ocjena' => 5));





} catch (PDOException $e) {
  echo "Greska".$e->getMessage();
  exit;

}

?>
<!DOCTYPE html>

<HTML>
<HEAD>
  <title>SQL</title>
  <style media="screen">
    table,tr,td {border: solid 2px;}
  </style>

</HEAD>

<BODY>

<table>
  <?php
foreach ($st->fetchAll() as $row) {
  echo "<tr>";
  echo "<td>".$row['Ime']."</td>";
  echo "<td>".$row['Prezime']."</td>";
  echo "<td>".$row['Ocjena']."</td>";
  echo "</tr>";

}
?>
</table>
</BODY>
</HTML>
