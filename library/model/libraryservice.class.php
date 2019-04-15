<?php

require_once __DIR__. '/users.class.php';
require_once __DIR__. '/db.class.php';

class LibraryService
{
  function getAllUsers()
  {
    $users =  array();

    $db = DB::getConnection();

    try
    {
      $st = $db->prepare( 'SELECT id,name,surname,password FROM users WHERE username=:username' );
      $st->execute();
    }catch( PDOException $e ) { echo "Greska ". $e->getMessage(); }

    while ($row = $st->fetch())
        $users[] = new User($row['id'], $row['name'], $row['surname'], $row['password']);



    return $users;

  }


}

  ?>
