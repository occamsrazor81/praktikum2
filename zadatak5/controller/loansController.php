<?php

require_once __DIR__.'/../model/libraryservice.class.php';

class LoansController
{
  public function index()
  {
    $ls = new LibraryService();
    $title = 'Popis svih posudbi';
    $loanList = $ls->getAllLoans();

    require_once __DIR__. '/../view/loans_index.php';

  }

  public function search()
  {
    $title = 'Pretraži posudbe po danu kraja posudbe';


    require_once __DIR__.'/../view/loans_search.php';
  }

  public function searchResults()
  {
    if(!isset($_POST['lease_end']) || !preg_match('/^[0-9-]{4,10}$/',$_POST['lease_end']))
    {
      header('Location: index.php?rt=loans/search');
      exit();
    }


    $ls = new LibraryService();
    $title = 'Tražena posudba';
    $loanList = $ls->getLoansByLeaseEnd($_POST['lease_end']);

    require_once __DIR__.'/../view/loans_index.php';

  }

  public function findBookLoan()
  {
    $title = 'Nađi knjigu';

    require_once __DIR__.'/../view/loans_findBookLoan.php';
  }

  public function findBookResults()
  {

    if(!isset($_POST['id_book']) || !preg_match('/^[1-9][0-9]*$/',$_POST['id_book']))
    {
      header('Location: index.php?rt=loans/findBookLoan');
      exit();
    }

    $title = 'Tražena knjiga';
    $ls = new LibraryService();

    $loanList = $ls->getBookLocation($_POST['id_book']);

    require_once __DIR__.'/../view/loans_index.php';
  }

  //----------------------------------------------------------------------
  //naci knjigu koja je posudena na lease_end (kombinacija tablica)
  //mozda i autora koji je je posudio



};


 ?>
