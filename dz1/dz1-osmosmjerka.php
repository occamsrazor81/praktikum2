<?php

    session_start();




    inicijaliziraj();
    odigrajPotez();

    if(count($_SESSION['nadene_rijeci']) === count($_SESSION['sve_rijeci']))
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
            $_SESSION['poruka1'] = "Samo slova za ime korisnika, velika ili mala.\n";
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
        $_SESSION['bojaj'] = array();
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

      if(isset($_POST['word']) && preg_match('/^[A-Z]{1,5}$/',$_POST['word']))
      {

        $rijec = $_POST['word'];
        $slova = str_split($rijec);
        //print_r($slova);





        foreach ($_SESSION['sve_rijeci'] as $key)
        {
          //provjeravamo ima li te rijeci

          //echo $key. " ";

          if(strcmp($rijec,$key) == 0) //ako je ima gledamo poziciju
          {

            $red = (int)$_POST['red'];
            $stup = (int)$_POST['stup'];
            // echo $red;
            // echo $stup;
            //echo $slova[0];
          //  echo "<br/>".$_SESSION['osmosmjerka'][$red-1][$stup-1];



            if( $slova[0] == $_SESSION['osmosmjerka'][$red - 1][$stup - 1])
            {


              //print_r($_SESSION['nadene_rijeci']);
              //array_unique($_SESSION['nadene_rijeci']);
              $gore = 1;
              $dolje = 1;
              $lijevo = 1;
              $desno = 1;
              $dolje_desno = 1;
              $dolje_lijevo = 1;
              $gore_desno = 1;
              $gore_lijevo = 1;
              // $_SESSION['dir'] =  array(0,0,0,0,0,0,0,0);
              // print_r($_SESSION['dir']);
              //echo "\n\n";
              //echo count($slova)."\n";

              for($i = 1; $i < count($slova); ++$i)
              {

                  //gore
                if(!isset($_SESSION['osmosmjerka'][$red - 1 - $i][$stup - 1]))
                  $gore = 0;
                elseif($slova[$i] != $_SESSION['osmosmjerka'][$red - 1 - $i][$stup - 1])
                  $gore = 0;

                  //dolje
                if(!isset($_SESSION['osmosmjerka'][$red - 1 + $i][$stup - 1]))
                  $dolje = 0;
                elseif($slova[$i] != $_SESSION['osmosmjerka'][$red - 1 + $i][$stup - 1])
                  $dolje = 0;

                  //lijevo
                if(!isset($_SESSION['osmosmjerka'][$red - 1][$stup - 1 - $i]))
                  $lijevo = 0;
                elseif($slova[$i] != $_SESSION['osmosmjerka'][$red - 1][$stup - 1 - $i])
                  $lijevo = 0;

                  //desno
                if(!isset($_SESSION['osmosmjerka'][$red - 1][$stup - 1 + $i]))
                  $desno = 0;
                elseif($slova[$i] != $_SESSION['osmosmjerka'][$red - 1][$stup - 1 + $i])
                  $desno = 0;

                  //dolje desno
                if(!isset($_SESSION['osmosmjerka'][$red - 1 + $i][$stup - 1 + $i]))
                  $dolje_desno = 0;
                elseif($slova[$i] != $_SESSION['osmosmjerka'][$red - 1 + $i][$stup - 1 + $i])
                  $dolje_desno = 0;

                  //dolje lijevo
                if(!isset($_SESSION['osmosmjerka'][$red - 1 + $i][$stup - 1 - $i]))
                  $dolje_lijevo = 0;
                elseif($slova[$i] != $_SESSION['osmosmjerka'][$red - 1 + $i][$stup - 1 - $i])
                  $dolje_lijevo = 0;

                  //gore desno
                if(!isset($_SESSION['osmosmjerka'][$red - 1 - $i][$stup - 1 + $i]))
                  $gore_desno = 0;
                elseif($slova[$i] != $_SESSION['osmosmjerka'][$red - 1 - $i][$stup - 1 + $i])
                  $gore_desno = 0;

                  //gore lijevo
                if(!isset($_SESSION['osmosmjerka'][$red - 1 - $i][$stup - 1 - $i]))
                  $gore_lijevo = 0;
                elseif($slova[$i] != $_SESSION['osmosmjerka'][$red - 1 - $i][$stup - 1 - $i])
                  $gore_lijevo = 0;



              }
              if($gore || $dolje || $lijevo || $desno ||
                 $dolje_desno || $dolje_lijevo || $gore_desno || $gore_lijevo)
                 {
                   echo $gore." ".$dolje." ".$lijevo." ".$desno." ".$dolje_desno." ".$dolje_lijevo." ".$gore_desno." ".$gore_lijevo."\n";
                   $_SESSION['zadnja_rijec'] = $rijec;
                   $_SESSION['string'] = implode(",#",$_SESSION['nadene_rijeci']);
                   //echo "(".$_SESSION['string'].")<br>";

                   array_push($_SESSION['nadene_rijeci'],$rijec);
                   $_SESSION['nadene_rijeci'] = array_unique($_SESSION['nadene_rijeci']);

                   //echo "Nadena rijec ".$slova[0]."\n";

                   // if($gore) $_SESSION['dir'] = 1;
                   // elseif($dolje) $_SESSION['dir'] = 2;
                   // elseif($lijevo) $_SESSION['dir'] = 3;
                   // elseif($desno) $_SESSION['dir'] = 4;
                   // elseif($dolje_desno) $_SESSION['dir'] = 5;
                   // elseif($dolje_lijevo) $_SESSION['dir'] = 6;
                   // elseif($gore_desno) $_SESSION['dir'] = 7;
                   // elseif($gore_lijevo) $_SESSION['dir'] = 8;

                   $_SESSION['provjera'] = 0;

                   break;
                  }






            } // kraj if( $slova[0] == $_SESSION['osmosmjerka'][$red - 1][$stup - 1])

            else
            {
              $_SESSION['poruka3'] = "Što ima dva oka, a ne vidi ?";
              $_SESSION['provjera'] = 1;

            }



            } // kraj if(strcmp($rijec,$key) == 0)

          else
          {
            $_SESSION['poruka3'] = "Što ima dva oka, a ne vidi ?";
            $_SESSION['provjera'] = 1;

          }
        } // kraj foreach

      } // kraj if(isset($_POST['word']) && preg_match('/^[a-zA-Z]{1,5}$/',$_POST['word']))


      else
      {
        $_SESSION['poruka2'] = "Što ima dva oka, a ne vidi da su samo velika slova ?";


      }




    } //kraj fje






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
            <?php if(isset($_SESSION['string'])) echo "#".$_SESSION['string'];?>
            {background-color: yellow; text-decoration-line: line-through;}
            <?php if(isset($_SESSION['zadnja_rijec'])) echo "#".$_SESSION['zadnja_rijec'];?>
            {background-color: green; text-decoration-line: line-through;}
            <?php if(isset($_SESSION['bojaj_tablicu'])) echo "#".$_SESSION['bojaj_tablicu'];?>

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
                echo '<td id = "p'.$i.'_'.$j.'" >';
                echo $_SESSION['osmosmjerka'][$i][$j];
                echo '</td>';
              }
              echo "</tr>";
            }



          ?>
        </table>

        <p>Pronađi riječ s popisa:
          <span id='PATKA'>PATKA</span>
          <span id='PISMO'>PISMO</span>
          <span id='SAVE' >SAVE</span>
          <span id='NOSI'>NOSI</span>
          <span id='OSA'>OSA</span>
          <span id='SLOVO'>SLOVO</span>
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



        </form>

        <br/>
        <form action="dz1-login.php" method="post">
          <input type="submit" name="reset" value="Resetiraj.">
        </form>
        <br/>
        <br/>

        <?php
        if(isset($_SESSION['poruka2']))
        {
          echo $_SESSION['poruka2']."<br/>";
          unset($_SESSION['poruka2']);
        }

        elseif (isset($_SESSION['poruka3']) && isset($_SESSION['provjera'])
                && $_SESSION['provjera'] === 1)
        {
          echo $_SESSION['poruka3']."<br/>";
          unset($_SESSION['poruka3']);

        }

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
