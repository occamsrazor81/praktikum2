<?php

function sendJSONandExit( $message )
{
    // Kao izlaz skripte pošalji $message u JSON formatu i prekini izvođenje.
    header( 'Content-type:application/json;charset=utf-8' );
    echo json_encode( $message );
    flush();
    exit( 0 );
}


$prvi = $_GET['p'];
$drugi = $_GET['d'];
$op = $_GET['operator'];

if( $op === '+')
  echo $prvi + $drugi;

else if( $op === '-')
    echo $prvi - $drugi;

else if( $op === '*')
    echo $prvi * $drugi;

else if( $op === '/')
  echo $prvi / $drugi;

 ?>
