<?php //session_start(); ?>
<?php require_once __DIR__.'/_header_ulogiranog.php'; ?>


<form  action="index.php?rt=leagues/acceptOrRejectApplicants" method="post">

<div id="idovi">
<?php
foreach( $leagueList as $league )
echo "<span>".$league['id']."</span>";
 ?>

</div>

<table>
	<tr><th>Admin</th><th class="title">Title</th><th>Type</th><th>Status</th><th>Applicants</th></tr>
	<?php
			if(isset($leagueList))
      foreach( $leagueList as $league )
      {

        echo '<tr>';

        echo '<td>'.$league['admin'].'</td>';
        // echo '<td>'.$league['title'].'</td>';
				echo '<td><button class="league" type="submit" name="league_id" value="'.
				$league['id'].'">'.$league['title'].'</button></td>';
        echo '<td>'.$league['league_type'].'</td>';
        echo '<td>'.$league['status'].'</td>';

        echo '<td><ul class="apps">';
        if( strcmp($_SESSION['name'], $league['admin']) === 0 &&
        ( strcmp($league['league_type'], 'private') === 0 ||
        strcmp($league['league_type'], 'paid_private') === 0 ))
          foreach ($league['applicants'] as $applicants)
          {
            echo '<li class="inUL">'.$applicants->username.'<br>'.
						'<button class="acc" type="submit" name="accept" value="'.
						$league['id'].'_'.$applicants->id.'">'.
						'Accept.</button> '.
						'<button class="rej" type="submit" name="reject" value="'.
						$league['id'].'_'.$applicants->id.'">'.
						'Reject.</button>'.
						'</li>';
            //dodati gumbe za prihvat odnosno odbijanje aplikanata
          }
					echo '</ul></td>';


        echo '</tr>';

      }

	?>
</table>
</form>


<script>




$(document).ready(function()
{

		checkClosed();

		uredi();

});


function checkClosed()
{
	var idovi = $("#idovi span");

	var allLeagueIds = [];
	var idsLen = $("#idovi span").length;

	for(var i = 0; i < idsLen; ++i)
	{

		var id = $("#idovi span").eq(i);

		allLeagueIds.push(id.html());

	}

	// $.ajax(
  //   {
  //     url: "index.php?rt=leagues/checkIfClosed",
  //     data:
  //     { allLeagueIds: allLeagueIds},
  //     method: "POST",
  //     dataType:"json",
  //     success: function( data )
  //     {
	//
  //       if( typeof(data.error) !== 'undefined')
  //       {
  //         console.log( "checkClosed :: success :: server javio grešku " + data.error );
  //         checkClosed();
  //       }
	//
  //       else
  //       {
	// 				console.log(data.status);
	//
  //       }
  //     },
  //     error: function(xhr, status)
  //     {
  //       console.log( "checkClosed :: error :: status = " + status );
  //           // Nešto je pošlo po krivu...
  //           // Ako se dogodio timeout, tj. server nije ništa poslao u zadnjih XY sekundi,
  //           // pozovi ponovno cekajPoruku.
  //            // if( status === "timeout" )
  //               checkClosed();
  //     }
	//
	//
  //   });
}

function uredi()
{

	$("body").css("background-color", "orange");
	$("table").css("background-color", "gold")
						.css("border-collapse","collapse")
						.css("border-spacing","0")
						.css("width","100%");

	$("th").css("border", "0.7px solid black")
				 .css("background-color", 'gold')
				 .css("width", "80").css("height", "40")
				 .css("text-align", "center")
				 .css("margin", "0").css("padding", "16px")
				 .css("text-transform", "uppercase")
				 .css("letter-spacing", "1.6")
				 .css("font-weight", "900")
				 .css("font-style", "italic");

	$("td").css("border", "0.5px solid black")
				 .css("background-color", 'gold')
				 .css("width", "80").css("height", "40")
				 .css("text-align", "center")
				 .css("margin", "0").css("padding", "16px")
				 .css("letter-spacing", "1.1");

	$(".league").css("background-color", 'gold')
						 .css("width", "100%")
						 .css("border","none")
						 .css("font-weight", "800").css("display", "table-cell")
						 .css("letter-spacing", "1.1")
						 .on("mouseenter", function(){
							$(this).css("opacity", "0.4");

								var td = $(this).parent();
								td.css("opacity","0.8");
						 })
						 .on("mouseleave", function(){
							$(this).css("opacity", "1");
								var td = $(this).parent();
								td.css("opacity","1");
						 });

 $(".apps").css('list-style', 'none')
					 .css('margin', '10px')
					.css("padding", '16px')
					.css('display', 'box')
				 .css("overflow", "hidden")

$(".inUL").css("padding","10px").css("margin","6px")
				.css("border-bottom","1px solid")
				.css("border-top","1px solid");

				$(".acc") .css("width", "70%")
									.css('background-color', '#3CB371')
									.css("padding", '5px')
									 .css("border","none")
									 .css("font-weight", "800")
									 .css("letter-spacing", "1.1")
									 .on("mouseenter", function(){
										$(this).css("opacity", "0.7");

									 })
									 .on("mouseleave", function(){
										$(this).css("opacity", "1");
									});

				$(".rej") .css("width", "70%")
									.css('background-color', '#FF6347')
									.css("padding", '5px')
									.css("border","none")
									.css("font-weight", "800")
									.css("letter-spacing", "1.1")
									.on("mouseenter", function(){
									$(this).css("opacity", "0.7");
									 })
									.on("mouseleave", function(){
									$(this).css("opacity", "1");
										});

$("#idovi").html("");

	var reg_open = /open/;
	var reg_closed = /closed/;

	var reg_private = /private|private_paid/;
	var reg_public = /public|public_paid/;

	var tdovi = $("td");

	for(var i = 0; i < tdovi.length; ++i)
	{
	var td = tdovi.eq(i);

		if(reg_open.test(td.html()))
		td.css("color","green").css("font-weight","800");



		else if(reg_closed.test(td.html()))
		td.css("color","red").css("font-weight","800");

		else if(reg_private.test(td.html()))
		td.css("color","red").css("font-weight","800");

		else if(reg_public.test(td.html()))
		td.css("color","green").css("font-weight","800");

		else td.css("text-transform", "capitalize").css("font-weight","600");
	}

}






</script>
<?php require_once __DIR__.'/_footer.php'; ?>
