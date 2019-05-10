<?php require_once __DIR__. '/_header.php'; ?>

<form action="index.php?rt=books/searchResults" method="POST">
  Unesi ime autora:
  <input type="text" name="author" />
  <input type="submit" value="Pretraži"/>
</form>



<?php require_once __DIR__. '/_footer.php'; ?>
