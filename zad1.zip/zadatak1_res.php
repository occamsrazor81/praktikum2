<?php

class Stol
{
	public $jelo, $cijena;
	function __construct( $jelo, $cijena )
	{
		$this->jelo = $jelo;
    $this->cijena = $cijena;

	}

  function getCijena() { return $this->cijena; }
  function getJelo() { return $this->jelo; }



	// function __get( $prop ) { return $this->$prop; }
	// function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}


//-------------------------------------------------------------

session_start();
  //
  // if(!isset($_SESSION['br_stolova']))
  //   $_SESSION['br_stolova'] = $_POST['br_stolova'];


  if(!isset($_SESSION['br_stolova']) )
  {
      $_SESSION['br_stolova'] = $_POST['br_stolova'];

      for($j = 0; $j < $_SESSION['br_stolova']; $j++)
       $_SESSION['stolovi'][$j] = array();
       //stolovi od 0 do n-1


      // echo "string";

  }

  if(isset($_POST['select_stolovi']) &&
  isset($_POST['unesi_ili_plati']) && isset($_POST['cijena']) &&
   preg_match('/^[a-zA-z]*$/',$_POST['unesi_ili_plati']))
  {
    $br_stola = (int)$_POST['select_stolovi'];

    if(strcmp($_POST['unesi_ili_plati'] ,'PLATI') !== 0) //nije PLATI
    {
      if(preg_match('/^[1-9][0-9]*$/',$_POST['cijena']))
      {
        $jelo = $_POST['unesi_ili_plati'];
        $cijena = $_POST['cijena'];

      //$br_stola-1 jer su u nizu od 0
        $stol = new Stol($jelo,$cijena);
      //  array_push($_SESSION['stolovi'][$br_stola-1], $stol);
      $_SESSION['stolovi'][$br_stola-1][] = $stol;
      }

    }


//vec imamo broj stola
    else  //PLATI
    {
      foreach ($_SESSION['stolovi'][$br_stola-1] as $stol)
      {
        $_SESSION['zarada'] += $stol->getCijena();
      }


      $_SESSION['stolovi'][$br_stola-1] = array();

    }




  }

if(isset($_POST['kraj']))
{
  session_unset();
  session_destroy();
  header('Location: https://rp2.studenti.math.hr/~knivan/praktikum2/zadatak1.php');
}







 ?>



 <!DOCTYPE html>

 <HTML>
 <HEAD>
   <title> Ukupna zarada = <?php if(isset($_SESSION['zarada'])) echo  $_SESSION['zarada']?></title>
   <style media="screen">
     td {border: solid 1px; background-color: yellow;}
     th {background-color: yellow;}
   </style>
 </HEAD>

 <BODY>
   <h3> Ukupna zarada =
     <?php if(isset($_SESSION['zarada'])) echo $_SESSION['zarada']; ?>
   </h3>
   <hr>

   <p>
     <b>Ubacio sam kraj da se restarta SESSION za laksu provjeru.</b>
   </p>
   <hr/>

   <table>
     <tr>
       <?php
        if(isset($_SESSION['br_stolova']))
                for($i = 0; $i < $_SESSION['br_stolova']; $i++)
                {
                  $brs = $i+1;
                  echo "<th>";
                  echo "Stol ".$brs;
                  echo "</th>";

                }
        ?>
     </tr>




     <tr>

       <?php


       if(isset($_SESSION['stolovi']))
       for($i = 0; $i < $_SESSION['br_stolova']; $i++ )
       {
         echo "<td>";

         foreach ($_SESSION['stolovi'][$i] as $stol)
         {
           echo $stol->getJelo()." ..... ".$stol->getCijena()."<br>";
         }


         echo "</td>";
       }


        ?>

     </tr>


   </table>


 <br><br><hr> <br><br>

   <form action="zadatak1_res.php" method="POST">
     Odaberi stol:
     <select  name="select_stolovi">

       <?php

        for($i = 0; $i < $_SESSION['br_stolova']; $i++ )
        {
          $brs1 = $i+1; //promijeniti u ovo ako stignem
          echo '<option value = "'.$brs1.'">'.$brs1.'</option>';

        }


        ?>




     </select>



     Unesi jelo (ili PLATI):
     <input type="text" name="unesi_ili_plati" >

     <br><br>

     Unesi cijenu jela:
     <input type="text" name="cijena" >

     <br><br>

     <input type="submit" name="izvrsi" value="Izvrsi">
      <input type="submit" name="kraj" value="Kraj">







     <br>



 </form>

 </BODY>
 </HTML>
