<?php

require_once __DIR__. '/user.class.php';
require_once __DIR__. '/book.class.php';

require_once __DIR__. '/db.class.php';

class LibraryService
{
  function getAllUsers()
  {
    $users =  array();

    $db = DB::getConnection();

    try
    {
      $st = $db->prepare( 'SELECT id,name,surname,password FROM users ');
      $st->execute();
    }catch( PDOException $e ) { echo "Greska ". $e->getMessage(); }

    while ($row = $st->fetch())
        $users[] = new User($row['id'], $row['name'], $row['surname'], $row['password']);



    return $users;

  }


  //----------------

  function getAllBooks()
  {
    $books =  array();

    $db = DB::getConnection();

    try
    {
      $st = $db->prepare( 'SELECT id,author,title FROM books ');
      $st->execute();
    }catch( PDOException $e ) { echo "Greska ". $e->getMessage(); }

    while ($row = $st->fetch())
        $books[] = new Book($row['id'], $row['author'], $row['title']);



    return $books;

  }




}

  ?>
