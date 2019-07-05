<?php

function sendJSONandExit( $message )
{
    // Kao izlaz skripte pošalji $message u JSON formatu i prekini izvođenje.
    header( 'Content-type:application/json;charset=utf-8' );
    echo json_encode( $message );
    flush();
    exit( 0 );
}

$rijeci = array( "PRAKTIKUM", "TRAMVAJ", "POPOKATEPETL", "KOLOKVIJ", "PRIJESTOLONASLJEDNIKOVICA" );

if(isset($_GET['koliko']))
{
  $brojRijeci = count($rijeci);


  $idx = rand(0,$brojRijeci-1);
  $duljina = strlen($rijeci[$idx]);

  $message["idx"] = $idx;
  $message["duljina"] = $duljina;

  sendJSONandExit($message);

}

elseif (isset($_GET['slovo']))
{
  $idx = $_GET['idx'];
  $slovo = $_GET['slovo'];

  $rijec = $rijeci[$idx];
  $lastPos = 0;

  $positions = array();

  while (($lastPos = strpos($rijec, $slovo, $lastPos))!== false)
  {
    $positions[] = $lastPos;
    $lastPos = $lastPos + 1;
  }

  $message['positions'] = $positions;
  sendJSONandExit($message);


}


?>
