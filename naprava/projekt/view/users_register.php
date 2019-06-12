
<?php require_once __DIR__.'/_header.php'; ?>


<?php if(isset($message)) echo $message.'<br>'; ?>

<form method="post" action="index.php?rt=users/registerResults">
<div class="container">
<label for="email"><b> Email: </b></label>
  <input type="text" name="email" class="inp" placeholder="Enter e-mail"/>

	<label for="uname"><b> Username: </b></label>
    <input type="text" name="username" class="inp" placeholder="Enter Username"/>

	<label for="psw"><b> Password: </b></label>
    <input type="password" name="password" class="inp" placeholder="Enter Password"/>

  <label for="conpsw"><b> Confirm-Password: </b></label>
    <input type="password" name="password_confirm" class="inp" placeholder="Confirm your password"/>

  <label for="ba"><b> Bank-Account: </b></label>
    <input type="text" name="bank_account" class="inp" placeholder="Enter credit card number"/>

</div>
	<button type="submit">Register</button>
</form>


<script type="text/javascript">

$("form").css('border', '3px solid #e2e2e2');

$(".inp").css('width', '100%')
				 .css('padding', '12px 20px')
				 .css('margin', '8px 0')
				 .css('display', 'inline-block')
				 .css('border', '1px solid #ccc')
				 .css('box-sizing', 'border-box');

$("button").css('background', '#4CAF50')
					 .css('color', '#000')
					 .css('padding', '14px 20px')
					 .css('margin', '8px 0')
					 .css('border', 'none')
					 .css('cursor', 'pointer')
					 .css('width', '20%')
					 .css('position', 'relative')
					 .mouseenter(function(){
						 $("button").css('opacity', '0.7');
					 })
					 .mouseleave(function(){
						 $("button").css('opacity', '1.0');
					 });

$(".container").css("padding", "16px");

</script>

<?php require_once __DIR__.'/_footer.php'; ?>
