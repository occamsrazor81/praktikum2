<?php


$user = 'student';
$pass = 'pass.mysql';


try {
  $db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=basic;charset=utf8',$user,$pass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);


} catch (PDOException $e) {
  echo "Greska".$e->getMessage();
  exit();

}

try
{
  $st = $db->prepare('SELECT igrac1,igrac2,koef1,koef2 from kladionica');
  $st->execute();

}
catch (PDOException $e) {echo "Greska".$e->getMessage(); exit();}
//
// $arr = array();
// while($row = $st->fetch())
// {
//   $arr[$row['igrac1']] = $row['koef1'];
//   $arr[$row['igrac2']] = $row['koef2'];
// }
//
//
// print_r($arr);
//






if(isset ($_POST['novac']) && preg_match('/^[1-9][0-9]*$/',$_POST['novac']))
{
    if(isset($_POST['radio1']))
       $par1 = (float)$_POST['radio1'];
    else $par1 = 1;

    if(isset($_POST['radio2']))
       $par2 = (float)$_POST['radio2'];
    else $par2 = 1;

    if(isset($_POST['radio3']))
       $par3 = (float)$_POST['radio3'];
    else $par3 = 1;

    if(isset($_POST['radio4']))
       $par4 = (float)$_POST['radio4'];
    else $par4 = 1;

    //echo $par1."<br>";

    $ulog = $_POST['novac'];
    $uk = $par1*$par2*$par3*$par4 *$ulog ;
    //echo $uk."<br>";

}




?>



<!DOCTYPE html>
<html>
<head>
<title>Tenis</title>
<style>
td { border:solid 2px; background-color:yellow;}
th {background-color : yellow;}
</style>
</head>
<body>



<form action= <?php echo $_SERVER['PHP_SELF']; ?>  method = "post">
<table>
<tr><th>Prvi</th><th>Drugi</th></tr>

<?php
$i = 1;
foreach ($st->fetchAll() as $row) {
  echo "<tr>";

  echo "<td>";
  echo '<input type = "radio" name="radio'.$i.'" value="'. $row['koef1'].'"/>';
  echo "(".$row['koef1'].") ".$row['igrac1'];
  echo "</td>";
  echo "<td>";
  echo $row['igrac2']."(".$row['koef2'].")";
  echo '<input type = "radio" name="radio'.$i.'" value="'. $row['koef2'].'"/>';
  echo "</td>";
  echo "</tr>";
  $i++;
     }
$i = 1;

 ?>


</table>
<br><br>
Ulozen iznos: <input type="text" name="novac">
<input type="submit" value = "Izracunaj">




</form>

<br>
<?php
if(isset($uk))
{
  echo "Moguci dobitak = ".$uk."<br/>";
  unset($uk);
}
 ?>

</body>
</html>
