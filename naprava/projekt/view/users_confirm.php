
<?php require_once __DIR__.'/_header.php'; ?>


<form method="post" action="index.php?rt=users/confirmCode">
<div class="container">
  <b>Username:</b> <input type="text" name="username" class="inp" placeholder="Enter Username">


  <b>Code:</b> <input type="text" name="confirmation" class="inp" placeholder="Enter confirmation code"/>


	<button type="submit">Confirm</button>
  </div>
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
