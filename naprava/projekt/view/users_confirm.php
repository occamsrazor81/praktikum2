
<?php require_once __DIR__.'/_header.php'; ?>


<form method="post" action="index.php?rt=users/confirmCode">

  Username: <input type="text" name="username">
  <br>

  Code here: <input type="text" name="confirmation" />
  <br>

	<button type="submit">Confirm</button>
</form>

<?php require_once __DIR__.'/_footer.php'; ?>
