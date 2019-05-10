<!DOCTYPE html>

<HTML>
<HEAD>
  <title>vjezbe2->zadatak4</title>

</HEAD>

<BODY>
<?php





class Vozilo
{
  private $name;
  private $dir;
  private $x;
  private $y;
  private $kilometri;

  function __construct($ime)
  {
    $this->name = $ime;
    $this->dir = 'N';
    $this->x = rand(0,100);
    $this->y = rand(0,100);
    $this->kilometri = 0;
  }

  function getIme() { return $this->name; }
  function getX() { return $this->x; }
  function getY() { return $this->y; }
  function getDir() { return $this->dir; }

  function setIme($ime) { $this->name = $ime; }
  function setX($x) { $this->x = $x; }
  function setY($y) { $this->y = $y; }
  function setDir($dir) { $this->dir = $dir; }

  function setKilometri($km) { $this->kilometri = $km; }
  function getKilometri() { return $this->kilometri; }


  function gdjeSam()
  {
    echo "Ime vozila = ".$this->getIme()."<br/>";
    echo "Koordinate vozila = (".$this->getX().",".$this->getY().")<br/>";

  }

  function idiRavno($km)
  {
    if(strcmp($this->getDir(),'N') === 0) { $this->setY($this->getY() + $km); }
    elseif(strcmp($this->getDir(),'S') === 0) { $this->setY($this->getY() - $km); }
    elseif(strcmp($this->getDir(),'W') === 0) { $this->setX($this->getX() - $km); }
    else { $this->setX($this->getX() + $km); }

    $this->setKilometri($this->getKilometri() + $km);
  }

  function skreniLijevo()
  {
    if(strcmp($this->getDir(),'N') === 0) { $this->setDir('W'); }
    elseif(strcmp($this->getDir(),'S') === 0) { $this->setDir('E'); }
    elseif(strcmp($this->getDir(),'W') === 0) { $this->setDir('S'); }
    else { $this->setDir('N'); }
  }

  function skreniDesno()
  {
    if(strcmp($this->getDir(),'N') === 0) { $this->setDir('E'); }
    elseif(strcmp($this->getDir(),'S') === 0) { $this->setDir('W'); }
    elseif(strcmp($this->getDir(),'W') === 0) { $this->setDir('N'); }
    else { $this->setDir('S'); }
  }

  //abstract protected function potrosenBenzin();
  //abstract protected function linija();

}

class Auto extends Vozilo
{
  function __construct($ime)
  {
    parent::__construct($ime);
    $this->kilometri = 0;
  }

  function potrosenBenzin() { return $this->getKilometri()/10; }

  function linija() { echo "Auto nema liniju.<br/>"; }


}

class Tramvaj extends Vozilo
{
  private $brLinije;

  function __construct($ime,$br)
  {
    parent::__construct($ime);
    $this->brLinije = $br;
  }

  function getLinija() { return $this->brLinije; }
  function setLinija($br) { $this->brLinije = $br; }


  function potrosenBenzin() { echo "Tramvaj ide na struju. <br/>"; }
  function linija() { return $this->getLinija(); }

}

$vozila = array();
$i = 0;

$auto = new Auto("Ferrari");
$auto->gdjeSam();
$auto->idiRavno(10);
$auto->gdjeSam();
$auto->skreniDesno();
$auto->idiRavno(20);
$auto->gdjeSam();
echo "Potrosen benzin = ".$auto->potrosenBenzin();
echo  " za vozilo s imenom ".$auto->getIme().".<br/>";
$auto->linija();
$vozila[$i] = $auto;
$i++;

echo "<hr/>";

$tramvaj = new Tramvaj("Dvanaestica",12);
$tramvaj->gdjeSam();
$tramvaj->skreniLijevo();
$tramvaj->idiRavno(25);
$tramvaj->gdjeSam();
echo "Linija = ".$tramvaj->linija();
echo " za vozilo s imenom ".$tramvaj->getIme().".<br/>";
$tramvaj->potrosenBenzin();
$vozila[$i] = $tramvaj;
$i++;

echo "<hr/><hr/>";


for($i = 2; $i < 10; $i++)
{
  $j = rand(1,3);
  if($j == 1) $vozilo = new Vozilo("Vozilo".$i);
  elseif($j ==2) $vozilo = new Auto("Auto".$i);
  else $vozilo = new Tramvaj("Tramvaj".$i,rand(1,19));
  $vozila[$i] = $vozilo;
}

for($i = 0; $i < count($vozila); $i++)
{
  $vozila[$i]->gdjeSam();
  $r = rand(1,3);
  echo "<hr/>Random skretanje = ".$r."<br/>";
  echo "Lijevo = 1<br/>Desno = 2<br/>Dvaput desno = 3<br/>";
  if($r == 1)
  {
    $km = rand(10,30);
    $vozila[$i]->skreniLijevo();
    $vozila[$i]->idiRavno($km);
    echo "Random prijedeno kilometara = ".$km."<br/>";
  }
  elseif($r == 2)
  {
    $km = rand(10,30);
    $vozila[$i]->skreniDesno();
    $vozila[$i]->idiRavno($km);
    echo "Random prijedeno kilometara = ".$km."<br/>";
  }

  else
  {
    $km = rand(10,30);
    $vozila[$i]->skreniDesno();
    $vozila[$i]->skreniDesno();
    $vozila[$i]->idiRavno($km);
    echo "Random prijedeno kilometara = ".$km."<br/>";
  }
  echo "<hr/>";

  $vozila[$i]->gdjeSam();

  if($vozila[$i] instanceof Tramvaj)
    echo "Tramvaj broj:".$vozila[$i]->linija()."<br/>";
  elseif($vozila[$i] instanceof Auto)
    echo "Auto je potrosio ".$vozila[$i]->potrosenBenzin()." litara benzina<br/>";


  echo "<hr/>";
}


 ?>


</BODY>
</HTML>
