<?php

//fetch radi samo jednom, ako zelimo ponovno
//proci elemente spremimo kod prvog fetcha u polje

if(isset($_POST['ocjena'])){
  crtaj_html_header();
  crtajPopis();
  crtaj_html_footer();
}
else
{
  crtaj_html_header();
  crtajFormu();
  crtaj_html_footer();

}


////////////////////////////////////

  function crtajPopis()
  {
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

    foreach ($st->fetchAll() as $row) {
      echo " JMBAG = ".$row['JMBAG'].",".
           " Ime = ".$row['Ime'].",".
           " Prezime = ".$row['Prezime']."<br />\n";
         }





  }

  function crtaj_html_header()
  {
    ?>


      <!DOCTYPE html>

      <HTML>
      <HEAD>
        <title>mysql</title>

      </HEAD>

      <BODY>
    <?php
  }


  function crtajFormu()
  {
    ?>




        <form action = "sql.php" method = "POST">
        Unesi ocjenu: <input type="text" name="ocjena"/>
          <br/><br/>
          <input type="submit" value="Posalji" />


        </form>

      <?php
  }


  function crtaj_html_footer()
  {
    ?>




  </BODY>
  </HTML>
  <?php
  }
?>
