<?php

require_once __DIR__.'/studenti.class.php';
require_once __DIR__.'/db.class.php';


class StudentService
{

  function getAllStudents()
  {
    try
    {
      $db = DB::getConnection();
      $st = $db->prepare("SELECT JMBAG,Ime,Prezime,Ocjena from Studenti");
      $st->execute();
    }
    catch (PDOException $e) {  exit( 'PDO error ' . $e->getMessage() ); }

    $arr = array();
    while($row = $st->fetch())
    $arr[] = new Student($row['JMBAG'], $row['Ime'], $row['Prezime'], $row['Ocjena']);

    return $arr;

  }

};

 ?>
