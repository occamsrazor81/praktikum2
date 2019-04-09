<?php
  session_start();




  if(isset($_POST['reset']))
  {
    session_unset();
    session_destroy();
  }
 ?>
 <!DOCTYPE html>

 <HTML lang = "hr">
 <HEAD>
   <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
   <title>Osmosmjerka-prijava</title>
 </HEAD>

 <BODY>
   <h2>Osmosmjerka!</h2>
   <form method="post" action="dz1-osmosmjerka.php">
     Unesi svoje ime: <input type="text" name="ime" />
     <br/><br/>
     <input type="submit" value="Započni igru !"/>



   </form>
<?php
  if(isset($_SESSION['poruka1']))
  echo $_SESSION['poruka1'];
 ?>



 </BODY>
 </HTML>
