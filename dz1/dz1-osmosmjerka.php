<?php

    session_start();

    // echo "<pre>";
    // print_r($_SESSION);
    // echo "<br>";
    // print_r($_POST);
    // echo "</pre>";

    inicijaliziraj();
    //ispisIgraca();
    odigrajPotez();
    if(count($_SESSION['nadene_rijeci']) === count($_SESSION['sve_rijeci']))
    //if(usporedi() == 1)
      $_SESSION['gameOver'] = 1;



     if(!$_SESSION['gameOver'])
      crtajPlocu();

    else
      crtajCestitku();









    //---------------------------

    function inicijaliziraj()
    {
      if(isset($_POST['ime']))
      {
        if(!preg_match('/^[a-zA-Z]{1,20}$/',$_POST['ime'] ))
          {
            header('Location: https://rp2.studenti.math.hr/~knivan/praktikum2/dz1/dz1-login.php');
            break;
          }
        else
        $_SESSION['ime'] = $_POST['ime'];
      }


      $_SESSION['gameOver'] = 0;
      if(!isset($_SESSION['br']))
      {
        $_SESSION['br'] = -1;
        // $_SESSION['ploca'] =
        // [
        //   [' ',' ',' ',' ',' '],
        //   [' ',' ',' ',' ',' '],
        //   [' ',' ',' ',' ',' '],
        //   [' ',' ',' ',' ',' '],
        //   [' ',' ',' ',' ',' '],
        //
        // ];

        $_SESSION['osmosmjerka'] =
        [
          ['P','A','T','K','A'],
          ['E','I','S','O','N'],
          ['V','P','S','L','I'],
          ['A','A','V','M','A'],
          ['S','L','O','V','O'],

        ];

        $_SESSION['nadene_rijeci'] = array();
        $_SESSION['sve_rijeci'] = ['PATKA','PISMO','SAVE','NOSI','OSA','SLOVO'];


      }


    }


    // function ispisIgraca()
    // {
    //   if(!$_SESSION['ime'])
    //   {
    //     $ime = $_POST['ime'];
    //     $_SESSION['ime'] = $ime;
    //     echo "Igrač : ".$ime."<br/>";
    //   }
    //   else
    //     echo "Igrač : ".$_SESSION['ime']."<br/>";
    // }


    function odigrajPotez()
    {
      // echo "<pre>";
      // print_r($_SESSION);
      // echo "<br>";
      // print_r($_POST);
      // echo "</pre>";

      $_SESSION['br']++;

      if(isset($_POST['word']))
      {
        $rijec = $_POST['word'];
        $slova = str_split($rijec);
        //print_r($slova);





        foreach ($_SESSION['sve_rijeci'] as $key)
        {
          //provjeravamo ima li te rijeci

          echo $key. " ";

          if(strcmp($rijec,$key) == 0) //ako je ima gledamo poziciju
          {

            $red = $_POST['red'];
            $stup = $_POST['stup'];
            // echo $red;
            // echo $stup;
            //echo $slova[0];
            echo $_SESSION['osmosmjerka'][$red-1][$stup-1]."\n";



            if( $slova[0] == $_SESSION['osmosmjerka'][$red - 1][$stup - 1])
            {
              array_push($_SESSION['nadene_rijeci'],$rijec);
              $_SESSION['zadnja_rijec'] = $rijec;
              echo "Nadena rijec ".$slova[0];
              break;
              //provjera postoji li u jednom smjeru ta rijec


            }

          //   else
          //   {
          //     $poruka = "Što ima dva oka, a ne vidi?";
          //     break;
          //   }
          //
          //
          //
          //
          //
          //
          //
          //
          //   // array_push($_SESSION['nadene_rijeci'],$rijec);
          //   // $_SESSION['zadnja_rijec'] = $rijec;
          // }
          //
          // else
          // {
          //   //$poruka = "Što ima dva oka, a ne vidi?";
          //   $poruka = "Što ima dva oka, a ne vidi?";
          //   break;
          // }
        }


        }
      }

    }




    function usporedi()
    {
      foreach ($_SESSION['nadene_rijeci'] as $key1)
       {
        $provjera = 0;
        foreach ($_SESSION['sve_rijeci'] as $key2 )
        {
          if($key1 == $key2)
          $provjera = 1;

        }
        if($provjera == 0)
          return 0;

      }

      return 1;
    }







    function crtajPlocu()
    {

      ?>



       <!DOCTYPE html>

       <HTML lang = "hr">
       <HEAD>
         <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
         <style>
            table {border: solid 2px;}
            tr,td {border: solid 0.5px; text-align: center;}
            #patka {background-color: green; text-decoration-line: line-through;}
         </style>
         <title>Osmosmjerka</title>
       </HEAD>

       <BODY>
         <h2>Osmosmjerka!</h2>
         <hr/>

         <?php echo "Igrač : ".$_SESSION['ime']."<br/>"; ?>
         <?php echo "Broj pokušaja : ".$_SESSION['br']."<br/>"; ?>

        <br/><br/>

        <table height="200" width="200">
          <?php
            for($i = 0; $i < 5; $i++)
            {
              echo "<tr>";
              for($j = 0; $j < 5; $j++)
              {
                echo "<td>";
                echo $_SESSION['osmosmjerka'][$i][$j];
                echo "</td>";
              }
              echo "</tr>";
            }



          ?>
        </table>

        <p>Pronađi riječ s popisa:
          <span id='patka'>PATKA</span>
          <span id='pismo'>PISMO</span>
          <span id='save' >SAVE</span>
          <span id='nosi'>NOSI</span>
          <span id='osa'>OSA</span>
          <span id='slovo'>SLOVO</span>
        </p>

        <br/>

        <form action="dz1-osmosmjerka.php" method="post">
          Našao sam riječ: <input type="text" name="word" />
          <br/><br/>
          Prvo slovo je u redu
          <select name="red">
            <option value="1" >1</option>
            <option value="2" >2</option>
            <option value="3" >3</option>
            <option value="4" >4</option>
            <option value="5" >5</option>
          </select>
          i u stupcu
          <select name="stup">
            <option value="1" >1</option>
            <option value="2" >2</option>
            <option value="3" >3</option>
            <option value="4" >4</option>
            <option value="5" >5</option>

          </select>

          <br/><br/>
          <input type="submit" name="oznaci" value="Označi riječ." />
          <br/>


        </form>

        <form action="dz1-login.php" method="post">
          <input type="submit" name="reset" value="Resetiraj.">
        </form>
        <br/>

      <?php
      // if($_SESSION['gameOver'] == 1)
      //   {
      //     echo "Čestitke, riješili ste.";
      //     session_unset();
      //     session_destroy();
      //   }

        ?>

       </BODY>
       </HTML>






      <?php

    }

    function crtajCestitku()
    {
      echo "<br/>";
      echo "Čestitke, riješili ste osmosmjerku.";
      session_unset();
      session_destroy();

      ?>

      <HTML lang = "hr">
      <HEAD>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
        <style>
           table {border: solid 2px;}
           tr,td {border: solid 0.5px; text-align: center;}
           #patka {background-color: green; text-decoration-line: line-through;}
        </style>
        <title>Osmosmjerka-Čestitka</title>
      </HEAD>

      <BODY>

      <form action="dz1-login.php" method="post">
        <input type="submit" name="reset" value="Resetiraj.">
      </form>
      <br/>

    </BODY>
    </HTML>



      <?php

    }






 ?>
