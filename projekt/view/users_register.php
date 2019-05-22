
<?php require_once __DIR__.'/_header.php'; ?>


<?php if(isset($message)) echo $message.'<br>'; ?>

<form method="post" action="index.php?rt=users/registerResults">

  Email: <input type="text" name="email" />
  <br>
	Username: <input type="text" name="username" />
	<br>
	Password: <input type="password" name="password" />
	<br>
  Confirm Password: <input type="password" name="password_confirm" />
	<br>
  Bank Account: <input type="text" name="bank_account" />
	<br>

	<button type="submit">Register</button>
</form>

<?php require_once __DIR__.'/_footer.php'; ?>
