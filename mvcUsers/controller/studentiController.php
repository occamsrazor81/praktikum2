<?php

require_once __DIR__.'/../model/studentservice.class.php';

class StudentiController
{
  public function index()
  {
    $ss = new StudentService();
    $title = 'StudentiApp';
    $studentList = $ss->getAllStudents();

    require_once __DIR__.'/../view/studenti_index.php';
  }

  public function searchOcjena()
  {

    $title = 'Pretraga po ocjeni';
    require_once __DIR__.'/../view/studenti_searchOcjena.php';

  }

  public function searchOcjenaResults()
  {
    if(!isset($_POST['ocjena']) || !preg_match('/^[1-5]$/',$_POST['ocjena']))
    {
      header('Location: index.php?rt=studenti/searchOcjena');
      exit();
    }
    $title = 'Studenti s ocjenom: '.$_POST['ocjena'];

    $ss = new StudentService();
    $studentList = $ss->getStudentsByOcjena($_POST['ocjena']);




    require_once __DIR__.'/../view/studenti_index.php';


  }


};

 ?>
