<?php

require_once 'db.php';

class Dionica
{
	protected  $oznaka, $ime, $cijena, $timestamp;

	function __construct( $oznaka, $ime, $cijena, $timestamp )
	{
		$this->oznaka = $oznaka;
    $this->ime = $ime;
    $this->cijena = $cijena;
    $this->timestamp = $timestamp;

	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

function sendJSONandExit( $message )
{
    // Kao izlaz skripte pošalji $message u JSON formatu i prekini izvođenje.
    header( 'Content-type:application/json;charset=utf-8' );
    echo json_encode( $message );
    flush();
    exit( 0 );
}

$db = DB::getConnection();

// $st = $db->prepare("SELECT * from Dionice order by timestamp desc");
// $st->execute();
//
// $arr = array();
//
// while($row = $st->fetch())
//   $arr[] = new Dionica($row['oznaka'], $row['ime'], $row['cijena'], $row['timestamp']);
//
//
//
//   $lastmodif    = isset( $_GET['timestamp'] ) ? $_GET['timestamp'] : 0;
//
//   // Otkrij kad je zadnji put bio promijenjena datoteka u kojoj je spremljena zadnja poruka.
//   $currentmodif = filemtime( $arr[0]['timestamp'] );

if(!isset($_GET['timestamp']))
  sendJSONandExit(["error" => "nema timestampa"]);

$timestamp = (int) $_GET['timestamp'];

  while( 1 )
  {
      $st = $db->prepare('SELECT (lastModified) as maxmod from Dionice');
      $st->execute();

      $row = $st->fetch();
      $lastDBChange = strtotime($row['maxmod']);

      if($lastDBChange > $timestamp)
        break;

      usleep(1000000);
  }


  $st = $db->prepare('SELECT * from Dionice');
  $st->execute();

  $msg = [];
  $msg['timestamp'] = $lastDBChange;
  $msg['oznaka'] = [];
  $msg['ime'] = [];
  $msg['cijena'] = [];

  while($row = $st->fetch())
  {
    $msg['oznaka'][] = $row['Oznaka'];
    $msg['ime'][] = $row['Ime'];
    $msg['cijena'][] = $row['Cijena'];
  }

  sendJSONandExit($msg);


 ?>
