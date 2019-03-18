<!-- <!DOCTYPE html>

<HTML>
<HEAD>
  <title>predavanja0</title>

</HEAD>

<BODY>

</BODY>
</HTML> -->

<pre>
  $_GET;
  <?php
  print_r($_GET);
  ?>
</pre>

<?php
  $prvi = (int)$_GET["broj1"];
  $drugi = (int)$_GET["broj2"];
  echo "Zbroj je: ";
  echo $prvi + $drugi;
 ?>
