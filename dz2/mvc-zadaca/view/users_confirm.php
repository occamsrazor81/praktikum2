<?php //session_start(); ?>
<?php require_once __DIR__.'/_header.php'; ?>

<?php //if(isset($_POST['logout'])) { session_unset(); session_destroy();} ?>

<form method="post" action="index.php?rt=users/confirmCode">

  Username: <input type="text" name="username">
  <br>

  Code here: <input type="text" name="confirmation" />
  <br>

	<button type="submit">Confirm</button>
</form>

<?php require_once __DIR__.'/_footer.php'; ?>
