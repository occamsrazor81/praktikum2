<!DOCTYPE html>

<HTML>
<HEAD>
  <title>vjezbe2->zadatak2</title>

</HEAD>

<BODY>
<?php



  // $broj = rand(97,122);
  // echo $broj."\n";
  // $str = chr($broj);
  // echo $str;
  //
  // $broj = rand(97,122);
  // echo $broj."\n";
  // $str .= chr($broj);
  // echo $str;
 $brStringova=10;
 $brSlova=5;
 $polje = [];

  for($i=0;$i<$brStringova;++$i)
  {
    $str='';
    for($j=0;$j<$brSlova;++$j)
    {
      $znak = chr(rand(ord('a'),ord('z')));
      $str .= $znak;

    }
    $polje[$i] = $str;

  }

  for($i=0;$i<$brStringova;++$i)
    echo $polje[$i]." ";

    echo "<br/><br/>";

//
// for($i=0;$i<$brStringova;++$i)
//   for($j=0;$j<$brStringova;++$j)
//   {
//     if(strcmp($polje[$i],$polje[$j]) < 0)
//     {
//       $tmp = $polje[$i];
//       $polje[$i] = $polje[$j];
//       $polje[$j] = $tmp;
//     }
//   }

function swap(&$polje,$l,$r)
{
  $tmp = $polje[$l];
  $polje[$l] = $polje[$r];
  $polje[$r] = $tmp;
}
function qSort(&$polje,$left,$right)
{
  $m = (int)($left + $right)/2;
  $l = $left;
  $r = $right;

  $pivot = $polje[$m];
  while($l <= $r)
  {
    while(strcmp($polje[$l], $pivot) < 0)
    ++$l;
    while(strcmp($polje[$r], $pivot) > 0)
    --$r;

    if($l <= $r)
    {
      // $tmp = $polje[$l];
      // $polje[$l] = $polje[$r];
      // $polje[$r] = $tmp;
      swap($polje,$l,$r);
      $l++;
      $r--;
    }
  }
  if($left < $r) qSort($polje,$left,$r);
  if($l < $right) qSort($polje,$l,$right);

}

  qSort($polje,0,$brStringova-1);
  for($i=0;$i<$brStringova;++$i)
    echo $polje[$i]." ";



 ?>


</BODY>
</HTML>
