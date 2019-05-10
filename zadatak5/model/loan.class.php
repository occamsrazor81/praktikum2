<?php
class Loan
{
  protected $id, $id_user, $id_book, $lease_end;

  function __construct($id, $id_user, $id_book, $lease_end)
  {
    $this->id = $id;
    $this->id_user = $id_user;
    $this->id_book = $id_book;
    $this->lease_end = $lease_end;
  }

  function __get($property) { return $this->$property; }
  function __set($property,$value) { $this->$property = $value; return $this;}

};



 ?>
