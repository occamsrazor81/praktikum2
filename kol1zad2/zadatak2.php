<?php

// class Formula
// {
// 	protected $id, $utrka, $trenutak, $vozac;
// 	function __construct( $id, $utrka, $trenutak, $vozac )
// 	{
// 		$this->id = $id;
// 		$this->utrka = $utrka;
// 		$this->trenutak = $trenutak;
//     $this->vozac = $vozac;
// 	}
// 	function __get( $prop ) { return $this->$prop; }
// 	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
// }

//---------------------------
session_start();

$user = 'student';
$pass = 'pass.mysql';

try
{
  $db = new PDO('mysql:host=rp2.studenti.math.hr;dbname=kolokvij;charset=utf8',$user,$pass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);


} catch (PDOException $e) { echo "Greska".$e->getMessage(); exit(); }

if(!isset($_SESSION['utrke']) || !isset($_SESSION['sve']))
{
  try
  {
    $st = $db->prepare('SELECT id,utrka,trenutak,vozac from formula order by trenutak');
    $st->execute();
  }
  catch (PDOException $e) { echo "Greska".$e->getMessage(); exit(); }

  $arr = array();
  $utrke = array();

  while($row = $st->fetch())
  {

    $arr[] = new Formula($row['id'], $row['utrka'], $row['trenutak'], $row['vozac']);
    array_push($utrke,$row['utrka']);
    $utrke = array_unique($utrke);
  }
  $_SESSION['utrke'] = $utrke;
//  $_SESSION['sve'] = $arr;
}





 ?>
 <!DOCTYPE html>

 <HTML>
 <HEAD>
   <title>z2</title>
 </HEAD>

 <BODY>
   <h3>Formula 1</h3>
   <hr/>

<form action= "zadatak2_res.php" method="POST">
Odaberi utrku koja te zanima i vozace u toj utrci: <br>
  <?php
  // <input type="radio" name="radio" value="" >
  foreach($_SESSION['utrke'] as $utrka)
  {
    echo '<input type="radio" name="radio" value ="'.$utrka.'"/>'.$utrka;
    echo "<br/>";
  }



   ?>
<br>
   <input type="submit" name="odaberi" value="Odaberi utrku">


 </form>

 </BODY>
 </HTML>
