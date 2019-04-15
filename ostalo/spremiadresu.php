<html>
<head>
<title>Adresar</title>
</head>
<body>
<h2>Spremljena Adresa</h2>

<?php
  $ime = $_GET['ime'];
  $prezime = $_GET['prezime'];
  $adresa = $_GET['adresa'];
  $grad = $_GET['grad'];
  if(isset($_GET['spol']))
  {
    if($_GET['spol'] == 'muski') $spol = 'm';
    else $spol = 'z';
  }
  if(isset($_GET['prijatelj'])) $prijatelj = 'da';
  else $prijatelj = 'ne';

  echo "Ime:".$ime."<br/>";
  echo "Prezime:".$prezime."<br/>";
  echo "Adresa:".$adresa."<br/>";
  echo "Grad:".$grad."<br/>";
  echo "Spol:".$spol."<br/>";
  echo "Prijatelj:".$prijatelj."<br/>";



?>

</body>
</html>
