
<?php //session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>FantasyApp</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

	<style media="screen">
	td { border: solid 2px; background-color: yellow;}
	tr {background-color: yellow;}
	</style>

</head>
<body>
	<h1><?php echo $title; ?></h1>

  <p>
    User: <span id="nick"><?php if(isset($_SESSION['name'])) echo $_SESSION['name']; ?></span> <br>
    League: <span id="ln"><?php if(isset($_SESSION['league_title']) )  echo $_SESSION['league_title']; ?></span><br>

  </p>

	<form method="post" action="index.php?rt=users/login">

		<button type="submit" name="logout" id="out">Logout</button>
	</form>

	<nav>
		<ul>
			<li><a class="link" href="index.php?rt=leagues/myLeagues">Return to MyLeagues</a></li>
			<li><a class="link" href="index.php?rt=teams/myTeam">My Team</a></li>
      <li><a class="link" href="index.php?rt=teams/myTeamStats">My Team Stats</a></li>
      <li><a class="link" href="index.php?rt=teams/changeTeamName">Change Team Name</a></li>
			<li><a class="link" href="index.php?rt=teams/addPlayer">Add player</a></li>
			<li><a class="link" href="index.php?rt=teams/proposeTrade">Propose Trade</a></li>
			<li><a class="link" href="index.php?rt=teams/tradeRequests">Trade Requests</a></li>
			<li><a class="link" href="index.php?rt=teams/pendingTrades">Pending Trades</a></li>
      <li><a class="link" href="index.php?rt=teams/determineWeeklyMatchUp">Determine Weekly Matchup</a></li>


		</ul>
	</nav>





	<script type="text/javascript">

	$(document).ready(function()
	{
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

	$("li").css("float", "left").width("33.33%");



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

	$("#ln").css("font-weight", "600")
						.css('font-family', 'Droid serif')
						.css('text-transform', 'capitalize')
						.css("letter-spacing", "1.1px")
						.css("position", "relative");

	});
	</script>
