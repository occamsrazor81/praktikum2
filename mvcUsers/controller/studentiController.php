<?php

require_once __DIR__.'/../model/studentservice.class.php';

class StudentiController
{
  public function index()
  {
    $ss = new StudentService();
    $title = 'Naslov';
    $studentList = $ss->getAllStudents();

    require_once __DIR__.'/../view/studenti_index.php';
  }


};

 ?>
