<!DOCTYPE html>
<html>
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Fantasy App</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

	<style media="screen">
	td { border: solid 2px; background-color: yellow;}
	tr {background-color: yellow;}
	</style>

</head>
<body>
	<h1><?php echo $title; ?></h1>

	<nav>
		<ul id="links">
			<!-- <li><a href="index.php?rt=users">All users</a></li> -->
			<li><a id=login href="index.php?rt=users/login">Login</a></li>
			<li><a id="register" href="index.php?rt=users/register">Register</a></li>
			<li><a id="confirm" href="index.php?rt=users/confirm">Confirm your registration</a></li>

		</ul>
	</nav>


<script type="text/javascript">
//
// $("body").css('background-color', '#FF7F50')
// 				 .css('font-family', 'Arial')
// 				 .css('text-align', 'justify');
//
// $("nav").css('background-color', 'gold')
// 				 .css('border-bottom', 'solid 3px #ccc')
// 				 .css('border-top', 'solid 3px #ccc')
// 				 .css('text-transfrom', 'uppercase')
// 				 .css('letter-spacing', '1px')
// 				 .css('font-weight', '600');
//
//
// $("ul").css('list-style', 'none')
// 			 .css('margin', '0')
// 			 .css("padding", '0')
// 			 .css('display', 'box')
// 			 .css("overflow", "hidden")
// 			 .css("border" , "1px solid #e7e7e7");
//
// $("li").css("float", "left").width("33.3333%");
//
// $("li a").css("display", "block")
// 				 .css("text-align", "center")
//          .css("padding", "16px");
//
// $("#login").css('text-decoration', 'none')
// 				  // .css('display', 'block')
// 					.css('padding', '0.9')
// 					.mouseenter(function(){
// 						$("#login").css('background-color', 'red');
// 					})
// 					.mouseleave(function(){
// 						$("#login").css('background-color', 'gold');
// 					});
//
// $("#register").css('text-decoration', 'none')
// // .css('display', 'block')
// 							.css('padding', '1.1')
// 							.mouseenter(function(){
// 							$("#register").css('background-color', 'red');
// 							})
// 							.mouseleave(function(){
// 							$("#register").css('background-color', 'gold');
// 										});
//
// $("#confirm").css('text-decoration', 'none')
// 				// .css('display', 'block')
// 				.css('padding', '0.9')
// 				.mouseenter(function(){
// 					$("#confirm").css('background-color', 'red');
// 			})
// 			.mouseleave(function(){
// 				$("#confirm").css('background-color', 'gold');
// 						});
//
// $(".container").css("padding", "16px");



// $("body").css('background-color', '#FF7F50')
// .css('font-family', 'Arial')
// .css('text-align', 'justify');
//
// $("h1").css("text-align", "hidden")
//
// $("nav").css('background-color', 'gold')
// .css('border-bottom', 'solid 3px #ccc')
// .css('border-top', 'solid 3px #ccc')
// .css('text-transfrom', 'uppercase')
// .css('letter-spacing', '1px')
// .css('font-weight', '600');
//
// $("ul").css('list-style', 'none')
// .css('margin', '0')
//              .css("padding", '0')
// .css('display', 'box')
//              .css("overflow", "hidden")
//              .css("border" , "1px solid #e7e7e7");
//
// $("li").css("float", "left").width("33.3333%");
//
//
//
// $("li a").css("display", "block")
// .css("text-align", "center")
//          .css("padding", "16px");
//
// $("#login").css('text-decoration', 'none')
// .mouseenter(function(){
// $("#login").css('background-color', 'red').css("opacity", "0.4");
//
// })
// .mouseleave(function(){
// $("#login").css('background-color', 'gold').css("opacity", "1");
// });
//
// $("#register").css('text-decoration', 'none')
// .mouseenter(function(){
// $("#register").css('background-color', 'red').css("opacity", "0.4");
// })
// .mouseleave(function(){
// $("#register").css('background-color', 'gold').css("opacity", "1");
// });
//
// $("#confirm").css('text-decoration', 'none')
// .mouseenter(function(){
// $("#confirm").css('background-color', 'red').css("opacity", "0.4");
// })
// .mouseleave(function(){
// $("#confirm").css('background-color', 'gold').css("opacity", "1");
// });


</script>




<script type="text/javascript">

$("body").css("background-color", "orange")
.css('font-family', 'Arial')
.css('text-align', 'justify');

$("h1").css("text-align", "hidden");

$("nav").css('background-color', 'gold')
.css('border-bottom', 'solid 3px #ccc')
.css('border-top', 'solid 3px #ccc')
.css('text-transfrom', 'uppercase')
.css('letter-spacing', '1px')
.css('font-weight', '600');

$("ul").css('list-style', 'none')
			.css('margin', '0')
      .css("padding", '0')
			.css('display', 'box')
      .css("overflow", "hidden")
      .css("border" , "1px solid #e7e7e7");

$("li").css("float", "left").width("33.3333%");



$("li a").css("display", "block")
.css("text-align", "center")
         .css("padding", "16px");

$("#login").css('text-decoration', 'none')
.mouseenter(function(){
$("#login").css('background-color', 'red').css("opacity", "0.4");

})
.mouseleave(function(){
$("#login").css('background-color', 'gold').css("opacity", "1");
});

$("#register").css('text-decoration', 'none')
.mouseenter(function(){
$("#register").css('background-color', 'red').css("opacity", "0.4");
})
.mouseleave(function(){
$("#register").css('background-color', 'gold').css("opacity", "1");
});

$("#confirm").css('text-decoration', 'none')
.mouseenter(function(){
$("#confirm").css('background-color', 'red').css("opacity", "0.4");
})
.mouseleave(function(){
$("#confirm").css('background-color', 'gold').css("opacity", "1");
});


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
