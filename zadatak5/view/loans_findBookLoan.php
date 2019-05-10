<?php require_once __DIR__.'/_header.php'; ?>

<form  action="index.php?rt=loans/findBookResults" method="post">

  Nađi knjigu po id: <input type="text" name="id_book" />
  <input type="submit" value="Traži" />

</form>

<?php require_once __DIR__.'/_footer.php'; ?>
