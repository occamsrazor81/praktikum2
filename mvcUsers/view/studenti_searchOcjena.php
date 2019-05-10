<?php require_once __DIR__.'/_header.php'; ?>

<form  action="index.php?rt=studenti/searchOcjenaResults" method="post">
  Pretraga po ocjeni: <input type="text" name="ocjena" />
  <input type="submit"  value="Traži" />

</form>


<?php require_once __DIR__.'/_footer.php'; ?>
