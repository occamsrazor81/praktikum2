<?php


$imena = dohvatiImena();

if(primaIme())
{
  $novoIme = dohvatiNovoIme();
  $imena = dodajNovoImeUPopis($novoIme,$imena);
  spremiNoviPopis($imena);
}

ispisiPopis($imena);

//------------------------------------------



function dohvatiImena()
{


  if(file_exists('users.txt'))
  {
    $string = file_get_contents('users.txt');
    $imena = explode(",",$string);
  }

  else {
    $imena = array();
  }

  return $imena;


}

function primaIme()
{
  if(isset($_POST['ime']))
    return true;

  else return false;
}


function dohvatiNovoIme()
{
  $novoIme = $_POST['ime'];

  return $novoIme;
}


function dodajNovoImeUPopis($novoIme,$imena)
{

  array_push($imena ,$novoIme);
  if(count($imena) > 5)
    unset($imena[0]);



  return $imena;
}



function spremiNoviPopis($imena)
{


  $string = implode(',',$imena);
  file_put_contents('users.txt',$string);

}

function ispisiPopis($imena)
{
  print_r($imena);


}


 ?>


 <!DOCTYPE html>

 <HTML>
 <HEAD>
   <title>users</title>

 </HEAD>

 <BODY>

 <form action = "users.php" method = "POST">
   Ime = <input type = "text" name = "ime" />
   <br/><br/>
   <input type = "submit" value = "Posalji." />
   <br/>


 </form>

 </BODY>
 </HTML>
