<?php


$imena = dohvatiStaraImena();
if(saljeNovoIme())
{
  $novoIme = dohvatiNovoIme();
  $imena = dodajNovoImeUPopis($novoIme,$imena);
  spremiNoviPopis($imena);

}

ispisiNoviPopis($imena);


  //----------------------------------------------
function dohvatiStaraImena()
{
  if(file_exists('users.txt'))
  {
    $string = file_get_contents('users.txt');
    $imena = explode(',' , $string);

  }

  else
    $imena = [];

  return $imena;
}


function saljeNovoIme()
{
  if(isset($_POST['novo_ime']))
    return true;

  else return false;

}

function dohvatiNovoIme()
{
  $novo = $_POST['novo_ime'];
  return $novo;
}



function dodajNovoImeUPopis($novoIme,$imena)
{
  //chmod for writing...(npr 766)
  $imena[] = $novoIme; //na kraj stavlja $novoIme
  if(count($imena) > 5)
    unset($imena[0]); //brisemo na indeksu 0 pa $imena pocinje s indeksom 1

  return $imena;
}

function spremiNoviPopis($imena)
{
  $string = implode(',' , $imena);
  file_put_contents('users.txt', $string);
}

function ispisiNoviPopis($imena)
{
  ?>


  <!DOCTYPE html>

  <HTML>
  <HEAD>
    <title>datoteke</title>

  </HEAD>

  <BODY>

    <form action = "dat.php" method = "POST" enctype="multipart/form-data">
    Unesi ime: <input type="text" name="novo_ime"/>
      <br/><br/>
      <input type="submit" value="Posalji" />


    </form>
    <br/>

    <ul>
      <?php
      foreach ($imena as $index => $ime) {
        echo '<li>'.$ime.'</li>';
      }

       ?>


    </ul>



  </BODY>
  </HTML>



  <?php
}

?>
