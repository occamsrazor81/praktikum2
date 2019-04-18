<?php

require_once 'model/libraryservice.class.php';

class BooksController
{
	public function index()
	{
		$ls = new LibraryService();

		$title = 'Popis svih knjiga knjižnice';
		$bookList = $ls->getAllBooks();

		require_once 'view/books_index.php';
	}


	public function search()
	{
		$title = 'Pretraži knjige po autoru';

		require_once 'view/books_search.php';
	}

	public function searchResults()
	{
		$ls = new LibraryService();


		if( !isset( $_POST['author'] ) || !preg_match( '/^[a-zA-Z ,-.]+$/', $_POST['author'] ) )
		{
			header( 'Location: index.php?rt=books/search');
			exit();
		}

		$title = 'Popis svih knjiga autora ' . $_POST['author'];
		$bookList = $ls->getBooksByAuthorName( $_POST['author'] );

		require_once 'view/books_index.php';
	}


	public function find()
	{
		$title = 'Pronađi pisca:';

		require_once __DIR__ .'/../view/books_find.php';
	}

	public function findAuthor()
	{

		$ls = new LibraryService();
		if(!isset($_POST['title']) || !preg_match( "/^[a-zA-Z0-9 ,-.:']+$/", $_POST['title']))
		{
			header('Location: index.php?rt=books/find');
			exit();
		}

		$title = 'Autor knjige '.$_POST['title'];
		$bookList = $ls->getAuthorByBook($_POST['title']);

		require_once __DIR__.'/../view/books_index.php';
	}






};

?>
