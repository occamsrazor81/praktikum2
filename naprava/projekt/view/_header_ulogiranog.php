<?php //session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>FantasyApp</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>


</head>

<body>
	<h1><?php echo $title; ?></h1>
	<form method="post" action="index.php?rt=users/login" class="logout">
<div id="ulogirani">
	<span id="nick">
		<?php
	if(isset($_SESSION['name'])) echo $_SESSION['name'];
	// else {
	// 	$_SESSION['username'] = $userList[0]->username;
	// 	$_SESSION['id_user'] = $userList[0]->id;
	// 	echo $_SESSION['username'].$_SESSION['id_user'];
	//  }


	?> </span>
		<button type="submit" name="logout" id="out">Logout</button>
</div>
	</form>



<br>
	<nav>
		<ul>
			<li><a href="index.php?rt=leagues" class="link">All Leagues</a></li>
			<li><a href="index.php?rt=leagues/myLeagues" class="link">My Leagues</a></li>
      <li><a href="index.php?rt=leagues/createNew" class="link">Start new League</a></li>
			<li><a href="index.php?rt=leagues/pendingApplications" class="link">League Applications</a></li>
			<li><a href="index.php?rt=leagues/pendingInvitations" class="link">League Invitations</a></li>
		</ul>
	</nav>





	<script type="text/javascript">

	$("body").css('background-color', 'orange')
	.css('font-family', 'Arial')
	.css('text-align', 'justify');

	$("h1").css("text-align", "hidden");

	$("nav").css('background-color', 'gold')
	.css('border-bottom', 'solid 3px #ccc')
	.css('border-top', 'solid 3px #ccc')
	.css('text-transfrom', 'uppercase')
	.css('letter-spacing', '1px')
	.css('font-weight', '600')
	.css("position", "relative");

	$("ul").css('list-style', 'none')
					.css('margin', '0')
	         .css("padding", '0')
					 	.css('display', 'box')
	             .css("overflow", "hidden")
	             .css("border" , "1px solid #e7e7e7");

	$("li").css("float", "left").width("20%");



	$("li a").css("display", "block")
					 .css("text-align", "center")
	         .css("padding", "16px");

	$(".link").css('text-decoration', 'none')
		.mouseenter(function(){
			$(this).css('background-color', 'red').css("opacity", "0.4");

	})
	.mouseleave(function(){
	$(this).css('background-color', 'gold').css("opacity", "1");
	});



	$(".logout").css('border', 'none');

	$(".inp").css('width', '100%')
	.css('padding', '12px 20px')
	.css('margin', '8px 0')
	.css('display', 'inline-block')
	.css('border', '1px solid #ccc')
	.css('box-sizing', 'border-box');

	$("#out").css('background', '#4CAF50')
	.css('color', '#000')
	.css('padding', '14px 20px')
	.css('margin', '8px 0')
	.css('border', 'none')
	.css('cursor', 'pointer')
	.css('width', '10%')
	.css('position', 'relative')
	.mouseenter(function(){
	$(this).css('opacity', '0.7');
	})
	.mouseleave(function(){
	$(this).css('opacity', '1.0');
	});

	$(".container").css("padding", "16px");

	$("#nick").css("font-weight", "600")
						.css('font-family', 'Droid serif')
						.css('text-transform', 'capitalize')
						.css("letter-spacing", "1.1px")
						.css("position", "relative");

	$("#logout").width("5%");


	</script>
