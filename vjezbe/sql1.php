<?php
  try {
    $db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=knezic;charset=utf8',
    'student','pass.mysql');

  } catch (PDOException $e) {
    echo "Greska:".$e->getMessage();
    exit();
  }


  $st = $db->query('SELECT JMBAG,Ime,Prezime FROM Studenti');
  foreach ($st->fetchAll() as $row) {
    echo " JMBAG = ".$row['JMBAG'].
         " Ime = ".$row['Ime'].
         " Prezime = ".$row['Prezime']."<br />\n";
       }
?>
