<?php
function sendJSONandExit( $message )
{
    // Kao izlaz skripte pošalji $message u JSON formatu i prekini izvođenje.
    header( 'Content-type:application/json;charset=utf-8' );
    echo json_encode( $message );
    flush();
    exit( 0 );
}

if(!isset($_GET['filename']))
{
  sendJSONandExit(['error' => 'Treba poslati filename']);
}

$filename = $_GET['filename'];
$filename = basename($filename);

if(!file_exists($filename))
sendJSONandExit(['error' => 'datoteka '.$filename. ' ne postoji.']);

$size = filesize($filename);
$lastChange = date("F d Y H:i:s", filemtime($filename));

$msg = [];
$msg['filename'] = $filename;
$msg['size'] = $size;
$msg['lastChange'] = $lastChange;

sendJSONandExit($msg);

 ?>
