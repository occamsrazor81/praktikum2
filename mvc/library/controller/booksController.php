<?php


require_once __DIR__. '/../model/libraryservice.class.php';

class BooksController
{

  public function index()
  {

    $ls = new LibraryService();



    $title = 'Popis svih knjiga';
    $bookList = $ls->getAllBooks();

    require_once __DIR__. '/../view/books_index.php';

  }

  public function search()
  {
    $title = 'Pretraživanje po autoru';





    require_once __DIR__. '/../view/books_search.php';

  }

  public function searchResults()
  {
    $ls = new LibraryService();

    if(isset($_POST['author']) && preg_match('/^[a-zA-Z0-9 .,]+$/'),$_POST['author'])
    {
      $title = 'Knjige autora'.$_POST['author'];
      $bookList = $ls->getBooksByAuthor($_POST['author']);


        require_once __DIR__. '/../view/books_index.php';

    }

    else
    {
      $title = 'Greska';
      $error = 'Krivi unos';
    }




  }




};



 ?>
