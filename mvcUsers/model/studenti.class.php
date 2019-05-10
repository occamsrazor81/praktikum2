
<?php

class Student
{
  protected $jmbag, $ime, $prezime, $ocjena;

  function __construct($jmbag,$ime,$prezime,$ocjena)
  {
    $this->jmbag = $jmbag;
    $this->ime = $ime;
    $this->prezime = $prezime;
    $this->ocjena = $ocjena;
  }

  function __get($property)
  {
    if(property_exists($this,$property))
    return $this->$property;
  }

  function __set($property,$value)
  {
    if(property_exists($this,$property))
    {
      $this->$property = $value;
       return $this;
     }
  }

};


 ?>
