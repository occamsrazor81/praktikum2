<?php

include  __DIR__.'/db.class.php';

$user = 'student';
$pass = 'pass.mysql';

//
// try {
//   $db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=knezic;charset=utf8',$user,$pass);
//   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
//
//
// } catch (PDOException $e) {
//   echo "Greska".$e->getMessage();
//   exit();
//
// }


//unos
if(isset($_POST['submit']) && isset($_POST['radio']) && $_POST['radio'] = 'ubaci')
if(isset($_POST['id_unos']) && isset($_POST['igrac1_unos']) && isset($_POST['igrac2_unos']) && isset($_POST['koef1_unos']) && isset($_POST['koef2_unos']))
try
{

  $db = DB::getConnection();
  $st = $db->prepare('INSERT into kladionica(id,igrac1,igrac2,koef1,koef2)
  values (:id,:igrac1,:igrac2,:koef1,:koef2)');
  $st->execute(array('id' => (int)$_POST['id_unos'], 'igrac1' => $_POST['igrac1_unos'],
              'igrac2' => $_POST['igrac2_unos'], 'koef1' => (float)$_POST['koef1_unos'],
                'koef2' => (float)$_POST['koef2_unos']));

}
catch (PDOException $e) {echo "Greska: ".$e->getMessage(); exit();}

//ispis
elseif(isset($_POST['submit']) && isset($_POST['radio']) && $_POST['radio'] = 'ispisi')
if(isset($_POST['id_ispis']) || isset($_POST['igrac1_ispis']) || isset($_POST['igrac2_ispis']) || isset($_POST['koef1_ispis']) || isset($_POST['koef2_ispis']))
if(isset($_POST['id_ispis']))
try
{
  $ispis = 1;
  echo $_POST['id_ispis'];

  $db = DB::getConnection();
  $st = $db->prepare('SELECT id,igrac1,igrac2,koef1,koef2 from kladionica where id=:id_ispis');
  // $st->execute(array('id' => (int)$_POST['id_ispis'], 'igrac1' => $_POST['igrac1_ispis'],
  //             'igrac2' => $_POST['igrac2_ispis'], 'koef1' => (float)$_POST['koef1_ispis'],
  //               'koef2' => (float)$_POST['koef2_ispis']));
  $st->execute(array('id_ispis'=>int($_POST['id_ispis'])));

}
catch (PDOException $e) {echo "Greska: ".$e->getMessage(); exit();}





 ?>


 <!DOCTYPE html>

 <html>
 <head>
   <title>kladionica</title>
   <style>
   td {  background-color:yellow;}
   th {background-color : yellow;}
   </style>
 </head>

 <body>
   <form  action = <?php echo $_SERVER['PHP_SELF']; ?> method="post">
     <table>
       <tr>
         <th>izaberi</th>
         <th>id</th>
         <th>igrac1</th>
         <th>igrac2</th>
         <th>koef1</th>
         <th>koef2</th>
       </tr>
    <tr>
    <td>
     <input type="radio" name="radio" value="ispisi">Ispis
   </td>
   <td>
      <input type="text" name="id_ispis"> <br/>
   </td>
   <td>
     <input type="text" name="igrac1_ispis"> <br/>
   </td>
   <td>
      <input type="text" name="igrac2_ispis"> <br/>
   </td>
   <td>
     <input type="text" name="koef1_ispis"> <br/>
   </td>
   <td>
      <input type="text" name="koef2_ispis"> <br/>
   </td>
   </tr>

   <tr>
   <td>
    <input type="radio" name="radio" value="ubaci">Unos
  </td>
  <td>
     <input type="text" name="id_unos"> <br/>
  </td>
  <td>
    <input type="text" name="igrac1_unos"> <br/>
  </td>
  <td>
     <input type="text" name="igrac2_unos"> <br/>
  </td>
  <td>
    <input type="text" name="koef1_unos"> <br/>
  </td>
  <td>
     <input type="text" name="koef2_unos"> <br/>
  </td>
  </tr>

  <tr>
  <td>
   <input type="radio" name="radio" value="izbaci">Izbaci
 </td>
 <td>
    <input type="text" name="id_izbaci"> <br/>
 </td>
 <td>
   <input type="text" name="igrac1_izbaci"> <br/>
 </td>
 <td>
    <input type="text" name="igrac2_izbaci"> <br/>
 </td>
 <td>
   <input type="text" name="koef1_izbaci"> <br/>
 </td>
 <td>
    <input type="text" name="koef2_izbaci"> <br/>
 </td>
 </tr>

 <tr>
 <td>
  <input type="radio" name="radio" value="promijeni">Promijeni
</td>
<td>
   <input type="text" name="id_promijeni"> <br/>
</td>
<td>
  <input type="text" name="igrac1_promijeni"> <br/>
</td>
<td>
   <input type="text" name="igrac2_promijeni"> <br/>
</td>
<td>
  <input type="text" name="koef1_promijeni"> <br/>
</td>
<td>
   <input type="text" name="koef2_promijeni"> <br/>
</td>
</tr>



   </table>

<br>
<hr>


   <input class = "bojaj" type="submit" name="submit" value="Provedi">

   </form>



   <br>
   <hr>

<table>
  <tr>
    <th>id</th>
    <th>igrac1</th>
    <th>igrac2</th>
    <th>koef1</th>
    <th>koef2</th>
  </tr>

  <?php
  if(isset($ispis) && $ispis == 1)
  foreach ($st->fetchAll() as $row) {
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['igrac1']."</td>";
    echo "<td>".$row['igrac2']."</td>";
    echo "<td>".$row['koef1']."</td>";
    echo "<td>".$row['koef2']."</td>";
    echo "</tr>";
  }


   ?>
</table>


 </body>
 </html>
