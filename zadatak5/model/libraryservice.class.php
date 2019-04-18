<?php

require_once 'db.class.php';
require_once 'user.class.php';
require_once 'book.class.php';

require_once __DIR__.'/loan.class.php';

class LibraryService
{
	function getUserById( $id )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, name, surname, password FROM users WHERE id=:id' );
			$st->execute( array( 'id' => $id ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if( $row === false )
			return null;
		else
			return new User( $row['id'], $row['name'], $row['surname'], $row['password'] );
	}


	function getAllUsers( )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, name, surname, password FROM users ORDER BY surname' );
			$st->execute();
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new User( $row['id'], $row['name'], $row['surname'], $row['password'] );
		}

		return $arr;
	}


	function getBookById( $id )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, author, title FROM books WHERE id=:id' );
			$st->execute( array( 'id' => $id ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		if( $row === false )
			return null;
		else
			return new Book( $row['id'], $row['author'], $row['title'] );
	}

	function getBooksByAuthorName( $author )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, author, title FROM books WHERE author=:author ORDER BY title' );
			$st->execute( array( 'author' => $author ) );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Book( $row['id'], $row['author'], $row['title'] );
		}

		return $arr;
	}


	function getAllBooks()
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id, author, title FROM books ORDER BY author' );
			$st->execute();
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Book( $row['id'], $row['author'], $row['title'] );
		}

		return $arr;
	}



	function getAuthorByBook($title)
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT id,author,title from books where title=:title');
			$st->execute(array('title' => $title));

		}
		catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			$arr[] = new Book( $row['id'], $row['author'], $row['title'] );
		}

		return $arr;

	}


	function getAllLoans()
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT id, id_user, id_book, lease_end from loans');
			$st->execute();

		}
		catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while($row = $st->fetch())
		{
			$arr[] = new Loan($row['id'], $row['id_user'], $row['id_book'], $row['lease_end']);
		}

		return $arr;

	}

	function getLoansByLeaseEnd($lease_end)
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT id,id_user,id_book,lease_end from
													loans where lease_end=:lease_end');
			$st->execute(array('lease_end' => $lease_end));

		}
		catch (PDOException $e) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while($row = $st->fetch())
		{
			$arr[] = new Loan($row['id'],$row['id_user'],$row['id_book'],$row['lease_end']);
		}

		return $arr;

	}









};

?>
