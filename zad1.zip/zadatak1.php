<?php

session_start();

$_SESSION['zarada'] = 0;





 ?>
 <!DOCTYPE html>

 <HTML>
 <HEAD>
   <title>z1</title>
 </HEAD>

 <BODY>
   <h3>Forma za unos</h3>
   <hr/>

   <form action="zadatak1_res.php" method="POST">

     Unesi broj stolova u restoranu:
     <input type="text" name="br_stolova" />
     <input type="submit" name="submit" value="Posalji.">

 </form>

 </BODY>
 </HTML>
