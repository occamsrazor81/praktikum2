<!DOCTYPE html>

<HTML>
<HEAD>
  <title>vjezbe2->zadatak1</title>
  <style> table,tr,td {border: solid 2px;}</style>
</HEAD>

<BODY>
<table>


  <?php
    $n=10;
    echo '<tr><td>*</td>';
    for($i=1;$i<=10;++$i)
    echo '<td>'.$i.'</td>';
    echo '</tr>';
    for($i=1;$i<=$n;++$i)
      {
         echo '<tr>';
        echo '<td>'.$i.'</td>';
        for($j=1;$j<=10;++$j)
        {

          echo '<td>'.$j*$i;
          echo '</td>';
        }
        echo '</tr>';

      }


  ?>
</table>


</BODY>
</HTML>
