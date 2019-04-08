<?php

  print_r($_POST);
  echo "<br/>";
  echo "<br/>";
  if(isset($_POST['ocjena']))
  {
    $ocjena = (int)$_POST['ocjena'];





    try {
      $db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=knezic;charset=utf8',
      'student','pass.mysql');
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);




        } catch (PDOException $e) {
          echo "Greska:".$e->getMessage();
          exit();
        }

    try {

      $st = $db->prepare('SELECT JMBAG,Ime,Prezime FROM Studenti where Ocjena =:ocjena');
      $st->execute(array('ocjena'=>$_POST['ocjena']));





            } catch (PDOException $e) {
              echo "Greska:".$e->getMessage();
              exit();
            }




  //$st = $db->query('SELECT JMBAG,Ime,Prezime FROM Studenti');
  foreach ($st->fetchAll() as $row) {
    echo " JMBAG = ".$row['JMBAG'].
         " Ime = ".$row['Ime'].
         " Prezime = ".$row['Prezime']."<br />\n";
       }
       //fetch radi samo jednom, ako zelimo ponovno
       //proci elemente spremimo kod prvog fetcha u polje
     }

     echo "<br/>";
     echo "<br/>";
?>


  <!DOCTYPE html>

  <HTML>
  <HEAD>
    <title>mysql</title>

  </HEAD>

  <BODY>

    <form action = "sql_modificirano.php" method = "POST">
    Unesi ocjenu: <input type="text" name="ocjena"/>
      <br/><br/>
      <input type="submit" value="Posalji" />


    </form>
    <br/>





  </BODY>
  </HTML>
