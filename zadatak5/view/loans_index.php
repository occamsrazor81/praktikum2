<?php require_once __DIR__ . '/_header.php'; ?>

<table>
  <tr><th>Id User</th><th>Id Book</th><th>Lease end</th></tr>

  <?php
  foreach ($loanList as $loan)
  {
    echo "<tr>";
    echo "<td>".$loan->id_user."</td>";
    echo "<td>".$loan->id_book."</td>";
    echo "<td>".$loan->lease_end."</td>";
    echo "</tr>";
  }

   ?>


</table>


<?php require_once __DIR__ .'/_footer.php'; ?>
