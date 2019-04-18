<?php require_once __DIR__.'/_header.php'; ?>

<table>
  <tr><th>JMBAG</th><th>Ime</th><th>Prezime</th><th>Ocjena</th></tr>

  <?php
  foreach ($studentList as $student)
  {
    echo "<tr>";
    echo "<td>".$student->jmbag."</td>";
    echo "<td>".$student->ime."</td>";
    echo "<td>".$student->prezime."</td>";
    echo "<td>".$student->ocjena."</td>";
    echo "</tr>";
  }
  ?>

</table>


<?php require_once __DIR__.'/_footer.php'; ?>
