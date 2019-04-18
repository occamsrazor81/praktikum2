
<?php require_once __DIR__ .'/_header.php'; ?>

<form  action="index.php?rt=books/findAuthor" method="post">
  Unesi ime knjige čiji te autor zanima:
  <input type="text" name="title" />
  <input type="submit"  value="Traži" />

</form>


<?php require_once __DIR__ . '/_footer.php'; ?>
